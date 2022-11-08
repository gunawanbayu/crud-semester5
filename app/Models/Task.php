<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Task extends Model
{
    protected $fillable = [
        'name',
    ];
    protected $casts=[
        'user_id'=>'int'
    ];
    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
