<!DOCTYPE html>
 <head>  <title>Enter bookid to display data - creating a simple web application</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <style>
li {list-style: none;}
</style>
</head>
<body>
<h2>Enter bookid and enter</h2>
<ul>
<form name="display" action="enter-bookid.php" method="POST" >
<li>Book ID:</li><li><input type="text" name="bookid" /></li>
<li><input type="submit" name="submit" /></li>
</form>
</ul>
</body>
</html>
<?php
$db = pg_connect("host=postgres port=5432 dbname=postgres user=postgres password=example");

if (isset($_POST['submit']))
{
$result = pg_query($db, "SELECT * FROM book where book_id = '$_POST[bookid]'");
$row = pg_fetch_assoc($result);
echo "<ul>
<form name='update' action='enter-bookid.php' method='POST' >
<li>Book ID:</li><li><input type='text' name='bookid_updated' value='$row[book_id]'  /></li>
<li>Book Name:</li><li><input type='text' name='book_name_updated' value='$row[book_name]' /></li><li>Author:</li><li><input type='text' name='author_updated' value='$row[author]' /></li> <li>Publisher:</li><li><input type='text' name='publisher_updated' value='$row[publisher]' /></li>  <li>Date of publication:</li><li><input type='text' name='dop_updated' value='$row[date_of_publication]' /></li>
<li>Price (USD):</li><li><input type='text' name='price_updated' value='$row[price]' /></li>
<li><input type='submit' name='new' /></li>  </form>
</ul>";
}
if (isset($_POST['new']))
{
$result1 = pg_query($db, "UPDATE book SET book_id = '$_POST[bookid_updated]', book_name = '$_POST[book_name_updated]', 
author = '$_POST[author_updated]', publisher = '$_POST[publisher_updated]',date_of_publication = '$_POST[dop_updated]',
price = '$_POST[price_updated]'");
if (!$result1)
{
echo "Update failed!!";
} else
{
echo "Update successfull;";
}
}
?>