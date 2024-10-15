<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class MaterialApiController extends Controller
{
    public function listaMateriais() : JsonResponse
    {
        try {
            $materiais = Material::select('id', 'nome', 'unidade_medida')->get();

            return response()->json([
                'status' => true,
                'message' => 'Lista exibida com sucesso!',
                'data' => $materiais,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Erro ao exibir lista de materiais.'
            ], 500);
        }
    }


    public function criarMaterial(MaterialRequest $request) : JsonResponse
    {
        try {
            $material = Material::create($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Material criado com sucesso!',
                'data' => $material->only('id', 'nome')
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha ao criar material.',
            ], 500);
        }
    }


    public function mostrarMaterialEspecifico($id) : JsonResponse
    {
        try {

            $material = Material::find($id);

            if (!$material) {
                return response()->json([
                    'status' => false,
                    'message' => 'Material não encontrado.',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Material encontrado!',
                'data' => $material->only('id', 'nome', 'unidade_medida')
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Ocorreu um erro ao buscar material.'
            ], 500);
        }
    }


    public function editarMaterial(MaterialRequest $request, $id) : JsonResponse
    {
        try {
            $material = Material::find($id);

            if (!$material) {
                return response()->json([
                    'status' => false,
                    'message' => 'Material não encontrado.'
                ], 404);
            }

            $material->update($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Material atualizado com sucesso!',
                'data' => $material->only('id', 'nome', 'unidade_medida')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha ao atualizar material.'
            ], 500);
        }
    }


    public function deletarMaterial($id) : JsonResponse
    {
        try {
            $material = Material::find($id);

            if (!$material) {
                return response()->json([
                    'status' => false,
                    'message' => 'Material não encontrado.'
                ], 404);
            }

            $material->delete();

            return response()->json([
                'status' => true,
                'message' => 'Material deletado com sucesso!',
                'data' => $material->only('id', 'nome', 'unidade_medida')
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Falha ao deletar material.'
            ], 500);
        }
    }

}
