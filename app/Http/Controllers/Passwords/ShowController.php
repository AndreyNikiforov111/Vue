<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use App\Models\Password;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke($id){
        //создание заказа
        $password = Password::find($id);
        $folder = Folder::all();
        //$folder = Folders::all();
        //dd($folder);

        //return  response()->json( $password );
        return  response()->json(['password' => $password, 'folder' => $folder] );
        //return View('Passwords.edit')->with('password', $password)->with('folder', $folder);
    }
}
