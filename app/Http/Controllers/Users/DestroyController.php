<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DestroyController extends Controller
{
    public function __invoke($id){
        $User = User::find($id);
        //dd($password);
        $User->delete();
        return  response()->json($User);
        //dd($User);
        //return Redirect::to('users');
    }
}
