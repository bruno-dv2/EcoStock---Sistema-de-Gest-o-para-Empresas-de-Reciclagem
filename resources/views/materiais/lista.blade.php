@extends('layouts.app')

@section('title', 'Lista de Materiais')

@section('content')
    <h1 class="mt-3">Lista de Materiais</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('materiais.formulario') }}" class="btn btn-primary mb-3">Adicionar Material</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Unidade de Medida</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($materiais as $material)
                <tr id="material-{{ $material->id }}">
                    <td>{{ $material->id }}</td>
                    <td>{{ $material->nome }}</td>
                    <td>{{ $material->unidade_medida }}</td>
                    <td>
                        <a href="{{ route('materiais.editar', $material->id) }}" class="btn btn-warning">Editar</a>
                        <button class="btn btn-danger delete-material" data-id="{{ $material->id }}">Remover</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.delete-material').click(function() {
            const materialId = $(this).data('id');
            const row = $('#material-' + materialId);

            if (confirm('Você tem certeza que deseja remover este material?')) {

                $.ajax({
                    url: '/materiais/deletar/' + materialId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        row.remove();
                        alert('Material removido com sucesso.');
                    },
                    error: function(erro) {
                    alert('Ocorreu um erro ao remover o material: ' + erro.responseJSON.error);
                    }
                });
            }
        });
    });
</script>
@endpush
