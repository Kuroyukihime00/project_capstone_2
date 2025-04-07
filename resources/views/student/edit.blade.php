@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      @error('err_msg')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="page-header">
        <h3 class="fw-bold mb-3">Student Management</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('student-list') }}">Student</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{ route('student-update', [$student->nrp]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="nrp">NRP</label>
                  <input type="text" name="nrp" id="nrp" maxlength="9" placeholder="e.g. 202072001" class="form-control" value="{{ $student->nrp }}" required readonly>
                  @error('nrp')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" maxlength="100" placeholder="e.g. John Doe" class="form-control" value="{{ $student->name }}" required autofocus>
                  @error('name')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="birth_date">Birth Date</label>
                  <input type="date" name="birth_date" id="birth_date" class="form-control" value="{{ $student->birth_date }}" required>
                  @error('birth_date')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" maxlength="50" placeholder="e.g. john.doe@email.com" class="form-control" value="{{ $student->email }}">
                  @error('email')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="tel" name="phone" id="phone" maxlength="16" placeholder="e.g. 628111222333" class="form-control" value="{{ $student->phone }}" required>
                  @error('phone')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <textarea name="address" id="address" maxlength="300" placeholder="e.g. Some street #1" rows="4" class="form-control" required>{{ $student->address }}</textarea>
                  @error('address')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="profile_picture">Student Photo</label>
                  <input type="file" name="profile_picture" id="profile_picture" accept="image/png,image/jpg,image/jpeg" class="form-control">
                  @if($student->profile_picture != null)
                    <a href="{{ asset('storage/students_picture/' . $student->profile_picture) }}" target="_blank" role="button" class="btn btn-warning">Show Profile Picture</a>
                  @endif
                  @error('profile_picture')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="lecturer_nik">Academic Supervisor</label>
                  <select name="lecturer_nik" id="lecturer_nik" class="form-control" required>
                    <option value="">-- Choose Academic Supervisor --</option>
                    @foreach($lecturers as $lecturer)
                      @if ($lecturer->nik == $student->lecturer_nik)
                      <option value="{{ $lecturer->nik }}" selected>{{ $lecturer->name }}</option>
                      @else
                      <option value="{{ $lecturer->nik }}">{{ $lecturer->name }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('lecturer_nik')
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