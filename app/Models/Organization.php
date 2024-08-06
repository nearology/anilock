<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',  # type: text
        'keyname',  # type: text
    ];

    public function users(){
        return $this->hasMany(User::class);
    }
}
