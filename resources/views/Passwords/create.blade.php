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
<form action="/passwords" method="POST">
    @csrf
    <div class="">Введите имя пароля</div>
    <input type="text" name="username" value="{{ old('username') }}" style="margin-bottom: 10px;">

    <div class="">Введите имя заголовок</div>
    <input type="text" name="title" value="{{ old('title') }}" style="margin-bottom: 10px;">

    <div class="">Пароль</div>
    <input type="text" name="password" value="{{ old('password') }}" style="margin-bottom: 10px;">
    <div class="">Проект</div>
    <input type="text" name="project" value="{{ old('project') }}" style="margin-bottom: 10px;">

    <div class="form-group">
            <div class="">Папка к которой относится пароль</div>
        <select class="form-control" name="folder_id">
            <option>Выберите папку</option>
            @foreach($folder as $key => $value)
                <option value="{{ $value->id }}"> {{ $value->name .' '. $value->id }}  </option>
            @endforeach

        </select>
    </div>
<button type="submit">Создать</button>

</form>

</body>
</html>
