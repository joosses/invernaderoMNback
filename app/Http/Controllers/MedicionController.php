<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Medicion;
use App\Invernadero;
use App\Sensor;

class MedicionController extends Controller
{
    public function index()
    {
        $medicions = Medicion::all()->last();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicions
        ], 200);
    }

    public function show($id)
    {
        $medicions = Medicion::find($id);

        if (is_object($medicions)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'estado' => $medicions->estado
            ];
        } else {
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'El tiempo  no existe'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function grafica()
    {
        $medicions = Medicion::all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicions
        ], 200);
    }

    public function graficaTemperatura($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'temperatura')->where('chipid', $var)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function graficaHumedad($id)
    {

        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'humedad')->where('chipid', $var)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function graficaHumedadSuelo($id)
    {

        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'humedad suelo')->where('chipid', $var)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function graficaCo2(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'co2')->where('chipid', $var)->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function showHumedadMin(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $sensor = Sensor::where('nombre', 'humedad')->where('invernadero_id_invernadero', $var)->first();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $sensor
        ], 200);
    }

    public function showHumedadSueloMin(int $id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $sensor = Sensor::where('nombre', 'humedadsuelo')->where('invernadero_id_invernadero', $var)->first();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $sensor
        ], 200);
    }

    public function showCo2Min($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $sensor = Sensor::where('nombre', 'co2')->where('invernadero_id_invernadero', $var)->first();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $sensor
        ], 200);
    }

    public function medicionTemperatura(Request $request)
    {
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion = new medicion();
        $medicion->valor = $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo = $tiempo;
        $medicion->chipid = $chipid;
        $medicion->nombre = "Temperatura";
        $medicion->save();
    }

    public function medicionHumedad(Request $request)
    {
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion = new medicion();
        $medicion->valor = $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo = $tiempo;
        $medicion->chipid = $chipid;
        $medicion->nombre = "Humedad";
        $medicion->save();
    }

    public function medicionSuelo(Request $request)
    {
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion = new medicion();
        $medicion->valor = $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo = $tiempo;
        $medicion->chipid = $chipid;
        $medicion->nombre = "Humedad Suelo";
        $medicion->save();
    }

    public function medicionCo2(Request $request)
    {
        //Recoger los datos por post
        $chipid = $request->input("chipid");
        $valor = $request->input("valor");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $medicion = new medicion();
        $medicion->valor = $valor;
        $tiempo = date('Y-m-d H:i:s');
        $medicion->tiempo = $tiempo;
        $medicion->chipid = $chipid;
        $medicion->nombre = "Co2";
        $medicion->save();
    }

    public function prueba()
    {
        $data = "";
        if (isset($_POST['chipid'])) {
            $chipid = $_POST['chipid'];
            $valor = $_POST['valor'];


            $medicion = new medicion();
            $medicion->chipid = $chipid;
            $medicion->valor =  $valor;
            $tiempo = date('Y-m-d H:i:s');
            $medicion->tiempo = $tiempo;

            $medicion->save();


            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'LO himos we.',
                'medicion' => $medicion
            ];
        } else {
            $medicion = new medicion();
            $medicion->chipid = 2;
            $medicion->valor =  2;
            $tiempo = date('Y-m-d H:i:s');
            $medicion->tiempo = $tiempo;

            $medicion->save();
        }
        $data = [
            'code' => 400,
            'status' => 'error',
            'message' => 'No has enviado ninguna entrevista.'
        ];
    }

    public function ultimaTemperatura($id)
    {

        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'temperatura')->where('chipid', $var)->get()->last();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function ultimaHumedad($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'humedad')->where('chipid', $var)->get()->last();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function ultimaHumedadSuelo($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'humedad suelo')->where('chipid', $var)->get()->last();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }

    public function ultimaCo2($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->chipid;
        $medicion = Medicion::where('nombre', 'co2')->where('chipid', $var)->get()->last();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'medicion' => $medicion
        ], 200);
    }
}
