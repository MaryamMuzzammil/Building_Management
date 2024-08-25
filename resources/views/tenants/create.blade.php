@extends('adminlayout.app')

@section('style')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    .container {
        max-width: 600px;
        background: #ffffffaf;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h3 {
        text-align: center;
        margin-bottom: 20px;
    }

    .alert {
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control, .form-select {
        border-radius: 5px;
        padding: 10px;
        font-size: 14px;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffb700;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        transition: background-color 0.3s ease, transform 0.3s ease;
        border: none;
        background-color: #996600;
        color: white;
    }

    .btn-primary:hover {
        background-color: #FFE0C5;
        color: #996600;
    }

    .mt-5 {
        margin-top: 3rem !important;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }
    .error-message{
        color: red;
        font-size: 13px;
    }
</style>
@endsection

@section('content')
<div class="container mt-5">
    
    <h3>Add Tenant</h3>
  
    <form action="{{ route('tenants.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="tenant_name" class="form-label">Tenant Name</label>
            <input type="text" class="form-control" id="tenant_name" name="tenant_name" value="{{ old('tenant_name') }}">
            @error('tenant_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="father_name" class="form-label">Father Name</label>
            <input type="text" class="form-control" id="father_name" name="father_name" value="{{ old('father_name') }}">
            @error('father_name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="cnic_number" class="form-label">CNIC Number</label>
            <input type="text" class="form-control" id="cnic_number" name="cnic_number" value="{{ old('cnic_number') }}">
            @error('cnic_number')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
            @error('phone_number')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="rent_start_date" class="form-label">Tenant Start Date</label>
            <input type="date" class="form-control" id="rent_start_date" name="rent_start_date" value="{{ old('rent_start_date') }}">
            @error('rent_start_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="rent_end_date" class="form-label">Tenant End Date</label>
            <input type="date" class="form-control" id="rent_end_date" name="rent_end_date" value="{{ old('rent_end_date') }}">
            @error('rent_end_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="residence_type" class="form-label">Residence Type</label>
            <select class="form-select" id="residence_type" name="residence_type" onchange="populateResidenceId(this.value)">
                <option value="">Select Type</option>
                <option value="flat" {{ old('residence_type') == 'flat' ? 'selected' : '' }}>Flat</option>
                <option value="shop" {{ old('residence_type') == 'shop' ? 'selected' : '' }}>Shop</option>
                <option value="mezzanine" {{ old('residence_type') == 'mezzanine' ? 'selected' : '' }}>Mezzanine</option>
            </select>
            @error('residence_type')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="residence_id" class="form-label">Residence</label>
            <select class="form-select" id="residence_id" name="residence_id">
                <option value="">Select Residence</option>
                @foreach ($flats as $flat)
                    <option value="{{ $flat->flat_number }}" {{ old('residence_id') == $flat->flat_number ? 'selected' : '' }}>Flat #{{ $flat->flat_number }}</option>
                @endforeach
                @foreach ($shops as $shop)
                    <option value="{{ $shop->shop_number }}" {{ old('residence_id') == $shop->shop_number ? 'selected' : '' }}>Shop #{{ $shop->shop_number }}</option>
                @endforeach
                @foreach ($mezzanines as $mezzanine)
                    <option value="{{ $mezzanine->mezzanine_number }}" {{ old('residence_id') == $mezzanine->mezzanine_number ? 'selected' : '' }}>Mezzanine #{{ $mezzanine->mezzanine_number }}</option>
                @endforeach
            </select>
            @error('residence_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cnic_image" class="form-label">CNIC Image</label>
            <input type="file" class="form-control" id="cnic_image" name="cnic_image" >
            @error('cnic_image')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Picture</label>
            <input type="file" class="form-control" id="picture" name="picture" >
            @error('picture')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
  
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-H5aLkMHfW4bm0ZolQk82IH3gSDAdRIbvYv8bPbsRYVpiG41tOJY9Pz5N9KKgA3f9" crossorigin="anonymous"></script>
<script>
    function populateResidenceId(type) {
        var select = document.getElementById('residence_id');
        select.innerHTML = '<option value="">Select Residence</option>'; // Clear options

        @foreach ($flats as $flat)
            if (type === 'flat') {
                select.innerHTML += '<option value="{{ $flat->flat_number }}">Flat #{{ $flat->flat_number }}</option>';
            }
        @endforeach

        @foreach ($shops as $shop)
            if (type === 'shop') {
                select.innerHTML += '<option value="{{ $shop->shop_number }}">Shop #{{ $shop->shop_number }}</option>';
            }
        @endforeach

        @foreach ($mezzanines as $mezzanine)
            if (type === 'mezzanine') {
                select.innerHTML += '<option value="{{ $mezzanine->mezzanine_number }}">Mezzanine #{{ $mezzanine->mezzanine_number }}</option>';
            }
        @endforeach
    }
</script>
@endsection
