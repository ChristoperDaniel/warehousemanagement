<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management System</title>
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
            text-align: center; /* Center align header */
            vertical-align: middle;
        }
        .table tbody td {
            text-align: center; /* Center align all table cells */
            vertical-align: middle;
            padding: 1rem;
        }

        /* Adjust checkbox column */
        .table th:first-child,
        .table td:first-child {
            width: 50px;
            text-align: center;
        }

        /* Name column styling */
        .table td .user-name {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Department Badge Colors */
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

        /* Status Badge Colors */
        .badge.status-active {
            background-color: #2ECC71 !important;
            color: white;
        }
        .badge.status-on-leave {
            background-color: #F1C40F !important;
            color: white;
        }
        .badge.status-inactive {
            background-color: #E74C3C !important;
            color: white;
        }

        /* Role Badge Colors */
        .badge.role-manager {
            background-color: #8E44AD !important;
            color: white;
        }
        .badge.role-admin {
            background-color: #2C3E50 !important;
            color: white;
        }
        .badge.role-staff {
            background-color: #16A085 !important;
            color: white;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
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
                <i class="fas fa-users me-2"></i>
                Employee Information
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
        <?php if (session()->getFlashdata('message')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('message') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if (session()->getFlashdata('error')): ?>
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
                    <div class="stats-number"><?= count($employee) ?></div>
                    <div class="stats-label">Total Employees</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($employee, function($emp) { return strtolower(str_replace(' ', '-', $emp['status'])) === 'active'; })) ?>
                    </div>
                    <div class="stats-label">Active Employees</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($employee, function($emp) { return strtolower(str_replace(' ', '-', $emp['status'])) === 'on-leave'; })) ?>
                    </div>
                    <div class="stats-label">On Leave</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stats-card">
                    <div class="stats-number">
                        <?= count(array_filter($employee, function($emp) { return strtolower(str_replace(' ', '-', $emp['status'])) === 'inactive'; })) ?>
                    </div>
                    <div class="stats-label">Inactive</div>
                </div>
            </div>
        </div>

        <!-- Add Employee Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-user-plus me-2"></i>
                    Add New Employee
                </h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('employee/inputDataEmployee') ?>" method="post">
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
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone me-2"></i>Phone
                            </label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">
                                <i class="fas fa-building me-2"></i>Department
                            </label>
                            <select class="form-select" id="department" name="department" required>
                                <option value="">Select Department</option>
                                <option value="Food">Food</option>
                                <option value="Drink">Drink</option>
                                <option value="Fashion">Fashion</option>
                                <option value="Tools">Tools</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">
                                <i class="fas fa-toggle-on me-2"></i>Status
                            </label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="Active">Active</option>
                                <option value="On Leave">On Leave</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="hire_date" class="form-label">
                                <i class="fas fa-calendar me-2"></i>Hire Date
                            </label>
                            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="role" class="form-label">
                                <i class="fas fa-briefcase me-2"></i>Role
                            </label>
                            <select class="form-select" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="Manager">Manager</option>
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Employee
                    </button>
                </form>
            </div>
        </div>

        <!-- Employee List -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>
                    Employee List
                </h5>
                <div>
                    <form action="<?= base_url('employee/updateEmployee') ?>" method="post" class="d-inline" id="updateForm">
                        <select class="form-select d-inline-block w-auto me-2" name="updateStatus">
                            <option value="Active">Active</option>
                            <option value="On Leave">On Leave</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                        <button type="submit" class="btn btn-warning" id="updateBtn" disabled>
                            <i class="fas fa-sync-alt me-2"></i>Update Status
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" class="form-check-input"></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Hire Date</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee as $emp): ?>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input employee-checkbox" 
                                           name="id_employee[]" form="updateForm" value="<?= $emp['id'] ?>">
                                </td>
                                <td>
                                    <i class="fas fa-user-circle me-2 text-secondary"></i>
                                    <?= esc($emp['name']) ?>
                                </td>
                                <td><?= esc($emp['email']) ?></td>
                                <td><?= esc($emp['phone']) ?></td>
                                <td>
                                    <span class="badge dept-<?= strtolower($emp['department']) ?>">
                                        <?= esc($emp['department']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge status-<?= strtolower(str_replace(' ', '-', $emp['status'])) ?>">
                                        <i class="fas fa-circle me-1"></i>
                                        <?= esc($emp['status']) ?>
                                    </span>
                                </td>
                                <td><?= esc($emp['hire_date']) ?></td>
                                <td>
                                    <span class="badge role-<?= strtolower($emp['role']) ?>">
                                        <?= esc($emp['role']) ?>
                                    </span>
                                </td>
                                <td>
                                    <form action="<?= base_url('employee/deleteEmployee') ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id[]" value="<?= $emp['id'] ?>">
                                        <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Are you sure you want to delete this employee?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle select all checkbox
        document.getElementById('selectAll').addEventListener('change', function() {
            const checkboxes = document.getElementsByClassName('employee-checkbox');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
            updateButtonState();
        });

        // Handle individual checkboxes
        const employeeCheckboxes = document.getElementsByClassName('employee-checkbox');
        for (let checkbox of employeeCheckboxes) {
            checkbox.addEventListener('change', updateButtonState);
        }

        // Update button state based on selections
        function updateButtonState() {
            const checkboxes = document.getElementsByClassName('employee-checkbox');
            const updateBtn = document.getElementById('updateBtn');
            let checkedCount = 0;
            
            for (let checkbox of checkboxes) {
                if (checkbox.checked) checkedCount++;
            }
            
            updateBtn.disabled = checkedCount === 0;
        }
    </script>
</body>
</html>