<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $guarded = [];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }
}
