<?php

use App\Http\Controllers\JobsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserAccountsController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
  //  return view('loginandregister');
//});

//Routes For Navigating through Pages
Route::get('/', [PagesController::class, 'index']);
Route::get('dashboard', [PagesController::class, 'dashboard']);

//Routes For Functionalities
Route::post('add.user', [UserAccountsController::class, 'addUser']);
Route::post('user.logout', [UserAccountsController::class, 'logout']);
Route::post('add.job', [JobsController::class, 'addJobApplication']);
Route::get('login.user', [UserAccountsController::class, 'login']);
Route::delete('delete.job/{id}', [JobsController::class, 'deleteCareer']);
Route::post('update.job', [JobsController::class, 'updateJob'])->name('update.job');


//Displaying Job Application datas in logged in user 
Route::get('/dashboard', [JobsController::class, 'jobsDisplayingDatas']);