<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Assignments</title>
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

        .badge.status-not-started {
            background-color: #F1C40F !important;
        }

        .badge.status-in-progress {
            background-color: #3498DB !important;
        }

        .badge.status-finished {
            background-color: #2ECC71 !important;
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

        .form-select {
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-tasks me-2"></i>
                Job Assignments
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

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job_assign, function($job) { return strtolower(str_replace(' ', '-', $job['status'])) === 'not-started'; })) ?>
                    </div>
                    <div class="stats-label">Not Started Tasks</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job_assign, function($job) { return strtolower(str_replace(' ', '-', $job['status'])) === 'in-progress'; })) ?>
                    </div>
                    <div class="stats-label">In Progress</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($job_assign, function($job) { return strtolower(str_replace(' ', '-', $job['status'])) === 'finished'; })) ?>
                    </div>
                    <div class="stats-label">Completed</div>
                </div>
            </div>
        </div>

        <!-- Job Assignments Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>
                    Job Assignments List
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($job_assign) && is_array($job_assign)): ?>
                                <?php foreach ($job_assign as $job): ?>
                                    <tr>
                                        <td><?= esc($job['id']) ?></td>
                                        <td>
                                            <i class="fas fa-user-circle me-2 text-secondary"></i>
                                            <?= esc($job['name']) ?>
                                        </td>
                                        <td><?= esc($job['email']) ?></td>
                                        <td>
                                            <span class="badge category-<?= strtolower($job['category']) ?>">
                                                <i class="fas fa-tag me-1"></i>
                                                <?= esc($job['category']) ?>
                                            </span>
                                        </td>
                                        <td><?= esc($job['product']) ?></td>
                                        <td>
                                            <span class="badge status-<?= strtolower(str_replace(' ', '-', $job['status'])) ?>">
                                                <i class="fas fa-circle me-1"></i>
                                                <?= esc($job['status']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <form action="<?= base_url('job_assign/updateJobAssign') ?>" method="post">
                                                <input type="hidden" name="id_job" value="<?= esc($job['id']) ?>">
                                                <div class="d-flex gap-2">
                                                    <select name="updateStatus" class="form-select" required>
                                                        <option value="Not Started" <?= $job['status'] === 'Not Started' ? 'selected' : '' ?>>Not Started</option>
                                                        <option value="In Progress" <?= $job['status'] === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                                                        <option value="Finished" <?= $job['status'] === 'Finished' ? 'selected' : '' ?>>Finished</option>
                                                    </select>
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="fas fa-sync-alt"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No job assignments available</td>
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