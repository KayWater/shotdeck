<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Region;

class RegionController extends Controller
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

    public function getRegionAll(Request $request)
    {
        $regions = Region::all();

        return response()->json([
            'regions' => $regions
        ]);
    }

}