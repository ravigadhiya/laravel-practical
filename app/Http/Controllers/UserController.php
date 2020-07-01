<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	
	public function __construct()
    {
        $this->middleware('authcheck');
    }
	
    /**
	* Function is use for list users
	*
	**/
	public function index(){
		$users_list = User::all();
        return view('user.index',['users'=>$users_list]);
    }
	
	/**
	* Function is use for create view for user
	*
	**/
	public function create(){
		return view('user.add');
    }
	
	/**
	* Function is use for store user
	*
	**/
	public function store(Request $request){
		 $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $data = $request->all();
        if (isset($data['image'])) {
            $file = $data['image'];
            $timestamp = str_replace([' ', ':', '-'], '', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $data['image'] = $name;
            $file->move(public_path() . '/uploads/user/', $name);
        }
        $userData = User::create($data);
        return redirect(action('UserController@index'))->with('message', 'User successfully created...')->with('class', 'alert-success');
    }
	
	/**
	* Function is use for show or edit user 
	*
	**/
	public function edit($id){
		$user = User::find($id);
        return view('user.edit', ['user' => $user]);
    }
	
	/**
	* Function is use for update user detail
	*
	**/
	public function update($id, Request $request){
		
		$user = User::find($id);
		$this->validate($request, [
            'name' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
        ]);
        $data = $request->all();
        if (isset($data['image']) && !empty($data['image'])) {
            $file = $data['image'];
            $timestamp = str_replace([' ', ':', '-'], '', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $data['image'] = $name;
            $file->move(public_path() . '/uploads/user/', $name);
            if(isset($user->image) && !empty($user->image)) {
                File::delete('uploads/user/' . $user->image);
            }
        }else{
            unset($data['image']);
        }
		if(!empty($request->get('first_name'))){
            $user->first_name = $request->get('first_name');
        }
		if(!empty($request->get('last_name'))){
            $user->last_name = $request->get('last_name');
        }
        if(!empty($request->get('password'))){
            $data['password'] =  bcrypt($request->get('password'));
        }else{
            unset($data['password']);
        }
        if(!$user->update($data)){
            return redirect(action('UserController@edit',$user->id))->with('message', 'Something wrong to updat data...')->with('class', 'alert-danger');
        }
        return redirect(action('UserController@edit',$user->id))->with('message', 'User successfully updated...')->with('class', 'alert-success');
    }
	
	/**
	* Function is use for delete user
	*
	**/
	public function destroy($id){
		$user = User::find($id);
		$user->delete();
        return redirect(action('UserController@index'))->with('message', 'User successfully deleted...')->with('class', 'alert-success');
    }
}
