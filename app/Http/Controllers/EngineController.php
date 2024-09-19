<?php

namespace App\Http\Controllers;

use App\Models\Engine;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EngineController extends Controller
{
    public function index()
    {
        $engines = Engine::all();
        return response()->json([
            'status' => true,
            'data'   => $engines
        ], Response::HTTP_OK);
    }
}
