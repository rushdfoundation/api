<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            
        </style>
    </head>
    <body class="antialiased">
        
    <form action="{{ url('video') }}" method="post" enctype="multipart/form-data">
        @csrf
        <p><input type="text" name="title" placeholder="Enter Video Title" /></p>
        <p><textarea name="description" cols="30" rows="10" placeholder="Video description"></textarea></p>
        <p><input type="file" name="video" /></p>
        <button type="submit" name="submit">Submit</button>
    </form>

    </body>
</html>
