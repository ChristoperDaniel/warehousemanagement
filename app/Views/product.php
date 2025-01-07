<!-- App/Views/product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
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
        .btn-add {
            background-color: #2ecc71;
        }
        .btn-edit {
            background-color: #3498db;
        }
        .btn-save {
            background-color: #27ae60;
        }
        .btn-cancel {
            background-color: #e74c3c;
        }
        .btn-delete {
            background-color: #e74c3c;
        }
        .btn:hover {
            opacity: 0.8;
        }
        .edit-form {
            display: none;
        }
        .edit-form.active {
            display: inline;
        }
        .edit-form input[type="number"] {
            width: 80px;
            margin-right: 5px;
        }
    </style>
    
    <script>
        function showEditForm(id) {
            // Hide all edit forms first
            document.querySelectorAll('.edit-form').forEach(form => {
                form.classList.remove('active');
            });
            // Show the selected edit form
            document.getElementById('edit-form-' + id).classList.add('active');
            // Hide the corresponding value display
            document.getElementById('value-display-' + id).style.display = 'none';
        }

        function cancelEdit(id) {
            document.getElementById('edit-form-' + id).classList.remove('active');
            document.getElementById('value-display-' + id).style.display = 'inline';
        }
    </script>
</head>
<body>
    <h2>Input Product</h2>
    <form action="<?= base_url('/product/addProduct') ?>" method="POST">
        <?= csrf_field() ?>
        <label for="name_product">Name Product:</label>
        <input type="text" name="name_product" id="name_product" required>
        <br>
        <label for="category_product">Category Product:</label>
        <input type="text" name="category_product" id="category_product" required>
        <br>
        <label for="quantity_product">Quantity Product:</label>
        <input type="number" name="quantity_product" id="quantity_product" required>
        <br>
        <button type="submit" class="btn">Add</button>
    </form>

    <h2>Data Product</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($product as $product_item): ?>
        <tr>
            <td><?= $product_item['id_product'] ?></td>
            <td><?= $product_item['name_product'] ?></td>
            <td><?= $product_item['category_product'] ?></td>
            <td>
                <span id="value-display-<?= $product_item['id_product'] ?>"><?= $product_item['quantity_product'] ?></span>
                <form id="edit-form-<?= $product_item['id_product'] ?>" class="edit-form" action="<?= base_url('/product/updateQuantityProduct/' . $product_item['id_product']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="number" name="quantity_product" value="<?= $product_item['quantity_product'] ?>" required>
                    <button type="submit" class="btn btn-save">Save</button>
                    <button type="button" class="btn btn-cancel" onclick="cancelEdit(<?= $product_item['id_product'] ?>)">Cancel</button>
                </form>
            </td>
            <td>
                <button class="btn btn-edit" onclick="showEditForm(<?= $product_item['id_product'] ?>)">Edit</button>
                <a href="<?= base_url('/product/deleteProduct/' . $product_item['id_product']) ?>" onclick="return confirm('Are you sure you want to delete this item?')" class="btn btn-delete">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>