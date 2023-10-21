<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Noass Posts</title>
    </head>
    <style>

        @font-face {
            font-family: Roboto-Bold;
            src: url('{{asset('/public/fonts/Roboto-Bold.ttf')}}');
        }

        button {
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
        }

        img {
            width: 25%;
            height: 25%; 
            object-fit: contain;
        }

    </style>
    <body>
           
        <div class="center">
        @auth
            @foreach ($posts as $post)
                @if (auth()->user()->id == $post['user_id'])
                    <p>You are logged in as <span style="color:CornflowerBlue;"><u>{{$post->user->name}}</u></span>.</p>
                    @break
                @endif
            @endforeach
            <form action="/logout" method="post">
                @csrf
                <button style="margin-bottom:2%;">Log out</button>
            </form>

            <div style="border: 3px solid black;">
                <h2>Write a new post</h2>
                <form action="/create-post" method="post" enctype="multipart/form-data">
                    @csrf
                    <input style="margin-bottom:1%;" type="text" name="title" placeholder="Post title" maxlength="255"></br>
                    <textarea name="body" placeholder="Post content..." cols="40" rows="8" maxlength="255"></textarea></br>
                    <input type="file" name="image"></br>
                    <button style="margin:1%;">Save post</button>
                </form>
            </div>

            <div style="border: 3px solid black">
                <h2>All posts</h2>
                @foreach ($posts as $post)
                    <div class="box" style="background-color:Thistle; padding:10px; margin:10px;">
                        <h3>{{ $post['title'] }} <span style="color: grey">(by: {{$post->user->name}})</span></h3>
                        <p>{{ $post['body'] }}</p>
                        <img src="{{ asset('uploads/users/'.$post->image) }}" size="10%" alt="">
                        <!--<p style="color:SlateBlue;">Created at: {{ $post['created_at'] }}</p>-->
                        @if (auth()->user()->id == $post['user_id'])
                            <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                            <form action="/delete-post/{{$post->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button>Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            </div>
        </div>
        @else
        <div class="center">
            <div style="border: 3px solid black;">
                <h2 style="margin: 1%">Register</h2>
                <form action="/register" method="post">
                    @csrf
                    <input name="name" type="text" placeholder="Username" >
                    <input name="email" type="text" placeholder="E-mail">
                    <input name="password" type="password" placeholder="Password"></br>
                    <button style="margin: 1%">Register</button>
                </form>
            </div>
            <div style="border: 3px solid black;">
                <h2 style="margin: 1%">Log in</h2>
                <form action="/login" method="post">
                    @csrf
                    <input name="loginName" type="text" placeholder="Username">
                    <input name="loginPassword" type="password" placeholder="Password"></br>
                    <button style="margin: 1%">Log in</button>
                </form>
            </div>
        </div>
        @endauth

    </body>
</html>
