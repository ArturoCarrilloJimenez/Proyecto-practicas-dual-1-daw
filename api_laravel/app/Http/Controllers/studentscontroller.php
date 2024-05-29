<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Models\student;

/**
 * @OA\Info(
 *             title="API Harry Potter", 
 *             version="1.0",
 *             description="Esta api se encarga de gestionar el contenido de estudiantes, profesores y casas"
 * )
 *
 * @OA\Server(url="http://127.0.0.1:8000")
 */
class studentscontroller extends Controller
{

    /**
     * Listado de todos los datos de los estudiantes.
     * @OA\Get(
     *     path="/api/student",
     *     tags={"Students"},
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="current_page",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="00df1ced-262e-49d0-87a3-0c12113acec3"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Stebbins"
     *                     ),
     *                     @OA\Property(
     *                         property="alternate_names",
     *                         type="array",
     *                         @OA\Items(type="string"),
     *                         example={}
     *                     ),
     *                     @OA\Property(
     *                         property="species",
     *                         type="string",
     *                         example="human"
     *                     ),
     *                     @OA\Property(
     *                         property="gender",
     *                         type="string",
     *                         example="male"
     *                     ),
     *                     @OA\Property(
     *                         property="houseId",
     *                         type="string",
     *                         example="f3393ae9-7234-4451-aa09-d190d069816a"
     *                     ),
     *                     @OA\Property(
     *                         property="dateOfBirth",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="yearOfBirth",
     *                         type="integer",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="wizard",
     *                         type="boolean",
     *                         example=true
     *                     ),
     *                     @OA\Property(
     *                         property="ancestry",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="eyeColour",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="hairColour",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="wand",
     *                         type="object",
     *                         @OA\Property(
     *                             property="wood",
     *                             type="string",
     *                             example=null
     *                         ),
     *                         @OA\Property(
     *                             property="core",
     *                             type="string",
     *                             example=null
     *                         ),
     *                         @OA\Property(
     *                             property="length",
     *                             type="string",
     *                             example=null
     *                         )
     *                     ),
     *                     @OA\Property(
     *                         property="patronus",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="hogwartsStudent",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="hogwartsStaff",
     *                         type="integer",
     *                         example=0
     *                     ),
     *                     @OA\Property(
     *                         property="actor",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="alternate_actors",
     *                         type="array",
     *                         @OA\Items(type="string"),
     *                         example={}
     *                     ),
     *                     @OA\Property(
     *                         property="alive",
     *                         type="boolean",
     *                         example=true
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2024-05-22T07:25:52.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2024-05-22T07:25:52.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="house",
     *                         type="string",
     *                         example="Ravenclaw"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="first_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/student?page=1"
     *             ),
     *             @OA\Property(
     *                 property="from",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="last_page",
     *                 type="integer",
     *                 example=9
     *             ),
     *             @OA\Property(
     *                 property="last_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/student?page=9"
     *             ),
     *             @OA\Property(
     *                 property="links",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
     *                         property="url",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="label",
     *                         type="string",
     *                         example="&laquo; Previous"
     *                     ),
     *                     @OA\Property(
     *                         property="active",
     *                         type="boolean",
     *                         example=false
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="next_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/student?page=2"
     *             ),
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/student"
     *             ),
     *             @OA\Property(
     *                 property="per_page",
     *                 type="integer",
     *                 example=12
     *             ),
     *             @OA\Property(
     *                 property="prev_page_url",
     *                 type="string",
     *                 example=null
     *             ),
     *             @OA\Property(
     *                 property="to",
     *                 type="integer",
     *                 example=12
     *             ),
     *             @OA\Property(
     *                 property="total",
     *                 type="integer",
     *                 example=101
     *             )
     *         )
     *     )
     * )
     */
    public function getStudent()
    {
        return response()->json(student::select('students.*', 'houses.name as house')->leftJoin('houses', 'students.houseId', '=', 'houses.id')->where('hogwartsStudent', true)->paginate(12), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/student/{id}",
     *     operationId="getStudentById",
     *     tags={"Students"},
     *     summary="Obtiene un estudiante por su ID",
     *     description="Retorna los detalles de un estudiante específico de Hogwarts por ID, incluyendo información completa del estudiante y la casa a la que pertenece.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del estudiante",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                         property="id",
     *                         type="string",
     *                         example="00df1ced-262e-49d0-87a3-0c12113acec3"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Stebbins"
     *                     ),
     *                     @OA\Property(
     *                         property="alternate_names",
     *                         type="array",
     *                         @OA\Items(type="string"),
     *                         example={}
     *                     ),
     *                     @OA\Property(
     *                         property="species",
     *                         type="string",
     *                         example="human"
     *                     ),
     *                     @OA\Property(
     *                         property="gender",
     *                         type="string",
     *                         example="male"
     *                     ),
     *                     @OA\Property(
     *                         property="houseId",
     *                         type="string",
     *                         example="f3393ae9-7234-4451-aa09-d190d069816a"
     *                     ),
     *                     @OA\Property(
     *                         property="dateOfBirth",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="yearOfBirth",
     *                         type="integer",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="wizard",
     *                         type="boolean",
     *                         example=true
     *                     ),
     *                     @OA\Property(
     *                         property="ancestry",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="eyeColour",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="hairColour",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="wand",
     *                         type="object",
     *                         @OA\Property(
     *                             property="wood",
     *                             type="string",
     *                             example=null
     *                         ),
     *                         @OA\Property(
     *                             property="core",
     *                             type="string",
     *                             example=null
     *                         ),
     *                         @OA\Property(
     *                             property="length",
     *                             type="string",
     *                             example=null
     *                         )
     *                     ),
     *                     @OA\Property(
     *                         property="patronus",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="hogwartsStudent",
     *                         type="integer",
     *                         example=1
     *                     ),
     *                     @OA\Property(
     *                         property="hogwartsStaff",
     *                         type="integer",
     *                         example=0
     *                     ),
     *                     @OA\Property(
     *                         property="actor",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="alternate_actors",
     *                         type="array",
     *                         @OA\Items(type="string"),
     *                         example={}
     *                     ),
     *                     @OA\Property(
     *                         property="alive",
     *                         type="boolean",
     *                         example=true
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example=null
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2024-05-22T07:25:52.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2024-05-22T07:25:52.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="house",
     *                         type="string",
     *                         example="Ravenclaw"
     *                     )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Registro no encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="Message",
     *                 type="string",
     *                 example="Registro no encontrado"
     *             )
     *         )
     *     )
     * )
     */
    public function getStudentxid($id)
    {
        $student = student::where('hogwartsStudent', true)->find($id);
        if (!$student) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        return response()->json(student::select('students.*', 'houses.name as house')->leftJoin('houses', 'students.houseId', '=', 'houses.id')->find($id), 200);
    }

    public function getPersonxName($name)
    {
        return response()->json(student::select('students.*')->where('name', $name)->get(), 200);
    }

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
