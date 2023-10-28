<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="bg.png">
    <div id="sam"></div>
    <div id="sample">
    
    
    <?php if (isset($user)): ?>
        <h1 id="home">Home</h1>
        
        <p style="font-size:20px">Welcome to home page, <?= htmlspecialchars($user["name"]) ?></p>
        
        <p><a href="logout.php">Log out</a></p>
        
    <?php else: ?>
        <h1 id="main">Round-1</h1>
        <p>
            <div id="btn1"><a style="text-decoration:none;color:grey" href="login.php"><div style="position:relative;top:6px;text-align:center">log in</div></a></div>
            <div id="btn2"><a style="text-decoration:none;color:grey" href="signup.html"><div style="position:relative;top:6px;text-align:center">sign up</div></a></div>
        </p>
        
    <?php endif; ?>
    </div>
    
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    