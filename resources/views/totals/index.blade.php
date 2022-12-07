@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Database Player</h2>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>Nama player</th>
            <th>Country</th>
            <th>Club</th>
        </tr>
        @foreach ($joins as $join)
        <tr>
            <td>{{ $join->player_name }}</td>
            <td>{{ $join->country_name }}</td>
            <td>{{ $join->club_name}} </td>
        </tr>
        @endforeach
    </table>
    {!! $joins->links() !!}
@endsection
