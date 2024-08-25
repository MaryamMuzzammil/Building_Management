@extends('adminlayout.app')

@section('style')
<style>
    .card-body {
        display: flex;
        flex-direction: column;
    }
    
    .card-text {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 10px;
    }
    
    .card-text strong {
        flex: 0 0 10rem; /* Adjust width as needed */
        min-width: 150px; /* Ensure consistent spacing */
    }
    
    .note {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-top: 20px;
        font-style: italic;
    }
    
    .note::before {
        content: "Note:  _";
        font-weight: bold;
    }
    
    .table {
        margin-top: 20px;
    }
    
    .search-bar {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin-bottom: 20px;
    }
    
    .search-bar .form-group {
        flex: 1;
        margin-right: 10px;
    }
    
    .search-bar .btn {
        white-space: nowrap;
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
</style>
@endsection

@section('content')
<div class="container mt-2">
    <div class="pagetitle">
        <h1><center>Tenant Details</center></h1>
    </div>
    
    <div class="card">
        <div class="card-body">
            <h2 class="card-title" style="text-transform: capitalize;">{{ $tenant->tenant_name }} {{ $tenant->father_name }}</h2>
            <p class="card-text" style="text-transform: capitalize;"><strong>Tenant Name:</strong> {{ $tenant->tenant_name }}</p>
            <p class="card-text" style="text-transform: capitalize;"><strong>Father Name:</strong> {{ $tenant->father_name }}</p>
            <p class="card-text"><strong>CNIC Number:</strong> {{ $tenant->cnic_number }}</p>
            <p class="card-text"><strong>Phone Number:</strong> {{ $tenant->phone_number }}</p>
            <p class="card-text"><strong>Rent Start Date:</strong> {{ $tenant->rent_start_date }}</p>
            <p class="card-text"><strong>Rent End Date:</strong> {{ $tenant->rent_end_date }}</p>
            <p class="card-text"><strong>Residence Type:</strong>
                @if ($tenant->flats->isNotEmpty())
                    Flat
                @elseif ($tenant->shops->isNotEmpty())
                    Shop
                @elseif ($tenant->mezzanines->isNotEmpty())
                    Mezzanine
                @endif
            </p>
            
            <p class="card-text"><strong>Residence ID:</strong>
                @if ($tenant->flats->isNotEmpty())
                    {{ $tenant->flats->first()->flat_number }} ({{ $tenant->flats->first()->total_rooms }} rooms)
                @elseif ($tenant->shops->isNotEmpty())
                    {{ $tenant->shops->first()->shop_number }}
                @elseif ($tenant->mezzanines->isNotEmpty())
                    {{ $tenant->mezzanines->first()->mezzanine_number }}
                @endif
            </p>
            <p class="note"> The tenant has rented {{ $tenant->home }}#{{ $tenant->residence }}</p>
           
            <span>
                <a href="{{ route('tenants.generatePDF', $tenant->id) }}" class="btn btn-primary">Download Tenant Details as PDF</a>
                <a href="{{ route('rents.create', $tenant->id) }}" class="btn btn-success">Add Rent</a>
                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete()">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </span>
            
            <h5 class="mt-4">Rent Payments</h5>
            
            <form method="GET" action="{{ route('tenants.show', $tenant->id) }}" class="search-bar">
                <div class="form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by month or date" value="{{ request()->get('search') }}">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            @php
            // Sort rents by date in descending order
            $sortedRents = $tenant->rents->sortByDesc('id');
        
            // Get unique rents based on multiple_month and year
            $uniqueRents = $sortedRents->unique(function ($item) {
                return $item->multiple_month . '-' . $item->year;
            });

            // Filter rents based on search query
            $search = request()->get('search');
            if ($search) {
                $uniqueRents = $uniqueRents->filter(function ($rent) use ($search) {
                    return strpos($rent->multiple_month, $search) !== false || strpos($rent->date, $search) !== false;
                });
            }
        @endphp
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Rent Amount</th>
                   
                    <th>Date</th>
                    <th>Paid</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($uniqueRents as $rent)
                    <tr>
                        <td>{{ $rent->multiple_month }}</td>
                        <td>{{ number_format($rent->all_total, 0) }}</td>
                       
                        <td>{{ $rent->date }}</td>
                        <td>{{ $rent->paid_rent ? 'Yes' : 'No' }}</td>
                        <td>
                            <a href="{{ route('rents.show', $rent->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('rents.edit', $rent->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('rents.destroy', $rent->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete2()">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
                
       
        </div>
    </div>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this tenant? This action cannot be undone.');
    }
    function confirmDelete2() {
        return confirm('Are you sure you want to delete this rent record? This action cannot be undone.');
    }
</script>
@endsection
