<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskDefaultController;
use App\Http\Controllers\TaskHistoryController;

// Rota inicial para carregar a view principal com as tarefas do dia e padrão
Route::get('/', function () {
    $dailyTasks = \App\Models\Task::where('type', 'daily')->get();
    $defaultTasks = \App\Models\TaskDefault::all();
    return view('index', compact('dailyTasks', 'defaultTasks'));
})->name('home');

// Rotas para autenticação
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Rotas protegidas por autenticação para gerenciamento de tarefas e histórico
//Route::middleware(['auth'])->group(function () {
    // Rotas para tarefas do usuário
    Route::get('/tasks', [TaskController::class, 'index']);           // Listar todas as tarefas do usuário
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');          // Criar nova tarefa
    Route::get('/tasks/{id}', [TaskController::class, 'show']);       // Visualizar uma tarefa específica
    Route::put('/tasks/{id}', [TaskController::class, 'update']);     // Atualizar uma tarefa existente
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Deletar uma tarefa

    // Rotas para tarefas padrão
    Route::get('/default_tasks', [TaskDefaultController::class, 'index']);         // Listar todas as tarefas padrão
    Route::post('/default_tasks', [TaskDefaultController::class, 'store'])->name('default_tasks.store');        // Criar nova tarefa padrão
    Route::get('/default_tasks/{id}', [TaskDefaultController::class, 'show']);     // Visualizar uma tarefa padrão específica
    Route::put('/default_tasks/{id}', [TaskDefaultController::class, 'update']);   // Atualizar uma tarefa padrão
    Route::delete('/default_tasks/{id}', [TaskDefaultController::class, 'destroy']);// Deletar uma tarefa padrão

    // Rotas para histórico de tarefas
    Route::get('/task_history', [TaskHistoryController::class, 'index']);         // Listar histórico de tarefas do usuário
    Route::post('/task_history', [TaskHistoryController::class, 'store']);        // Adicionar tarefa ao histórico
//});
