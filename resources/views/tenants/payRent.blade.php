<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pay Rent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h3>Pay Rent</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('tenants.payRent', $tenant->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="rent_for_month" class="form-label">Rent Amount</label>
                <input type="text" class="form-control" id="rent_for_month" name="rent_for_month" value="{{ old('rent_for_month') }}">
            </div>
            <div class="mb-3">
                <label for="month" class="form-label">Month</label>
                <input type="text" class="form-control" id="month" name="month" value="{{ old('month') }}">
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}">
            </div>
            <div class="mb-3">
                <label for="paid_rent" class="form-label">Rent Paid?</label>
                <select class="form-select" id="paid_rent" name="paid_rent">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
