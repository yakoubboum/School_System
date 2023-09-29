<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;











class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *

   */

   




  public function index()
  {
    $Grades=Grade::all();
    return view("pages.grades.grades",compact("Grades"));
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
  public function store(Request $request)
  {
    $validate = $request->validate([
        'Name' => 'required|max:255|unique:grades,Name->ar',
        'Name_en' => 'required|max:255|unique:grades,Name->en',

    ],[
        'Name.required'=>trans('validation.required'),
        'Name_en.required'=>trans('validation.required'),
        'Name.unique'=>trans("Grades_trans.exists"),
    ]);

    $Grade = new Grade();

    $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];

    $Grade->save();
    toastr()->success(trans('messages.success'));
    return back();

//  حذف مرحلة دراسية مع الصفوف
// حذف بحركة واحدة
  }

  /**
   * Display the specified resource.
   *
   * param  int  $id
   *
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * param  int  $id
   *
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * param  int  $id
   *
   */
  public function update(Request $request)
  {


        $validate = $request->validate([
            'Name' => 'required|max:255|unique:grades,Name->ar'.$request->id,
        'Name_en' => 'required|max:255|unique:grades,Name->en,'.$request->id,

        ],[
            'Name.required'=>trans('validation.required'),
            'Name_en.required'=>trans("validation.required"),
        ]);
        $Grades = Grade::findOrFail($request->id);
        $Grades->update([
          $Grades->Name = ['ar' => $request->Name, 'en' => $request->Name_en],
          $Grades->Notes = $request->Notes,
        ]);
        toastr()->success(trans('messages.Update'));
        return back();

  }

  /**
   * Remove the specified resource from storage.
   *
   * param  int  $id

   */
  public function destroy(Request $request)
  {



    $Grades = Grade::findOrFail($request->id)->forcedelete();

    toastr()->success(trans('messages.Delete'));

    return back();

  }

  public function getclasses(){


  }


}
