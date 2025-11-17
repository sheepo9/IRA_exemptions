<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOJLr Exemption & Variation Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .landing-container {
            display: flex;
            height: 100vh;
        }

        /* Left Image Section (70%) */
        .landing-image {
            flex: 7;
            background: url('{{ asset('images/background.jpg') }}') center center/cover no-repeat;
        }

        /* Right Content Section (30%) */
        .landing-content {
            flex: 3;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            background-color: #ffffff;
            text-align: center;
            box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1);
        }

        .landing-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 2rem;
        }

        .landing-buttons .btn {
            width: 150px;
            margin: 0.5rem;
            border-radius: 30px;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
        }

        .btn-register {
            background-color: #0d6efd;
            color: white;
        }

        .btn-register:hover {
            background-color: #0b5ed7;
            color: white;
        }

        .btn-login {
            border: 1px solid #0d6efd;
            color: #0d6efd;
        }

        .btn-login:hover {
            background-color: #0d6efd;
            color: white;
        }

        /* Responsive Layout */
        @media (max-width: 992px) {
            .landing-container {
                flex-direction: column;
            }
            .landing-image {
                flex: none;
                height: 50vh;
            }
            .landing-content {
                flex: none;
                height: 50vh;
            }
        }
    </style>
</head>
<body>
    <div class="landing-container">
        <!-- Left Image -->
        <div class="landing-image"></div>

        <!-- Right Content -->
        <div class="landing-content">
             <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 400px; margin-right: 10px;">
            <h1 class="landing-title">
                Welcome to <br>
                Ministry of Justice and Labour Relations<br>
                <br>
                <br>
                 Exemption and Variation Application
            </h1>

            <div class="landing-buttons">
                <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
