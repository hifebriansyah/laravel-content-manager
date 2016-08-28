<?php

namespace MFebriansyah\LaravelContentManager\Models;

use MFebriansyah\LaravelContentManager\Traits\Factory;

abstract class MainModel extends \MFebriansyah\LaravelAPIManager\Models\MainModel
{
    use Factory;

    protected $primaryKey = 'id';
    public $timestamps = false;

    public static $lcmGlobal = [
    	'columnLabel' => 'name',
    	'hides' => [],
    	'readOnly' => ['created_at', 'updated_at'],
    	'files' => ['image_url']
    ];

    public static $lcm = [];
}
