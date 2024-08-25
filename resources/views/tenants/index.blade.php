@extends('adminlayout.app')

@section('style')
<style>
    .pagetitle h1 {
        font-size: 35px;
        margin-bottom: 0;
        font-weight: 1000;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
    .table {
        border: 3px solid #99660038 ;
        box-shadow: 12px 19px 9px rgba(0, 0, 0, 0.231);
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }
    .table thead th {
        background-color: #FFE0C5;
        color: #996600;
        font-weight: bold;
        text-align: center;
        border: none;
    }
    .table tbody td {
        text-align: center;
        border: none;
    }
    .table tbody tr {
        background: linear-gradient(to right, #FFD786, #FFEBEB);
        color: #996600;
        border-bottom: 1px solid #f1f1f1;
    }
    .table tbody tr:hover {
        background-color: #f1f1f1;
        transition: background-color 0.3s ease;
    }
    .btn {
        margin-right: 5px;
        border: none;
    }
    .table-actions {
        display: flex;
        justify-content: center;
    }
    .btn-info, .btn-primary {
        background-color: #FFE0C5;
        color: #996600;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: none;
    }
    .btn-info:hover, .btn-primary:hover {
        background-color: #996600;
        color: white;
    }
    .btn-danger {
        background-color: #dc3545;
        color: white;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: none;
    }
    .btn-danger:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }
    .input-group-append button {
        border-radius: 1%;
        padding: 17%;
    }
     /* Pagination styles */
     .pagination {
        justify-content: center;

    }
    .pagination .page-item .page-link {
        color: #996600;
        background-color: #FFE0C5;
        border: none;
     
    }
    .pagination .page-item .page-link:hover {
        background-color: #996600;
        color: #ffffff;
     
    }
    .pagination .page-item.active .page-link {
        background-color: #996600;
        color: #ffffff;
        border: none;
    }
    
</style>
@endsection

@section('content')
<div class="container mt-5">
    <div class="pagetitle">
        <h1><center>Tenants List</center></h1>
    </div>
    
    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('tenants.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search tenants..." value="{{ request()->input('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </div>
    </form>

    {{-- <a href="{{ route('tenants.create') }}" class="btn btn-primary mb-3">Add New Tenant</a> --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tenant Name</th>
                <th>Father Name</th>
                <th>Phone Number</th>
                <th>Residence Type</th>
                <th>Residence Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tenants as $tenant)
                <tr>
                    <td>{{ $tenant->tenant_name }}</td>
                    <td>{{ $tenant->father_name }}</td>
                    <td>{{ $tenant->phone_number }}</td>
                    <td style="text-transform: capitalize;">
                        {{-- @if ($tenant->flats->isNotEmpty())
                            Flat
                        @elseif ($tenant->shops->isNotEmpty())
                            Shop
                        @elseif ($tenant->mezzanines->isNotEmpty())
                            Mezzanine
                        @endif --}}
                       {{ $tenant->home }}
                    </td>
                    <td>
                        {{-- @if ($tenant->flats->isNotEmpty())
                            {{ $tenant->flats->first()->flat_number }}
                        @elseif ($tenant->shops->isNotEmpty())
                            {{ $tenant->shops->first()->shop_number }}
                        @elseif ($tenant->mezzanines->isNotEmpty())
                            {{ $tenant->mezzanines->first()->mezzanine_number }}
                        @endif --}}
                       {{ $tenant->residence }}
                    </td>
                    <td class="table-actions">
                        <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-info">View</a>
                        {{-- <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning">Edit</a> --}}
                        {{-- <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form> --}}
                    </td>
                    {{-- <td>
                        <a href="{{ route('rents.create', $tenant->id) }}" class="btn btn-success">Add Rent</a>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="d-flex justify-content-center mt-3">
        {{ $tenants->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
  

@endsection

@section('scripts')
@endsection
