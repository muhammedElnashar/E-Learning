<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class RegisterationController extends Controller
{
    public function Register(Request $request){
        $data=$request->all();
       $registerValidator=Validator::make($data,[
           'name' => ['required', 'string', 'max:255'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
           'password' => ['required', 'string', 'min:8', 'confirmed'],
           "password_confirmation" => ['required'],
           'national_id' => ['required','digits:14', 'string', 'unique:users'],
           'gender' => ['required', 'string', 'in:Male,Female'],
           'image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:1000'],

       ]);
       if ($registerValidator->fails()){
           return response()->json([
               'validation_errors' => $registerValidator->errors(),
               'message' => 'Failed to register',

           ],422);
       }
        if ($request->hasFile("image")) {
            $image = $request->file("image");
            $imagePath = $image->store("images", "user_image");
        }
       $data['role_id']=3;
        $data['image'] = $imagePath;
        $data['password']=Hash::make($request->password);
       $user=User::create($data);
       $token =$user->createToken($request->name);
        return[
            new UserResource($user),
            'massage'=>'Register Successfully ',
            'result'=>true,
            'token' => $token->plainTextToken,

        ] ;
    }
    public function Login(Request $request){
        $loginValidator=Validator::make($request->all(),[
            'email' => ['required', 'email','exists:users'],
            'password' => ['required', 'min:8'],
        ]);
        if ($loginValidator->fails()){
            return response()->json([
                'validation_errors' => $loginValidator->errors(),
                'message' => 'Login Failed',

            ],422);
        }
    $user = User::where('email',$request->email)->first();
        if ( !$user|| !Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Invalid Password',
            ],401);
        }
        $token =$user->createToken($user->name);

        return[
           'data' =>  new UserResource($user),
            'massage'=>'Login Successfully ',
            'result'=>true,
            'token' => $token->plainTextToken,
        ] ;
    }
    public function Logout(Request $request){
       $user= $request->user();
        $user->tokens()->delete();
        return response()->json([
           'message' => 'Logged Out Successfully',
        ]);
    }

}
