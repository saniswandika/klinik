@extends('layouts.app')

@section('title', 'Management Akun')


@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.css"/>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/js/C"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.js"></script>


<div class="container">
  @if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif
  <div class="card text-center">
    <div class="card-header">
      <h2>Users Management</h2>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                    {{-- @can('pemakaian-create') --}}
                      <a  class="btn btn-success" href="/users/create">Buat user akun</a>
                    {{-- @endcan --}}
                </div>
            
            </div>
        </div>
    </div>
  
      <div class="tab-pane fade show table-responsive">
      <table id="tableuser" class="table table-bordered">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th width="280px">Action</th>
          </tr>
        </thead>
        @foreach ($data as $key => $user)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#Show{{ $user->id }}">
                Show
              </button>
              <div class="modal fade" id="Show{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Akun {{ $user->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-left">
                      {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                      <div class="row">
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <strong>Name:</strong>
                                  <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->name }}" aria-describedby="emailHelp" placeholder="Enter email" disabled>
                                  {{-- {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control disable')) !!} --}}
                              </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="form-group">
                                  <strong>Email:</strong>
                                  <input type="email" class="form-control" id="exampleInputEmail1" value="{{ $user->email }}" aria-describedby="emailHelp" placeholder="Enter email" disabled>
                                  {{-- {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!} --}}
                              </div>
                          </div>
                          {{-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div> --}}
                      </div>
                      
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editUser{{ $user->id }}">
                Edit
              </button>
              <div class="modal fade" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Akun {{ $user->name }}</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-left">
                      {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
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
                                <strong>no_telepon:</strong>
                                {!! Form::text('no_telepon', null, array('placeholder' => 'no_telepon','class' => 'form-control')) !!}
                            </div>
                          </div>
                          <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Jenis Kelamin:</strong>
                                <select class="form-select" aria-label="Default select example" name="jenis_kelamin">
                                  <option value="{{ $user->jenis_kelamin }}" selected>{{ $user->jenis_kelamin }}</option>
                                  @if ($user->jenis_kelamin == 'Laki-Laki' )
                                   <option value="Perempuan">Perempuan</option>
                                  @else
                                   <option value="Laki-Laki">Laki-Laki</option>
                                  @endif
                                  {{-- <option value="3">Three</option> --}}
                              </select>
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
                          <div class="form-group">
                            <strong>Role:</strong>
                            <select class="form-control" name="roles" id="exampleFormControlSelect1">
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
                          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                      </div>
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        @endforeach
        </table>
      </div>
    </div>
    {!! $data->render() !!}
    {{-- <div class="card-footer text-muted">
      2 days ago
    </div> --}}
    
  </div>
</div>




{{-- <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p> --}}
@endsection