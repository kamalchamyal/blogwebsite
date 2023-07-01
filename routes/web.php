<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\formcontroller;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CommentController;




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

// Route::get('/', function () {
//     return view('frontend.blogger');
// });


//  Auth::routes();

Route::prefix('admin')->group(function(){
    Auth::routes(['login'=>true]);
});
//  Route::fallback(function(){
//     return redirect('/');
//  });
 Route::fallback(function(){
    abort(404);
 });
//  Route::any('{any}', function () {
//     return response()->view('errors.404', [], 404);
// })->where('any', '.*');

// Route::fallback(function () {
//     return view('errors.404');
// });
// abort(404);
Route::group(['middleware' => 'auth'], function () {
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::resource('products', ProductController::class);

// Route::get('/search', [App\Http\Controllers\CategoryController::class, 'search'])->name('search');
Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::post('/category/toggle-status/{id}', 'App\Http\Controllers\CategoryController@toggleStatus')->name('category.toggleStatus');

Route::get('/comments', [CommentController::class, 'show'])->name('comments.show');
Route::post('/comments/toggle-status/{id}', [CommentController::class, 'toggleStatus'])->name('comments.toggle-status');
Route::get('/comments/count', [CommentController::class, 'updateCommentCount'])->name('comments.count');
Route::post('/comments/replystore', [CommentController::class, 'replyStore'])->name('comments.replystore');
Route::delete('/comments/reply/{id}', [CommentController::class, 'deletes'])->name('reply.destroy');
Route::delete('/comments/{id}', [CommentController::class, 'delete'])->name('comments.destroy');
Route::get('/replies',  [CommentController::class, 'index'])->name('replies.index');

Route::resource('post',PostController::class);

 });

Route::get('/', [App\Http\Controllers\FrontendController::class, 'show'])->name('show');
Route::get('{category}/{slug}',[ FrontendController::class, 'singleview'])->name('singleview');
Route::get('{c_slug}',[ FrontendController::class, 'postdetail'])->name('postdetail');
Route::resource('form', formcontroller::class);


Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


// Route::get('/comments', [CommentController::class, 'showComments']);


Route::get('/status-update/{id}', [App\Http\Controllers\formcontroller::class, 'status_update'])->name('destroy');

