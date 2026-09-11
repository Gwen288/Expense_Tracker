<?php

require "db.php";

$id = intval($_GET["id"] ?? 0);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $category = trim($_POST["category"]);
    $amount = trim($_POST["amount"]);
    $expense_date = $_POST["expense_date"];
    $post_id = intval($_POST["id"]);

    $stmt = $conn->prepare(
        "UPDATE expenses SET category=?, amount=?, expense_date=? WHERE id=?"
    );

    $stmt->bind_param("sdsi", $category, $amount, $expense_date, $post_id);

    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM expenses WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$expense = $stmt->get_result()->fetch_assoc();

$stmt->close();

if (!$expense) {
    die("Expense not found.");
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Expense</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-container">

    <h2>Edit Expense</h2>

    <form method="POST" action="edit.php">

        <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">

        <div class="form-group">
            <label>Category</label>

            <select name="category" required>
                <option value="Food" <?php echo $expense['category'] === 'Food' ? 'selected' : ''; ?>>
                    Food
                </option>

                <option value="Transport" <?php echo $expense['category'] === 'Transport' ? 'selected' : ''; ?>>
                    Transport
                </option>

                <option value="School" <?php echo $expense['category'] === 'School' ? 'selected' : ''; ?>>
                    School
                </option>

                <option value="Entertainment" <?php echo $expense['category'] === 'Entertainment' ? 'selected' : ''; ?>>
                    Entertainment
                </option>

                <option value="Other" <?php echo $expense['category'] === 'Other' ? 'selected' : ''; ?>>
                    Other
                </option>
            </select>
        </div>

        <div class="form-group">
            <label>Amount</label>

            <input type="number"
                   name="amount"
                   step="0.01"
                   value="<?php echo htmlspecialchars($expense['amount']); ?>"
                   required>
        </div>

        <div class="form-group">
            <label>Expense Date</label>

            <input type="date"
                   name="expense_date"
                   value="<?php echo htmlspecialchars($expense['expense_date']); ?>"
                   required>
        </div>

        <div class="form-buttons">

            <button type="submit" class="btn">
                Update Expense
            </button>

            <a href="index.php" class="back-link">
                Back
            </a>

        </div>

    </form>

</div>

</body>
</html>