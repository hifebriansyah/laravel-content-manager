<?php

namespace MFebriansyah\LaravelContentManager\Models;

use MFebriansyah\LaravelContentManager\Traits\Factory;

class User extends \MFebriansyah\LaravelAPIManager\Models\User
{
    use factory;
    
    protected $primaryKey = 'id';
    static $columnLabel = 'id';
    public $timestamps = false;
}