<?php 
    require_once '../core/dbConfig.php'; 
    require_once '../core/models.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPU Shop Business</title>
    <style>
        body {
            font-family: "Arial", sans-serif;
        }
        input, select {
            font-size: 1.2em;
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
        }
        table {
            width: 80%;
            margin-top: 50px;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h3>Reb's GPU Shop</h3>

    <!-- add gpus form -->
    <form action="../core/handleForms.php" method="POST">
        <p>
            <label for="brand">GPU Brand</label>
            <input type="text" name="brand" id="brand" required>
        </p>
        <p>
            <label for="model">GPU Model</label>
            <input type="text" name="model" id="model" required>
        </p>
        <p>
            <label for="price">Price</label>
            <input type="number" step="0.01" name="price" id="price" required>
        </p>
        <p>
            <label for="in_stock">In Stock</label>
            <select name="in_stock" id="in_stock" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </p>
        <p>
            <input type="submit" name="insertNewGPUBtn" value="Add GPU">
        </p>
    </form>

    <!-- gpu table -->
    <table>
        <thead>
            <tr>
                <th>GPU ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Price</th>
                <th>In Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $gpuRecords = seeGPURecords($pdo); 
            foreach ($gpuRecords as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['gpuID']); ?></td>
                    <td><?php echo htmlspecialchars($row['brand']); ?></td>
                    <td><?php echo htmlspecialchars($row['model']); ?></td>
                    <td><?php echo htmlspecialchars(number_format((float)$row['price'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['in_stock'] ? 'Yes' : 'No'); ?></td>
                    <td>
                        <a href="update.php?gpuID=<?php echo htmlspecialchars($row['gpuID']); ?>">Edit</a>
                        <a href="delete.php?gpuID=<?php echo htmlspecialchars($row['gpuID']); ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- sales form -->
    <h3>Record a Sale</h3>
    <form action="../core/handleForms.php" method="POST">
        <p>
            <label for="gpuID">GPU ID</label>
            <input type="number" name="gpuID" id="gpuID" required>
        </p>
        <p>
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" required>
        </p>
        <p>
            <label for="total_price">Total Price</label>
            <input type="number" step="0.01" name="total_price" id="total_price" required>
        </p>
        <p>
            <input type="submit" name="insertNewSaleBtn" value="Record Sale">
        </p>
    </form>

    <!-- sales table -->
    <h3>Sales</h3>
    <table>
        <thead>
            <tr>
                <th>Sale ID</th>
                <th>GPU ID</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $salesRecords = seeSalesRecords($pdo); 
            foreach ($salesRecords as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['saleID']); ?></td>
                    <td><?php echo htmlspecialchars($row['gpuID']); ?></td>
                    <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                    <td><?php echo htmlspecialchars(number_format((float)$row['total_price'], 2)); ?></td>
                    <td>
                        <a href="delete.php?saleID=<?php echo htmlspecialchars($row['saleID']); ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
