<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 15px;
            width: 200px;
            height: 570px;
        }

        nav div {
            /* Style for user name */
            font-weight: bold;
            margin-bottom: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        li {
            margin-bottom: 10px;
        }

        a {
            text-decoration: none;
            color: #fff;
        }

        a:hover {
            border-bottom: 2px solid #fff;
        }

        /* Content area */
        main {
            flex: 1;
            padding: 20px;
        }

        /* Add more styles as needed */

        /* Responsive styles */
        @media(max-width: 768px) {
            body {
                flex-direction: column;
            }


            nav {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<nav>

    <div>
        <!-- User Name -->
        <p>{{Auth::guard('seller')->user()->name}}</p>

        <form method="POST" action="{{route('seller.logout')}}">
            @csrf
            <button type="submit">Log Out</button>
        </form>
    </div>

    <!-- Vertical Navigation List -->
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Profile</a></li>

</nav>

<!-- Page Content -->
<main>
    <div class="header" style="display: flex; justify-content: space-between">
        <h1>Seller Dashboard</h1>

        <ul>
            <li>Jan 01 - Jan 28</li>
        </ul>

    </div>
</main>

</body>
</html>
