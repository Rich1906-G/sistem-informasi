<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $guarded = [];


    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
