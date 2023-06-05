@extends('master')

@section('title', "Registrierung")
@section('main')
    <div>
        <button class="btn btn-outline-secondary" onclick="window.location.assign('/login')">Anmeldung</button>
        <h1>Registrierung</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('register')}}" method="POST">
            @csrf
            <label class="form-label" for="name_field">Namen</label>
            <input class="form-control" id="name_field" name="name" type="text" placeholder="Max Mustermann" required/>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label class="form-label" for="email_field">Email</label>
            <input class="form-control" id="email_field" name="email" type="email" placeholder="max.mustermann@gmail.com" required/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <label class="form-label" for="passwd_field">Passwort</label>
            <input class="form-control" id="passwd_field" name="password" type="password" placeholder="Passwort1234" required/>
            <input type="password" class=" mt-1 form-control" name="password_confirmation" placeholder="Passwort1234" required>
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <button type="submit" class="mt-2 btn btn-primary">Anmelden</button>
        </form>
    </div>
@endsection
