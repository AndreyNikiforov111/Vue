<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\User_folder_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(UserRequest $request){

        //проверка на ошибки
        $validatedData = $request->validated();
        //dd($request['username']);
        $name = $request['name'];
        $email = $request['email'];
        $password = $request['password'];
        $role = $request['role'];
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,

        ]);

        return  response()->json(['result' =>'success']);
        //return redirect()->back()->with('errors', [])->with('success',  'Пользователь создан')->withInput();
    }
}
