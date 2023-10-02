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
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\PaymentStudentController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\OnlineClasseController;
use App\Http\Controllers\teacher\StudentController;
use App\Http\Controllers\TeacherController;
use App\Models\Teacher;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Models\Students;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



Route::group(['namespace' => 'Auth',
], function () {

    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
});






















































// Route::group(['middleware' => ['guest']], function () {

Route::get('/', function () {
    return view('auth.selection');
})->name('selection');




// Route::get('/', function () {
//     return view('dashboard');
// });



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/student/dashboard', function () {
            return view('pages.Students.dashboard.profile');
        })->name('dashboard.Students');
    }
);



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ],
    function () {

        //==============================dashboard============================
        Route::get('/teacher/dashboard', function () {

            $sections = Teacher::findOrfail(auth()->user()->id)->Sections()->pluck('section_id');

            $section_number = $sections->count();

            $students_n = Students::whereIn('section_id', $sections)->count();

            return view('pages.Teachers.dashboard.dashboard', compact('section_number', 'students_n'));
        });



        Route::group(['namespace' => 'teacher'], function () {
            //==============================students============================
            Route::get('student', [StudentController::class, 'index'])->name('student.index');

            Route::get('sections',[StudentController::class, 'sections'])->name('sections.index');

            Route::get('report',[StudentController::class, 'report'])->name('Attendance.report');

            Route::post('report_search',[StudentController::class, 'report_search'])->name('attendance.search');

        });
    }
);








Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web,student,teacher']
    ],
    function () {



        Route::resource('Attendance', AttendanceController::class);


        Route::resource('Quizzes', QuizzeController::class);

        Route::resource('questions', QuestionController::class);


        Route::get('Get_classrooms/{id}', [SectionController::class, 'Get_classrooms']);


        Route::get('Get_Sections/{id}', [StudentsController::class, "Get_Sections"]);

    }
);









Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ],
    function () {





        Route::resource('grade', GradeController::class);

        Route::post('grade/store', [GradeController::class, 'store']);



        Route::post('classrooms/store', [ClassroomController::class, "store"]);


        Route::post('classrooms/deleteall', [ClassroomController::class, "deleteall"]);

        Route::post('classrooms/filter', [ClassroomController::class, "filter"]);




        Route::resource('classrooms', ClassroomController::class);

        Route::resource('Sections', SectionController::class);


        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('home');



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




        Route::resource('online_classes', OnlineClasseController::class);



        Route::resource('Graduated', GraduatedController::class);



        Route::resource('subjects', SubjectController::class);


        Route::post('upload_attachments', [StudentsController::class, "upload_attachments"]);



        Route::post('Delete_attachment', [StudentsController::class, "Delete_attachment"]);


        Route::get('Download_attachment/{student_name}/{file_name}', [StudentsController::class, "Download_attachment"]);


        Route::get('downloadAttachment/{filename}/{folder}', [LibraryController::class, "downloadAttachment"]);


        // Route::get('Get_classrooms/{id}', [StudentsController::class,"Get_classrooms"]);

        Route::get('Get_Price/{id}', [FeeInvoicesController::class, "Get_Price"]);
    }
);


Route::get('test', function () {
    return view('livewire.test');
});




// Route::get('login/{type}', [GradeController::class,'loginform'])->middleware('guest')->name('login.show');

// Route::get('login/{type}', function ($type) {
//     return view('auth.login', compact("type"));
// })->name('login.show');





// Route::post('login', [LoginController::class, 'login'])->name('login');


// require __DIR__.'\auth.php';
// require __DIR__.'\student.php';






