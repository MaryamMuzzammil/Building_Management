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
<div class="container mt-2">
    <div class="pagetitle">
        <h1>Edit Rent</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Rent for Tenant: {{ $rent->tenant->tenant_name }}</h2>
            <form action="{{ route('rents.update', $rent->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="start_month" class="form-label">Start Month</label>
                    <select id="start_month" name="start_month" class="form-control @error('start_month') is-invalid @enderror">
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{ $month }}" {{ old('start_month', $rent->month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('start_month')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="end_month" class="form-label">End Month</label>
                    <select id="end_month" name="end_month" class="form-control @error('end_month') is-invalid @enderror">
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{ $month }}" {{ old('end_month', $rent->month) == $month ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>
                    @error('end_month')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $rent->year) }}" >
                    @error('year')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $rent->date) }}" >
                    @error('date')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="rent_for_month" class="form-label">Rent Amount</label>
                    <input type="number" class="form-control @error('rent_for_month') is-invalid @enderror" id="rent_for_month" name="rent_for_month" value="{{ old('rent_for_month', $rent->rent_for_month) }}" >
                    @error('rent_for_month')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="government_taxes" class="form-label">Government Taxes</label>
                    <input type="number" class="form-control @error('government_taxes') is-invalid @enderror" id="government_taxes" name="government_taxes" step="0.01" value="{{ old('government_taxes', $rent->government_taxes) }}"> 
                    @error('government_taxes')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="total_month" class="form-label">Total Months</label>
                    <input type="number" class="form-control @error('total_month') is-invalid @enderror" id="total_month" name="total_month" value="{{ old('total_month', $rent->total_month) }}" >
                    @error('total_month')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="paid_rent" class="form-label">Paid Rent</label>
                    <select class="form-control @error('paid_rent') is-invalid @enderror" id="paid_rent" name="paid_rent">
                        <option value="0" {{ old('paid_rent', $rent->paid_rent) == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('paid_rent', $rent->paid_rent) == '1' ? 'selected' : '' }}>Yes</option>
                    </select>
                    @error('paid_rent')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-between">
                    <a href="{{ route('tenants.show', $rent->tenant_id) }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update Rent</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                customClass: {
                    popup: 'swal2-small-popup',
                },
                width: '300px',
                padding: '1em',
                backdrop: 'rgba(0,0,0,0.2)',
                confirmButtonColor: '#996600',
            });
        @endif
    });
</script>
<style>
    .swal2-small-popup {
        border-radius: 10px;
        background: #fff3e0;
        color: #996600;
        font-size: 14px;
    }
</style>
@endsection
