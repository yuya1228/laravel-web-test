<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel（入門）</title>
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('/assets/css/reset.css') }}" rel="stylesheet">
</head>

<body>
    <div class="todo_list">
        <h1>Todo List</h1>
        <form action="{{route('todos.create')}}" method="POST">
            @csrf
            @error('todo_name')
                {{ $message }}
            @enderror
            <div class="form-group">
                <input type="text" name="todo_name" class="todo_text">
                <button type="submit" class="create_button">追加</button>
            </div>
        </form>
        <table>
            <tr>
                <th>作成日</th>
                <th>タスク名</th>
                <th>更新</th>
                <th>削除</th>
            </tr>
            @foreach ($todos as $todo)
                <tr>
                    <td>{{ \Carbon\Carbon::now() }}</td>
                    <td><input type="text" class="task_name">
                        <form action="{{ route('todos.create') }}" method="post">
                            @csrf
                            @method('POST')
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('todos.edit', $todo->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="update_buttom">更新</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{route('todos.destroy',$todo->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete_buttom">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
