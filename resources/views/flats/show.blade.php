@extends('layouts.app')

@section('content')
<div>
    <h1>Flat Details</h1>
    <p>Flat Number: {{ $flat->flat_number }}</p>
    <p>Total Rooms: {{ $flat->total_rooms }}</p>
</div>
@endsection
