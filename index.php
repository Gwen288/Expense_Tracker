<?php

require "db.php";

$result = $conn->query("SELECT * FROM expenses ORDER BY expense_date DESC");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Expense Tracker</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <div class="header">
        <div>
            <h1>Expense Tracker</h1>
            <p style="color: #777;">
                Keep track of your everyday expenses.
            </p>
        </div>

        <a href="create.php" class="btn">
            + Add Expense
        </a>
    </div>

    <div class="expenses-container">

        <?php if ($result->num_rows > 0): ?>

            <?php while ($row = $result->fetch_assoc()): ?>

                <div class="expense-card">

                    <div class="expense-info">

                        <h3>
                            <?php echo htmlspecialchars($row['category']); ?>
                        </h3>

                        <p class="amount">
                            GH₵ <?php echo htmlspecialchars($row['amount']); ?>
                        </p>

                        <span class="date">
                            <?php echo htmlspecialchars($row['expense_date']); ?>
                        </span>

                    </div>

                    <div class="expense-actions">

                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                           class="edit-btn">
                            Edit
                        </a>

                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                           class="delete-btn"
                           onclick="return confirm('Delete this expense?');">
                            Delete
                        </a>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="empty-message">
                <h3>No expenses yet</h3>
                <p>Add your first expense to start tracking.</p>
            </div>

        <?php endif; ?>

    </div>

</div>

</body>
</html>