<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Auth;
class UsersController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }
    public function show($user_id){
      $user = User::findOrFail($user_id);

      return view('user/show')->with('user' , $user);
    }


    public function edit(){
      $user = Auth::user();

      return view('user/edit')->with('user' , $user);
    }

    public function update(Request $request)
    {

      $this->validate($request , [
        'user_name' => 'required|string|max:255',
        'user_password' => 'required|string|min:6|confirmed',
      ]);


      $user = User::findOrFail($request->user_id);

      if($request->hasFile('user_profile_photo')){
        if($request->file('user_profile_photo')->isValid()){
          $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
          $user->profile_photo = $user->id . '.jpg';
        }
      }
      $user->name = $request->user_name;
      $user->email = $request->user_email;
      $user->password = bcrypt($request->user_password); //hashed

      $user->save();
      return redirect('/users/' . $user->id);
    }
}
