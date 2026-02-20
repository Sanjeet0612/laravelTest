<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_admin';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'emailid',
        'password',
        'phone',
        'profile_img',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}