<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
        }

        header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            padding: 1.5rem 2rem;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        header h1 {
            font-size: 3rem;
            font-weight: 600;
            text-align: center;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        nav {
            background-color: rgba(52, 73, 94, 0.8);
            padding: 1rem 2rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            margin-right: 1rem;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: rgba(44, 62, 80, 0.9);
            transform: translateY(-2px);
        }

        main {
            flex: 1;
            padding: 2rem;
        }

        footer {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        footer p {
            font-size: 0.9rem;
            opacity: 0.9;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }
        
        .nav-container {
            display: flex;
            justify-content: center;
            gap: 2rem;
            padding: 3rem;
            background: transparent;
        }

        .nav-box {
            width: 220px;
            height: 220px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: #2c3e50;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .nav-box:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 1);
        }

        .nav-box svg {
            width: 64px;
            height: 64px;
            margin-bottom: 1.2rem;
            color: #1a2980;
            transition: all 0.3s ease;
        }

        .nav-box:hover svg {
            color: #26d0ce;
            transform: scale(1.1);
        }

        .nav-box span {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            margin-top: 0.8rem;
            color: #1a2980;
        }
    </style>
</head>
<body>
    <header>
        <h1>Warehouse Management</h1>
    </header>
    <nav class="nav-container">
        <a href="/product" class="nav-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.29 7 12 12 20.71 7"></polyline>
                <line x1="12" y1="22" x2="12" y2="12"></line>
            </svg>
            <span>Product List Management</span>
        </a>
        
        <a href="/login" class="nav-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
            <span>Employee Management</span>
        </a>
        <a href="/product-employee-filter" class="nav-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                <polyline points="3.29 7 12 12 20.71 7"></polyline>
                <line x1="12" y1="22" x2="12" y2="12"></line>
            </svg>
            <span>Filter By Category</span>
        </a>
        
    </nav>
    <footer>
        <p>Made by 18222034 & 18222100</p>
    </footer>
</body>
</html>