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
<form action="/users" method="POST">
    @csrf
    <div class="">Введите имя пароля</div>
    <input type="text" name="name" value="{{ old('name') }}" style="margin-bottom: 10px;">

    <div class="">Введите имя заголовок</div>
    <input type="text" name="email" value="{{ old('email') }}" style="margin-bottom: 10px;">

    <div class="">Пароль 6-8 знаков </div>
    <input type="text" name="password" value="{{ old('password') }}" style="margin-bottom: 10px;">
    <br>

    <select class="form-control" name="role">
        <option>Выберите роль пользователя</option>
            <option value="admin"> admin </option>
        <option value="user"> user </option>
    </select>
    <button type="submit">Создать</button>

</form>

</body>
</html>
