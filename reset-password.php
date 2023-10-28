<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css"> -->
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <img src="bg.png">
    <div id="sam1"></div>
    <div id="sam">
    <h1>Reset Password</h1>
    <div id="bodyl">

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <div><label style="color:white;font-size:18px" for="password">new password</label></div>
        <input style="width:395px;height:28px;border-radius:5px;border:none;margin-bottom:30px" type="password" id="password" name="password">

        <div><label style="color:white;font-size:18px" for="password_confirmation">repeat password</label></div>
        <input style="width:395px;height:28px;border-radius:5px;border:none;margin-bottom:30px" type="password" id="password_confirmation"
               name="password_confirmation">

        <div><button  style="width:400px;height:33px;background-color:#003465;border:none;border-radius:5px;color:white">Send</button></div>
    </form>
</div>
</div>

</body>
</html>