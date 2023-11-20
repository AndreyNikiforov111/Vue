<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(){

        //$user = User::all();
        //$folder = Folder::all();
        return response()->json();
        //return View('Users.create');
    }
}
