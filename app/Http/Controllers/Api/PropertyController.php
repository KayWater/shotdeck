<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PropertyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        $limit = $request->query('limit', 20);
        $offset = $request->query('offset', 0);

        $count = Property::count();

        $properties = Property::limit($limit)->offset($offset)->get();

        return response()->json([
            'properties' => $properties,
            'count' => $count
        ]);
    }

    public function store(Request $request)
    {

        $name = $request->input('name');

        $property = new Property();
        $property->name = $name;
        $property->parent_id = 0;
        $property->path = '-';
        $property->status = 1;

        $property->save();

        return response()->json([
            'property' => $property
        ]);
    }

    public function show(Request $request, $id) {

        $property = Property::findOrFail($id);

        return response()->json([
            'property' => $property
        ]);
    }

    public function update(Request $request, $id) {
        $property = Property::findOrFail($id);
        $name = $request->input('name');
        $property->name = $name;

        $property->save();

        return response()->json([
            'property' => $property
        ]);
    }

    public function getValues(Request $request, $id) {
        $property = Property::findOrFail($id);

        $property->load('values');

        return response()->json([
            'property' => $property
        ]);
    }

    public function query(Request $request)
    {
        $names = $request->query('name');

        $properties = Property::with('values')->whereIn('name', $names)->get();

        return response()->json([
            'properties' => $properties,
        ]);
    }
}