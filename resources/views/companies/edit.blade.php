@extends('layouts.app')

@section('title', 'Edit Company')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('companies.index') }}">Companies</a></li>
        <li class="breadcrumb-item active">Edit</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header">
                            <h5 class="mb-0">Company Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="company_name">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('company_name') is-invalid @enderror"
                                       name="company_name" id="company_name"
                                       value="{{ old('company_name', $company->name) }}" required>
                                @error('company_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_email">Company Email</label>
                                <input type="email" class="form-control @error('company_email') is-invalid @enderror"
                                       name="company_email" id="company_email"
                                       value="{{ old('company_email', $company->email) }}">
                                @error('company_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_phone">Company Phone</label>
                                <input type="text" class="form-control @error('company_phone') is-invalid @enderror"
                                       name="company_phone" id="company_phone"
                                       value="{{ old('company_phone', $company->phone) }}">
                                @error('company_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_address">Company Address</label>
                                <textarea class="form-control @error('company_address') is-invalid @enderror"
                                          name="company_address" id="company_address" rows="3">{{ old('company_address', $company->address) }}</textarea>
                                @error('company_address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="company_logo">Company Logo</label>
                                @if($company->site_logo)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $company->site_logo) }}" alt="Current Logo" style="max-height: 60px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control-file @error('company_logo') is-invalid @enderror"
                                       name="company_logo" id="company_logo" accept="image/*">
                                <small class="form-text text-muted">Leave empty to keep current logo</small>
                                @error('company_logo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_active"
                                           name="is_active" {{ $company->is_active ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="is_active">Active</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Company Users</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->roles->pluck('name')->implode(', ') }}</td>
                                                <td>
                                                    @if($user->is_active)
                                                        <span class="badge badge-success">Active</span>
                                                    @else
                                                        <span class="badge badge-danger">Inactive</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">No users.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-lg"></i> Update Company
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
