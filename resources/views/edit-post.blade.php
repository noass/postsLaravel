<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit post</title>
</head>
<body>
    <h1>Edit post</h1>
    <form action="/edit-post/{{$post->id}}" method="post">
        @csrf
        @method('PUT')
        <input type="text" name="title" value="{{$post->title}}"></br>
        <textarea name="body" cols="30" rows="10">{{$post->body}}</textarea>
        <input type="file" name="image"></br>
        <button>Save changes</button>
    </form>
</body>
</html>