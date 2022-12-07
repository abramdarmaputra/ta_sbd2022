@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Deleted Countries</h2>
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
            <th>ID Country</th>
            <th>Nama Country</th>
            <th>Pelatih</th>
            <th>ID Player</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($countries as $country)
        <tr>
            <td>{{ $country->id_country }}</td>
            <td>{{ $country->country_name }}</td>
            <td>{{ $country->country_coach }}</td>
            <td>{{ $country->id_player }}</td>
            <td>
                    <a class="btn btn-info" href="trash/{{ $country->id_country }}/restore">Restore</a>
                    <a class="btn btn-danger" href="trash/{{ $country->id_country }}/forcedelete">Delete</a>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $countries->links() !!}
    
@endsection
