<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        body {
            background-color: #f8fafc;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: linear-gradient(135deg, #1a2980 0%, #3b82f6 100%);
            color: white;
            padding: 1.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .navbar-brand {
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-outline-light:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 2rem auto;
            padding: 3rem 1rem;
            flex: 1;
        }

        .nav-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .nav-box {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-decoration: none;
            color: #1e293b;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .nav-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        .icon-container {
            background: #eff6ff;
            padding: 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .nav-box:hover .icon-container {
            background: #1a2980;
        }

        .nav-box svg {
            width: 40px;
            height: 40px;
            stroke: #2563eb;
            transition: all 0.3s ease;
        }

        .nav-box:hover svg {
            stroke: white;
        }

        .nav-box span {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
        }

        .nav-box p {
            font-size: 0.875rem;
            color: #64748b;
            text-align: center;
            margin-top: -1rem;
        }

        footer {
            background: linear-gradient(135deg, #1a2980 0%, #3b82f6 100%);
            color: #FFFFFF;
            text-align: center;
            padding: 1.5rem;
            margin-top: 2rem;
        }

        @media (max-width: 768px) {
            .header-content {
                padding: 0 0.5rem;
            }

            .container {
                margin: 1rem auto;
                padding: 0.5rem 1rem;
            }

            .nav-box {
                padding: 1.5rem;
            }

            .icon-container {
                padding: 1rem;
            }

            .nav-box svg {
                width: 32px;
                height: 32px;
            }

            .nav-box span {
                font-size: 1.125rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a href="/" class="navbar-brand">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Employee Dashboard
            </a>
            <div class="ms-auto">
                <a href="/logout" class="btn btn-outline-light">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </header>
    <div class="container">
        <nav class="nav-container">
            <a href="/employee" class="nav-box">
                <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <span>Employee Profile</span>
                <p>View and manage employee information</p>
            </a>
            
            <a href="/attendance" class="nav-box">
                <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                </div>
                <span>Attendance</span>
                <p>Track employee attendance and time records</p>
            </a>

            <a href="/job" class="nav-box">
                <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </div>
                <span>Job Assignment</span>
                <p>View employee tasks and projects</p>
            </a>

            <a href="/check_stock" class="nav-box">
                <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                        <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                        <line x1="12" y1="22.08" x2="12" y2="12"></line>
                    </svg>
                </div>
                <span>Check Stock</span>
                <p>View product stock</p>
            </a>
        </nav>
    </div>
    <footer>
        <p>&copy; 2025 Employee Management. All rights reserved.</p>
    </footer>
</body>
</html>