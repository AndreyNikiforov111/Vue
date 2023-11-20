<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id){
        //создание заказа
        $user = User::find($id);

        //$folder = Folders::all();
        //dd($user);
        return  response()->json($user);
        //return View('Users.edit')->with('user', $user);
    }
}
