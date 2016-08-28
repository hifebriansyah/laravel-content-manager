<?php

namespace MFebriansyah\LaravelContentManager\Models;

use MFebriansyah\LaravelContentManager\Traits\Factory;

abstract class MainModel extends \MFebriansyah\LaravelAPIManager\Models\MainModel
{
    use Factory;

    protected $primaryKey = 'id';
    public static $columnLabel = 'id';
    public $timestamps = false;
}
