<?php
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Theory</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php include('header.php'); ?>

<div class="container">
    <h1>Theoretical Material</h1>

    <!-- Форма для выбора книги -->
    <form method="get" action="theory.php">
        <label for="book">Select Book:</label>
        <select id="book" name="book_id">
            <option value="">-- All Books --</option>
            <?php
            // Получение списка книг из базы данных
            $book_sql = "SELECT * FROM books";
            $book_result = $conn->query($book_sql);
            while ($book_row = $book_result->fetch_assoc()) {
                $selected = (isset($_GET['book_id']) && $_GET['book_id'] == $book_row['id']) ? 'selected' : '';
                echo "<option value='" . $book_row['id'] . "' $selected>" . $book_row['title'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Filter">
    </form>

    <hr>

    <!-- Вывод теоретического материала -->
    <?php
    // Получение выбранной книги
    $book_id = isset($_GET['book_id']) ? intval($_GET['book_id']) : '';

    // Формирование SQL запроса
    $sql = "SELECT * FROM theory";
    if ($book_id) {
        $sql .= " WHERE book_id = $book_id";
    }
    $sql .= " ORDER BY title";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='theory-item'>";
            echo "<div class='theory-header'>";
            if (!empty($row['chapter_number'])) {
                echo "<div class='chapter-number'>Chapter: " . htmlspecialchars($row['chapter_number']) . "</div>";
            }
            echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
            echo "</div>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<p><strong>Page:</strong> " . htmlspecialchars($row['page_number']) . "</p>";
            echo "<hr>";
            echo "</div>";
        }
    } else {
        echo "<p>No theoretical material found.</p>";
    }

    $conn->close();
    ?>
</div>
</body>
</html>
