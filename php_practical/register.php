<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">

            <label for="prefix">Prefix:</label>
            <select name="prefix" id="prefix">
                <option value="mr">mr</option>
                <option value="miss">miss</option>
                <option value="mrs">mrs</option>
            </select>
        </div>

        <div class="input-group">
            <label>first name</label>
            <input type="text" name="fname">
        </div>
        <div class="input-group">
            <label>Last name</label>
            <input type="text" name="lname">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="input-group">
            <label>Mobile number</label>
            <input type="number" name="mno">
        </div>

        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div class="input-group">
            <label>Confirm Password</label>
            <input type="password" name="cpassword">
        </div>
        <div class="input-group">
            <label>Information</label>
            <input type="text" name="information">
        </div>

        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>

</html>