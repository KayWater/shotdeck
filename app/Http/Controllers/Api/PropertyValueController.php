<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Property;
use App\Models\PropertyValue;

class PropertyValueController extends Controller
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

        $count = PropertyValue::count();

        $propertyValues = PropertyValue::with('property:id,name')->limit($limit)->offset($offset)->get();

        return response()->json([
            'propertyValues' => $propertyValues,
            'count' => $count
        ]);
    }

    public function store(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        $name = $request->input('name');

        $propertyValue = new PropertyValue();
        $propertyValue->property_id = $id;
        $propertyValue->name = $name;
        $propertyValue->status = 1;
        $propertyValue->order = 1;

        $propertyValue->save();

        return response()->json([
            'propertyValue' => $propertyValue
        ]);
    }

    public function show(Request $request, $id) {

        $propertyValue = PropertyValue::with('property:id,name')->findOrFail($id);

        return response()->json([
            'propertyValue' => $propertyValue
        ]);
    }

    public function update(Request $request, $id) {
        $propertyValue = PropertyValue::findOrFail($id);
        $name = $request->input('name');
        $propertyValue->name = $name;

        $propertyValue->save();

        return response()->json([
            'propertyValue' => $propertyValue
        ]);
    }
}