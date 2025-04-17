@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Employee Management</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('admin.employee.index') }}">Employee</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{ route('admin.employee.update', [$employee->nip]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="nip">NIP</label>
                  <input type="text" name="nip" id="nip" maxlength="7" placeholder="e.g. 720001" class="form-control" value="{{ $employee->nip }}" required readonly>
                  @error('nip')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" maxlength="100" placeholder="e.g. John Doe" class="form-control" value="{{ $employee->name }}" required autofocus>
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" maxlength="50" placeholder="e.g. john.doe@email.com" class="form-control" value="{{ $employee->email }}" required>
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')
  <script>
    $("#table-lecturer").DataTable({
      pageLength: 25,
    });
  </script>
@endsection