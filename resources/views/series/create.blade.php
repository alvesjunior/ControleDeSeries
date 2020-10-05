@extends('layout')

@section('cabecalho')
    Adicionar Serie
@endsection
@section('conteudo')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col col-6">
                <div class="form-group">
                    <label for="nome" class="label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome">
                </div>
            </div>
            <div class="col col-3">
                <label for="qtd_temporadas" class="label">Nº temporadas</label>
                <input type="number" class="form-control" name="qtd_temporadas" id="qtd_temporadas">
            </div>
            <div class="col col-3">
                <label for="ep_por_temporadas" class="label">Epº por temporada</label>
                <input type="number" class="form-control" name="ep_por_temporadas" id="ep_por_temporadas">
            </div>
        </div>
        <div class="row">
            <div class="col col-12">
                <label for="capa"> </label>
                <input type="file" class="form-control" id="capa" name="capa">
            </div>
        </div>


        <button class="btn btn-primary mt-2"> Adicionar</button>
    </form>
@endsection


