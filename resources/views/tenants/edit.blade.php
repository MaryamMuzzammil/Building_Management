@extends('adminlayout.app')

@section('style')
<style>
    .container {
        max-width: 600px; /* Restrict form width for better readability */
    }
    .pagetitle h1 {
        text-align: center;
        margin-bottom: 20px;
        font-weight: 800;
        color: #ffffff;
    }
    h3{
        color: white;
        font-weight: bolder;
        text-align: center;
        font-size: 40px;
    }
    .card {
        margin-top: 20px;
    }
    .card-title {
        margin-bottom: 20px;
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #FFE0C5;
        color: #996600;
        border: none;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #996600;
        color: white;
    }
    .btn-secondary {
        background-color: #f8f9fa;
        color: #6c757d;
        border: 1px solid #ced4da;
        transition: background-color 0.3s ease, color 0.3s ease;
    }
    .btn-secondary:hover {
        background-color: #e2e6ea;
        color: #495057;
    }
    .error-message {
        color: red;
        font-size: 0.875rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <h3>Edit Tenant</h3>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label for="tenant_name" class="form-label">Tenant Name</label>
            <input type="text" class="form-control" id="tenant_name" name="tenant_name" value="{{ old('tenant_name', $tenant->tenant_name) }}">
        </div>
        
        <div class="mb-3">
            <label for="father_name" class="form-label">Father Name</label>
            <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name', $tenant->father_name) }}">
        </div>
        
        <div class="mb-3">
            <label for="cnic_number" class="form-label">CNIC Number</label>
            <input type="text" class="form-control" id="cnic_number" name="cnic_number" value="{{ old('cnic_number', $tenant->cnic_number) }}">
        </div>
        
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $tenant->phone_number) }}">
        </div>
        
        <div class="mb-3">
            <label for="rent_start_date" class="form-label">Rent Start Date</label>
            <input type="date" class="form-control" id="rent_start_date" name="rent_start_date" value="{{ old('rent_start_date', $tenant->rent_start_date) }}">
        </div>
        
        <div class="mb-3">
            <label for="rent_end_date" class="form-label">Rent End Date</label>
            <input type="date" class="form-control" id="rent_end_date" name="rent_end_date" value="{{ old('rent_end_date', $tenant->rent_end_date) }}">
        </div>
        
     
        
        <div class="mb-3">
            <label for="cnic_image" class="form-label">CNIC Image</label>
            <input type="file" class="form-control" id="cnic_image" name="cnic_image">
            @if ($tenant->cnic_image)
                <img src="{{ asset($tenant->cnic_image) }}" alt="CNIC Image" style="max-width: 150px; margin-top: 10px;">
            @endif
        </div>
        
        <div class="mb-3">
            <label for="picture" class="form-label">Tenant Picture</label>
            <input type="file" class="form-control" id="picture" name="picture">
            @if ($tenant->picture)
                <img src="{{ asset($tenant->picture) }}" alt="Tenant Picture" style="max-width: 150px; margin-top: 10px;">
            @endif
        </div>
        
        <button type="submit" class="btn btn-primary">Update Tenant</button>
    </form>
</div>
@endsection
