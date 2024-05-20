<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\student;

class studentscontroller extends Controller
{
    public function getStudent() {
        return response()->json(student::all(),200);
    }
    
    public function getStudentxid($id) {
        $categoria =student::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        return response()->json(student::find($id),200);
    }

    public function insertStudent(Request $request) {
        // Verificar si la entrada es un array de estudiantes
        if(is_array($request->all())) {
            $students = [];
            foreach ($request->all() as $data) {
                $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
                $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
                $students[] = Student::create($data);
            }
            return response()->json($students, 200);
        } else {
            // Manejo para un solo estudiante, si es necesario
            $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
            $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
            $student = Student::create($request->all());
            return response($student, 200);
        }
    }

    public function updateStudent(Request $request, $id) {
        $categoria = student::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        $categoria->update($request->all());
        return response($categoria, 200);
    }

    public function deleteStudent($id) {
        $categoria = student::find($id);
        if (!$categoria) {
            return response()->json(['Message'=>'Registro no encontrado'],404);
        }
        $categoria->delete();
        return response()->json(['Message'=>'Registro eliminado correctamente'],200);
    }
}
