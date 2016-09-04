<?php

namespace MFebriansyah\LaravelContentManager\Models;

use MFebriansyah\LaravelContentManager\Traits\Factory;

class User extends \MFebriansyah\LaravelAPIManager\Models\User
{
    use Factory;

    protected $primaryKey = 'id';
    public $timestamps = false;

    public static $lcmGlobal = [
        'columnLabel' => 'username',
        'hides' => [],
        'readOnly' => ['created_at', 'updated_at'],
    ];

    public static $lcm = [];
}
