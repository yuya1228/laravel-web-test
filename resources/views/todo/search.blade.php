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
            <h1>タスク検索</h1>
            <ul>
                @if (Auth::check())
                    <p>  「{{ $user->name . '' }}」でログイン中</p>
                @else
                    <p>ログインしてください。（<a href="/login">ログイン</a>
                        <a href="/register">登録</a>）
                    </p>
                @endif
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <li><button>ログアウト</button></li>
                </form>
            </ul>
        </div>
        <form action="{{route('todo.find')}}" method="get">
            @csrf
            <input type="search" name="find" class="todo_text">
            <select name="todo_tag" class="life_tag">
                <option value="0"></option>
                <option value="1">家事</option>
                <option value="2">勉強</option>
                <option value="3">運動</option>
                <option value="4">食事</option>
                <option value="5">移動</option>
            </select>
            <button type="submit" class="create_button">検索</button>
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
            @error('text')
            <tr>
                <td>{{ $message }}</td>
            </tr>
        @enderror
                <form action="{{ route('todo.update', ['id' => $todo->id]) }}" method="POST">
                        @csrf
                    <td>{{ $todo->created_at }}</td>
                        <td><input type="text" value="{{ $todo->text }}" name="text" class="task_name">
                        </td>
                        <td><select name="tag_id" class="life_list">
                                @foreach ($tags as $tag)
                                    <option value="{{ $tag->id }}"
                                        @if ($todo->tag_id == $tag->id) selected @endif>
                                        {{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><button type="submit" class="update_buttom">更新</button>
                        </td>
                    </form>
                <td>
                    <form action="{{ route('todo.delete',$todo ) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete_buttom">削除</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <a href="{{url('/home')}}"><button class="return_button">戻る</button></a>
    </div>
</body>

</html>
