<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';


// insert gpu
if (isset($_POST['insertNewGPUBtn'])) {
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $in_stock = trim($_POST['in_stock']);

    if (!empty($brand) && !empty($model) && !empty($price) && isset($in_stock)) {
        $query = insertIntoGPURecords($pdo, $brand, $model, $price, $in_stock);

        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Failed to insert GPU record.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}

// edit gpu
if (isset($_POST['editGPUBtn'])) {
    $gpuID = $_GET['gpuID'];
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $price = trim($_POST['price']);
    $in_stock = trim($_POST['in_stock']);

    if (!empty($gpuID) && !empty($brand) && !empty($model) && !empty($price) && isset($in_stock)) {
        $query = updateGPU($pdo, $gpuID, $brand, $model, $price, $in_stock);

        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Failed to update GPU record.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}

// delete gpu
if (isset($_POST['deleteGPUBtn'])) {
    $gpuID = $_GET['gpuID'];
    if (!empty($gpuID)) {
        $query = deleteGPU($pdo, $gpuID);

        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Failed to delete GPU.";
        }
    } else {
        echo "Invalid GPU ID.";
    }
}

// insert sale
if (isset($_POST['insertNewSaleBtn'])) {
    $gpuID = trim($_POST['gpuID']);
    $quantity = trim($_POST['quantity']);
    $total_price = trim($_POST['total_price']);

    if (!empty($gpuID) && !empty($quantity) && !empty($total_price)) {
        $query = insertIntoSalesRecords($pdo, $gpuID, $quantity, $total_price);

        if ($query) {
            header("Location: ../sql/index.php");
            exit;
        } else {
            echo "Failed to record the sale.";
        }
    } else {
        echo "All fields are required. Please fill in all fields.";
    }
}


