@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Countries</h2>
            </div>
            <div class="pull-right">
                @can('country-create')
                <a class="btn btn-success" href="{{ route('countries.create') }}"> Create New Country</a>
                @endcan
                @can('country-delete')
                <a class="btn btn-info" href="countries/trash"> Deleted Country</a>
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
            <th>ID Country</th>
            <th>Nama Country</th>
            <th>ID Player</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($countries as $country)
        <tr>
            <td>{{ $country->id_country }}</td>
            <td>{{ $country->country_name }}</td>
            <td>{{ $country->id_player }}</td>
            <td>
                <form action="{{ route('countries.destroy',$country->id_country) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('countries.show',$country->id_country) }}">Show</a>
                    @can('country-edit')
                    <a class="btn btn-primary" href="{{ route('countries.edit',$country->id_country) }}">Edit</a>
                    @endcan
                    @csrf
                    @method('DELETE')
                    @can('country-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {!! $countries->links() !!}
    
@endsection
