<?php

namespace App\Http\Controllers\AccessUser;

use App\Http\Controllers\Controller;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id){

        try {
            DB::beginTransaction();
        User_password_access::where('password_id', $id)->delete();
        $password = $request->checkedPassword;
        $checkedPassword = [];
        foreach ( $password as $item) {
            $access = User_password_access::create([
                'user_id' => $item,
                'password_id' => $id
            ]);
            $checkedPassword[] = $access->user_id;
        }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }


        return  response()->json(['checkedPassword' => $checkedPassword]);
    }
}
