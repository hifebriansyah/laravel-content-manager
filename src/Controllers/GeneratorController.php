<?php

namespace HiFebriansyah\LaravelContentManager\Controllers;

use Session;
use App\Http\Controllers\Controller;
use HiFebriansyah\LaravelContentManager\Traits\Generator;

class GeneratorController extends Controller
{
    use Generator;

    protected $model;

    /*
    |--------------------------------------------------------------------------
    | CONSTRUCTOR
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $class = 'App\\Models\\'.(\Route::current()->getParameter('class'));
        $this->model = new $class();
    }

    /*
    |--------------------------------------------------------------------------
    | METHODS
    |--------------------------------------------------------------------------
    */

    public function getIndex($class)
    {
        $columns = $this->model->getColumns();
        $model = $this->model;
        $data = $model->get();

        return view('lcm::pages/index', compact('class', 'model', 'columns', 'data'));
    }

    public function getForm($class, $id = null)
    {
        $columns = $this->model->getColumns();
        $model = ($id) ? $this->model->findOrFail($id) : $this->model;
        $generator = $this;

        return view('lcm::pages/form', compact('class', 'columns', 'model', 'generator'));
    }

    public function postUpdate($class, $id)
    {
        $columns = $this->model->getColumns();
        $model = $this->model->setRules($columns);

        $this->validate(request(), $model->rules);

        $model = $this->model->findOrFail($id);

        foreach ($columns as $column) {
            if (request()->has($column->Field)) {
                $model->{$column->Field} = request()->input($column->Field);
            }
        }

        $model->save();

        Session::flash('flash_notification', [
            'level' => 'success',
            'message' => 'Update success',
        ]);

        return redirect(url('lcm/gen/'.$class.'/form/'.$model->{$model->getKeyName()}));
    }

    public function postStore($class)
    {
        $columns = $this->model->getColumns();

        $model = $this->model->setRules($columns);

        $this->validate(request(), $model->rules);

        foreach ($columns as $column) {
            if (strpos($column->Extra, 'auto_increment') === false) {
                $model->{$column->Field} = request()->input($column->Field);
            }
        }

        $model->save();

        Session::flash('flash_notification', [
            'level' => 'success',
            'message' => 'Create success',
        ]);

        return redirect(url('lcm/gen/'.$class.'/form/'.$model->{$model->getKeyName()}));
    }

    public function getLogin($class)
    {
        return view('lcm::pages/login', compact('model'));
    }

    public function postLogin($class)
    {
        $this->validate(request(), ['email' => 'required', 'password' => 'required']);
        $model = $this->model->postLogIn();

        if ($model) {
            $response = redirect(url('lcm/gen/'.$class.'/form/'.$model->{$model->getKeyName()}));
        } else {
            Session::flash('flash_notification', [
                'level' => 'error',
                'message' => 'Incorrect Credential',
            ]);

            $response = redirect()->back()->withInput();
        }

        return $response;
    }
}
