<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\student;

use function Laravel\Prompts\select;

class staffcontroller extends Controller
{
    public function getStaff() {
        return response()->json(student::select('students.*', 'houses.name as house')->leftJoin('houses', 'students.houseId', '=', 'houses.id')->where('hogwartsStaff',true)->paginate(12),200);
    }
    
    public function getStaffxid($id) {
        $categoria =student::where('hogwartsStaff',true)->find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        return response()->json(student::select('students.*', 'houses.name as house')->leftJoin('houses', 'students.houseId', '=', 'houses.id')->find($id),200);
    }

    // Funcion que inserta un solo estudiante
    public function insertStaff(Request $request) {
        // Manejo para un solo estudiante, si es necesario
        $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
        $request['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
        $request['hogwartsStudent'] = false;
        $request['hogwartsStaff'] = true;
        $student = Student::create($request->all());
        return response($student, 200);
    }

    // Funcion para portar un array de estudiantes
    public function portStaff(Request $request) {
        $students = [];
        foreach ($request->all() as $data) {
            $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
            $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
            $data['hogwartsStudent'] = false;
            $data['hogwartsStaff'] = true;
            $students[] = Student::create($data);
        }
        return response()->json($students, 200);
    }

    public function updateStaff(Request $request, $id) {
        $categoria = student::where('hogwartsStaff',true)->find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        $request['hogwartsStudent'] = false;
        $request['hogwartsStaff'] = true;
        $categoria->update($request->all());
        return response($categoria, 200);
    }
}
