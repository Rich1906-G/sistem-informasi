<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Account extends Authenticatable
{
    use Notifiable;

    protected $table = 'account'; // kalau tabelmu bernama 'account'

    protected $guarded = [];

    // supaya Auth::attempt tahu username yg dipakai
    // public function getAuthIdentifierName()
    // {
    //     return 'username';
    // }

    
}
