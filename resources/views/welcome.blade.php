<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Management System</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f7fafc;
        }

        .dark-mode body {
            background-color: #1a202c;
            color: white;
        }

        .content {
            text-align: center;
            margin-bottom: 20px;
        }

        .button-container {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .button {
            padding: 0.5rem 1rem;
            font-size: 1rem;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            background-color: #4a5568;
            color: white;
        }

        .button.dark {
            background-color: #2d3748;
        }

        .button:hover {
            background-color: #2c5282;
        }

        .button.dark:hover {
            background-color: #1a202c;
        }
    </style>
</head>

<body class="antialiased dark:bg-gray-900 dark:text-white">
    <div class="content">
        <h1>Welcome to Sales Management System</h1>
    </div>
    <div class="button-container">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">
                    <button class="button dark">Dashboard</button>
                </a>
            @else
                <a href="{{ route('login') }}">
                    <button class="button dark">Log in</button>
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">
                        <button class="button dark">Register</button>
                    </a>
                @endif
            @endauth
        @endif
    </div>
</body>

</html>
