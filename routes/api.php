<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Models\ListTodos;
use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

// Project resources
Route::group([

    'middleware' => 'auth-api',

], function () {

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{project}', [ProjectController::class, 'show']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects/{project}', [ProjectController::class, 'update']);
Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);

});



// Route::get('/users/{user_id}', function (Request $request) {
//     $user = User::where('id', '=' ,$request->user_id)->with('projects')->get();
//     return response()->json([
//         "User" => $user,
//     ]);
// });

// Route::get('/users/{user_id}/projects', function (Request $request) {
//     return response()->json([
//         "name" => "Aissam",
//         "Id" => $request->user_id,
//         "Projects" => [
//             "projects 1" ,
//             "projects 2" ,
//             "projects 3" ,
//             "projects 4" ,
//         ]
//     ]);
// });

// Route::get('/users/{user_id}/projects', [ProjectController::class,'userProjects']);
// Route::get('/users/{user_id}/projects/{project_id}', function(Request $request){
//     $user = User::findOrFail($request->user_id);
//     $project = Project::findOrFail($request->project_id);

//     return response()->json(
//         [
//             "User name" => $user->name, 
//             "project" => $project->name, 
//             "project Lists" => $project->lists, 
//         ]
//     );
// });

// Route::get('/projects/{project_id}/lists/{list_id}', function(Request $request){
//     $user = User::findOrFail($request->user_id);
//     $project = Project::findOrFail($request->project_id);
//     $list = ListTodos::findOrFail($request->list_id);

//     return response()->json(
//         [
//             "User name" => $user->name, 
//             "project" => $project->name, 
//             "List" => $list, 
//         ]
//     );
// });

// Route::get('/projects/{project_id}/lists/{list_id}/todos', function(Request $request){
    
//     $user = User::findOrFail($request->user_id);
//     $project = Project::findOrFail($request->project_id);
//     $list = ListTodos::findOrFail($request->list_id);
//     $todos = Todo::where('list_id',$request->list_id)->get();

//     return response()->json(
//         [
//             "User name" => $user->name, 
//             "Project" => $project->name, 
//             "List" => $list, 
//             "Todos" => $todos, 
//         ]
//     );
// });


// Route::get('/users/{user_id}/projects/{project_id}', [ProjectController::class,'userProjects']);
// Route::get('/users/{user_id}/projects/{project_id}/lists', [ProjectController::class,'userProjects']);
// Route::get('/users/{user_id}/projects/{project_id}/lists/{list_id}/todos', [ProjectController::class,'userProjects']);


