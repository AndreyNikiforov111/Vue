<?php

namespace App\Http\Controllers\Passwords;

use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UpdateController extends Controller
{
    public function __invoke(PasswordRequest $request, $id){
        $validatedData = $request->validated();
        $password = Password::find($id);
        $password->update($validatedData);
        return  response()->json($password);
        //return redirect()->back()->with('errors', [])->with('success', 'Заказ изменен');
    }
}
