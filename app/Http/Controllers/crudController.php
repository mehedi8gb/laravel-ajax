<?php

namespace App\Http\Controllers;

use App\Models\crud;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\Auth;

class crudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $crud = crud::get();
        flash('Welcome '.Auth::user()->name);

        return view('welcome' , compact('crud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = crud::get();
        if($data)
            return $data;
        else
            abort(500, 'no data');


    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if($request->name && $request->email){

          $validate =  $request->validate([
                'email' => 'required'
            ]);
        if (!$validate) {
                return 2;
         }
        $data = new crud();
        $data->user_id = $request->user_id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->created_at = Carbon::now();
        $data->save();
        flash('Done! Data Added.')->success();
        return 1;
       }else{


           return 0;
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = crud::FindOrFail($id);
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $data = crud::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->updated_at = Carbon::now();
        $data->update();
            return 1;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

       Crud::find($id)->delete();
       return 1;

    }
}
