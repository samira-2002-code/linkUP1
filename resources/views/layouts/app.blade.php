<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LinkUp</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f3f2ef;
            color: #1d1d1d;
        }

        /* Navbar */
        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e0e0e0;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar .logo {
            font-size: 22px;
            font-weight: bold;
            color: #0a66c2;
            text-decoration: none;
        }

        .navbar a.nav-link {
            color: #555;
            text-decoration: none;
            font-size: 15px;
        }

        .navbar a.nav-link:hover {
            color: #0a66c2;
        }

        /* Page content */
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('feed') }}" class="logo">LinkUp</a>
        <a href="{{ route('feed') }}" class="nav-link">Home</a>
    </nav>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>
