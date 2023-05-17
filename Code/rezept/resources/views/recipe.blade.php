@extends('master')

@section('title', 'Rezepte')
@section('main')
    <style>
        .table td.fit,
        .table th.fit {
            white-space: nowrap;
            width: 1%;
        }
    </style>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="row">
                <img src="{{$recipe->image}}" class="img-fluid"/>
            </div>
            <div class="row">
                <p>
                    <strong>Kategorie:</strong> {{$recipe->category}}
                    <br/>
                    <strong>Veröffentlicht:</strong> {{date("d.m.Y", strtotime($recipe->date))}}
                    <br/>
                    @if(isset($recipe->score))
                    <strong>Bewertung:</strong> {{$recipe->score}}/10
                    @endif
                </p>
            </div>
            @if(isset($recipe->nutrition))
            <div class="row">
                <table class="m-1 ps-1">
                    <tr>
                        @foreach($recipe->nutrition->stuff as $s)
                            <th>{{$s->name}}</th>
                        @endforeach
                    </tr>
                    <tr>
                        @foreach($recipe->nutrition->stuff as $s)
                            <td>{{$s->value}}@if(isset($s->unit)){{$s->unit}}@endif</td>
                        @endforeach
                    </tr>
                </table>
            </div>
            @endif
        </div>
        <div class="col-lg-6 col-sm-12">
            <h3>{{$recipe->name}}</h3>
            <div class="row">
                <h6>Zutaten:</h6>
                <input type="number" class="mb-1" style="width: 50%" value="500">
                <span style="width: 50%" class="text-center"> Gramm</span>
                <table class="table table-striped rounded-3">
                    @foreach($recipe->ingredient as $i)
                        <tr>
                            <td class="percent fit">{{isset($i->percent)?$i->percent."%":"-"}}</td>
                            <td>{{$i->name}}</td>
                        </tr>
                    @endforeach
                </table>
                <h6>Anleitung:</h6>
                @if(isset($recipe->expense->duration)&&isset($recipe->expense->difficulty))
                <p>
                    <strong>Dauer:</strong> {{$recipe->expense->duration}}
                    <br/>
                    <strong>Schwierigkeit:</strong> {{$recipe->expense->difficulty}}
                </p>
                @endif
                <p>{{$recipe->manual}}</p>
            </div>
        </div>
    </div>
    @if(isset($recipe->comment))
        <div class="row">
            @foreach($recipe->comment as $c)
                <div class="col-7 m-3">
                    <p>
                        <strong>{{$c->author}}</strong>
                        <br>
                        <small>{{date("d.m.Y", strtotime($c->date))}}</small>
                        <br>
                        <span>
                        {{$c->value}}
                        </span>
                    </p>
                </div>
            @endforeach
        </div>
    @endif
    <script>
        const percent = [@foreach($recipe->ingredient as $i) {{isset($i->percent)?$i->percent.",":0}} @endforeach];
        const input = document.querySelector("input[type='number']");
        function calculate(){
            for(let d in document.getElementsByClassName("percent"))
            {
                document.getElementsByClassName("percent")[d].innerText = Math.round((input.value/100)*parseFloat(percent[d]))  + " g";
            }
        }
        input.addEventListener('change',calculate )
        calculate();
    </script>
@endsection
