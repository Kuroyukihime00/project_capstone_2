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

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @error('err_msg')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h4 class="card-title">Employee List</h4>
            <a href="{{ route('admin.employee.create') }}" class="btn btn-primary btn-round ms-auto">
              <i class="fa fa-plus"></i> Add Data
            </a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="table-employee" class="display table table-striped table-hover">
                <thead class="thead-dark">
                  <tr>
                    <th>NIP</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th style="width: 10%">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($employees as $employee)
                  <tr>
                    <td>{{ $employee->nip }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->role->name }}</td>
                    <td>
                      <div class="form-button-action d-flex gap-1">
                        <button class="btn btn-link btn-primary edit-data"
                          data-url="{{ route('admin.employee.edit', [$employee->nip]) }}"
                          title="Edit">
                          <i class="fa fa-edit"></i>
                        </button>

                        @if($employee->role->name !== 'admin')
                        <form method="POST" action="{{ route('admin.employee.destroy', [$employee->nip]) }}">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link btn-danger delete-data" title="Delete">
                            <i class="fa fa-times"></i>
                          </button>
                        </form>
                        @endif
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

@section('ExtraJS')
<!-- jQuery (pastikan ini ada di layout utama atau sebelum ini) -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/plugin/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
  $('#table-employee').DataTable({ pageLength: 25 });

  $('.edit-data').on('click', function () {
    window.location.href = $(this).data('url');
  });

  $('.delete-data').on('click', function (e) {
    e.preventDefault();
    const form = $(this).closest('form');

    Swal.fire({
      title: "Yakin ingin menghapus data ini?",
      text: "Data tidak bisa dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Ya, hapus!"
    }).then((result) => {
      if (result.isConfirmed) {
        form.submit();
      }
    });
  });
</script>

@if(session('status'))
<script>
  $.notify({
    message: "{{ session('status') }}"
  }, {
    type: "success",
    delay: 4000,
  });
</script>
@endif

@error('err_msg')
<script>
  $.notify({
    message: "{{ $message }}"
  }, {
    type: "danger",
    delay: 4000,
  });
</script>
@enderror
@endsection
