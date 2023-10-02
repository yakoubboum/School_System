@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    اضافة اختبار جديد
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    اضافة اختبار جديد
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('Quizzes.store') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">اسم الاختبار باللغة العربية</label>
                                    <input type="text" name="Name_ar" class="form-control">
                                </div>

                                <div class="col">
                                    <label for="title">اسم الاختبار باللغة الانجليزية</label>
                                    <input type="text" name="Name_en" class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">

                                <div class="col">
                                    <label for="title">subject</label>
                                    <input type="text" name="Name_en" class="form-control" disabled
                                        value="{{ $subject }}">
                                </div>

                            </div>

                            <div class="form-row">





                                <div class="col">
                                    <div class="form-group">
                                        <label for="section_id">{{ trans('Students_trans.section') }} : </label>
                                        <select class="custom-select mr-sm-2" name="section_id">
                                            @foreach ($sections->sections as $section)
                                                <option value="{{ $section->id }}">{{$section->Grades->Name}}--{{$section->My_classs->classname}}--{{ $section->Name_Section }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                            </div>






                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">حفظ
                                البيانات</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection
