<?php
require "db.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
$title = trim($_POST["title"]);
$description = trim($_POST["description"]);
$status = $_POST["status"];
$stmt = $conn->prepare("INSERT INTO expenses(category, amount,expense_date) VALUES (?, ?,?)");
$stmt->bind_param("sss", $category, $amount,$Expense_date);
$stmt->execute();
$stmt->close();
$conn->close();
header("Location: index.php");
exit;
}

?>
<!DOCTYPE html>
<html>
<head><title>Add Expense</title></head>
<body>
<h2>Add Expense</h2>
<form method="POST" action="create.php">

    <label>Category</label><br>
    <select name="category" required>
        <option value="Food">Food</option>
        <option value="Transport">Transport</option>
        <option value="School">School</option>
        <option value="Entertainment">Entertainment</option>
        <option value="Other">Other</option>
    </select><br>

    <label>Amount</label><br>
    <input type="number" name="amount" step="0.01" required><br>

    <label>Expense Date</label><br>
    <input type="date" name="expense_date" required><br>

    <button type="submit">Save Expense</button>

</form>
<a href="index.php">Back</a>
</body>
</html>


