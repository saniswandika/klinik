@extends('layouts.app')
@section('content')
    @if ($message = Session::get('masuk'))
    <div class="alert alert-success">
        <a class="close" data-dismiss="alert">×</a>
        <p>{{ $message }}</p>
        <img src="close.soon" style="display:none;" onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },2000 ); })(this);" />
    </div>
    @endif
    @if ($message = Session::get('deleted'))
    <div class="alert alert-danger">
        <a class="close" data-dismiss="alert">×</a>
        <p>{{ $message }}</p>
        <img src="close.soon" style="display:none;" onerror="(function(el){ setTimeout(function(){ el.parentNode.parentNode.removeChild(el.parentNode); },2000 ); })(this);" />
    </div>
    @endif
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        <div class="card mt-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div class="p-2 bd-highlight">Create Role</div>
                    
                    <div class="p-2 bd-highlight">
                        <ul class="list-group list-group-unbordered center">
                            <a class="btn btn-primary" href="{{ route('roles.index') }}"> kembali</a>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="card-body">              
                <div class="row">
                 
                    @foreach($permission as $value)
                        
                        <div class="col-sm-2 mt-4">
                            <div class="content">
                                <ul class="list-group">
                                    <li class="list-group-item">  
                                        <label> 
                                            <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            {{ $value->name }}</label>
                                        <br/>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <ul class="list-group list-group-unbordered mb-3 center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </ul>
        </div>
    {!! Form::close() !!}
@endsection