@extends('layouts.index')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Dashboard</h6>
            </div>
            <div class="ms-md-auto py-2 py-md-0">
                <a href="#" class="btn btn-label-info btn-round me-2">Manage</a>
                <a href="#" class="btn btn-primary btn-round">Add Customer</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Edit Data Dosen</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('dosenUpdate', [$dosen->nik]) }}">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" id="nik" name="nik" class="form-control" maxlength="7" required readonly value="{{ $dosen->nik }}"/>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" maxlength="100" required autofocus value="{{ $dosen->name }}"/>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_lahir">Birth Date</label>
                        <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required value="{{ $dosen->tanggal_lahir }}"/>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" maxlength="100" required value="{{ $dosen->email }}"/>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('dosenList') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
