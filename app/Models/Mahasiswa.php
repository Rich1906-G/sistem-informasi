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

    public function tugas()
    {
        return $this->belongsToMany(Tugas::class, 'mahasiswa_tugas', 'mahasiswa_id', 'tugas_id')->withPivot(['status'])->withTimestamps();
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'mahasiswa_project', 'mahasiswa_id', 'project_id');
    }
}
