<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialApiController extends Controller
{

    public function listaMateriais() {

        $materiais = Material::select('id', 'nome', 'unidade_medida')->get();

        return response()->json($materiais);
    }


    public function criarMaterial(Request $request) {

        try {
            $validateData = $request->validate([
                'nome' => 'required|string|max:50',
                'unidade_medida' => 'nullable|string|max:10',
            ]);

            $material = Material::create($validateData);

            return response()->json([
                'message' => 'Material criado com sucesso!',
                'data' => $material->only('id', 'nome')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Falha ao criar material.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function mostrarMaterialEspecifico($id) {

        try {
            $material = Material::findOrFail($id);

            return response()->json([
                'message' => 'Material encontrado!',
                'data' => $material->only('id', 'nome', 'unidade_medida')
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Material não encontrado.',
                'error' => $e->getMessage()
            ], 404);
        }
    }


    public function editarMaterial(Request $request, $id) {
        try {
            $material = Material::findOrFail($id);

            $validated = $request->validate([
                'nome' => 'required|string|max:50',
                'unidade_medida' => 'nullable|string|max:10',
            ]);

            $material->update($validated);

            return response()->json([
                'message' => 'Material atualizado com sucesso!',
                'data' => $material->only('id', 'nome')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Falha ao atualizar material.',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function deletarMaterial($id) {
        try {
            $material = Material::findOrFail($id);
            $material->delete();

            return response()->json([
                'message' => 'Material deletado com sucesso!',
                'data' => $material->only('id', 'nome')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Falha ao deletar material.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
