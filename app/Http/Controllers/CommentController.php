<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'post_id' =>'required',
            'Comment_status'=>'required',

            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create($validatedData);
        Session::put('commentData', $validatedData);

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    public function replystore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'comment' => 'required',
            'post_id' =>'required',
            'Comment_status'=>'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

      $reply=  Comment::create($validatedData);
      Session::forget('commentData',$validatedData);
      if($reply){
        return true;
    }
    else
    {
        return false;
    }
    }

    public function index()
    {
        $replies = Comment::leftJoin("posts", "comments.post_id", "=", "posts.id")

        ->select('comments.*', 'posts.post_title') ->whereNotNull('parent_id')->with('replies')->get();
        return response()->json($replies);
    }


public function show()
{
    $comments = Comment::leftJoin("posts", "comments.post_id", "=", "posts.id")

    ->select('comments.*', 'posts.post_title')
    ->whereNull('parent_id')->with('replies') ->paginate(5);
    $count = Comment::where('comment_status', 0)->count();

    return view('backend.comment', compact('comments','count')) ->with('i', (request()->input('page', 1) - 1) * 5);
}
public function updateCommentCount()
{
    $commentCount = Comment::where('Comment_status', 0)->count();

    return response()->json(['count' => $commentCount]);
}


public function toggleStatus($id)
    {
    $comment = Comment::find($id);

    if (!$comment) {
        // Handle the situation when the comment is not found
        return response()->json(['error' => 'Comment not found'], 404);
    }

    $comment->Comment_status = $comment->Comment_status == 1 ? 0 : 1;
    $comment->save();

    return response()->json(['status' => $comment->Comment_status ]);

    }

public function delete($id)
{
    // Find the comment
    $comment = Comment::findOrFail($id);

    // Check if the authenticated user is authorized to delete the comment (optional)
    // Add any necessary authorization logic here

    // Delete the comment and its replies
    $comment->replies()->delete(); // Delete the replies
    $comment->delete(); // Delete the comment

    // Redirect or return a response as needed
    return redirect()->back()->with('success', 'Comment and replies deleted successfully.');
}
public function deletes($id)
{

    $reply = Comment::findOrFail($id);

    $reply->delete();


    return redirect()->back()->with('success', 'Comment and replies deleted successfully.');
}

}
