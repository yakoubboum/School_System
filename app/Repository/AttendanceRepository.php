<?php


namespace App\Repository;


use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Students;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.Attendance.Sections', compact('Grades', 'list_Grades', 'teachers'));
    }

    public function show($id)
    {
        $students = Students::with('attendance')->where('section_id', $id)->get();
        return view('pages.Attendance.index', compact('students'));
    }

    public function store($request)
    {







        foreach ($request->attendences as $studentid => $attendence) {

            if ($attendence == 'presence') {
                $attendence_status = true;
            } else if ($attendence == 'absent') {
                $attendence_status = false;
            }

            $attendance = Attendance::where('student_id', $studentid)
            ->where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->where('attendence_date', date('Y-m-d'))
            ->first();


            if ($attendance) {
                $attendance->attendence_status = $attendence_status;
                $attendance->save();
            } else {
                // Create a new record.
                Attendance::create([
                    'student_id' => $studentid,
                    'grade_id' => $request->grade_id,
                    'classroom_id' => $request->classroom_id,
                    'section_id' => $request->section_id,
                    'teacher_id' => auth()->user()->id,
                    'attendence_date' => date('Y-m-d'),
                    'attendence_status' => $attendence_status
                ]);
            }




        }

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function update($request)
    {
        // TODO: Implement update() method.
    }

    public function destroy($request)
    {
        // TODO: Implement destroy() method.
    }
}
