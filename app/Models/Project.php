<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';

    protected $guarded = [];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }
}
