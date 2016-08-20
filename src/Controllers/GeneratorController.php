<?php

namespace MFebriansyah\LaravelContentManager\Controllers;

use Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneratorController extends Controller
{
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
        $schemes = $this->model->getSchemes();
        $model = $this->model;
        $data = $model->get();

        return view('lcm::pages/index', compact('class', 'model', 'schemes', 'data'));
    }

    public function getForm($class, $id = null)
    {
        $schemes = $this->model->getSchemes();
        $model = ($id) ? $this->model->findOrFail($id) : $this->model;

        return view('lcm::pages/form', compact('class', 'model', 'schemes', 'model'));
    }

    public function postUpdate($class, $id, Request $request)
    {
        $schemes = $this->model->getSchemes();
        $model = $this->model->setRules($schemes);

        $this->validate($request, $model->rules);

        $model = $this->model->findOrFail($id);

        foreach ($schemes as $scheme) {
            if ($request->has($scheme->Field)) {
                $model->{$scheme->Field} = $request->input($scheme->Field);
            }
        }

        $model->save();

        Session::flash('flash_notification', [
            'level' => 'success',
            'message' => 'Update success',
        ]);

        return redirect(url('lcm/gen/'.$class.'/form/'.$model->{$model->getKeyName()}));
    }

    public function postStore($class, Request $request)
    {
        $schemes = $this->model->getSchemes();

        $model = $this->model->setRules($schemes);

        $this->validate($request, $model->rules);

        foreach ($schemes as $scheme) {
            if (strpos($scheme->Extra, 'auto_increment') === false) {
                $model->{$scheme->Field} = request()->input($scheme->Field);
            }
        }

        $model->save();

        Session::flash('flash_notification', [
            'level' => 'success',
            'message' => 'Create success',
        ]);

        return redirect(url('lcm/gen/'.$class.'/form/'.$model->{$model->getKeyName()}));
    }
}
