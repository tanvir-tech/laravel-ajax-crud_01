<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

class TeacherController extends Controller
{
    
    function listTeacher(Request $req){
        $data = Teacher::orderBy('id','DESC')->get();
        return response()->json($data);
    }
}
