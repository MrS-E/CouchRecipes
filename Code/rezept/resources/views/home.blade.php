@extends('master')

@section('title', 'Rezepte')
@section('main')
    <div class="row">
        @foreach($recipes as $recipe)
            <div class="col-lg-3 col-md-4 col-sm-6 mt-2" onclick="window.location.assign('{{"/".$recipe->_id}}')">
                <img src="{{$recipe->image}}" class="img-fluid rounded-4"/>
                <p class="text-center"><strong>{{$recipe->name}}</strong></p>
            </div>
        @endforeach
    </div>
@endsection
