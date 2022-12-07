@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Players</h2>
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
            <th>ID Player</th>
            <th>Nama Player</th>
            <th>Posisi</th>
            <th>ID Club</th>
            <th>ID Country</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($players as $player)
        <tr>
            <td>{{ $player->id_player }}</td>
            <td>{{ $player->player_name }}</td>
            <td>{{ $player->position }}</td>
            <td>{{ $player->id_club }}</td>
            <td>{{ $player->id_country }}</td>
            <td>
                    <a class="btn btn-info" href="trash/{{ $player->id_player }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $player->id_player }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $players->links() !!}
    
@endsection
