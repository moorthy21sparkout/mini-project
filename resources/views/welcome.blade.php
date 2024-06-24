<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-size: cover;
            text-align: center;
            color: #b18787;
        }

        .content {
            background-color: rgba(235, 232, 232, 0.5);
            padding: 2rem;
            border-radius: 8px;
        }

        a {
            color: #3b3a33;
            text-decoration: none;
            margin: 0 1rem;
            font-weight: bold;
        }

      
      
       
    </style>
</head>

<body>
    <div class="content">
        <h1>Task Management</h1>
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/home') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Sign in</a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</body>

</html>
