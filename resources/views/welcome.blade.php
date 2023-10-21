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
        @auth
            <p>You are logged in as <span style="color:CornflowerBlue;"><u>{{ auth()->user()->name }}</u></span>.</p>
            <form action="/logout" method="post">
                @csrf
                <button style="margin-bottom:2%;">Log out</button>
            </form>

            <div style="border: 3px double black;">
                <h2>Write a new post</h2>
                <form action="/create-post" method="post" enctype="multipart/form-data">
                    @csrf
                    <input style="margin-bottom:1%;" type="text" name="title" placeholder="Post title" maxlength="255"></br>
                    <textarea name="body" placeholder="Post content..." cols="40" rows="8" maxlength="255"></textarea></br>
                    <label for="image">Image: </label>
                    <input type="file" name="image"></br>
                    <button style="margin:1%;">Save post</button>
                </form>
            </div>

            <div style="border: 3px double black; ">
                <h2>All posts</h2>
                @foreach ($posts as $post)
                    <div class="box" style="background-color:Thistle; padding:10px; margin:10px; border: 3px double black; overflow:hidden; zoom:1; ">
                        <h2>{{ $post['title'] }} <span style="color: grey">(by: {{$post->user->name}})</span></h2>
                        <p>{{ $post['body'] }}</p>
                        @if($post->image !== null)
                            <img src="{{ asset('uploads/users/'.$post->image) }}" alt="">
                        @endif
                        <!--<p style="color:SlateBlue;">Created at: {{ $post['created_at'] }}</p>-->
                        @if (auth()->user()->id == $post['user_id'])
                            <p style="text-align: right;"><a href="/edit-post/{{$post->id}}">Edit</a></p>
                            <form action="/delete-post/{{$post->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button style="background-color:rgb(219, 70, 70); float: right;">Delete</button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
            </div>
        </div>
        @else
        <h1 class="center">Noass Posts</h1>
        <div class="center" style="margin-top: 40%">
            <div style="border: 3px double black;">
                <h2 style="margin: 1%">Register</h2>
                <form action="/register" method="post">
                    @csrf
                    <input name="name" type="text" placeholder="Username" >
                    <input name="email" type="text" placeholder="E-mail">
                    <input name="password" type="password" placeholder="Password"></br>
                    <button style="margin: 1%">Register</button>
                </form>
            </div>
            <div style="border: 3px double black;">
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
