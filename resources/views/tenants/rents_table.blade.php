<h5 class="mt-4">Rent Payments</h5>
<!-- Search Form -->
<form id="search-form" class="mt-3" method="GET" action="{{ route('rents.search', $tenant->id) }}">
  <div class="form-group">
      <input type="text" id="search" name="search" class="form-control" placeholder="Search by month or date" value="{{ request('search') }}">
  </div>
  <button type="submit" class="btn btn-primary">Search</button>
</form>

@php
// Sort rents by date in descending order
$sortedRents = $rents->sortByDesc('id');

// Get unique rents based on multiple_month and year
$uniqueRents = $sortedRents->unique(function ($item) {
    return $item->multiple_month . '-' . $item->year;
});
@endphp

<table class="table table-bordered" id="rents-table">
<thead>
    <tr>
        <th>Rent Amount</th>
        <th>Month</th>
        <th>Date</th>
        <th>Paid</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($uniqueRents as $rent)
        <tr>
            <td>{{ $rent->rent_for_month }}</td>
            <td>{{ $rent->multiple_month }}</td>
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

<script>
    function confirmDelete2() {
        return confirm('Are you sure you want to delete this rent record? This action cannot be undone.');
    }
</script>
