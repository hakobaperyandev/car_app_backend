<?php

namespace App\Http\Controllers;

use App\Models\Transmission;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TransmissionController extends Controller
{
    public function index()
    {
        $engines = Transmission::all();
        return response()->json([
            'status' => true,
            'data'   => $engines
        ], Response::HTTP_OK);
    }
}
