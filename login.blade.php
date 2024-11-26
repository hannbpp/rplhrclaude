<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Recoleta HR Recruitment System</title>
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap');

        @font-face {
            font-family: 'Recoleta';
            src: url('/fonts/Recoleta-Black.ttf') format('truetype');
            font-weight: 900;
            font-style: normal;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #07799F;
            font-family: 'Lato', sans-serif;
            margin: 0;
        }

        .login-container {
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .login-title {
            font-family: 'Recoleta', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            color: #07799F;
        }

        .login-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 1.5rem;
            margin-top: -1rem;
        }

        .form-control {
            font-size: 1rem;
        }

        .input-group-text {
            background-color: transparent;
            border-right: none;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-primary,
        .btn-secondary {
            background-color: #4B4B4B;
            border-color: #4B4B4B;
            font-weight: 700;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #333;
            border-color: #333;
        }

        .back-btn-container {
            margin-top: 0%;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1 class="login-title">Recoleta</h1>
        <p class="login-subtitle">Recruitment System</p>
        <form method="POST" action="/login">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text"><img src="/images/username-icon.png" alt="Username Icon" width="20"></span>
                <input type="text" class="form-control" placeholder="Username" name="username" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text"><img src="/images/password-icon.png" alt="Password Icon" width="20"></span>
                <input type="password" class="form-control" placeholder="Password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>
            <div class="back-btn-container">
                <a href="/" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>