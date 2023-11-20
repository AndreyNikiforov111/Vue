<?php

namespace App\Http\Controllers\Folders;

use App\Http\Controllers\Controller;
use App\Http\Requests\FolderRequest;
use App\Models\Folder;
use App\Models\User_folder_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function __invoke(FolderRequest $request){
        $validatedData = $request->validated();
        if (Auth::check()) {
        $name = $validatedData['name'];
        //$user_id = $validatedData['user_id'];
        //dd($name);
        $folder = Folder::create([
            'name' => $name,
            'user_id' =>  Auth::id(),

        ]);

            if (Auth::user()->hasRole('user')) {
                User_folder_access::create([
                    'folder_id' => $folder->id,
                    'user_id' => Auth::id()
                ]);
            }
        }
            //dd($password);
        return response()->json(['result' =>'success']);
        //return redirect()->back()->with('errors', [])->with('success',  'Ваш папка создана')->withInput();;
    }
}
