<!DOCTYPE html>
<html>
<head>
    <title>Insert data to PostgreSQL with PHP - Creating a Simple Web Application</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        li {list-style: none;}
    </style>
</head>
<body>
    <h2>Enter information regarding book</h2>
    <ul>
        <form name="insert" action="index.php" method="POST" >
            <li>Book ID:</li><li><input type="text" name="bookid" /></li>
            <li>Book Name:</li><li><input type="text" name="book_name" /></li>
            <li>Author:</li><li><input type="text" name="author" /></li>
            <li>Publisher:</li><li><input type="text" name="publisher" /></li>
            <li>Date of publication:</li><li><input type="text" name="dop" /></li>
            <li>Price (USD):</li><li><input type="text" name="price" /></li>
            <li><input type="submit" /></li>
        </form>
    </ul>
</body>
</html>

<?php
$host = "postgres";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "example";

$connectionString = "host=$host port=$port dbname=$dbname user=$user password=$password";

// Attempt to connect to the PostgreSQL database
$db = pg_connect($connectionString);

if (!$db) {
    die("Error: Unable to connect to the database");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bookid = $_POST['bookid'];
    $book_name = $_POST['book_name'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $dop = $_POST['dop'];
    $price = $_POST['price'];

    // Use a prepared statement to prevent SQL injection
    $query = "INSERT INTO book (book_id, book_name, author, publisher, date_of_publication, price) VALUES ($1, $2, $3, $4, $5, $6)";
    
    $result = pg_query_params($db, $query, array($bookid, $book_name, $author, $publisher, $dop, $price));

    if ($result) {
        echo "Book information submitted successfully!";
    } else {
        echo "Error submitting book information.";
    }
}
?>
