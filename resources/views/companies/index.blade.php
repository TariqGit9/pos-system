@extends('layouts.app')

@section('title', 'Companies')

@section('breadcrumb')
    <ol class="breadcrumb border-0 m-0">
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
        <li class="breadcrumb-item active">Companies</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">All Companies</h5>
                            <a href="{{ route('companies.create') }}" class="btn btn-primary">
                                <i class="bi bi-plus-lg"></i> Add Company
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Users</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($companies as $company)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->email ?? '-' }}</td>
                                            <td>{{ $company->phone ?? '-' }}</td>
                                            <td>{{ $company->users_count }}</td>
                                            <td>
                                                @if($company->is_active)
                                                    <span class="badge badge-success">Active</span>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <form action="{{ route('companies.enter', $company) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-info btn-sm" title="Enter Company">
                                                            <i class="bi bi-box-arrow-in-right"></i> Enter
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('companies.edit', $company) }}" class="btn btn-primary btn-sm" title="Edit">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('companies.destroy', $company) }}" method="POST" class="d-inline"
                                                          onsubmit="return confirm('Are you sure? This will delete all company data.')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No companies found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
