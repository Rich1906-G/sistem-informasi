<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tugas extends Model
{
    protected $table = 'tugas';

    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function project()
    {
        return $this->hasMany(Project::class);
    }

    public function mahasiswa()
    {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_tugas', 'tugas_id', 'mahasiswa_id')->withPivot(['status'])->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($tugas) {
            $tugas->slug = Str::slug($tugas->nama_tugas, '-'); // Buat slug dari judul otomatis
        });
    }
}
