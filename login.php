<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<img src="bg.png">
<div id="sam"></div>
<div id="sam1">
    <h1 id="login">Login</h1>
    <div id="bodyl">
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <form method="post">
        <div id="lab"><label style="color:white;font-size:20px" for="email">email</label></div>
        <input style="width:395px;height:28px;border-radius:5px;border:none;margin-bottom:25px" type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        <div id="lab"><label style="color:white;font-size:20px" for="password">password</label></div>
        <input style="width:395px;height:28px;border-radius:5px;border:none;margin-bottom:10px" type="password" name="password" id="password">
        <a href="forgot-password.php"><div style="margin-bottom:25px">Forgot password?</div></a>
        <div><button style="width:400px;height:33px;background-color:#003465;border:none;border-radius:5px;color:white">Log in</button></div>
    </form>
    </div>

    
    </div>
    
</body>
</html>








