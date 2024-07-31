<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tests</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js"></script>
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
    <h1>Tests</h1>
    <form method="get" action="tests.php">
        <label for="book">Select Book:</label><br>
        <select id="book" name="book_id" onchange="this.form.submit()">
            <option value="">Select a book</option>
            <?php
            $book_sql = "SELECT * FROM books";
            $book_result = $conn->query($book_sql);
            while ($book_row = $book_result->fetch_assoc()) {
                echo "<option value='" . $book_row['id'] . "'>" . $book_row['title'] . "</option>";
            }
            ?>
        </select><br><br>
    </form>
    <?php
    if (isset($_GET['book_id'])) {
        $book_id = $_GET['book_id'];
        $test_sql = "SELECT * FROM tests WHERE book_id = $book_id";
        $test_result = $conn->query($test_sql);
        while ($test_row = $test_result->fetch_assoc()) {
            echo "<div class='test-question'>";
            echo "<p>" . $test_row['question'] . "</p>";
            for ($i = 1; $i <= 4; $i++) {
                echo "<button onclick='checkAnswer(this, " . $test_row['answer'] . ")'>" . $test_row['option' . $i] . "</button><br>";
            }
            echo "</div>";
        }
    }
    $conn->close();
    ?>
</div>
</body>
</html>

<script>
    function checkAnswer(button, correctAnswer) {
        var buttons = button.parentNode.getElementsByTagName('button');
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].disabled = true;
            if (i + 1 == correctAnswer) {
                buttons[i].style.backgroundColor = 'green';
            } else {
                buttons[i].style.backgroundColor = 'red';
            }
        }
        if (button.innerText != buttons[correctAnswer - 1].innerText) {
            button.style.backgroundColor = 'red';
        }
    }
</script>
