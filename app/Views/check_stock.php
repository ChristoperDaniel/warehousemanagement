<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Stock</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #1a2980;
            --secondary-color: #26d0ce;
            --accent-color: #e74c3c;
            --light-bg: #f8f9fa;
        }
        
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(120deg, #1a2980 0%, #26d0ce 100%);
            padding: 1rem 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            color: white !important;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .btn-outline-light:hover {
            background-color: #e74c3c;
            border-color: #e74c3c;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.08);
            padding: 1.5rem;
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        .search-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
        }

        .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #dee2e6;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .badge.category-food {
            background-color: #FF6B6B !important;
            color: white;
        }
        .badge.category-drink {
            background-color: #4ECDC4 !important;
            color: white;
        }
        .badge.category-fashion {
            background-color: #9B59B6 !important;
            color: white;
        }
        .badge.category-tools {
            background-color: #3498DB !important;
            color: white;
        }

        .badge.status-restock {
            background-color: #e74c3c !important;
            color: white;
        }
        .badge.status-ok {
            background-color: #2ECC71 !important;
            color: white;
        }

        .result-item {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }

        .result-item:hover {
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-box-open me-2"></i>
                Check Stock
            </span>
            <div class="ms-auto">
                <a href="/logout" class="btn btn-outline-light">
                    <i class="fas fa-sign-out-alt me-2"></i>
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Search Form -->
        <div class="search-card">
            <h5 class="card-title mb-4">
                <i class="fas fa-search me-2"></i>
                Search Product
            </h5>
            <form id="stockForm" class="row g-3">
                <div class="col-md-9">
                    <input type="text" class="form-control" id="product" name="product" placeholder="Enter product name" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search me-2"></i>
                        Check Stock
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Card -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Stock Results
                </h5>
            </div>
            <div class="card-body">
                <div id="result"></div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('stockForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const productName = document.getElementById('product').value;
            const resultDiv = document.getElementById('result');
            
            // Show loading state
            resultDiv.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x text-primary"></i></div>';

            fetch(`/check/restock?product=${encodeURIComponent(productName)}`)
                .then(response => response.json())
                .then(data => {
                    resultDiv.innerHTML = '';

                    if (data.error) {
                        resultDiv.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                ${data.error}
                            </div>`;
                        return;
                    }

                    if (data.length === 0) {
                        resultDiv.innerHTML = `
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                No products found matching your search.
                            </div>`;
                        return;
                    }

                    data.forEach(item => {
                        const div = document.createElement('div');
                        div.className = 'result-item';
                        div.innerHTML = `
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-3">
                                        <i class="fas fa-box me-2 text-secondary"></i>
                                        ${item.name_product}
                                    </h5>
                                    <p class="mb-2">
                                        <span class="badge category-${item.category_product.toLowerCase()}">
                                            <i class="fas fa-tag me-1"></i>
                                            ${item.category_product}
                                        </span>
                                    </p>
                                    <p class="mb-2">
                                        <strong>Quantity:</strong> ${item.quantity_product}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="mb-2">
                                        <i class="fas fa-user-circle me-2 text-secondary"></i>
                                        <strong>Assigned to:</strong> ${item.name}
                                    </p>
                                    <p class="mb-2">
                                        <i class="fas fa-envelope me-2 text-secondary"></i>
                                        ${item.email}
                                    </p>
                                    <p class="mb-0">
                                        <i class="fas fa-tasks me-2 text-secondary"></i>
                                        <strong>Status:</strong> ${item.status}
                                    </p>
                                </div>
                            </div>
                        `;
                        resultDiv.appendChild(div);
                    });
                })
                .catch(error => {
                    resultDiv.innerHTML = `
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            An error occurred: ${error.message}
                        </div>`;
                });
        });
    </script>
</body>
</html>