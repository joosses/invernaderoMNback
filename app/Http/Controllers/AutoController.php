<?php

namespace App\Http\Controllers;

use App\Auto;

class AutoController extends Controller
{
    public function index()
    {
        $marcas = Auto::all()->last();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'marca' => $marcas
        ], 200);
    }
}
