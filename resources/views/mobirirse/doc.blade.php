@extends('mobirirse/template')

@section('title')
    {{$docs[0]->titulo}}
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


                                @foreach($docs as $doc)
                                <p><b>Titulo: </b>{{$doc->titulo}}</p>
                                <p><b>Año: </b>{{$doc->fecha}}</p>
                                <p><b>Autor: </b>{{$doc->autor}}</p>
                                <p><b>Tipo: </b> {{$doc->tipo}}</p>
                                <hr>
                                {!! $doc->texto !!}
                                @endforeach

                        @else
                        @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection

@section('scripts')

@endsection