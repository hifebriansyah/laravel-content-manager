<?php

namespace HiFebriansyah\LaravelContentManager\Traits;

use Form;
use Illuminate\Support\MessageBag;
use Carbon;
use Session;

trait Generator
{
    public function generateForm($class, $columns, $model)
    {
        $lcm = $model->getConfigs();
        $errors = Session::get('errors', new MessageBag());
        $isDebug = (request()->input('debug') == true);

        if ($model[$model->getKeyName()]) {
            echo Form::model($model, ['url' => url('lcm/gen/'.$class.'/1'), 'method' => 'post', 'files' => true]);
        } else {
            echo Form::model('', ['url' => url('lcm/gen/'.$class), 'method' => 'post', 'files' => true]);
        }

        foreach ($columns as $column) {
            if (strpos($column->Extra, 'auto_increment') === false && !in_array($column->Field, $lcm['hides'])) {
                $readOnly = (in_array($column->Field, $lcm['readOnly'])) ? 'readonly' : '';

                if (!$model[$column->Field] && $column->Default != '') {
                    if ($column->Default == 'CURRENT_TIMESTAMP') {
                        $mytime = Carbon::now();
                        $model->{$column->Field} = $mytime->toDateTimeString();
                    } else {
                        $model->{$column->Field} = $column->Default;
                    }
                }

                echo '<div class="form-group '.($errors->has($column->Field) ? 'has-error' : '').'">';

                if (in_array($column->Field, $lcm['files'])) {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field));
                    echo Form::file($column->Field, [$readOnly]);
                } elseif (strpos($column->Key, 'MUL') !== false) {
                    $reference = $model->getReference($column->Field);
                    $referencedClass = '\\App\\Models\\'.studly_case(str_singular($reference->REFERENCED_TABLE_NAME));
                    $referencedClass = new $referencedClass();
                    $referencedClassLcm = $referencedClass->getConfigs();
                    $labelName = str_replace('_', ' ', $column->Field);
                    $labelName = str_replace('id', ':'.$referencedClassLcm['columnLabel'], $labelName);

                    echo Form::label($column->Field, $labelName);
                    echo Form::select($column->Field, ['' => '---'] + $referencedClass::lists($referencedClassLcm['columnLabel'], 'id')->all(), null, ['id' => $column->Field, 'class' => 'form-control', $readOnly]);
                } elseif (strpos($column->Type, 'char') !== false) {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field));
                    echo Form::text($column->Field, $model[$column->Field], ['class' => 'form-control', $readOnly]);
                } elseif (strpos($column->Type, 'text') !== false) {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field));
                    echo Form::textarea($column->Field, $model[$column->Field], ['class' => 'form-control', $readOnly]);
                } elseif (strpos($column->Type, 'int') !== false) {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field));
                    echo Form::number($column->Field, $model[$column->Field], ['class' => 'form-control', $readOnly]);
                } elseif (strpos($column->Type, 'timestamp') !== false || strpos($column->Type, 'date') !== false) {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field));
                    echo Form::text($column->Field, $model[$column->Field], ['class' => 'form-control has-datepicker', $readOnly]);
                } else {
                    echo Form::label($column->Field, str_replace('_', ' ', $column->Field.' [undetect]'));
                    echo Form::text($column->Field, $model[$column->Field], ['class' => 'form-control', $readOnly]);
                }

                echo $errors->first($column->Field, '<p class="help-block">:message</p>');
                echo '</div>';

                if ($isDebug) {
                    echo '<pre>', var_dump($column), '</pre>';
                }
            }
        }

        foreach ($lcm['checkboxes'] as $key => $value) {
            echo Form::checkbox('name', 'value');

        }

        echo '<button type="submit" class="btn btn-info"><i class="fa fa-save"></i>'.(($model[$model->getKeyName()]) ? 'Update' : 'Save').'</button>';

        Form::close();

        if ($isDebug) {
            echo '<pre>', var_dump($errors), '</pre>';
        }
    }
}
