@extends('master')

@section('title', 'Rezepte')
@section('main')
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-4">
                {{$recipe}}
            </div>
        @endforeach
    </div>
@endsection
