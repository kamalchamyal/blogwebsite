<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $categories=Category::where([
        ['c_name','!=',Null],
        [function ($query) use ($request){
            if(($term = $request->term)){
                $query->orWhere('c_name','LIKE', '%' . $term . '%')->get();
            }
        }
        ]
      ])
        ->orderBy("id", "desc")
        ->paginate(5);
      return view('backend.category',compact('categories'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('backend.addcategory');
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


				        $addcategory = new Category();
                $addcategory->c_name = $data['c_name'];
                // $addcat->c_slug = $data['c_slug'];
                // $addcategory->c_slug = Str::slug($data['c_slug']);
                $addcategory->c_slug = Str::slug($data['c_name']);
                $addcategory->c_status=$data['c_status'];
                date_default_timezone_set("Asia/Calcutta");



                // $category->status = $data['status'];

                if (Category::where('c_name', $request->c_name)->exists()) {
                  //categorie exists in categories table
                  //echo "alredy exits";
                  return redirect()->route('category.create')->with('success','Category Already Exits');

               }


               else{


                $addcategory->save();


        return redirect()->route('category.index')
                        ->with('success','Category Add successfully.');
    }
   }
    public function show($id)
    {

    }

    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->c_status = $category->c_status == 1 ? 0 : 1;
        $category->save();

        return response()->json(['status' => $category->c_status]);
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorie = Category::find($id);
        // return view('editcat',['categorie'=> $categorie]);
        return view('backend.editcategory',compact('categorie'));
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
        $categorie = Category::find($id);
        $categorie-> c_name= $request->c_name;
         $categorie-> c_status= $request->c_status;
        $categorie->c_slug = Str::slug($request['c_name']);
        date_default_timezone_set("Asia/Calcutta");






        $categorie->save();

        return redirect(route('category.index'))->with('success','Category Update  Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category :: destroy($id);
        //     return redirect(route('addcat'))->with('status','category Remove Successfully');

        return redirect()->route('category.index')
                        ->with('success','Category deleted successfully');
    }
}
