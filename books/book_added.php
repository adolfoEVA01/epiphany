<?php
require("library/head.php");
include 'library/book_info.php';
echo '<title>This is Epiphany Books - ' . $book_name . '</title>' . "\xA";

echo '</head>' . "\xA";
echo '<body>' . "\xA";
include_once 'library/navigation-books.php';
if(isset($_POST['insert_book'])) {

$insert_isbn_10 = mysqli_real_escape_string($conn_books, $_POST['book_isbn_10']);
$insert_isbn_13 = mysqli_real_escape_string($conn_books, $_POST['book_isbn_13']);
$insert_title = mysqli_real_escape_string($conn_books, $_POST['book_title']);
$insert_author = mysqli_real_escape_string($conn_books, $_POST['book_author']);
$insert_description = mysqli_real_escape_string($conn_books, $_POST['book_description']);
$insert_url = 'https://books.google.com/books?id=' . $book_id;
include_once 'library/book_insert.php';

include 'library/book_info.php';
echo '  <h2>' . $book_name . '</h2>' . "\xA";
echo '  <h4>' . $book_author . '</h2>' . "\xA";
echo '  <div class="main-body">' . "\xA";
echo '    <div class="left_side">' . "\xA";
echo '      <p align="center"><img src="' . $book_image . '" alt="' . $book_name . '"></p>' . "\xA";
echo '  </div>' . "\xA";
echo '  <div class="right_side">' . "\xA";
echo '  <p>' . $book_desc . '</p>' . "\xA";
echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";
echo '    <h3>Books in Epiphany by ' . $book_author . '</h3>' . "\xA";
echo '    <p>' . $more_info . '</p>' . "\xA";
echo '  </div>' . "\xA";
echo '  <h3><a href="JavaScript:window.close()">Close</a></h3>' . "\xA";
echo '</div>' . "\xA";
}
else {
echo '  <div class="main-body">' . "\xA";
echo '  <h2>no book was added, please try again</h2>' . "\xA";
echo '  <h4>if problem persists please contact <a href="mailto:support@epiphanyproductions.net">our support team</a></h4>' . "\xA";
echo '  </div>' . "\xA";
}
require("library/footer.php");
?>