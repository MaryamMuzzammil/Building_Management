@extends('adminlayout.app')
@section('style')
<style>
     .btn-primary {
        background-color: #FFE0C5;
        color: #996600;
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: none;
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
</style>
@endsection
@section('content')
<div class="container mt-2">
    <div class="pagetitle">
        <h1><center>Rent Details</center></h1>
    </div>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="text-transform: capitalize;">Rent Details for Tenant: {{ $rent->tenant->tenant_name }}</h2>
            <p class="card-text"><strong>Month:</strong> {{ $rent->multiple_month }}</p>
            <p class="card-text"><strong>Total Months:</strong> {{ $rent->total_month }}</p>
            <p class="card-text"><strong>Date:</strong> {{ $rent->date }}</p>
            <p class="card-text"><strong>Rent Amount Per Room:</strong> {{ number_format($rent->rent_for_month, 0) }}</p>
            <p class="card-text"><strong>Total Rent:</strong> {{ number_format($rent->total_amount, 0) }}</p>
            <p class="card-text"><strong>Government Taxes:</strong> {{ number_format($rent->government_taxes, 0) }}</p>
            <p class="card-text"><strong>Total Amount Paid:</strong> {{ number_format($rent->all_total, 0) }}</p>
            <p class="card-text"><strong>Paid:</strong> {{ $rent->paid_rent ? 'Yes' : 'No' }}</p>
            <div class="d-flex justify-content-between">
                <a href="{{ route('tenants.show', $rent->tenant->id) }}" class="btn btn-secondary">Back</a>
                <a href="{{ route('rents.receipt.download', $rent->id) }}" class="btn btn-primary">Print Receipt</a>
            </div>
        </div>
    </div>
</div>
@endsection
