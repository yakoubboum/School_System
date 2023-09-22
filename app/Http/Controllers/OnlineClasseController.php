<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\online_classe;
use Illuminate\Http\Request;



class OnlineClasseController extends Controller
{
    public function index()
    {
        $online_classes = online_classe::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }


    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }


    public function store(Request $request)
    {
        try {

            // $meeting = $this->createMeeting($request);
            online_classe::create([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->Grade_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => '1',
                'start_url' => 'n',
                'join_url' => 'n',
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        try {
            // $meeting = Zoom::meeting()->find($request->id);
            // $meeting->delete();
            online_classe::where('meeting_id', $request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
