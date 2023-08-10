<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        #container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        header {
            background-color: #35424a;
            color: white;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #35424a;
            float: left;
            width: 20%;
            height: 100vh;
            padding-top: 20px;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            margin-bottom: 10px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #4a5b63;
        }

        section {
            float: left;
            width: 80%;
            padding: 20px;
            background-color: white;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to Your Dashboard</h1>
    </header>
    <div id="container">
        <nav>
            <ul>
                <li><a href="signout.php">Log Out</a></li>
                <li><a href="bank.php">Bank</a></li>
                <li><a href="adminlookup.php">Admin Lookup</a></li>
                <li><a href="forum.php">Forums</a></li>
                <li><a href="pdcad.php">PoliceCAD</a></li>
                <li><a href="emscad.php">EMSCAD</a></li>
                <li><a href="university.php">University</a></li>
                <li><a href="ticket.php">Open a Ticket</a></li>
                <li><a href="market.php">Market</a></li>
            </ul>
        </nav>
        <section>
            <!-- Your content goes here -->
        </section>
    </div>
</body>
</html>
