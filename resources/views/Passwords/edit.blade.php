<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="/passwords/{{$password->id}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="">Поле редактирования имени пароля</div>
    <input type="text" name="username" value="{{$password->username}}" style="margin-bottom: 10px;">

    <div class="">Введите имя заголовок</div>
    <input type="text" name="title" value="{{ $password->title }}" style="margin-bottom: 10px;">

    <div class="">Пароль</div>
    <input type="text" name="password" value="{{ $password->password }}" style="margin-bottom: 10px;">
    <div class="">Проект</div>
    <input type="text" name="project" value="{{ $password->project }}" style="margin-bottom: 10px;">

    <div class="form-group">
        <div class="">Папка к которой относится пароль</div>
        <select class="form-control" name="folder_id">
            <option>Выберите папку</option>
            @foreach($folder as $key => $value)
                <option
                    {{old('folder_id') == $value->id ? 'selected' : ''}}
                    {{ $password -> folder_id  == $value->id ? 'selected' : '' }}
                    value="{{ $value->id }}"> {{ $value->name}}
                </option>
            @endforeach
        </select>
    </div>

    {{--<select class="form-control" name="folder_id">
        <option>Выберите роль пользователя</option>
        <option
            {{old('role') == 'admin' ? 'selected' : ''}}
            {{ $user->role  == 'admin' ? 'selected' : '' }}
            value="admin"> admin
        </option>
        <option
            {{old('role') == 'user' ? 'selected' : ''}}
            {{ $user->role  == 'user' ? 'selected' : '' }}
            value="user"> user
        </option>
    </select>--}}


    <button type="submit">Редактировать</button>

</form>
</body>
</html>
