@extends('layouts.index')

@section('content')
<div class="container">
  <div class="page-inner">
    <h4>Edit Role Pengguna</h4>
    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
      @csrf
      @method('PUT')
      <div class="form-group">
        <label for="role_id">Role</label>
        <select name="role_id" class="form-control" required>
          @foreach ($roles as $role)
            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
              {{ ucfirst($role->name) }}
            </option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
  </div>
</div>
@endsection
