<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Helper;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $fileupload;

    public function __construct(FileUploadService $fileupload)
    {
       
        $this->fileupload=$fileupload;
     
    }
    public function login(AuthRequest $request)
    {
        // login user
        if(!Auth::attempt($request->only('email','password'))){
            Helper::sendError('Email Or Password is wroing !!!');
        }
        // send response
        return new UserResource(auth()->user());
    }

    public function register(RegisterRequest $request){
        $data=$request->all();
        $data['image'] =  $this->fileupload->download($request)??false;
      
        $data['password' ]= Hash::make($request->password);
        $user=User::create($data); 
       
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
      return new UserResource(auth()->user());
    }
}
