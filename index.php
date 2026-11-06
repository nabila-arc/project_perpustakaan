<?php
session_start();
if (isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
}
if (isset($_SESSION['username'])) {
    header("location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Digital Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background: linear-gradient(135deg, #4287ee 0%, #93ecfc 40%, #fcc1db 75%, #a86d39 100%);
            background-attachment: fixed; 
            background-size: cover;
            min-height: 100vh; 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .glass-card { 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 15px; 
            box-shadow: 0 10px 30px rgba(0,0,0,0.2); 
            padding: 30px;
            width: 100%;
            max-width: 400px;
            margin: 15px;
        }
    </style>
</head>
<body>
    <div class="glass-card">
        <h3 class="text-center mb-4" style="color: #0A192F; font-weight:bold;">Digital Library</h3>
        <form method="POST" action="proses_login.php">
            <div class="mb-3">
                <label class="form-label fw-bold" style="color: #4E89AE;">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold" style="color: #4E89AE;">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label text-secondary" for="remember">Remember Me</label>
            </div>
            <button type="submit" class="btn w-100 fw-bold" style="background-color: #0A192F; color: white;">Login</button>
        </form>
    </div>
</body>
</html>