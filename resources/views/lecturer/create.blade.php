@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Lecturer Management</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('admin.lecturer.index') }}">Lecturer</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{ route('admin.lecturer.store') }}">
                @csrf
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" id="nik" maxlength="7" placeholder="e.g. 720001" class="form-control" value="{{ old('nik') }}" required autofocus>
                  @error('nik')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" maxlength="100" placeholder="e.g. John Doe" class="form-control" value="{{ old('name') }}" required>
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="birth_date">Birth Date</label>
                  <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ old('birth_date') }}" required>
                  @error('birth_date')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" maxlength="50" placeholder="e.g. john.doe@email.com" class="form-control" value="{{ old('email') }}" required>
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Save</button>
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