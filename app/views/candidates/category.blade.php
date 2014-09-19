@extends('layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="container">
    <h1>{{ $category->name }}</h1>
    <table class="table table-striped">
        <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Descipción</th>
            <th>Ver</th>
        </tr>
        @foreach ($category->candidates as $candidate)
        <tr>
            <td>{{ $candidate->user->full_name }}</td>
            <td>{{ $candidate->job_type }}</td>
            <td>{{ $candidate->description }}</td>
            <td with="50">
                <a href="{{ route('candidate', [$candidate->slug, $candidate->id]) }}" class="btn btn-info">
                    Ver
                </a>
            </td>
        </tr>
        @endforeach
    </table>

    {{ $category->paginate_candidates->links() }}

</div> <!-- /container -->

@endsection