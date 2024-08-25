
@foreach ($rents as $rent)
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
