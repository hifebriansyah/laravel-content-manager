@extends('lcm::layouts/master')

@section('title', $class)

@section('page-title', strtoupper($class)." MANAGEMENT")

@section('content')

	<div class="row">
	    <div class="col-md-12">
	        <div class="box">
	            <div class="box-header with-border">
	                <h3 class="box-title">Master Table</h3>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body">
	                <div class="row">
	                    <div class="col-xs-3">
	                        <a href="{{url('lcm/gen/'.$class.'/form')}}" class="btn btn-bg btn-warning"><i class="fa fa-plus-circle"></i> Add New</a>
	                    </div>
	                </div>
	                <br>
	                <div class="row">
	                    
	                    @if (isset($q))
	                        <center>
	                            <span>
	                                <a href="#">Show All</a>
	                            </span>
	                        </center>
	                    @endif

	                </div>
	                <br>
	                <table class="table table-bordered">
	                    <tr>	
	                    	@foreach ($columns as $column)
                    			@if(!in_array($column->Field, $model->hide))
                    				<th class="info">{{str_replace("_", " ", $column->Field)}}</th>
                    			@endif
							@endforeach
							<th style="text-align:center" class="info">actions</th>
	                    </tr>
	                    
	                    @forelse ($data as $row)

		                    <tr>
		                    	@foreach ($columns as $column)
	                    			@if(!in_array($column->Field, $model->hide))
		                        	<td>{{ $row[$column->Field] }}</td>
		                			@endif
								@endforeach
		                        <td align="center">
                            		{!! Form::model($model, ['url' => [url('lcm/gen/'.$class.'/'.$row[$model->getKeyName()])], 'method' => 'delete', 'class' => 'form-inline'] ) !!}
	                                	<a href="{{url('lcm/gen/'.$class.'/form/'.$row[$model->getKeyName()])}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>
	                                	<button type="submit" class="btn btn-xs btn-danger js-submit-confirm"><i class="fa fa-trash"></i> Delete</button>
	                                {!! Form::close()!!}
		                        </td>
		                    </tr>

	                    @empty
	                    <tr>
	                        <td colspan="6">Tidak ada data</td>
	                    </tr>
	                    @endforelse
	                </table>
	            </div>
	            <!-- /.box-body -->
	        </div>
	    </div>
	</div>
@endsection