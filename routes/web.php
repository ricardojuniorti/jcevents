<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ItemEventController;
use App\Http\Controllers\EventCategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClasseController;


//tela inicial de listagem de eventos
Route::get('/', [EventController::class, 'index']);

//tela inicial de listagem de cursos
Route::get('/courses', [CourseController::class, 'index']);

// Painel de Gerenciar Usuarios
Route::get('/user/show', [UserController::class, 'show'])->middleware('auth');
Route::get('/user/viewUser', [UserController::class, 'viewUser'])->middleware('auth');
Route::get('/user/editUser/{id}', [UserController::class, 'editUser'])->middleware('auth');
Route::put('/user/updateUser/{id}', [UserController::class, 'updateUser'])->middleware('auth');
Route::delete('/user/{id}', [UserController::class, 'deleteUser'])->middleware('auth');
Route::get('/user/showPDF', [UserController::class, 'showPDF'])->middleware('auth');
Route::get('/user/showEXCEL', [UserController::class, 'showEXCEL'])->middleware('auth');


// Gerenciar Perfil de Usuarios
Route::get('/userProfile/show', [UserProfileController::class, 'show'])->middleware('auth');
Route::get('/userProfile/createUserProfile', [UserProfileController::class, 'createUserProfile'])->middleware('auth');
Route::post('/userProfile', [UserProfileController::class, 'recordUserProfile'])->middleware('auth');
Route::get('/userProfile/editUserProfile/{id}', [UserProfileController::class, 'editUserProfile'])->middleware('auth');
Route::put('/userProfile/updateUserProfile/{id}', [UserProfileController::class, 'updateUserProfile'])->middleware('auth');
Route::delete('/userProfile/{id}', [UserProfileController::class, 'deleteUserProfile'])->middleware('auth');

// eventos que estou participando

Route::get('/event/myEvent', [EventController::class, 'myEvent'])->middleware('auth');

//Gerir Eventos
Route::get('/event/createEvent', [EventController::class, 'createEvent'])->middleware('auth');
Route::post('/event', [EventController::class, 'recordEvent']);
Route::get('/event/{id}', [EventController::class, 'detailsEvent']);
Route::get('/event/editEvent/{id}', [EventController::class, 'editEvent'])->middleware('auth');
Route::put('/event/updateEvent/{id}', [EventController::class, 'updateEvent'])->middleware('auth');
Route::post('/event/editItemEvent/{id}', [EventController::class, 'editItemEvent'])->middleware('auth');
Route::delete('/event/{id}', [EventController::class, 'deleteEvent'])->middleware('auth');
Route::delete('/event/itemEvent/{id}', [EventController::class, 'deleteItemEvent'])->middleware('auth');

//Gerir Cursos
Route::get('/course/createCourse', [CourseController::class, 'createCourse'])->middleware('auth');
Route::post('/course', [CourseController::class, 'recordCourse'])->middleware('auth');
Route::get('/course/show', [CourseController::class, 'show'])->middleware('auth');
Route::get('/course/{id}', [CourseController::class, 'detailsCourse']);
Route::get('/course/editCourse/{id}', [CourseController::class, 'editCourse'])->middleware('auth');
Route::put('/course/updateCourse/{id}', [CourseController::class, 'updateCourse'])->middleware('auth');
Route::get('/mycourses', [CourseController::class, 'myCourses'])->middleware('auth');
Route::post('/course/joinCourse/{id}', [CourseController::class, 'joinCourse'])->middleware('auth');
Route::delete('/course/leaveCourse/{id}', [CourseController::class, 'leaveCourse'])->middleware('auth');
Route::delete('/course/{id}', [CourseController::class, 'deleteCourse'])->middleware('auth');


//Gerir Aulas
Route::get('/classe/createClasse', [ClasseController::class, 'createClasse'])->middleware('auth');
Route::post('/classe', [ClasseController::class, 'recordClasse'])->middleware('auth');
Route::post('/classe/{id}', [ClasseController::class, 'detailsClasse']);
Route::get('/classe/editClasse', [ClasseController::class, 'editClasse'])->middleware('auth');
Route::put('/classe/updateClasse/{id}', [ClasseController::class, 'updateClasse'])->middleware('auth');
Route::delete('/classe/{id}', [ClasseController::class, 'deleteClasse'])->middleware('auth');
Route::get('/classe/detailsClasse/{id}', [ClasseController::class, 'detailsClasse'])->middleware('auth');
Route::post('/classe/createMessage/{id}', [ClasseController::class, 'createMessage'])->middleware('auth');


//Gerir Itens de Evento
Route::get('/itemEvent/show', [ItemEventController::class, 'show'])->middleware('auth');
Route::get('/itemEvent/createItemEvent', [ItemEventController::class, 'createItemEvent'])->middleware('auth');
Route::post('/itemEvent', [ItemEventController::class, 'recordItemEvent'])->middleware('auth');
Route::get('/itemEvent/editItemEvent/{id}', [ItemEventController::class, 'editItemEvent'])->middleware('auth');
Route::put('/itemEvent/updateItemEvent/{id}', [ItemEventController::class, 'updateItemEvent'])->middleware('auth');
Route::delete('/itemEvent/{id}', [ItemEventController::class, 'deleteItemEvent'])->middleware('auth');

//Gerir Categoria de evento
Route::get('/eventCategory/show', [EventCategoryController::class, 'show'])->middleware('auth');
Route::get('/eventCategory/createEventCategory', [EventCategoryController::class, 'createEventCategory'])->middleware('auth');
Route::post('/eventCategory', [EventCategoryController::class, 'recordEventCategory'])->middleware('auth');
Route::get('/eventCategory/editEventCategory/{id}', [EventCategoryController::class, 'editEventCategory'])->middleware('auth');
Route::put('/eventCategory/updateEventCategory/{id}', [EventCategoryController::class, 'updateEventCategory'])->middleware('auth');
Route::delete('/eventCategory/{id}', [EventCategoryController::class, 'deleteEventCategory'])->middleware('auth');


// painel de eventos
Route::get('/dashboard', [EventController::class, 'dashboard'])->middleware('auth');
Route::post('/event/joinEvent/{id}', [EventController::class, 'joinEvent'])->middleware('auth');
Route::delete('/event/leaveEvent/{id}', [EventController::class, 'leaveEvent'])->middleware('auth');

// rota do painel de configuracoes do usuario
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/user', function () {
    return view('dashboard');
})->name('dashboard');

// relatorios
Route::get('/report/eventTime', [ReportController::class, 'eventTime'])->middleware('auth');

// Facebook login Social
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);


Route::get('/contact', function () {
    return view('contact');
});










