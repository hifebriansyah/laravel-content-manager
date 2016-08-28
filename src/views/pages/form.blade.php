@extends('lcm::layouts/master')

@section('title', $class." - form")

@section('page-title', strtoupper($class)." MANAGEMENT")

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <a href="{{url('lcm/gen/'.$class)}}" class="box-title">Master</a> >
                <span class="box-title">{{ ($model) ? 'Edit' : 'Create' }} Form</span>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title"></h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                            
                                @if($model[$model->getKeyName()])
                                    {!! Form::model($model, ['url' => url('lcm/gen/'.$class.'/1'), 'method'=>'post', 'files' => true]) !!}
                                @else
                                    {!! Form::model('', ['url' => url('lcm/gen/'.$class), 'method'=>'post', 'files' => true]) !!}
                                @endif

                                @foreach ($schemes as $scheme)
                                    @if(strpos($scheme->Extra, 'auto_increment') === false && !in_array($scheme->Field, $lcm['hides']))

                                        <?php $readOnly = (in_array($scheme->Field, $lcm['readOnly'])) ? 'readonly' : '' ?>

                                        @if(!$model[$scheme->Field] && $scheme->Default != '')
                                            @if($scheme->Default == 'CURRENT_TIMESTAMP')
                                                <?php
                                                    $mytime = Carbon\Carbon::now();
                                                    $model->{$scheme->Field} = $mytime->toDateTimeString();
                                                ?>
                                            @else
                                                <?php $model->{$scheme->Field} = $scheme->Default; ?>                                                
                                            @endif
                                        @endif

                                        @if(in_array($scheme->Field, $lcm['files']))
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::file($scheme->Field, $model[$scheme->Field], ['class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @elseif(strpos($scheme->Key, 'MUL') !== false)
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                <?php 
                                                    $reference = $model->getReference($scheme->Field);
                                                    $referencedClass = '\\App\\Models\\'.studly_case(str_singular($reference->REFERENCED_TABLE_NAME));
                                                    $referencedClassLcm = array_merge($referencedClass::$lcmGlobal, $referencedClass::$lcm);
                                                ?>
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::select($scheme->Field, ['' => '---']+$referencedClass::lists($referencedClassLcm['columnLabel'],'id')->all(), null, ['id'=>$scheme->Field, 'class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}      
                                            </div>                      
                                        @elseif(strpos($scheme->Type, 'char') !== false)
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::text($scheme->Field, $model[$scheme->Field], ['class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @elseif(strpos($scheme->Type, 'text') !== false)
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::textarea($scheme->Field, $model[$scheme->Field], ['class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @elseif(strpos($scheme->Type, 'int') !== false)
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::number($scheme->Field, $model[$scheme->Field], ['class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @elseif(strpos($scheme->Type, 'timestamp') !== false || strpos($scheme->Type, 'date') !== false)
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field)) !!}
                                                {!! Form::text($scheme->Field, $model[$scheme->Field], ['class'=>'form-control has-datepicker', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>
                                        @else
                                            <div class="form-group {!! $errors->has($scheme->Field) ? 'has-error' : '' !!}">
                                                {!! Form::label($scheme->Field, str_replace("_", " ", $scheme->Field.' [undetect]')) !!}
                                                {!! Form::text($scheme->Field, $model[$scheme->Field], ['class' => 'form-control', $readOnly]) !!}
                                                {!! $errors->first($scheme->Field, '<p class="help-block">:message</p>') !!}
                                            </div>                                      
                                        @endif   
                                        <pre class="hidden">{{var_dump($scheme)}}</pre>                              
                                    @endif



                                @endforeach

                                <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> {{ ($model[$model->getKeyName()]) ? 'Update' : 'Save' }}</button>

                                {!! Form::close() !!}

                            </div>
                            <!-- /.box-body -->

                        </div>
                        <!-- /.box -->
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<!-- /.row -->
@endsection

@section('styles')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
@endsection

@section('scripts')
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
        $(function() {
            $( ".has-datepicker:not([readonly])" ).datepicker({dateFormat:'yy-mm-dd'});
        });
    </script>
@endsection

