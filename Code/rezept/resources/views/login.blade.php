@extends('master')

@section('title', "Anmeldung")
@section('main')
    <div>
        <button class="btn btn-outline-secondary" onclick="window.location.assign('/register')">Registrierung</button>
        <h1>Anmeldung</h1>

        <form action="{{route('login')}}" method="POST">
            @csrf
            <label class="form-label" for="email_field">Email</label>
            <input class="form-control" id="email_field" name="email" type="email" placeholder="max.mustermann@gmail.com"/>
            <label class="form-label" for="passwd_field">Passwort</label>
            <input class="form-control" id="passwd_field" name="password" type="password" placeholder="Passwort1234"/>
            @if ($errors->any())
                <div class=" pt-2 alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <button type="submit" class="mt-2 btn btn-primary">Anmelden</button>
        </form>
    </div>
@endsection
