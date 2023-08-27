<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <body>
        <title>animal</title>
        <h1>動物介紹畫面</h1>
        @foreach($animals as $animal)
        <h2>動物名稱：{{$animal->name}}</h2>
        @endforeach
    </body>
</html>
