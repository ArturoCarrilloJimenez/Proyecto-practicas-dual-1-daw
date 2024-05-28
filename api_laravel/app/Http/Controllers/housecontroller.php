<?php

namespace App\Http\Controllers;

use App\Models\house;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;

class housecontroller extends Controller
{
    /**
     * Listado de todos los datos de las casas de Hogwarts.
     * @OA\Get(
     *     path="/api/houses",
     *     tags={"Houses"},
     *     @OA\Response(
     *         response=200,
     *         description="Un listado paginado de casas de Hogwarts.",
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
     *                         example="0763e821-09ea-4fc8-bac1-d8fc70c3e4b4"
     *                     ),
     *                     @OA\Property(
     *                         property="name",
     *                         type="string",
     *                         example="Hufflepuff"
     *                     ),
     *                     @OA\Property(
     *                         property="puntos",
     *                         type="integer",
     *                         example=24
     *                     ),
     *                     @OA\Property(
     *                         property="image",
     *                         type="string",
     *                         example="https://i.pinimg.com/736x/39/80/92/398092891a39c67b1241734c5fea6843.jpg"
     *                     ),
     *                     @OA\Property(
     *                         property="created_at",
     *                         type="string",
     *                         example="2024-05-22T07:06:45.000000Z"
     *                     ),
     *                     @OA\Property(
     *                         property="updated_at",
     *                         type="string",
     *                         example="2024-05-22T07:06:45.000000Z"
     *                     )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="first_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/houses?page=1"
     *             ),
     *             @OA\Property(
     *                 property="from",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="last_page",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="last_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/houses?page=1"
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
     *                 example=null
     *             ),
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/houses"
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
     *                 example=4
     *             ),
     *             @OA\Property(
     *                 property="total",
     *                 type="integer",
     *                 example=4
     *             )
     *         )
     *     )
     * )
     */
    public function getHouse()
    {
        return response()->json(house::paginate(12), 200);
    }

    /**
     * @OA\Get(
     *     path="/api/house/{id}",
     *     tags={"Houses"},
     *     summary="Obtiene una casa por su ID",
     *     description="Retorna los detalles de una casa específico de Hogwarts por ID, incluyendo información de los mienbros que pertenecen a este",
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
     *                 property="current_page",
     *                 type="integer",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(
     *                     @OA\Property(
 *                 property="id",
 *                 type="string",
 *                 example="0763e821-09ea-4fc8-bac1-d8fc70c3e4b4"
 *             ),
 *             @OA\Property(
 *                 property="name",
 *                 type="string",
 *                 example="Hufflepuff"
 *             ),
 *             @OA\Property(
 *                 property="puntos",
 *                 type="integer",
 *                 example=24
 *             ),
 *             @OA\Property(
 *                 property="image",
 *                 type="string",
 *                 example="https://i.pinimg.com/736x/39/80/92/398092891a39c67b1241734c5fea6843.jpg"
 *             ),
 *             @OA\Property(
 *                 property="student",
 *                 type="string",
 *                 example="Hannah Abbott"
 *             ),
 *             @OA\Property(
 *                 property="studentImg",
 *                 type="string",
 *                 example=null
 *             ),
 *             @OA\Property(
 *                 property="studentId",
 *                 type="string",
 *                 example="0a9fe88e-7738-46a7-a8af-592598ce9475"
 *             ),
 *             @OA\Property(
 *                 property="created_at",
 *                 type="string",
 *                 example="2024-05-22T07:06:45.000000Z"
 *             ),
 *             @OA\Property(
 *                 property="updated_at",
 *                 type="string",
 *                 example="2024-05-22T07:06:45.000000Z"
 *             )
     *                 )
     *             ),
     *             @OA\Property(
     *                 property="first_page_url",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/staff?page=1"
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
     *                 example="http://127.0.0.1:8000/api/staff?page=9"
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
     *                 example="http://127.0.0.1:8000/api/staff?page=2"
     *             ),
     *             @OA\Property(
     *                 property="path",
     *                 type="string",
     *                 example="http://127.0.0.1:8000/api/staff"
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
     *                 example=23
     *             )
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
    public function getHousexid($id)
    {
        $categoria = house::find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        return response()->json(house::select('students.name as student', 'students.image as studentImg', 'students.id as studentId', 'houses.*')->join('students', 'students.houseId', '=', 'houses.id')->where('houses.id', $id)->paginate(12), 200);
    }

    // Funcion que inserta una sola casa
    public function insertHouse(Request $request)
    {
        $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
        $request['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
        $house = house::create($request->all());
        return response($house, 200);
    }

    // Funcion para portar un array de casas
    public function portHouse(Request $request)
    {
        $house = [];
        foreach ($request->all() as $data) {
            $uuid = Uuid::uuid4()->toString(); // Genera la clave uuid que es lo mismo que el id
            $data['id'] = $uuid;  // Asumiendo que el modelo Student tiene un atributo 'id' donde se guarda el UUID
            $house[] = house::create($data);
        }
        return response()->json($house, 200);
    }

    public function updateHouse(Request $request, $id)
    {
        $categoria = house::find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        $categoria->update($request->all());
        return response($categoria, 200);
    }

    public function deletehouse($id)
    {
        $categoria = house::find($id);
        if (!$categoria) {
            return response()->json(['Message' => 'Registro no encontrado'], 404);
        }
        $categoria->delete();
        return response()->json(['Message' => 'Registro eliminado correctamente'], 200);
    }
}
