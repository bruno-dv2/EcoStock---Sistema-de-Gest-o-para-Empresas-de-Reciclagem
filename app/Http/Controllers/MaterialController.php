<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{

    public function listaMateriais() {

        $materiais = Material::all();

        return view('materiais.lista', compact('materiais'));
    }


    public function exibirFormulario() {

        return view('materiais.formulario');
    }


    public function salvarMaterial(Request $request) {

        $validateData = $request->validate([
            'nome' => 'required|string|max:50',
            'unidade_medida' => 'nullable|string|max:10',
        ]);

        Material::create($validateData);

        return redirect()->route('materiais.lista')->with('success', 'Material cadastrado com sucesso!');
    }


    public function editarMaterial($id) {

        $material = Material::findOrFail($id);

        return view('materiais.editar', compact('material'));
    }


    public function atualizarMaterial(Request $request, $id) {

        $material = Material::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'required|string|max:50',
            'unidade_medida' => 'nullable|string|max:10',
        ]);

        $material->update($validated);

        return redirect()->route('materiais.lista')->with('success', 'Material atualizado com sucesso!');
    }


    public function deletarMaterial($id) {

        try {
            $material = Material::findOrFail($id);
            $material->delete();

            return response()->json(['success' => 'Material removido com sucesso!']);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Material não encontrado.'], 404);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Falha ao deletar material: ' . $e->getMessage()], 500);
        }
    }

}


