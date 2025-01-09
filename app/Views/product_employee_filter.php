<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product & Employee Filter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #2c3e50;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn-filter {
            background-color: #3498db;
        }
        .btn:hover {
            opacity: 0.8;
        }
        #filterForm {
            display: flex;
            gap: 10px;
            align-items: flex-end;
        }
        .form-group {
            flex: 1;
        }
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .btn-logout {
            background-color: rgb(204, 46, 46);
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <h2>Product & Employee Filter</h2>
    
    <form id="filterForm">
        <div class="form-group">
            <label for="category">Select Category/Department:</label>
            <select id="category" name="category">
                <option value="">Select Category</option>
                <option value="Food">Food</option>
                <option value="Drink">Drink</option>
                <option value="Fashion">Fashion</option>
                <option value="Tools">Tools</option>
                <!-- Add more categories as needed -->
            </select>
        </div>
        <button type="button" class="btn btn-filter" onclick="filterData()">Filter</button>
    </form>

    <table id="resultTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Person In Charge</th>
                <th>Status</th>
                <th>Job Title</th>
            </tr>
        </thead>
        <tbody id="resultBody">
            <!-- Results will be populated here -->
        </tbody>
    </table>

    <script>
        function filterData() {
            const category = document.getElementById('category').value;
            if (!category) {
                alert('Please select a category');
                return;
            }

            fetch(`/filter/productemployee?category=${encodeURIComponent(category)}`)
                .then(response => response.json())
                .then(data => {
                    const tbody = document.getElementById('resultBody');
                    tbody.innerHTML = '';

                    if (data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="6" style="text-align: center;">No results found</td></tr>';
                        return;
                    }

                    data.forEach(item => {
                        const row = `
                            <tr>
                                <td>${item.name_product}</td>
                                <td>${item.category_product}</td>
                                <td>${item.quantity_product}</td>
                                <td>${item.name}</td>
                                <td>${item.status}</td>
                                <td>${item.job_title}</td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching the data');
                });
        }
    </script>

    <div style="text-align: right; margin-top: 20px;">
        <a href="/logoutUserProduct" class="btn btn-logout">
            <span>Logout</span>
        </a>
    </div>
</body>
</html>