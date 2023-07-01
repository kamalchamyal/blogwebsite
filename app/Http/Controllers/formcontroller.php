<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\form;
use Illuminate\Support\Facades\DB;

class formcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $form = form::latest()->paginate(5);

        return view('form.index',compact('form'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form.create');
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


        $form = new form();
$form->name = $data['name'];
$form->status = $data['status'];
// $addcategory->c_slug = Str::slug($data['c_slug']);
// $addcategory->c_slug = Str::slug($data['c_name']);











$form->save();




        return redirect()->route('form.index')
                        ->with('success','form created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = form::find($id);

        return view('form.edit',compact('form'));
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
        $form = form::find($id);
        $form-> name= $request->name;




        $form->save();

        return redirect(route('form.index'))->with('success','form Update  Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        form :: destroy($id);
        //     return redirect(route('addcat'))->with('status','category Remove Successfully');

        return redirect()->route('form.index')
                        ->with('success','form deleted successfully');
    }
    public function status_update($id)
{

    $form=DB::table('forms')
    ->select('status')
    ->where('id','=',$id)
    ->first();
    if($form->status=='1'){
        $status='0';
    }else{
        $status='1';
    }
    $values= array('status'=>$status);
    DB::table('forms')->where ('id',$id)->update($values);
    session()->flash('status','form status has been updated.');
    return redirect()->route('form.index');
}
}
