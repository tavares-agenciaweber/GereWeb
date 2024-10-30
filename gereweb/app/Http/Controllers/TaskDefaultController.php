<?php

namespace App\Http\Controllers;

use App\Models\TaskDefault;
use Illuminate\Http\Request;

class TaskDefaultController extends Controller
{
    public function index()
    {
        return response()->json(TaskDefault::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string'
        ]);

        // Criar a tarefa com o campo 'type' definido como 'daily'
        $task = TaskDefault::create([
            'description' => $validated['description'],
            // Não estamos relacionando a um usuário no momento, então não usamos user_id
        ]);

        //return response()->json($task, 201);
        return redirect()->route('home')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show($id)
    {
        $TaskDefault = TaskDefault::findOrFail($id);
        return response()->json($TaskDefault);
    }

    public function update(Request $request, $id)
    {
        $TaskDefault = TaskDefault::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $TaskDefault->update($validated);
        return response()->json($TaskDefault);
    }

    public function destroy($id)
    {
        $TaskDefault = TaskDefault::findOrFail($id);
        $TaskDefault->delete();
        return response()->json(['message' => 'Default task deleted'], 204);
    }
}
