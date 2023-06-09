@extends('master')
@section('title', "Neues Rezept")
@section('main')
    <div class="container-fluid">
        <h3>Neues Rezept</h3>
        <div class="row">
            <img id="bild" class="img img-fluid figure-img" style="max-height: 25vh; width: auto"/>
            <label for="img_field" class="form-label">Bild</label>
            <input id="img_field" class="form-control" type="file" accept="image/png, image/webp, image/jpg">
        </div>

        <form method="POST" action="/create">
            @csrf
            <div class="row">
                <label for="name_field" class="form-label">Namen</label>
                <input id="name_field" class="form-control" name="name" type="text" required
                       placeholder="Schnecken Eintopf"/>
            </div>
            <div class="row">
                <div class="col-4">
                    <table>
                        <thead>
                        <tr>
                            <td class="form-label">Zutat</td>
                            <td class="form-label">Menge [%]</td>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <div id="new_ingred" class="btn btn-dark rounded flex-fill">+</div>
                    </div>
                </div>
                <div class="col-8 d-block">
                    <div class="row">
                        <label for="category_field" class="form-label">Kategorie</label>
                        <select id="category_field" name="category" class="form-select">
                            <option value="Apéro">Aperitif</option>
                            <option value="Brote">Brote</option>
                            <option value="Hauptspeisen">Hauptspeisen</option>
                            <option value="Kuchen">Kuchen</option>
                            <option value="Desserts">Nachspeisen</option>
                            <option value="Salate">Salate</option>
                            <option value="Vorspeisen">Vorspeisen</option>
                        </select>
                    </div>
                    <div class="row">
                        <label for="manuel_field" class="form-label">Anleitung</label>
                        <textarea id="manuel_field" name="manuel" class="form-text" required></textarea>
                    </div>
                </div>
            </div>
            <div class="d-none">
                <input type="text" id="img" name="img" readonly required>
                <input type="text" id="ingredient" name="ingredient" readonly required>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <button class="flex-fill btn btn-primary" type="submit">Einreichen</button>
            </div>
        </form>
    </div>
    <script src="{{ URL::asset('js/new_recipe.js') }}"></script>
@endsection
