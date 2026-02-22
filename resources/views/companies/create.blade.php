@extends('layouts.app')

@section('title', 'Create Company')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('companies.store') }}" method="POST">
            @csrf
            <div class="row">
                {{-- Company Details --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Company Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                       name="company_name" id="company_name" value="{{ old('company_name') }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_email">Company Email</label>
                                <input type="email" class="form-control @error('company_email') is-invalid @enderror"
                                       name="company_email" id="company_email" value="{{ old('company_email') }}">
                                @error('company_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_phone">Company Phone</label>
                                <input type="text" class="form-control @error('company_phone') is-invalid @enderror"
                                       name="company_phone" id="company_phone" value="{{ old('company_phone') }}">
                                @error('company_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_address">Company Address</label>
                                <textarea class="form-control @error('company_address') is-invalid @enderror"
                                          name="company_address" id="company_address" rows="3">{{ old('company_address') }}</textarea>
                                @error('company_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Company Admin --}}
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Company Admin User</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="admin_name">Admin Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('admin_name') is-invalid @enderror"
                                       name="admin_name" id="admin_name" value="{{ old('admin_name') }}" required>
                                @error('admin_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="admin_email">Admin Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('admin_email') is-invalid @enderror"
                                       name="admin_email" id="admin_email" value="{{ old('admin_email') }}" required>
                                @error('admin_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="admin_password">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('admin_password') is-invalid @enderror"
                                       name="admin_password" id="admin_password" required>
                                @error('admin_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="admin_password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control"
                                       name="admin_password_confirmation" id="admin_password_confirmation" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Create Company
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
