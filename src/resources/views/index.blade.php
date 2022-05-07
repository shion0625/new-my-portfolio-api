<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <form action="/api/images" enctype="multipart/form-data" method="post">
        @csrf
        <input type="hidden" name="work_id" value=3>
        <input type="file" name="imgpath">
        <input type="submit" value="アップロードする">
    </form>
</html>
