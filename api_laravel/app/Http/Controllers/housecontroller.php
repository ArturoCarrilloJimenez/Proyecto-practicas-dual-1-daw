<?php

namespace App\Http\Controllers;

use App\Models\house;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class housecontroller extends Controller
{
    public function getHouse() {
        return response()->json(house::paginate(10),200);
    }
    
    public function getHousexid($id) {
        $categoria =house::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        return response()->json(house::find($id),200);
    }

    // Funcion que inserta una sola casa
    public function insertHouse(Request $request) {
        $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
        $request['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
        $house = house::create($request->all());
        return response($house, 200);
    }

    // Funcion para portar un array de casas
    public function portHouse(Request $request) {
        $house = [];
        foreach ($request->all() as $data) {
            $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
            $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
            $house[] = house::create($data);
        }
        return response()->json($house, 200);
    }

    public function updateHouse(Request $request, $id) {
        $categoria = house::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        $categoria->update($request->all());
        return response($categoria, 200);
    }

    public function deletehouse($id) {
        $categoria = house::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        $categoria->delete();
        return response()->json(['Message'=>'Registro eliminado correctamente'],200);
    }
}
