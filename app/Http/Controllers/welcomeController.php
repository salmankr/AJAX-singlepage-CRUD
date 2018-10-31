<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\student;
class welcomeController extends Controller
{
    public function index(){
        $data = student::all();
        return view('welcome', compact('data'));
    }
    public function create(Request $request){
    	$request->validate([
           'name' => 'required',
           'semester' => 'required',
           'reg_no' => 'required|unique:students',
    	]);
    	$data = new student;
        $data->name = $request->get('name');
        $data->semester = $request->get('semester');
        $data->reg_no = $request->get('reg_no');
        $data->save();
        return $data;
    }
    public function delete($id){
        $data = student::find($id);
        $data->delete();
        return ('Student data deleted successfuly');
    }
    public function studentlist(){
        $students = student::all();
        return $students;
    }
    public function updateID($id){
        $student = student::find($id);
        return $student; 
    }
    public function update(Request $request, $id){
        $request->validate([
           'name' => 'required',
           'semester' => 'required',
           'reg_no' => 'required',
        ]);

        $data = student::find($id);
        $data->name = $request->get('name');
        $data->semester = $request->get('semester');
        $data->reg_no = $request->get('reg_no');
        $data->save();
        return $data;
    }
}
