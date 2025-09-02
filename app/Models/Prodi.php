<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';

    protected $guarded = [];

    public function account()
    {
        return $this->hasMany(Account::class);
    }
}
