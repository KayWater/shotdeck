<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Person;

class PersonController extends Controller
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
    }

    public function store(Request $request)
    {

        $name = $request->input('name');
        $nameEn = $request->input('nameEn');
        $gender = $request->input('gender');
        $country = $request->input('country');
        $birthday = $request->input('birthday');

        $person = Person::where('name', $name)->firstOrNew();
        if ($person->exists) {
            return response()->json([
                'message'=> '系统已有同名演职员，请勿重复添加',
            ], 400);
        }

        $person->name = $name;
        $person->name_en = $nameEn;
        $person->gender = $gender;
        $person->country_id = $country;
        $person->birthday = $birthday;

        $person->save();

        return response()->json([
            'person' => $person
        ]);
    }

    public function show(Request $request, $id) 
    {

    }

    public function update(Request $request, $id) 
    {

    }

    public function getValues(Request $request, $id) 
    {
        
    }

    public function search(Request $request)
    {
        $queryStr = $request->query('query');

        $people = Person::when($queryStr, function($query, $queryStr) {
            return $query->where('name', 'like', '%' . $queryStr . '%')
                ->orWhere('name_en', 'like', '%' . $queryStr . '%');
        })->get();

        return response()->json([
            'people' => $people
        ]);
    }
}