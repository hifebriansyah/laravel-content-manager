<?php

namespace MFebriansyah\LaravelContentManager\Models;

use MFebriansyah\LaravelContentManager\Traits\Factory;

abstract class MainModel extends \MFebriansyah\LaravelAPIManager\Models\MainModel
{
    use factory;

    protected $primaryKey = 'id';
    static $columnLabel = 'id';
    public $timestamps = false;
}