<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;

class studentscontroller extends Controller
{
    public function getStudent() {
        return response()->json(student::all(),200);
    }
}
