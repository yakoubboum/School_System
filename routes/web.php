<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeInvoicesController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizzeController;
use App\Http\Controllers\ReceiptStudentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\OnlineClasseController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', "auth"]
    ],
    function () {


        Route::resource('grade', GradeController::class);

        Route::post('grade/store', [GradeController::class, 'store']);

        Route::get('Get_classrooms/{id}', [SectionController::class, 'Get_classrooms']);

        Route::post('classrooms/store', [ClassroomController::class, "store"]);


        Route::post('classrooms/deleteall', [ClassroomController::class, "deleteall"]);

        Route::post('classrooms/filter', [ClassroomController::class, "filter"]);




        Route::resource('classrooms', ClassroomController::class);

        Route::resource('Sections', SectionController::class);


        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware("auth");



        Route::view('add_parent', "livewire.showform")->name('add_parent');



        Route::resource('library', LibraryController::class);


        Route::resource('Teachers', TeacherController::class);

        Route::resource('Students', StudentsController::class);

        Route::resource('Promotion', PromotionController::class);

        Route::resource('Fees', FeeController::class);

        Route::resource('FeesInvoices', FeeInvoicesController::class);

        Route::get('/Promotion/graduateone/{id}', [PromotionController::class, "graduateone"]);


        Route::resource('Graduated', GraduatedController::class);

        Route::resource('receipt_students', ReceiptStudentController::class);


        Route::resource('receipt_students', ReceiptStudentController::class);

        Route::resource('ProcessingFee', ProcessingFeeController::class);


        Route::resource('Payment_students', PaymentStudentController::class);


        Route::resource('Quizzes', QuizzeController::class);

        Route::resource('questions', QuestionController::class);

        Route::resource('online_classes', OnlineClasseController::class);



        Route::resource('Graduated', GraduatedController::class);

        Route::resource('Attendance', AttendanceController::class);


        Route::resource('subjects', SubjectController::class);


        Route::post('upload_attachments', [StudentsController::class, "upload_attachments"]);



        Route::post('Delete_attachment', [StudentsController::class, "Delete_attachment"]);


        Route::get('Download_attachment/{student_name}/{file_name}', [StudentsController::class, "Download_attachment"]);


        Route::get('downloadAttachment/{filename}/{folder}', [LibraryController::class, "downloadAttachment"]);


        // Route::get('Get_classrooms/{id}', [StudentsController::class,"Get_classrooms"]);
        Route::get('Get_Sections/{id}', [StudentsController::class, "Get_Sections"]);

        Route::get('Get_Price/{id}', [FeeInvoicesController::class, "Get_Price"]);
    }
);



// Route::view('en/add_parent', "livewire.showform")->name('add_parent');
// Route::view('en/add_parent', "livewire.showform")->name('add_parent');







Auth::routes();







Route::get('test', function () {
    return view('livewire.test');
});



















Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});
