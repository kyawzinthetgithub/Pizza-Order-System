<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//GET
Route::get('product/list', [RouteController::class, 'productList']); //(READ *)
Route::get('category/list', [RouteController::class, 'categoryList']); //(READ *)

Route::get('delete/category/{id}', [RouteController::class, 'deleteCategory']); //(DELETE/ID)   //delete with get method
Route::get('category/details/{id}', [RouteController::class, 'detailCategory']); // (DETAILS/ID)   //detail with get method

//POST
Route::post('create/category', [RouteController::class, 'categoryCreate']); //(CREATE NEW ONE)
Route::post('create/contact', [RouteController::class, 'contactCreate']); //(CREATE NEW ONE)

// Route::post('delete/category', [RouteController::class, 'deleteCategory']);  //(DELETE)  //delete with post method

//Route::post('category/details', [RouteController::class, 'detailCategory']);  //(DETAILS/ID) //detail with post method

Route::post('category/update', [RouteController::class, 'updateCategory']); //(UPDATE/ID)   //update category with post method