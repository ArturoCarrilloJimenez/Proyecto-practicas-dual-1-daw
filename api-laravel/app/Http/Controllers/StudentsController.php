<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;

class StudentsController extends Controller
{
    public function getStudent() {
        return response()->json(Students::all(),200);
    }
}
