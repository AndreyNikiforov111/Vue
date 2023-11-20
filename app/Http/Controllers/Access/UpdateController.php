<?php

namespace App\Http\Controllers\Access;

use App\Http\Controllers\Controller;
use App\Models\User_folder_access;
use App\Models\User_password_access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $id){
        try {
            DB::beginTransaction();

        User_password_access::where('user_id', $id)->delete();
        $password = $request->checkedPassword;
        $checkedPassword = [];
        foreach ( $password as $item) {
            $access = User_password_access::create([
                'user_id' => $id,
                'password_id' => $item
            ]);
            $checkedPassword[] = $access->password_id;
        }

        $folderRequest =  $request->checkedFolder;

        User_folder_access::where('user_id', $id)->delete();
        $checkedFolder = [];
        foreach ( $folderRequest as $item) {
            $folder = User_folder_access::create([
                'user_id' => $id,
                'folder_id' => $item
            ]);
            $checkedFolder[] = $folder->folder_id;
        }
            DB::commit();
        }catch (\Exception $exception ){
            DB::rollBack();
            return $exception->getMessage();
        }

        return  response()->json(['checkedPassword' => $checkedPassword,'checkedFolder' => $checkedFolder ]);
    }
}
