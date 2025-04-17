@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <h4 class="fw-bold mb-4">Dashboard Statistik Surat</h4>

    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Surat</h5>
                    <p class="card-text fs-4">{{ $total }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-dark bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Pending</h5>
                    <p class="card-text fs-4">{{ $pending }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Disetujui</h5>
                    <p class="card-text fs-4">{{ $approved }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Ditolak</h5>
                    <p class="card-text fs-4">{{ $rejected }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
