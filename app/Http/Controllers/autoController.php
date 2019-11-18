<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\auto;

class autoController extends Controller
{
    public function index(){
        $marcas=auto::all()->last();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'marca'=>$marcas
        ],200);
    }
}
