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
        <form action="/todos" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="todo_name" class="todo_text">
                <button type="submit" class="create_button">追加</button>
                @error('todo_name')
                    {{ $message }}
                @enderror
            </div>
        </form>

        <div class="text">
            <p class="time">作成日</p>
            <div class="task">
                <p>タスク名</p>
                <input type="text" class="task_name">
            </div>
            <div class="update">
                <p>更新</p>
                <button type="submit" class="update_buttom">更新</button>
            </div>
            <div class="delete">
                <p>削除</p>
                <button type="submit" class="delete_buttom">削除</button>
            </div>
        </div>
    </div>
</body>

</html>
