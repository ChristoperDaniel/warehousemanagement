<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
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

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
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

        .badge.dept-food {
            background-color: #FF6B6B !important;
            color: white;
        }
        .badge.dept-drink {
            background-color: #4ECDC4 !important;
            color: white;
        }
        .badge.dept-fashion {
            background-color: #9B59B6 !important;
            color: white;
        }
        .badge.dept-tools {
            background-color: #3498DB !important;
            color: white;
        }

        .badge.status-present {
            background-color: #2ECC71 !important;
        }

        .badge.status-absent {
            background-color: #E74C3C !important;
        }

        .badge.status-on-leave {
            background-color: #F1C40F !important;
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
            text-align: center; /* Center align header */
            vertical-align: middle;
        }

        .table tbody td {
            text-align: center; /* Center align all table cells */
            vertical-align: middle;
            padding: 1rem;
        }

    </style>
</head>
<body>
    <nav class="navbar navbar-dark mb-4">
        <div class="container">
            <span class="navbar-brand">
                <i class="fas fa-user-clock me-2"></i>
                Attendance Management
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

        <!-- Stats Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($attendance, function($attend) { return strtolower(str_replace(' ', '-', $attend['status'])) === 'present'; })) ?>
                    </div>
                    <div class="stats-label">Present Today</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($attendance, function($attend) { return strtolower(str_replace(' ', '-', $attend['status'])) === 'absent'; })) ?>
                    </div>
                    <div class="stats-label">Absent Today</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($attendance, function($attend) { return strtolower(str_replace(' ', '-', $attend['status'])) === 'on-leave'; })) ?>
                    </div>
                    <div class="stats-label">On Leave</div>
                </div>
            </div>
        </div>

        <!-- Add Attendance Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Add Attendance
                </h5>
            </div>
            <div class="card-body">
                <form action="/attendance/inputAttendance" method="post">
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>Name
                            </label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email
                            </label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">
                                <i class="fas fa-building me-2"></i>Department
                            </label>
                            <input type="text" name="department" id="department" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Present">Present</option>
                                <option value="Absent">Absent</option>
                                <option value="On Leave">On Leave</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Attendance
                    </button>
                </form>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>
                    Attendance List
                </h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($attendance)) : ?>
                                <?php $no = 1; ?>
                                <?php foreach ($attendance as $item) : ?>
                                    <tr>
                                        <td class="text-center"><?= $no++; ?></td>
                                        <td>
                                            <i class="fas fa-user-circle me-2 text-secondary"></i>
                                            <?= esc($item['name']); ?>
                                        </td>
                                        <td><?= esc($item['email']); ?></td>
                                        <td>
                                            <span class="badge dept-<?= strtolower($item['department']) ?>">
                                                <?= $item['department'] ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge status-<?= strtolower(str_replace(' ', '-', $item['status'])) ?>">
                                                <i class="fas fa-circle me-1"></i>
                                                <?= esc($item['status']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center"><?= esc(date('d-m-Y H:i', strtotime($item['created_at']))); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="6" class="text-center">No attendance records found</td>
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