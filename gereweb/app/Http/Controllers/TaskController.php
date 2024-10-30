<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->where('type', 'daily')->get();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string', // Certifique-se de que este campo existe
            'duration' => 'nullable',
        ]);

        // Criar a tarefa com o campo 'type' definido como 'daily'
        $task = Task::create([
            'description' => $validated['description'], // Mapeie o nome da tarefa corretamente
            'duration' => '00:00:00', // Mantenha o campo de duração
            'type' => 'daily',
            'position' => 0, // Se necessário, defina uma posição padrão
            // Não estamos relacionando a um usuário no momento, então não usamos user_id
        ]);

        //return response()->json($task, 201);
        return redirect()->route('home')->with('success', 'Tarefa criada com sucesso!');
    }

    public function show($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'duration' => 'nullable|integer',
            'completed' => 'nullable|boolean',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    public function destroy($id)
    {
        $task = Auth::user()->tasks()->findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted'], 204);
    }
}
