<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\formcontroller;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;


Route::prefix('admin')->group(function(){
    Auth::routes(['login'=>true]);
});
 Route::fallback(function(){
    abort(404);
 });
Route::group(['middleware' => 'auth'], function () {
Route::get('Dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('profile',[ProfileController::class,'index'])->name('profile');
Route::post('/edit-profile/{id}',[ProfileController::class,'update'])->name('edit.profile');
Route::resource('products', ProductController::class);
Route::resource('category', 'App\Http\Controllers\CategoryController');
Route::post('/category/toggle-status/{id}', 'App\Http\Controllers\CategoryController@toggleStatus')->name('category.toggleStatus');
Route::get('/comments', [CommentController::class, 'show'])->name('comments.show');
Route::post('/comments/toggle-status/{id}', [CommentController::class, 'toggleStatus'])->name('comments.toggle-status');
Route::get('/comments/count', [CommentController::class, 'updateCommentCount'])->name('comments.count');
Route::post('/comments/replystore', [CommentController::class, 'replyStore'])->name('comments.replystore');
Route::delete('/replies/delete-selected', [CommentController::class, 'deleteSelectedReplies'])->name('delete.selected.replies');
Route::delete('/comments/{id}', [CommentController::class, 'delete'])->name('comments.destroy');
Route::get('/replies',  [CommentController::class, 'index'])->name('replies.index');
Route::resource('post',PostController::class);
 });
 Route::get('search', [App\Http\Controllers\FrontendController::class, 'search'])->name('search');
Route::get('/', [App\Http\Controllers\FrontendController::class, 'show'])->name('show');
Route::get('/contact-us', [ContactusController::class, 'index'])->name('Contactus');
Route::post('/contact-us', [ContactusController::class, 'store'])->name('Contactus.store');

Route::get('/{category}/{slug}',[ FrontendController::class, 'singleview'])->name('singleview');
Route::get('/{c_slug}',[ FrontendController::class, 'postdetail'])->name('postdetail');
Route::resource('form', formcontroller::class);
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/status-update/{id}', [App\Http\Controllers\formcontroller::class, 'status_update'])->name('destroy');


