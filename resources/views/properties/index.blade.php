<!-- resources/views/properties/index.blade.php -->

@extends('adminlayout.app')

@section('style')
<style>
    .container {
        max-width: 1200px; /* Adjust width for larger view */
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
    border-left: none; /* Remove left border */
    border-right: none; /* Remove right border */
    border-top: none; /* Remove top border */
    border-bottom: 1px solid rgba(128, 128, 128, 0.135); /* Add bottom border */
    }
    .table tbody tr {
        border-bottom: 1px solid grey;
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
    h2 , h4{
        font-weight: 1000;
        color: #ffffff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Properties Overview</h2>
    
    <!-- Flats Table -->
    <div class="table-container">
        <h4>Flats</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Flat Number</th>
                    <th>Floor Number</th>
                    <th>Total Rooms</th>
                    <th>Area (sq ft)</th>
                    <th>Tenant Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($flats as $flat)
                    <tr>
                        <td>{{ $flat->flat_number }}</td>
                        <td>{{ $flat->floor_number }}</td>
                        <td>{{ $flat->total_rooms }}</td>
                        <td>{{ $flat->sq_ft_area }}</td>
                        <td>{{ $flat->tenant ? $flat->tenant->tenant_name : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No flats available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mezzanine Floors Table -->
    <div class="table-container">
        <h4>Mezzanine Floors</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mezzanine Number</th>
                    <th>Area (sq ft)</th>
                    <th>Tenant Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mezzanines as $mezzanine)
                    <tr>
                        <td>{{ $mezzanine->mezzanine_number }}</td>
                        <td>{{ $mezzanine->sq_ft_area }}</td>
                        <td>{{ $mezzanine->tenant ? $mezzanine->tenant->tenant_name : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No mezzanine floors available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Shops Table -->
    <div class="table-container">
        <h4>Shops</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Shop Number</th>
                    <th>Area (sq ft)</th>
                    <th>Tenant Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse($shops as $shop)
                    <tr>
                        <td>{{ $shop->shop_number }}</td>
                        <td>{{ $shop->sq_ft_area }}</td>
                        <td>{{ $shop->tenant ? $shop->tenant->tenant_name : 'N/A' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No shops available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
