@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Clubs</h2>
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
            <th>ID Club</th>
            <th>Nama Club</th>
            <th>Coach</th>
            <th>ID Player</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($clubs as $club)
        <tr>
            <td>{{ $club->id_club }}</td>
            <td>{{ $club->club_name }}</td>
            <td>{{ $club->club_coach }}</td>
            <td>{{ $club->id_player }}</td>
            <td>
                    <a class="btn btn-info" href="trash/{{ $club->id_club }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $club->id_club }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $clubs->links() !!}
    
@endsection
