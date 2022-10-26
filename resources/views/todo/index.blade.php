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
        <div class="todo_login">
            <h1>Todo List</h1>
            <ul>
                @if (Auth::check())
                    <p>「 {{ $user->name . '' }}」でログイン中</p>
                @else
                    <p>ログインしてください。（<a href="/login">ログイン</a>｜
                        <a href="/register">登録</a>）
                    </p>
                @endif
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <li><button>ログアウト</button></li>
                </form>
            </ul>
        </div>
        <a href="{{ url('/search') }}">
            <button type="submit" class="task_serch">タスク検索</button></a>
        @error('text')
            <tr>
                <td>{{ $message }}</td>
            </tr>
        @enderror
        <form action="/create" method="post">
            @csrf

            <input type="text" name="text" class="todo_text">
            <select name="tag_id" class="life_tag">
                <option value="家事">家事</option>
                <option value="勉強">勉強</option>
                <option value="運動">運動</option>
                <option value="食事">食事</option>
                <option value="移動">移動</option>
            </select>
            <button type="submit" class="create_button">追加</button>
        </form>
        <table>
            <tr>
                <th>作成日</th>
                <th>タスク名</th>
                <th>タグ</th>
                <th>更新</th>
                <th>削除</th>
            </tr>
            <tr>
                @foreach ($todos as $todo)
                    <td>{{ $todo->created_at }}</td>
                    <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="POST">
                        @csrf
                        <td><input type="text" value="{{ $todo->text }}" name="text" class="task_name">
                        </td>
                        <td><select name="tag_id" class="life_list">
                            @foreach(Config::get('tag_list.tag_id') as $key => $tag_id)
                                <option value="{{ $todo->tag_id }}">{{ $todo->tag_id}}</option>
                                @endforeach
                            </select>
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
