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


    function addTeacher(Request $req){

        $req->validate([
            'name'=>'required',
            'title'=>'required',
            'department'=>'required',
            'institute'=>'required'
        ]);

        $data = Teacher::insert([
            'name'=>$req->name,
            'title'=>$req->title,
            'department'=>$req->department,
            'institute'=>$req->institute
        ]);

        return $data;
    }


    function editTeacher($id){

        $data = Teacher::findOrFail($id);
        return response()->json($data);
    }

    function updateTeacher(Request $req, $id){
        $req->validate([
            'name'=>'required',
            'title'=>'required',
            'department'=>'required',
            'institute'=>'required'
        ]);


        $data = Teacher::findOrFail($id)->update([
            'name'=>$req->name,
            'title'=>$req->title,
            'department'=>$req->department,
            'institute'=>$req->institute
        ]);

    }


    function deleteTeacher($id){
        Teacher::destroy($id);
        
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
