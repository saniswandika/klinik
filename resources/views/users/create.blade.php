@extends('layouts.app')


@section('content')
<div class="card" >
     <div class="card-header ">
      
        <div class="pull-left">
            <h2>Buat Akun Baru User</h2>
        </div>
        <div class="text-end" style="margin-bottom: -50px;">
            <a class="btn btn-primary ml-2" href="{{ route('users.index') }}">Kembali</a>
        </div>
        {{-- <a href="{{ route('rekomendasi_terdaftar_yayasans.index') }}" class="btn btn-primary ml-2">Kembali</a> --}}
    </div>
    
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
        </ul>
      </div>
    @endif
    <div class="card-body">
        {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>alamat:</strong>
                    {!! Form::text('alamat', null, array('placeholder' => 'alamat','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Jenis kelamin:</strong>
                    <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                        <option selected>Pilih Jenis Kelamin...</option>
                        <option value="laki-laki">laki-laki</option>
                        <option value="perempuan">perempuan</option>
                        {{-- <option value="3">Three</option> --}}
                    </select>
                    {{-- {!! Form::text('jenis_kelamin', null, array('placeholder' => 'jenis_kelamin','class' => 'form-control')) !!} --}}
                    {{-- {!! Form::select('jenis_kelamin', $optionsArray, null, ['class' => 'form-control']) !!} --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>No Telepon:</strong>
                    {!! Form::number('no_telepon', null, array('placeholder' => 'no_telepon','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select class="form-select" aria-label="Default select example" name="roles">
                      <option selected>
                        {{-- @if(!empty($user->getRoleNames()))
                          @foreach($user->getRoleNames() as $v)
                              <label class="badge badge-success">{{ $v }}</label>
                          @endforeach
                        @endif --}}
                      </option>
                      @foreach ($roles as $role )
                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                      @endforeach
                  </select> 
                    
                    {{-- {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','option')) !!} --}}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
         
        </div>
        {!! Form::close() !!}
    </div>
  </div>







{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
@endsection