<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

$post =Post::select
(
  "posts.id", "posts.c_id","categories.c_name as c_name","posts.post_title",
 "posts.post_Description","posts.post_img","posts.banner_img","posts.slug","posts.created_at"
)
->leftJoin("categories", "categories.id", "=", "posts.c_id")
->where('categories.is_deleted',0)
           ->where('posts.is_deleted' ,0)
->where([
    ['post_title','!=',Null],
    [function ($query) use ($request){
        if(($term = $request->term)){
            $query->orWhere('post_title','LIKE', '%' . $term . '%')->get();
        }
    }
    ]
  ])->orderBy('posts.id', 'DESC')
->paginate(5);

          return view('backend.post',compact('post',$post))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('backend.addpost',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->input();


        $post = new post;

   $post->c_id = $data['c_id'];
   $post->post_title = $data['post_title'];
   $post->post_Description = $data['post_Description'];
   $post->slug = Str::slug($request->post_title);

//    $post->slug = Str::slug($data['slug']);

//    $addpost->slug = $data['slug'];
// $request['slug'] = Str::slug($request->slug);


  if($request->hasfile('post_img'))
  {
      $file = $request->file('post_img');
      $extention =$file->getClientOriginalExtension();
      $filename = time().'.'.$extention;
      $file->move('image',$filename);
      $post->post_img =$filename;
     // $addpost->banner_img =$filename;
  }

  if($request->hasfile('banner_img'))
  {
      $file = $request->file('banner_img');
      $extention =$file->getClientOriginalExtension();
      $filename = time().'.'.$extention;
      $file->move('banner',$filename);
      $post->banner_img =$filename;
     //  $addpost->banner_img =$filename;

  }
  date_default_timezone_set("Asia/Calcutta");



   $post->save();
   return redirect()->route('post.index')->with('success','New Post Added  Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = post::find($id);

        return view('backend.showpost',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        $categorie =Category::all();
        // return view('editcat',['categorie'=> $categorie]);
        return view('backend.editpost',compact('posts','categorie'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $upost = post::find($id);
        if($upost){
            $upost->c_id = $request->c_id;
        $upost-> post_title = $request->post_title ;
        $upost->slug = Str::slug($request->post_title);

        $upost-> post_Description= $request->post_Description;
        // $upost-> post_img= $request->post_img;
        // $upost-> banner_img= $request->banner_img;
        if($request->hasfile('post_img'))
        {
            $destination ='image/' .$upost->post_img;
            if(File::exists( $destination))
            {
                File::delete($destination);

            }

            $file = $request->file('post_img');
            $extention =$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('image',$filename);
            $upost->post_img =$filename;
        }
        if($request->hasfile('banner_img'))
        {
            $destination ='banner/' .$upost->banner_img;
            if(File::exists( $destination))
            {
                File::delete($destination);

            }
            $file = $request->file('banner_img');
            $extention =$file->getClientOriginalExtension();
            $filename = time().'.'.$extention;
            $file->move('banner',$filename);
            $upost->banner_img =$filename;
        }

    //print_r($upost);
       $upost->save();
        return redirect()->route('post.index')->with('success','Post Update  Successfully');

    }
    else{
        return redirect()->route('post.index')->with('success','Invalid post id');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = post::find($id);
        $destination = 'image/' .$post->post_img;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $destination = 'banner/' .$post->banner_img;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        $post->delete();


        return redirect()->route('post.index')->with('success','Post Deleted Successfully ');

    }
}
