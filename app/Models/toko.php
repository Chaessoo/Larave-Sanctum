<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class toko extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = ["id"];


    public function User()
    {
        return $this->belongsTo(User::class,"id_user");
    }
}
