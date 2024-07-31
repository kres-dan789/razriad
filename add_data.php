<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Data</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>
<div class="container">
    <h1>Add Data</h1>

    <!-- Форма добавления теории -->
    <h2>Add Theory</h2>
    <form method="post" action="add_data.php">
        <label for="book">Book:</label><br>
        <select id="book" name="book_id" required>
            <?php
            $book_sql = "SELECT * FROM books";
            $book_result = $conn->query($book_sql);
            while ($book_row = $book_result->fetch_assoc()) {
                echo "<option value='" . $book_row['id'] . "'>" . $book_row['title'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">Content:</label><br>
        <textarea id="content" name="content" rows="10" cols="50" required></textarea><br><br>

        <label for="page_number">Page Number:</label><br>
        <input type="number" id="page_number" name="page_number" required><br><br>

        <label for="chapter_number">Chapter Number (optional):</label><br>
        <input type="text" id="chapter_number" name="chapter_number"><br><br>

        <input type="submit" name="add_theory" value="Add Theory">
    </form>

    <hr>

    <!-- Форма добавления тестов -->
    <h2>Add Test</h2>
    <form method="post" action="add_data.php">
        <label for="book_test">Book:</label><br>
        <select id="book_test" name="book_id" required>
            <?php
            $book_sql = "SELECT * FROM books";
            $book_result = $conn->query($book_sql);
            while ($book_row = $book_result->fetch_assoc()) {
                echo "<option value='" . $book_row['id'] . "'>" . $book_row['title'] . "</option>";
            }
            ?>
        </select><br><br>

        <label for="question">Question:</label><br>
        <input type="text" id="question" name="question" required><br><br>

        <label for="option1">Option 1:</label><br>
        <input type="text" id="option1" name="option1" required><br><br>

        <label for="option2">Option 2:</label><br>
        <input type="text" id="option2" name="option2" required><br><br>

        <label for="option3">Option 3:</label><br>
        <input type="text" id="option3" name="option3" required><br><br>

        <label for="option4">Option 4:</label><br>
        <input type="text" id="option4" name="option4" required><br><br>

        <label for="answer">Correct Answer (1-4):</label><br>
        <input type="number" id="answer" name="answer" min="1" max="4" required><br><br>

        <input type="submit" name="add_test" value="Add Test">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Обработка добавления теории
        if (isset($_POST['add_theory'])) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $page_number = $_POST['page_number'];
            $book_id = $_POST['book_id'];
            $chapter_number = $_POST['chapter_number']; // Получаем значение номера главы

            // Подготавливаем SQL запрос для вставки теории
            if ($chapter_number !== '') {
                $theory_sql = "INSERT INTO theory (title, content, page_number, chapter_number, book_id) 
                                   VALUES ('$title', '$content', '$page_number', '$chapter_number', $book_id)";
            } else {
                $theory_sql = "INSERT INTO theory (title, content, page_number, book_id) 
                                   VALUES ('$title', '$content', '$page_number', $book_id)";
            }

            if ($conn->query($theory_sql) === TRUE) {
                echo "<p>Theory added successfully!</p>";
            } else {
                echo "<p>Error: " . $theory_sql . "<br>" . $conn->error . "</p>";
            }
        }

        // Обработка добавления тестов
        if (isset($_POST['add_test'])) {
            $question = $_POST['question'];
            $option1 = $_POST['option1'];
            $option2 = $_POST['option2'];
            $option3 = $_POST['option3'];
            $option4 = $_POST['option4'];
            $answer = $_POST['answer'];
            $book_id = $_POST['book_id'];

            $test_sql = "INSERT INTO tests (question, option1, option2, option3, option4, answer, book_id) 
                             VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$answer', $book_id)";

            if ($conn->query($test_sql) === TRUE) {
                echo "<p>Test added successfully!</p>";
            } else {
                echo "<p>Error: " . $test_sql . "<br>" . $conn->error . "</p>";
            }
        }
    }

    $conn->close();
    ?>
</div>
</body>
</html>
