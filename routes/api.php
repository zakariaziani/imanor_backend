<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\CourrierController;

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

//-------------------------------Agent Routes------------------------------------------


Route::get('/agent', [AgentController::class, 'index']); //all agents
Route::get('/agent/{id}', [AgentController::class, 'show']); // provide ID -> get agent
Route::post('/agent', [AgentController::class, 'store']); //create an agent
Route::put('/agent/{id}', [AgentController::class, 'update']); // update an agent (provide an ID)
Route::delete('/agent/{id}', [AgentController::class, 'delete']); // delete an agent 
Route::post('/register', [AgentController::class, 'register']); //register an agent
Route::post('/login', [AgentController::class, 'login']); // login 

//! the user must be authenticated to access these routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AgentController::class, 'profile']); 
    Route::post('/logout', [AgentController::class, 'logout']);
});


//---------------------------Departement Routes----------------------------------

Route::get('/departement', [DepartementController::class, 'index']); 
Route::get('/departement/{id}', [DepartementController::class, 'show']); 
Route::post('/departement', [DepartementController::class, 'store']); 
Route::put('/departement/{id}', [DepartementController::class, 'update']); 
Route::delete('/departement/{id}', [DepartementController::class, 'delete']); 

//---------------------------Courrier Routes---------------------------------------

Route::get('/courrier', [CourrierController::class, 'index']); 
Route::get('/courrier/{id}', [CourrierController::class, 'show']); 
Route::post('/courrier', [CourrierController::class, 'store']); 
Route::put('/courrier/{id}', [CourrierController::class, 'update']); 
Route::delete('/courrier/{id}', [CourrierController::class, 'delete']); 