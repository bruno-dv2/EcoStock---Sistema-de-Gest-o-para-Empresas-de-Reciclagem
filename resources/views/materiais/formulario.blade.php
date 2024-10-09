@extends('layouts.app')

@section('title', 'Adicionar Material')

@section('content')
    <h1>Adicionar Material</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('materiais.salvar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Material</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome') }}" required>
        </div>

        <div class="form-group">
            <label for="unidade_medida">Unidade de Medida</label>
            <input type="text" class="form-control" id="unidade_medida" name="unidade_medida" value="{{ old('unidade_medida') }}">
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <a href="{{ route('materiais.lista') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
