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
<table>
    @foreach($user as $key => $value)
        <tr>
            <td><div>{{$value->id}} - id ;  </div></td>
            <td><div>{{$value->name}} - Имя пользователя; </div></td>
            <td><div>{{$value->email}} - Email пользователя; </div></td>
            <td><div>{{$value->role}} - Роль пользователя; </div></td>
            <td>
                <form action="{{ url('/users/'. $value->id) }}" method="POST" class="btn btn-small btn-danger" style="margin: 0 50px ; display: block" >
                    <input class="btn btn-default" type="submit" value="Delete" />
                    @method('delete')
                    @csrf
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
