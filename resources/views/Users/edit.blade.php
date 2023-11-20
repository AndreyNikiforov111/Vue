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
<form action="/users/{{$user->id}}" method="POST">
    @csrf
    @method('PATCH')
    <div class="">Поле редактирования имени пароля</div>
    <input type="text" name="name" value="{{$user->name}}" style="margin-bottom: 10px;">

    <div class="">Введите имя заголовок</div>
    <input type="text" name="email" value="{{ $user->email }}" style="margin-bottom: 10px;">

    <div class="">Введите пароль от 6 до 8 символов</div>
    <input type="text" name="password" value="" style="margin-bottom: 10px;">
    <br>
    <select class="form-control" name="role">
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
    </select>

    <br>
    <br>
    <button type="submit">Редактировать</button>

</form>
</body>
</html>
