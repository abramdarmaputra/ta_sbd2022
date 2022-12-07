@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Clubs</h2>
            </div>
            <div class="pull-right">
                @can('club-create')
                <a class="btn btn-success" href="{{ route('clubs.create') }}"> Create New Club</a>
                @endcan
                @can('club-delete')
                <a class="btn btn-info" href="clubs/trash"> Deleted Club</a>
                @endcan
            </div>
            <div class="my-3 col-12 col-sm-8 col-md-5">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Keyword" name = "keyword" aria-label="Keyword" aria-describedby="basic-addon1">
                        <button class="input-group-text btn btn-primary" id="basic-addon1">Search</button>
                    </div>
                </form>
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
            <th>Pelatih</th>
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
                <form action="{{ route('clubs.destroy',$club->id_club) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('clubs.show',$club->id_club) }}">Show</a>
                    @can('club-edit')
                    <a class="btn btn-primary" href="{{ route('clubs.edit',$club->id_club) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('club-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $clubs->links() !!}
    
@endsection
