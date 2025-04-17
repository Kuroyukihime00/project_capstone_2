@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Student Management</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('admin.student.index') }}">Student</a></li>
        </ul>
      </div>
      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      @error('err_msg')
      <div class="alert alert-danger">{{ $message }}</div>
      @enderror
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <div class="d-flex align-items-center">
                <h4 class="card-title">Add Student</h4>
                <a href="{{ route('admin.student.create') }}" class="btn btn-primary btn-round ms-auto">
                  <i class="fa fa-plus"></i>
                  Add Data
                </a>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                    id="table-student"
                    class="display table table-striped table-hover"
                >
                  <thead class="thead-dark">
                  <tr>
                    <th>NRP</th>
                    <th>Name</th>
                    <th>Birth Date</th>
                    <th>Phone</th>
                    <th>Academic Supervisor</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($students as $student)
                    <tr>
                      <td>{{ $student->nrp }}</td>
                      <td>{{ $student->name }}</td>
                      <td>{{ \Carbon\Carbon::parse($student->birth_date)->format('d M Y') }}</td>
                      <td>{{ $student->phone }}</td>
                      <td>{{ $student->academicSupervisor->nik }} - {{ $student->academicSupervisor->name }}</td>
                      <td>
                        <div class="form-button-action">
                          <button
                              data-bs-toggle="tooltip"
                              title="Student Detail"
                              class="btn btn-link btn-success detail-data"
                              data-original-title="Student Detail"
                              data-url="{{ route('admin.student.show', [$student->nrp]) }}"
                          >
                            <i class="fas fa-info-circle"></i>
                          </button>
                          <button
                              data-bs-toggle="tooltip"
                              title="Edit Student"
                              class="btn btn-link btn-primary edit-data"
                              data-original-title="Edit Student"
                              data-url="{{ route('admin.student.edit', [$student->nrp]) }}"
                          >
                            <i class="fa fa-edit"></i>
                          </button>
                          <form method="post" action="{{ route('admin.student.destroy', [$student->nrp]) }}">
                            @csrf
                            @method('DELETE')
                            <button
                                type="submit"
                                data-bs-toggle="tooltip"
                                title="Delete Student"
                                class="btn btn-link btn-danger delete-data"
                                data-original-title="Remove Student"
                            >
                              <i class="fa fa-times"></i>
                            </button>
                          </form>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
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
  <script src="{{ asset('assets/js/plugin/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script>
    $("#table-student").DataTable({
      pageLength: 25,
    });
    $('.detail-data').click(function () {
      window.location.href = $(this).data('url');
    })
    $('.edit-data').click(function () {
      window.location.href = $(this).data('url');
    })
    $('.delete-data').click(function (e) {
      e.preventDefault()
      Swal.fire({
        title: "Confirm to delete this data?",
        showCancelButton: true,
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.isConfirmed) {
          $(e.target).closest("form").submit()
        }
      })
    })
  </script>
  @error('err_msg')
  <script>
    $.notify({
      message: "{{ $message }}"
    }, {
      type: "danger",
      delay: 4000,
    })
  </script>
  @enderror
@endsection