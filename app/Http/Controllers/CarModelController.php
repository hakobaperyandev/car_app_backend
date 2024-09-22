<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarModelFilterRequest;
use App\Http\Requests\CarModelRequest;
use App\Http\Resources\CarModelResource;
use App\Models\CarModel;
use App\Repositories\CarModelRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CarModelController extends Controller
{

    protected $carModelRepository;
    public function __construct(CarModelRepositoryInterface $carModelRepository)
    {
        $this->carModelRepository = $carModelRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cars = $this->carModelRepository->all($request);
        return CarModelResource::collection($cars)
                ->response()
                ->setStatusCode(Response::HTTP_OK);
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
