@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Club</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('clubs.index') }}"> Back</a>
            </div>
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('clubs.update',$club->id_club) }}" method="POST">
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Club:</strong>
                    <input type="number" name="id_club" value="{{ $club->id_club }}" class="form-control" placeholder="ID Club">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nama Club:</strong>
                    <input type="text" name="club_name" value="{{ $club->club_name }}" class="form-control" placeholder="Nama Club">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Pelatih:</strong>
                    <input type="text" name="club_coach" value="{{ $club->club_coach }}" class="form-control" placeholder="Pelatih">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID Player:</strong>
                    <input type="number" name="id_player" value="{{ $club->id_player }}" class="form-control" placeholder="ID Player">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
