@extends('layout')

@section('cabecalho')
    Series
@endsection
@section('conteudo')

    <a href="{{ route('form_criar_serie') }}" class="btn btn-dark mb-2">Adicinar </a>

    @if(!empty($mensagem))
        <div class="row ">
            <div class="col-md-12">
                <div class="alert {{ $classBootstrap}}">
                    {{ $mensagem }}
                </div>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <ul class="list-group">
                @foreach($series as $serie)
                    <li hidden class="list-group-item d-flex  justify-content-between align-items-center">
                        <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>
                        <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                            <input type="text" class="form-control" value="{{ $serie->nome }}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                                    <i class="fas fa-check"></i>
                                </button>
                                @csrf
                            </div>
                        </div>


                        <div class="d-flex">
                            <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{ $serie->id }})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="/series/{{$serie->id}}/temporadas" class="btn btn-dark btn-sm mr-1">
                                <i class="fas fa-external-link-alt"></i>
                            </a>

                            <form action="/series/remove/{{$serie->id}}" method="post"
                                  onsubmit="return confirm('Tem certeza?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>

                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

