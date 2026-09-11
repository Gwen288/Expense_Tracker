<?php

require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $category = trim($_POST["category"]);
    $amount = trim($_POST["amount"]);
    $expense_date = $_POST["expense_date"];

    $stmt = $conn->prepare(
        "INSERT INTO expenses(category, amount, expense_date) VALUES (?, ?, ?)"
    );

    $stmt->bind_param("sds", $category, $amount, $expense_date);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Expense</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-container">

    <h2>Add New Expense</h2>

    <p style="color: #777; margin-bottom: 25px;">
        Enter the details of your expense below.
    </p>

    <form method="POST" action="create.php">

        <div class="form-group">
            <label>Category</label>

            <select name="category" required>
                <option value="" disabled selected>Select a category</option>
                <option value="Food">Food</option>
                <option value="Transport">Transport</option>
                <option value="School">School</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label>Amount</label>

            <input type="number"
                   name="amount"
                   step="0.01"
                   min="0"
                   placeholder="e.g. 25.00"
                   required>
        </div>

        <div class="form-group">
            <label>Expense Date</label>

            <input type="date"
                   name="expense_date"
                   required>
        </div>

        <div class="form-buttons">

            <button type="submit" class="btn">
                Add Expense
            </button>

            <a href="index.php" class="back-link">
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>