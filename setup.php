<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- theme meta -->
        <meta name="theme-name" content="focus" />
        <title>Setup CAD System</title>
        <!-- ================= Favicon ================== -->
        <!-- Standard -->
        <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
        <!-- Retina iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
        <!-- Retina iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
        <!-- Standard iPad Touch Icon-->
        <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
        <!-- Standard iPhone Touch Icon-->
        <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
        <!-- Styles -->
        <link href="css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
        <link href="css/lib/chartist/chartist.min.css" rel="stylesheet">
        <link href="css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="css/lib/themify-icons.css" rel="stylesheet">
        <link href="css/lib/owl.carousel.min.css" rel="stylesheet" />
        <link href="css/lib/owl.theme.default.min.css" rel="stylesheet" />
        <link href="css/lib/weather-icons.css" rel="stylesheet" />
        <link href="css/lib/menubar/sidebar.css" rel="stylesheet">
        <link href="css/lib/bootstrap.min.css" rel="stylesheet">
        <link href="css/lib/helper.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>

 
<body> 
    <div id="sidebar">
        <!-- Add your sidebar content here -->
    </div>
    <div id="main-content">
         <div id="header">
              <h1 class = "text-center" style="margin-top: 5vh;">Setup Page</h1>
          </div>
          <form action="setupscript.php" method="POST" onsubmit="return validateForm(event)" class="container mt-4" style="margin-bottom: 5vh;"> 

            <div class="error-message alert alert-danger" style="display:none;"></div>
          
            <div class="form-group">
              <label for="database-name">Database Name:</label>
              <input type="text" id="database-name" name="database-name" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="database-username">Database Username:</label>
              <input type="text" id="database-username" name="database-username" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="database-password">Database Password:</label>
              <input type="password" id="database-password" name="database-password" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="database-address">Database Address:</label>
              <input type="text" id="database-address" name="database-address" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="server-name">Server Name:</label>
              <input type="text" id="server-name" name="server-name" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="user-username">User's Username:</label>
              <input type="text" id="user-username" name="user-username" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="user-password">User's Password:</label>
              <input type="password" id="user-password" name="user-password" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="product-key">Product Key:</label>
              <input type="text" id="product-key" name="product-key" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="server-ip-address">Server IP Address:</label>
              <input type="text" id="server-ip-address" name="server-ip-address" class="form-control">
            </div>
          
            <div class="form-group">
              <label for="server-game">Server Game:</label>
              <select id="server-game" name="server-game" class="form-control">
                <option value="Minecraft">Minecraft</option>
                <option value="Unturned">Unturned</option>
                <option value="GTA">GTA</option>
                <!-- more to come later -->
              </select>
            </div>
          
            <div class="form-group">
              <label for="discord-link">Discord Link:</label>
              <input type="text" id="discord-link" name="discord-link" class="form-control">
            </div>
          
            <button type="submit" class="btn btn-primary">Submit</button>
          
          </form>
          
     </div>
  
    </script>
</body>
</html>
