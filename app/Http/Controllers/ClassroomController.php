<?php

namespace App\Http\Controllers;

use App\Http\Requests\classroomv;
use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;




use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationData;



class ClassroomController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $My_Classes = Classroom::all();

        $Grades = Grade::all();

        return view("pages.classrooms.classrooms", compact("My_Classes", "Grades"));
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     */
    public function store(classroomv $request)
    {







        $List_Classes = $request->List_Classes;

        $validated = $request->validated();

        // $rules = [
        //     'Name' => 'required|max:255|unique:classrooms,classname->ar',
        //     'Name_class_en' => 'required|max:255|unique:classrooms,classname->en',
        // ];

        // $errors = [];

        // foreach ($List_Classes as $classroom) {
        //     $validator = Validator::make($classroom, $rules);

        //     if ($validator->fails()) {
        //         $errors = $validator->errors();
        //         break;
        //     }
        // }

        // if (count($errors) > 0) {
        //     return redirect()->back()->withErrors($errors);
        // }




        foreach ($List_Classes as $List_Class) {

            Classroom::create([
                'classname' => ['en' => $List_Class['Name_class_en'], 'ar' => $List_Class['Name']],
                'grade_id' => $List_Class['Grade_id'],
            ]);
        }

        toastr()->success(trans('messages.success'));
        return back();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     */
    public function update(Request $request)
    {

        $Classroom = Classroom::findOrFail($request->id);

        $Classroom->update([

            $Classroom->classname = ['ar' => $request->Name, 'en' => $request->Name_en],
            $Classroom->grade_id = $request->Grade_id,
        ]);
        toastr()->success(trans('messages.Update'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     */
    public function destroy(Request $request)
    {

        $Classrooms = Classroom::findOrFail($request->id)->forcedelete();
        toastr()->error(trans('messages.Delete'));
        return back();
    }

    public function deleteall(Request $request){


        $delete_all_id = explode(",", $request->delete_all_id);

        Classroom::whereIn('id', $delete_all_id)->forcedelete();
        toastr()->error(trans('messages.Delete'));
        return back();
    }

    public function filter(Request $request){
        $Grades = Grade::all();
        $Search = Classroom::select('*')->where('Grade_id','=',$request->Grade_id)->get();
        return view('pages.classrooms.classrooms',compact('Grades'))->withDetails($Search);

    }
}
