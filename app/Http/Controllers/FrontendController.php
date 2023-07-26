<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Psy\Command\WhereamiCommand;

class FrontendController extends Controller
{
    public function show(Request $request)
    {
       $category = Category::where("c_status",1)->orderBy('id', 'DESC')->get();
       if(!$category){
        abort(404);
    }
    $mostCommentedPost = Post::leftJoin('comments', 'posts.id', '=', 'comments.post_id')
    ->leftJoin('categories', 'categories.id', '=', 'posts.c_id')
    ->whereNull('comments.parent_id')
    ->select('categories.id', 'categories.c_name', 'categories.c_status', 'posts.id', 'posts.post_title','posts.slug', 'posts.post_img', DB::raw('COUNT(comments.id) as comment_count'))
    ->groupBy('categories.id', 'categories.c_name', 'categories.c_status','posts.slug', 'posts.id', 'posts.post_title', 'posts.post_img')
    ->where("c_status",1) ->orderBy('comment_count', 'desc')
    ->orderBy('posts.created_at', 'desc')
    ->take(5)
    ->get();


    $latestPosts = DB::table('categories')
        ->leftJoin('posts', 'categories.id', '=', 'posts.c_id')
        ->select('categories.id', 'categories.c_name','c_status', 'posts.post_img','posts.slug','posts.post_Description', 'posts.post_title', 'posts.created_at', 'users.name')
        ->join("users", "users.id", "=", "posts.added_by")
        ->whereRaw('posts.id = (SELECT MAX(id) FROM posts WHERE c_id = categories.id)')->where("c_status",1)
        ->orderBy('posts.id', 'DESC')
        ->get();
        if(!$latestPosts){
            abort(404);
        }




    $currentTimestamp = time();
    $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);


    return view('frontend.blogger', ['mostCommentedPost'=>$mostCommentedPost ,'currentDateTime' => $currentDateTime ,'latestPosts' => $latestPosts , 'category' => $category]);

    }

    public function singleview($category, $slug)
{
    $post = DB::table('posts')
        ->select('categories.id', 'categories.c_name','c_status','posts.view','posts.id', 'posts.c_id', 'posts.post_img','posts.slug','posts.post_Description', 'posts.post_title', 'posts.created_at', 'users.name')
        ->leftJoin("users", "users.id", "=", "posts.added_by")
        ->leftJoin("categories", "categories.id", "=", "posts.c_id")
        ->where('slug', $slug)
        ->first();

      DB::table('posts')
        ->where('slug', $slug)
        ->increment('view');
        if (!$post) {
            abort(404); // Redirect to error page with 404 status code
        }
        $category = Category::where("c_status",1)->orderBy('id', 'DESC')->get();
        $commentData = Session::get('commentData');
        $mostCommentedPost = Post::leftJoin('comments', 'posts.id', '=', 'comments.post_id')
        ->leftJoin('categories', 'categories.id', '=', 'posts.c_id')
        ->whereNull('comments.parent_id')
        ->select('categories.id', 'categories.c_name', 'categories.c_status', 'posts.id', 'posts.post_title','posts.slug', 'posts.post_img', DB::raw('COUNT(comments.id) as comment_count'))
        ->groupBy('categories.id', 'categories.c_name', 'categories.c_status','posts.slug', 'posts.id', 'posts.post_title', 'posts.post_img')
        ->where("c_status",1) ->orderBy('comment_count', 'desc')
        ->orderBy('posts.created_at', 'desc')
        ->take(5)
        ->get();

        $comments = Comment::where('post_id', $post->id)
        ->where('Comment_status', 1)
        ->whereNull('parent_id')
        ->with('replies')
        ->get();

    $comments->load('replies'); // Load the replies for each comment separately





        if ($comments) {
            $refreshCount = Session::get('refreshCount', 0);
            $refreshCount++;

            if ($refreshCount >= 1) {
                Session::forget('commentData');
                Session::forget('refreshCount');
            } else {
                Session::put('refreshCount', $refreshCount);
            }
        }
        $currentTimestamp = time();
        $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);
        return view('frontend.singleview',['mostCommentedPost'=>$mostCommentedPost ,'commentData' => $commentData,'comments'=>$comments, 'currentDateTime'=>$currentDateTime,   'category'=> $category, 'post'=>$post]);
    }

    public function postdetail($c_slug)
    {

        $latestpost= DB::table('posts')->leftjoin("users","users.id", "=","posts.added_by")->leftJoin("categories","categories.id"  , "=", "posts.c_id")
      ->where('c_slug',$c_slug)->where("c_status",1)->get();
      $mostCommentedPost = Post::leftJoin('comments', 'posts.id', '=', 'comments.post_id')
      ->leftJoin('categories', 'categories.id', '=', 'posts.c_id')
      ->whereNull('comments.parent_id')
      ->select('categories.id', 'categories.c_name', 'categories.c_status', 'posts.id', 'posts.post_title','posts.slug', 'posts.post_img', DB::raw('COUNT(comments.id) as comment_count'))
      ->groupBy('categories.id', 'categories.c_name', 'categories.c_status','posts.slug', 'posts.id', 'posts.post_title', 'posts.post_img')
      ->where("c_status",1) ->orderBy('comment_count', 'desc')
      ->orderBy('posts.created_at', 'desc')
      ->take(5)
      ->get();


         $category = Category::where("c_status",1)->orderBy('id', 'DESC')->get();
         if (!$category ) {
            abort(404);
        }

        $currentTimestamp = time();
        $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);
        if ($latestpost->isEmpty()) {
            abort(404);
        }
        return view('frontend.postdetail',['mostCommentedPost'=>$mostCommentedPost,'currentDateTime'=>$currentDateTime,   'category'=> $category, 'latestpost'=>$latestpost ,]);
    }

    public function search()
    {
        $searchTerm = request('search_term');

        $category = Category::where("c_status", 1)->orderBy('id', 'DESC')->get();

        $currentTimestamp = time();
        $currentDateTime = date('d F. l Y. g:i A', $currentTimestamp);

        $posts = Post::leftJoin('categories', 'categories.id', '=', 'posts.c_id')->where('post_title', 'like', '%' . $searchTerm . '%')
            ->orWhere('post_Description', 'like', '%' . $searchTerm . '%')
            ->orderBy('posts.created_at', 'desc')
            ->get();

        return view('frontend.search', [
            'currentDateTime' => $currentDateTime,
            'category' => $category,
            'posts' => $posts,
        ]);
    }

}


