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
<form action="/folders/store" method="POST">
    @csrf
    <div class="">Введите имя папки</div>
    <input type="text" name="name" value="{{ old('name') }}" style="margin-bottom: 10px;">
    <button type="submit">Создать</button>

</form>

</body>
</html>
