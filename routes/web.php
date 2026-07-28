<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\AdminAccountController;

use App\Http\Controllers\AdminExamController;
use App\Http\Controllers\AdminQuestionController;
use App\Http\Controllers\AdminConversationController;
use App\Http\Controllers\AdminMaintenanceController;

use App\Http\Controllers\AdminUserController;



use App\Http\Controllers\ExamController;
use App\Http\Controllers\WorkboardController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\FeedbackController;



use App\Http\Middleware\ValidUser;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});
Route::get('login', function () { return view('login/login');})->name('login');
Route::get('register', function () { return view('login/register');})->name('register');
Route::post('loginRequest', [LoginController::class, 'loginRequest'])->name('loginRequest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('exams', function () { return view('frontend/pages/exams');})->name('exams');
Route::get('about', function () { return view('frontend/pages/about');})->name('about');

//Dashboard Route
// Route::get('dashboard', function () { return view('dashboard/dashboard');})->middleware(['auth']);
Route::get('dashboard', [ExamController::class, 'purchasedexam'])->middleware(['auth']);
Route::get('myexam', [ExamController::class, 'purchasedexam'])->middleware(['auth']);


Route::get('updatedbentry', [ExamController::class, 'updatedbentry'])->middleware(['auth']);
//Route::get('resultshow', [WorkboardController::class, 'resultshow'])->name('resultshow')->middleware(['auth']);

Route::get('showexam/{e_id}', [ExamController::class, 'showexam'])->middleware(['auth']);
Route::get('createnew/{e_id}', [ExamController::class, 'createnew'])->middleware(['auth']);
Route::get('subsection/{e_id}', [ExamController::class, 'subsection'])->middleware(['auth']);
Route::post('subsectionselected/{e_id}', [ExamController::class, 'subsectionselected'])->name('subsectionselected')->middleware(['auth']);
Route::get('workboard/{linkDatastring}', [WorkboardController::class, 'workboard'])->middleware(['auth']);
Route::get('workboard_r/{testid}', [WorkboardController::class, 'workboard_r'])->middleware(['auth']);

Route::post('submitmcq/{testid}', [WorkboardController::class, 'submitmcq'])->name('submitmcq')->middleware(['auth']);
Route::post('submitemq/{testid}', [WorkboardController::class, 'submitemq'])->name('submitemq')->middleware(['auth']);

Route::get('questionskip/{linkData}', [WorkboardController::class, 'questionskip'])->name('questionskip')->middleware(['auth']);
Route::get('finishexam/{testid}', [WorkboardController::class, 'finishexam'])->name('finishexam')->middleware(['auth']);

Route::post('submitrmcq/{testid}', [WorkboardController::class, 'submitrmcq'])->name('submitrmcq')->middleware(['auth']);
Route::post('submitramcq/{testid}', [WorkboardController::class, 'submitramcq'])->name('submitramcq')->middleware(['auth']);



Route::post('submitremq/{testid}', [WorkboardController::class, 'submitremq'])->name('submitremq')->middleware(['auth']);
Route::post('submitraemq/{testid}', [WorkboardController::class, 'submitraemq'])->name('submitraemq')->middleware(['auth']);

Route::get('submitrfc/{linkData}', [WorkboardController::class, 'submitrfc'])->name('submitrfc')->middleware(['auth']);
Route::get('submitrafc/{linkData}', [WorkboardController::class, 'submitrafc'])->name('submitrafc')->middleware(['auth']);







Route::post('makeexam', [ExamController::class, 'makeexam'])->name('makeexam')->middleware(['auth']);









Route::post('/contact', [FormController::class, 'store'])->name('contact.store');

Route::get('buyexam/{e_id}', [BasketController::class, 'buyexam'])->middleware(['auth']);
Route::get('basket', [BasketController::class, 'userbasketdata'])->middleware(['auth']);
Route::get('basketremoveitem/{ba_id}', [BasketController::class, 'basketremoveitem'])->middleware(['auth']);
Route::get('basketupdateitem', [BasketController::class, 'basketupdateitem'])->name('basketupdateitem')->middleware(['auth']);
Route::post('basketaddcoupon', [BasketController::class, 'basketaddcoupon'])->name('basketaddcoupon')->middleware(['auth']);

Route::get('subscriptions', [SubscribeController::class, 'usersubscribedata'])->middleware(['auth']);
Route::get('invoice', [SubscribeController::class, 'userinvoicedata'])->middleware(['auth']);
Route::get('examhistory', [SessionController::class, 'examhistorydata'])->middleware(['auth']);
Route::get('loginhistory', [SessionController::class, 'loginhistorydata'])->middleware(['auth']);
Route::get('betteranswer', [FeedbackController::class, 'betteranswerdata'])->middleware(['auth']);
Route::get('correction', [FeedbackController::class, 'correctiondata'])->middleware(['auth']);




//Admin Route
// Route::middleware(['auth'])->group(function () { Route::get('/admin', function () { return view('admin/pages/login');})->name('admin');});
Route::get('/admin', function () { return view('admin/pages/login');});
Route::post('adminLoginRequest', [LoginController::class, 'adminLoginRequest'])->name('adminLoginRequest');
Route::get('adminDashboard', [LoginController::class, 'dashboardPage'])->name('adminDashboard')->middleware(['auth']);
//Admin Account Routes
Route::get('adminAccount', [AdminAccountController::class, 'show'])->name('adminAccount')->middleware(['auth']);
//Admin Conversation Routes
Route::get('adminConversation', [AdminConversationController::class, 'show'])->name('adminConversation')->middleware(['auth']);
//Admin Maintenance Routes
Route::get('adminMaintenance', [AdminMaintenanceController::class, 'show'])->name('adminMaintenance')->middleware(['auth']);
//Admin Question Routes
Route::get('adminQuestions', [AdminQuestionController::class, 'show'])->name('adminQuestions')->middleware(['auth']);
//Admin User Routes
Route::get('adminUsers', [AdminUserController::class, 'show'])->name('adminUsers')->middleware(['auth']);
//Admin Exams Routes
Route::get('adminExams', [AdminExamController::class, 'show'])->name('adminExams')->middleware(['auth']);
Route::get('adminExamInner/{e_id}', [AdminExamController::class, 'showInner'])->name('adminExamInner')->middleware(['auth']);
Route::post('adminAddExam', [AdminExamController::class, 'adminAddExam'])->name('adminAddExam')->middleware(['auth']);
Route::post('adminAddExamSubSection', [AdminExamController::class, 'adminAddExamSubSection'])->name('adminAddExamSubSection')->middleware(['auth']);
Route::get('adminEditExam/{e_id}', [AdminExamController::class, 'adminEditExam'])->name('adminEditExam')->middleware(['auth']);
Route::post('adminEditUExam', [AdminExamController::class, 'adminEditUExam'])->name('adminEditUExam')->middleware(['auth']);
Route::post('adminEditU2Exam', [AdminExamController::class, 'adminEditU2Exam'])->name('adminEditU2Exam')->middleware(['auth']);
//Admin Question Routes
Route::get('adminQuestion/{q_qt_id}', [AdminQuestionController::class, 'showQuestion'])->name('adminMCQ')->middleware(['auth']);
Route::post('adminQuestionSelectExam/{e_id}', [AdminQuestionController::class, 'selectQuestionExam'])->name('adminQuestionSelectExam')->middleware(['auth']);    
Route::get('adminQuestionSelectExamLink/{linkData}', [AdminQuestionController::class, 'selectQuestionExamLink'])->name('adminQuestionSelectExamLink')->middleware(['auth']);
Route::post('adminQuestionSelectExam/{e_id}', [AdminQuestionController::class, 'selectQuestionExam'])->name('adminQuestionSelectExam')->middleware(['auth']);    
Route::get('adminEditQuestion/{linkData1}', [AdminQuestionController::class, 'adminEditQuestion'])->name('adminEditQuestion')->middleware(['auth']);


Route::get('adminAddQuestion/{linkData}', [AdminQuestionController::class, 'adminAddQuestion'])->name('adminAddQuestion')->middleware(['auth']);
Route::post('adminEditUMCQOption', [AdminQuestionController::class, 'adminEditUMCQOption'])->name('adminEditUMCQOption')->middleware(['auth']);
Route::post('adminEditUMCQ', [AdminQuestionController::class, 'adminEditUMCQ'])->name('adminEditUMCQ')->middleware(['auth']);


Route::post('adminEditUEMQOption', [AdminQuestionController::class, 'adminEditUEMQOption'])->name('adminEditUEMQOption')->middleware(['auth']);
Route::post('adminEditUEMQ', [AdminQuestionController::class, 'adminEditUEMQ'])->name('adminEditUEMQ')->middleware(['auth']);

Route::post('adminEditUFCOption', [AdminQuestionController::class, 'adminEditUFCOption'])->name('adminEditUFCOption')->middleware(['auth']);
Route::post('adminEditUFC', [AdminQuestionController::class, 'adminEditUFC'])->name('adminEditUFC')->middleware(['auth']);


