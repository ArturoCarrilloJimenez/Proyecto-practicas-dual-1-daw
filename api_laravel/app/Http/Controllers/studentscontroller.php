<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\student;

class studentscontroller extends Controller
{
    public function getStudent()
    {
        return response()->json(student::select('students.*', 'houses.name as house')->leftJoin('houses', 'students.houseId', '=', 'houses.id')->where('hogwartsStudent', true)->paginate(12), 200);
    }

    public function getStudentxid($id)
    {
        $categoria = student::where('hogwartsStudent', true)->find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        return response()->json(student::find($id), 200);
    }

    // Funcion que inserta un solo estudiante
    public function insertStudent(Request $request)
    {
        // Manejo para un solo estudiante, si es necesario
        $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
        $request['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
        $request['hogwartsStudent'] = true;
        $request['hogwartsStaff'] = false;
        $student = Student::create($request->all());
        return response($student, 200);
    }

    // Funcion para portar un array de estudiantes
    public function portStudent(Request $request)
    {
        $students = [];
        foreach ($request->all() as $data) {
            $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
            $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
            $data['hogwartsStudent'] = true;
            $data['hogwartsStaff'] = false;
            $students[] = Student::create($data);
        }
        return response()->json($students, 200);
    }

    public function updateStudent(Request $request, $id)
    {
        $categoria = student::where('hogwartsStudent', true)->find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        $request['hogwartsStudent'] = true;
        $request['hogwartsStaff'] = false;
        $categoria->update($request->all());
        return response($categoria, 200);
    }

    public function deletePerson($id)
    {
        $categoria = student::where('hogwartsStudent', true)->find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        $categoria->delete();
        return response()->json(['Message' => 'Registro eliminado correctamente'], 200);
    }
}
