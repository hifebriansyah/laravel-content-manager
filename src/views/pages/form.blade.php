@extends('lcm::layouts/master')

@section('title', $class." - form")

@section('page-title', strtoupper($class)." MANAGEMENT")

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <a href="{{url('lcm/gen/'.$class)}}" class="box-title">Master Table</a> >
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

                                {{$generator->generateForm($class, $columns, $model)}}

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

