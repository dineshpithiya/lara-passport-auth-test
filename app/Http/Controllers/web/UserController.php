<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function verify(Request $request)
    {
        $rules = array(
            'email' => 'required|email',
            'password' => 'required|min:5');
        $validator = Validator::make(Input::all() , $rules);
        if ($validator->fails())
        {
            return response(
                array(
                    'status'=>400,
                    'msg'=>'All filds required',
                    'data'=>$validator->messages()->toArray()
                ),400)->header('Content-Type','json');
        }
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) 
        {
            return response(
                array(
                    'status'=>200,
                    'msg'=>'Succss',
                    'data'=>"Login success"
                ),401)->header('Content-Type','json');
        }
        else
        {
            return response(
                array(
                    'status'=>401,
                    'msg'=>'Fail',
                    'data'=>"Authentication fail"
                ),401)->header('Content-Type','json');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
