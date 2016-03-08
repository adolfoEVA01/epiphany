<?php
require("library/head.php");
include 'library/book_query.php';
include_once 'library/book_info.php';
echo '<title>Epiphany Productions&mdash;' . $book_name . '</title>' . "\xA";
echo '</head>' . "\xA";
echo '<body>' . "\xA";

include_once 'library/navigation-books.php';

echo '  <h2>' . $book_name . '</h2>' . "\xA";
echo '  <h4>' . $book_author . '</h4>' . "\xA";
echo '  <p class="glyph-hr"><img src="/images/cellulose.png" alt="-------------"></p>' . "\xA";
echo '  <div class="main-body">' . "\xA";
echo '    <div class="left_side">' . "\xA";
echo '      <p align="center"><img src="' . $book_image . '" alt="' . $book_name . '"></p>' . "\xA";
echo '    </div>' . "\xA";
echo '    <div class="right_side">' . "\xA";
echo '      <p>' . $book_desc . '</p>' . "\xA";
echo '      <h3>Books in Epiphany by ' . $book_author . '</h3>' . "\xA";
echo '      <p>' .$more_info . '</p>' . "\xA";
echo '    </div>' . "\xA";

$alpha = $_GET['alpha'];

echo '  </div>' . "\xA";
echo '    <h3><a href="book_list.php?id=' . $alpha . '">browse our whole collection</a></h3>' . "\xA";
echo '  <p class="glyph-hr"><img src="/images/cellulose.png" alt="-------------"></p>' . "\xA";
?>
<?php require("library/footer.php"); ?>