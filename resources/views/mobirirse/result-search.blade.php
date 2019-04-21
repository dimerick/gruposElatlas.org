@extends('mobirirse/template')

@section('title')
    Resultados para {{$keyWord}}
@endsection


@section('content')
    <section class="mbr-section mbr-after-navbar" id="form1-0" style="background-color: rgb(255, 255, 255); padding-top: 120px; padding-bottom: 120px;">


        <div class="mbr-section mbr-section-nopadding">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-lg-10 col-lg-offset-1" data-form-type="formoid">

                        <div data-form-alert="true">
                            <div hidden="" data-form-alert-success="true" class="alert alert-form alert-success text-xs-center">Thanks for filling out form!</div>
                        </div>


                        @if(count($docs) > 0)
                            <p><b>{{$docs->total()}}</b> documentos contienen la palabra <b>{{$keyWord}}</b></p>
                            {!! $docs->render() !!}

                            <table class="table table-bordered">
                                <thead class="thead-inverse">
                                <tr>
                                    <th>Titulo</th>
                                    <th>Fecha</th>
                                    <th>Autor</th>
                                    <th>Tipo</th>
                                    <th>Texto</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($docs as $doc)
                                    <tr>
                                        <td><a href="/opensource-legion-del-afecto/doc/id={{$doc->id}}&key-word={{$keyWord}}">{{$doc->titulo}}</a></td>
                                        <td>{{$doc->fecha}}</td>
                                        <td>{{$doc->autor}}</td>
                                        <td>{{$doc->tipo}}</td>
                                        <td>{!! $doc->texto !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        <hr>
                            {!! $docs->render() !!}
                        @else
                            <p><h3>La busqueda no arrojo resultados</h3></p>
                            <a href="/opensource-legion-del-afecto/">Realizar una nueva busqueda</a>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')

@endsection