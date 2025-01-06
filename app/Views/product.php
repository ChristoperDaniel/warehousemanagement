<!-- App/Views/product.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; }
        .btn { 
            padding: 5px 10px;
            margin: 0 2px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            text-decoration: none;
            font-family: 'Courier New', monospace;
            background-color: #535353;
            color: white;
        }
        .btn-edit {
            background-color: #0c6ff6;
            color: white;
        }
        .btn-save {
            background-color: #229708;
            color: white;
        }

        .btn-cancel {
            background-color: #b00404;
            color: white;
        }

        .btn-delete {
            background-color: #b00404;
            color: white;
        }
        .edit-form {
            display: none;
        }
        .edit-form.active {
            display: inline;
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