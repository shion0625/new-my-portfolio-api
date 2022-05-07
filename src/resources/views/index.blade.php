<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <form action="/api/images" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="work_id" value=1>
        <input type="file" name="imgpath">
        <input type="submit" value="アップロードする">
    </form>
    <img src=" {{ asset('storage/1651929632.109.jpeg')}}">
</html>
