<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit post</title>
</head>

<style>

        @font-face {
            font-family: Roboto-Bold;
            src: url('/fonts/Roboto-Bold.ttf');
        }

        button {
            font-family: Roboto-Bold;
			color: #ffffff;
			background-color: #2d63c8;
			font-size: 14px;
			border: 0px solid #000000;
			padding: 10px 12px;
			cursor: pointer
		}
		button:hover {
			color: #2d63c8;
			background-color: #ffffff;
		}
        body{
            background-color: rgb(223, 221, 255);
        }

        div.box {
            word-wrap: break-word;
            text-align:left;
        }

        .center{
            margin: auto;
            text-align: center;
            min-width:343px;
            width: 30%;
        }

        img {
            width: 25%;
            height: 25%; 
            object-fit: contain;
        }

        p{
            font-size: 18px;
            line-height: 0px
        }


</style>

<body style="font-family: Roboto-Bold;">
    <div class="center">
        <h1>Edit post</h1>
        <form action="/edit-post/{{$post->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="text" name="title" value="{{$post->title}}"><br>
            <textarea name="body" cols="30" rows="10">{{$post->body}}</textarea><br>

            @if($post->image)
                <img src="{{ asset('uploads/users/'.$post->image) }}" alt="Current Image"><br>
            @endif

            <input type="file" name="new_image" id="new_image"><br>

            <button style="margin-top:1%;">Save changes</button>
        </form>
    </div>
</body>
</html>
