<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Country;

class CountryController extends Controller
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

    }

    public function show(Request $request, $id) 
    {

    }

    public function update(Request $request, $id) 
    {
    }

    public function getCountryAll(Request $request)
    {
        $countries = Country::all();

        return response()->json([
            'countries' => $countries
        ]);
    }

}