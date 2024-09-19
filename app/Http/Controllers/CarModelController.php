<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarModelFilterRequest;
use App\Http\Requests\CarModelRequest;
use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = CarModel::with(['brand', 'engine', 'transmission'])->orderBy('id', 'desc')->paginate(15);
        return response()->json([
            'data'   => $cars,
            'status' => true
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarModelRequest $request)
    {
        $carModel = CarModel::create($request->only([
            'brand_id', 
            'price', 
            'year', 
            'engine_id', 
            'transmission_id', 
            'exterior_color', 
            'interior_color'
        ]));

        return response()->json([
            'status' => true,
            'data'   => $carModel
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarModel $car)
    {
        return response()->json([
            'status' => true,
            'data'   => $car->load(['brand', 'engine', 'transmission'])
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CarModelRequest $request, CarModel $car)
    {
        $car->update($request->only([
            'brand_id', 
            'price', 
            'year', 
            'engine_id', 
            'transmission_id', 
            'exterior_color', 
            'interior_color'
        ]));

        return response()->json([
            'status' => true,
            'data'   => $car
        ], Response::HTTP_OK);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarModel $car)
    {
        $car->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data has successfully deleted'
        ], Response::HTTP_NO_CONTENT);
    }

    public function filter(CarModelFilterRequest $request)
    {
        // dd($request->all());
        $query = CarModel::query();

        
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

               
        if ($request->filled('year_from') && $request->filled('year_to')) {
            $query->whereBetween('year', [$request->year_from, $request->year_to]);
        }

        
        if ($request->filled('price_min') && $request->filled('price_max')) {
            $query->whereBetween('price', [$request->price_min, $request->price_max]);
        }

       
        if ($request->filled('engine_id')) {
            $query->where('engine_id', $request->engine_id);
        }

        
        if ($request->filled('transmission_id')) {
            $query->where('transmission_id', $request->transmission_id);
        }

       
        if ($request->filled('exterior_color')) {
            $query->where('exterior_color', 'like', '%' . $request->exterior_color . '%');
        }
       
        if ($request->filled('interior_color')) {
            $query->where('interior_color', 'like', '%' . $request->interior_color . '%');
        }
        $cars = $query->with(['brand', 'engine', 'transmission'])->paginate(15);

        return response()->json([
            'status' => true,
            'data'   => $cars
        ], Response::HTTP_OK);
    }

    public function interiorColors()
    {
        $interiorColors = CarModel::select('interior_color')->distinct()->pluck('interior_color');
        return response()->json([
            'status' => true,
            'data' => $interiorColors
        ]);
    }

    public function exteriorColors()
    {
        $exteriorColors = CarModel::select('exterior_color')->distinct()->pluck('exterior_color');
        return response()->json([
            'status' => true,
            'data' => $exteriorColors
        ]);
    }

}
