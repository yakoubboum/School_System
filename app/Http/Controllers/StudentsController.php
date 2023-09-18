<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentsRequest;
use App\Models\Students;
use Illuminate\Http\Request;

use App\Repository\StudentRepositoryInterface;




class StudentsController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }




    public function index()
    {
        return $this->Student->Get_Student();
        // $student=Students::all();;
        // return $student;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->Student->Create_Student();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentsRequest $request)
    {
        return $this->Student->Store_Student($request);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->Student->Show_Student($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return $this->Student->Edit_Student($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreStudentsRequest $request)
    {
        return $this->Student->Update_Student($request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->Student->Delete_Student($request);
    }


    public function Get_Sections($id)
    {

        return $this->Student->Get_Sections($id);
    }

    public function Get_classrooms($id)
    {
        return $this->Student->Get_classrooms($id);
    }

    public function upload_attachments(Request $request){
        return $this->Student->Upload_attachment($request);
    }

    public function Download_attachment($student,$filename){
        return $this->Student->Download_attachment($student,$filename);

    }

    public function Delete_attachment(Request $request){
        return $this->Student->Delete_attachment($request);
    }
}
