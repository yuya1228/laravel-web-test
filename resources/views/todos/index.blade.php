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
        @error('text')
                <tr>
                    <td>{{ $message }}</td>
                </tr>
            @enderror
        <form action="/create" method="post">
            @csrf
            <input type="text" name="text" class="todo_text">
            <button type="submit" class="create_button">追加</button>
        </form>
        <table>
            <tr>
                <th>作成日</th>
                <th>タスク名</th>
                <th>更新</th>
                <th>削除</th>
            </tr>
            <tr>
                @foreach ($todos as $todo)
                    <td>{{$todo -> created_at}}</td>
                    <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="POST">
                        @csrf
                        <td><input type="text" value="{{ $todo->text }}" name="text" class="task_name">
                        </td>
                        <td><button type="submit" class="update_buttom">更新</button>
                        </td>
                    </form>
                    <td>
                        <form action="{{ route('todo.destroy', $todo) }}" method="post">
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
