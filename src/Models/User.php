<?php

namespace MFebriansyah\LaravelContentManager\Models;

use DB;

class User extends \MFebriansyah\LaravelAPIManager\Models\User
{
    protected $primaryKey = 'id';
    static $columnLabel = 'id';
    public $rules = [];
    public $timestamps = false;
    public $hide = [];
}