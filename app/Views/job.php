<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Assignment</title>
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

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            transform: translateY(-1px);
        }

        .table {
            background-color: white;
            border-radius: 10px;
        }

        .table thead th {
            background-color: var(--light-bg);
            border-bottom: none;
            padding: 1rem;
            font-weight: 600;
            color: var(--primary-color);
            text-align: center;
            vertical-align: middle;
        }

        .table tbody td {
            text-align: center;
            vertical-align: middle;
            padding: 1rem;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .badge.cat-food {
            background-color: #FF6B6B !important;
            color: white;
        }
        .badge.cat-drink {
            background-color: #4ECDC4 !important;
            color: white;
        }
        .badge.cat-fashion {
            background-color: #9B59B6 !important;
            color: white;
        }
        .badge.cat-tools {
            background-color: #3498DB !important;
            color: white;
        }

        .badge.status-not-started {
            background-color: #F1C40F !important;
            color: white;
        }

        .badge.status-in-progress {
            background-color: #3498DB !important;
            color: white;
        }

        .badge.status-finished {
            background-color: #2ECC71 !important;
            color: white;
        }

        .stats-card {
            background: linear-gradient(135deg, var(--secondary-color), #2980b9);
            color: white;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-tasks me-2"></i>
                Job Assignment
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
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('message')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count($job) ?>
                    </div>
                    <div class="stats-label">Total Jobs</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job, function($j) { return strtolower(str_replace(' ', '-', $j['status'])) === 'not-started'; })) ?>
                    </div>
                    <div class="stats-label">Not Started</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job, function($j) { return strtolower(str_replace(' ', '-', $j['status'])) === 'in-progress'; })) ?>
                    </div>
                    <div class="stats-label">In Progress</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job, function($j) { return strtolower(str_replace(' ', '-', $j['status'])) === 'finished'; })) ?>
                    </div>
                    <div class="stats-label">Completed</div>
                </div>
            </div>
        </div>

        <!-- Add Job Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add New Job
                </h5>
            </div>
            <div class="card-body">
                <form action="/job/inputJob" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>Name
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="product" class="form-label">
                                <i class="fas fa-box me-2"></i>Product
                            </label>
                            <input type="text" class="form-control" id="product" name="product" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Not Started">Not Started</option>
                                <option value="In Progress">In Progress</option>
                                <option value="Finished">Finished</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Job
                    </button>
                </form>
            </div>
        </div>

        <!-- Job List -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>
                    Job List
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Category</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($job)) : ?>
                                <?php foreach ($job as $index => $item) : ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td>
                                            <i class="fas fa-user-circle me-2 text-secondary"></i>
                                            <?= $item['name']; ?>
                                        </td>
                                        <td><?= $item['email']; ?></td>
                                        <td>
                                            <span class="badge cat-<?= strtolower($item['category']) ?>">
                                                <?= $item['category'] ?>
                                            </span>
                                        </td>
                                        <td><?= $item['product']; ?></td>
                                        <td>
                                            <span class="badge status-<?= strtolower(str_replace(' ', '-', $item['status'])) ?>">
                                                <i class="fas fa-circle me-1"></i>
                                                <?= $item['status']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#updateModal<?= $item['id']; ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="/job/deleteJob" method="post" style="display:inline-block;">
                                                <input type="hidden" name="id" value="<?= $item['id']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure want to delete this job?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>

                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateModal<?= $item['id']; ?>" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="/job/updateJob" method="post">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Update Job</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id_job" value="<?= $item['id']; ?>">
                                                        <div class="mb-3">
                                                            <label for="updateProduct" class="form-label">
                                                                <i class="fas fa-box me-2"></i>Product
                                                            </label>
                                                            <input type="text" class="form-control" id="updateProduct" 
                                                                   name="updateProduct" value="<?= $item['product']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="updateStatus" class="form-label">
                                                                <i class="fas fa-toggle-on me-2"></i>Status
                                                            </label>
                                                            <select class="form-select" id="updateStatus" name="updateStatus" required>
                                                                <option value="Not Started" <?= $item['status'] === 'Not Started' ? 'selected' : ''; ?>>
                                                                    Not Started
                                                                </option>
                                                                <option value="In Progress" <?= $item['status'] === 'In Progress' ? 'selected' : ''; ?>>
                                                                    In Progress
                                                                </option>
                                                                <option value="Finished" <?= $item['status'] === 'Finished' ? 'selected' : ''; ?>>
                                                                    Finished
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-secondary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">No jobs available</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>