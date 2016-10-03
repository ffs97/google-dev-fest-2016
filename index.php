<?php
session_start();
@include('config.php');

if (isset($_SESSION['user_name'])) {
    $query = "SELECT * FROM Users WHERE Username = '".$_SESSION['user_name']."'";
    $response = @mysqli_query($dbc, $query) or die("Cannot connect to the database, please check your connection or try again later.");

    $logged = false;
    if ($row = @mysqli_fetch_array($response)) {
        $logged = true;
        $name = $row['Name'];
        $username = $row['Username'];
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>PiCandy</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/common.css">
        <link rel="stylesheet" href="css/index.css">
        <link rel="stylesheet" href="css/fonts.css">

        <script src="js/index.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>

    <div class="container-fluid" id="header">
        <div class="container">
            <div id="logo">PI<span>C</span>ANDY</div>
            <div id="user-info">
                <?php if ($logged) { ?>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Hello <?php echo $name; ?>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="width: 100%; font-size: 16px;">
                            <li onclick="showUpload()"><a href="#"><span class="glyphicon glyphicon-plus"></span> &nbsp; Upload</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> &nbsp; Logout</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <span onclick="showLogin()">Login / Register</span>
                <?php } ?>
            </div>
        </div>
    </div>

    <div id="frame">

        <?php

        $query = "SELECT * FROM Posts";
        $response = mysqli_query($dbc, $query);
        $data = [];

        while ($row = mysqli_fetch_array($response)) {
            $data[] = $row;
        }
        $data = array_reverse($data);

        $i = 1;
        foreach ($data as $row) { ?>
            <div class="image-container">
                <div class="image-header">
                    <span class="user-image"><img src="user-images/guggu.jpg"></span>
                    <span class="user-name"><?php echo $row['Username']; ?></span>
                </div>
                <div class="image-content">
                    <img src="<?php echo $row['Url']; ?>">
                </div>
                <div class="image-controls">
                    <?php if ($logged) { ?>
                        <div class="image-like" onclick="showAds('<?php echo $row['Tags']; ?>', <?php echo $i; ?>)"><span class="fa fa-thumbs-o-up"></span> </div>
                    <?php } ?>
                    <div class="image-tags"><?php echo $row['Tags']; ?></div>
                </div>
                <div class="image-ads" id="image-ads-<?php echo $i; ?>">
                    <div class="loader">
                    </div>
                </div>
            </div>
        <?php $i++; } ?>

    </div>

    <?php if ($logged) { ?>

        <div id="upload-container" class="hidden">
            <h2>Upload Image</h2>
            <form class="upload-box" method="post" action="upload.php" onsubmit="updateTags()">
                <input type="text" name="url" placeholder="Upload from Url" id="upload-url">
                <input type="hidden" name="tags" id="upload-tags">
                <input type="submit" value="Upload">
            </form>
        </div>

    <?php } else { ?>

        <div id="login-container" class="hidden">
            <form id="login-signin" method="post" action="login.php">
                <h2>Login</h2>

                <label for="username">
                    <img src="images/username.png">
                    <input type="username" name="username" placeholder="Username" required>
                </label>

                <label for="username">
                    <img src="images/password.png">
                    <input type="password" name="password" placeholder="Password" required>
                </label>

                <input type="submit" name="login" value="Sign In">
            </form>

            <form id="login-signup" style="margin-top: 40px;" method="post" action="login.php">
                <h2>Register</h2>

                <label for="name">
                    <img src="images/name.png">
                    <input type="text" name="name" placeholder="Full Name" required>
                </label>

                <label for="username">
                    <img src="images/username.png">
                    <input type="username" name="username" placeholder="Username" required>
                </label>

                <label for="username">
                    <img src="images/password.png">
                    <input type="password" name="password" placeholder="Password" required>
                </label>

                <input type="submit" name="register" value="Sign Up">
            </form>
        </div>

    <?php } ?>

    </body>
</html>
