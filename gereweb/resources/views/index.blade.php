<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" href="{{ asset('images/agencia-weber-logo.webp') }}" type="image/x-icon">
    <title>GereWeb</title>
</head>

<body>
    <header class="header">
        <img class="profile-image" src="{{ asset('images/avatar.png') }}" alt="">

        <form class="login-form" action="{{ route('login') }}" method="POST">
            @csrf
            <input class="input-field" type="text" name="email" placeholder="E-mail" required>
            <input class="input-field" type="password" name="password" placeholder="Senha" required>
        </form>
    </header>

    <main class="main-content">
        <section class="daily-tasks">
            <div class="task-header">
                <h2 class="title">Tarefas do Dia</h2>
                <div class="play-icons">
                    <i class="icon bi bi-play-fill"></i>
                    <i class="icon bi bi-pause-fill"></i>
                </div>
            </div>

            <div class="new-task">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <input class="input-task" type="text" name="description" placeholder="Cadastrar nova tarefa" required>
                    <button class="add-task-button" type="submit">+</button>
                </form>
            </div>

            <div class="task-list">
                @foreach($dailyTasks as $task)
                    <div class="task-item">
                        <div class="task-checkbox">
                            <input class="checkbox" type="checkbox">
                            <label class="task-label">{{ $task->description }}</label>
                        </div>
                        <p class="task-duration">{{ $task->duration }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="default-tasks">
            <div class="default-task-header">
                <h2 class="title">Tarefas padrão</h2>
            </div>

            <div class="default-task-list">
                <form action="{{ route('default_tasks.store') }}" method="POST">
                    @csrf
                    <input class="input-default-task" type="text" name="description" placeholder="Cadastrar nova tarefa" required>
                    <button class="add-default-task-button" type="submit">+</button>
                </form>

                @foreach($defaultTasks as $defaultTask)
                    <div class="default-task-item">
                        <label class="default-task-label">{{ $defaultTask->description }}</label>
                    </div>
                @endforeach
            </div>
        </section>
    </main>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>