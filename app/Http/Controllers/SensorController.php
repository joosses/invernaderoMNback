<?php

namespace App\Http\Controllers;

use App\Invernadero;
use App\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorController extends Controller
{
    public function show($id)
    {
        $sensor = Sensor::find($id);
        if (is_object($sensor)) {
            $data = [
                'code' => 200,
                'status' => 'success',
                'tiempo' => $sensor->tiempo
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

    public function lista($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $sensor = Sensor::where('invernadero_id_invernadero', $var)->all();
        return response()->json([
            'code' => 200,
            'status' => 'success',
            'sensor' => $sensor
        ], 200);
    }

    public function showTemperaturaMin($id)
    {
        $invernadero = Invernadero::where('usuario_id_usuario', $id)->first();
        $var = $invernadero->id;
        $sensor = Sensor::where('nombre', 'temperatura')->where('invernadero_id_invernadero', $var)->first();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tiempo' => $sensor
        ], 200);
    }

    public function showHumedadMin($id)
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

    public function showHumedadSueloMin($id)
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

    public function update($id, Request $request)
    {
        //Recoger datos por post
        $json = $request->input('json', null);
        $params_array = json_decode($json, true);

        if (!empty($params_array)) {
            //Validar los datos s
            $validate = Validator::make($params_array, [
                'id' => 'required',
            ]);

            //unset($params_array['id']);

            //actualizar el registro de modelo
            $sensor = Sensor::where('id', $id)->update($params_array);

            $data = [
                'code' => 200,
                'status' => 'success',
                'sensor' => $params_array
            ];
        } else {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'No has enviado ningun sensor.'
            ];
        }
        return response()->json($data, $data['code']);
    }

    public function nuevo(Request $request)
    {
        //Recoger los datos por post
        $nombre = $request->input("nombre");
        $estado = $request->input("estado");
        $caracteristica = $request->input("caracteristica");
        $invernadero_id_invernadero = $request->input("invernadero_id_invernadero");
        $tiempo = $request->input("tiempo");
        $minimo = $request->input("minimo");
        $maximo = $request->input("maximo");

        //en caso de no haber errores, guarda la medicion en la base de datos
        $sensor = new sensor();
        $sensor->nombre = $nombre;

        $sensor->estado = $estado;
        $sensor->caracteristica = $caracteristica;
        $sensor->invernadero_id_invernadero = $invernadero_id_invernadero;
        $sensor->tiempo = $tiempo;
        $sensor->minimo = $minimo;
        $sensor->maximo = $maximo;

        $sensor->save();
    }

    public function register(Request $request)
    {
        //recoger los datos del Sensor enviados por post
        $json = $request->input('json', null);
        $params = json_decode($json);               //decodifica los datos en un objeto
        $params_array = json_decode($json, true);    //decodifica los datos en un array

        //limpiar datos (quita espacios en blanco)
        $params_array = array_map('trim', $params_array);

        //validar datos
        if (!empty($params) && !empty($params_array)) {
            $validate = Validator::make($params_array, [
                'nombre'      => 'required|alpha',
                'invernadero_id_invernadero'   => 'required|numeric',
            ]);

            if ($validate->fails()) {
                $data = array(
                    'status' => 'error',
                    'code'   => 404,
                    'message' => 'El Sensor no se ha creado',
                    'errores' => $validate->errors()
                );
            } else {
                //crear el Sensor
                $sen = new sensor();
                $sen->nombre = $params_array['nombre'];
                $sen->estado = $params_array['estado'];
                $sen->caracteristica = $params_array['caracteristica'];
                $sen->invernadero_id_invernadero = $params_array['invernadero_id_invernadero'];
                $sen->tiempo = $params_array['tiempo'];
                $sen->minimo = $params_array['minimo'];
                $sen->maximo = $params_array['maximo'];

                //guardar el Sensor
                $sen->save();

                $data = array(
                    'status' => 'success',
                    'code'   => 200,
                    'message' => 'El Sensor se ha creado',
                    'usuario'   => $sen
                );
            }
        } else {
            $data = array(
                'status' => 'error',
                'code'   => 404,
                'message' => 'Los datos no se han ingresado correctamente',
            );
        }

        return response()->json($data, $data['code']);
    }
}
