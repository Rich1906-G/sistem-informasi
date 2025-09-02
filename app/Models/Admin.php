<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin';

    protected $guarded = [];

    public function account()
    {
        return $this->hasMany(Account::class);
    }
    
}
