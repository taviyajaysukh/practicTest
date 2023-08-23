<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $allowedFields = [
        'profile_picture',
        'username',
        'email',
        'password',
        'full_name',
        'gender',
        'city',
        'state',
        'status',
        'address',
        'created_at',
        'updated_at',
    ];
}
