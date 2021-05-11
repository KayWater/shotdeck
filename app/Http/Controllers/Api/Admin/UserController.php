<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;

class UserController extends Controller
{
    /**
     * Create a new controller instance
     */
    public function __construct()
    {
        
    }

    /**
     * Get users
     * 
     * @param   \Illuminate\Http\Request $request
     * @return  Response
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit');
        $offset = $request->query('offset');

        $search = $request->query('search');
        if ($search) {
            $total =  $total = User::where('name', 'like', "%$search%")
                ->orWhere('employee_id', '=', $search)
                ->count();

            $users = User::with('department:id,name')->where('name', 'like', "%$search%")
                ->orWhere('employee_id', '=', $search)
                ->limit($limit)
                ->offset($offset)
                ->get();
        } else {
            $total = User::count();
            $users = User::with('department:id,name')->limit($limit)->offset($offset)->get();
        }

        return response()->json([
            'users' => $users,
            'total' => $total,
        ]);
    }

    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Search user
     */
    public function search(Request $request)
    {
        $limit = $request->query('limit');
        $offset = $request->query('offset');
        $search = $request->query('search');

        $total = User::where('name', 'like', "%$search%")
            ->orWhere('employee_id', '=', $search)
            ->count();

        $users = User::with('department:id,name')->where('name', 'like', "%$search%")
            ->orWhere('employee_id', '=', $search)
            ->limit($limit)
            ->offset($offset)
            ->get();

        return response()->json([
            'users' => $users,
            'total' => $total,
        ]);

        /**
         * scope: notInGroup
         */
    }

    /**
     * Get current user
     * 
     * @param   \Illuminate\Http\Request $request
     * @return  Response
     */
    
    public function getCurrentUser(Request $request)
    {
        try {
            $user = Auth::guard('admin')->user();

            // $user->load('roles:id,name',);
        
            return response()->json([
                'user' => $user,
            ]);
        } catch (Exception $error) {
            dd($error);
        }
    }

    /**
     * Create user
     * 
     * @param   StoreUserRequest $request
     * @return  Response
     */
    public function store(StoreUserRequest $request)
    {
        $password = $request->input('password');
        
        $this->authorize('create', User::class);

        $user = new User();
        $user->name = $request->input('name');
        $user->employee_id = $request->input('employeeId');
        $user->department_id = $request->input('departmentId', 0);
        $user->email = $request->input('email');
        $entryDate = $request->input('entryDate');
        $user->entry_date = $entryDate ? Carbon::createFromTimestampMs($entryDate) : Carbon::now();
        $user->password = bcrypt($password);
        $user->save();

        return response()->json([
            'user' => $user
        ]);
    }

    /**
     * Update user
     * 
     * @param   UpdateUserRequest $request
     * @param   Integer $id
     * @return  Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', User::class);

        $entryDate = $request->input('entryDate');
        $resignationDate = $request->input('resignationDate');
        
        $user->name = $request->input('name');
        $user->employee_id = $request->input('employeeId');
        $user->department_id = $request->input('departmentId', 0);
        $user->entry_date = $entryDate ? Carbon::createFromFormat('Y-m-d H:i:s', $entryDate) : null;
        $user->resignation_date = $resignationDate ? Carbon::createFromFormat('Y-m-d H:i:s', $resignationDate) : null;
        $user->status = $resignationDate ? User::RESIGNED_STATUS : User::ON_THE_JOB_STATUS;
        $user->email = $request->input('email');
        $user->save();

        return response()->json([
            'user' => $user->load('department')
        ]);
    }

    /**
     * Get roles the user have
     * 
     * @param   \Illuminate\Http\Request $request
     * @param   Integer $id
     * @return  Response
     */
    public function getRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $roles = $user->roles->makeHidden('pivot')
            ->load('permissions:id,name');

        return response()->json([
            'roles' => $roles,
        ]);
    }

    /**
     * Get permissions the user have
     * 
     * @param   \Illuminate\Http\Request  $request
     * @param   Integer $id
     * @return  Response
     */
    public function getPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $directPermissions = $user->getDirectPermissions();
        $directPermissions = $directPermissions->map(function($item) {
            $item['is_direct'] = true;
            return $item->makeHidden('pivot');
        });

        $rolesPermissions = $user->getPermissionsViaRoles();
        $rolesPermissions = $rolesPermissions->map(function($item) {
            $item['is_direct'] = false;
            return $item->makeHidden('pivot');
        });

        $permissions = $directPermissions->concat($rolesPermissions);

        return response()->json([
            'permissions' => $permissions,
        ]);
    }

    /**
     * Get direct permissions the user have
     * 
     * @param   \Illuminate\Http\Request  $request
     * @param   Integer $id
     * @return  Response
     */
    public function getDirectPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $permissions = $user->getDirectPermissions();

        return response()->json([
            'permissions' => $permissions,
        ]);
    }

    /**
     * Grant roles to user
     * 
     * @param   \Illuminate\Http\Request $request
     * @param   Integer $id
     * @return  Response
     */
    public function grantRoles(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $roles = $request->input('roles');

        $user->syncRoles($roles);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Cancel role from user
     */
    public function cancelRole(Request $request, $id, $roleId)
    {
        $user = User::findOrFail($id);

        $user->removeRole($roleId);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Grant permissions to user
     * 
     * @param   \Illuminate\Http\Request $request
     * @param   Integer $id
     * @return  Response
     */
    public function grantPermissions(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $permissions = $request->input('permissions');

        $user->syncPermissions($permissions);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * Cancel permission from user
     */
    public function cancelPermission(Request $request, $id, $permissionId)
    {
        $user = User::findOrFail($id);

        $user->revokePermissionTo($permissionId);

        return response()->json([
            'user' => $user,
        ]);
    }
}