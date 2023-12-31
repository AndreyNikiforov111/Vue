<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected function folders(){
        return $this->hasMany(User_folder_access::class, 'folder_id');
    }
}
