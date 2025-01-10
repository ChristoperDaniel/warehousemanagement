<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: #2d3748;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            color: #718096;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.75rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .btn {
            width: 100%;
            padding: 0.75rem;
            background: rgba(52, 73, 94, 0.8);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background:rgba(44, 62, 80, 0.9);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-header">
                <h2><a href="/" style="text-decoration: none; color: inherit;">Welcome</a></h2>
                <p>Please sign in to your account</p>
            </div>
        </div>
        
        <form action="/login_action" method="POST" autocomplete="off">
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input 
                    type="text" 
                    class="form-control" 
                    name="username" 
                    placeholder="Username" 
                    required
                    autocomplete="new-password"
                    readonly
                    onfocus="this.removeAttribute('readonly');"
                >
            </div>
            
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input 
                    type="password" 
                    class="form-control" 
                    name="password" 
                    placeholder="Password" 
                    required
                    autocomplete="new-password"
                    readonly
                    onfocus="this.removeAttribute('readonly');"
                >
            </div>
            
            <button type="submit" class="btn">
                Sign In
            </button>
        </form>
    </div>
</body>
</html>