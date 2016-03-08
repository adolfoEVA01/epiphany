<?php
require("library/head.php");
echo '<title>Epiphany Productions&mdash;BOOKS</title>' . "\xA";
echo '</head>' . "\xA";
echo '<body>' . "\xA";
echo '<div class="main-nav">' . "\xA";

include_once 'library/navigation-books.php';

echo '</div>' . "\xA";

include 'library/book_codes.php';

echo '<div class="main-body">' . "\xA";
echo '  <div class="description">' . "\xA";
echo '    <h3>Latest Read Book</h3>' . "\xA";

$latest_book_id = 'MQeHAAAAQBAJ';
$latest_page = file_get_contents("https://www.googleapis.com/books/v1/volumes/$latest_book_id?key=$apiKey");
$latest_json = json_decode($latest_page, true);
$latest_title = $latest_json['volumeInfo']['title'];
$latest_desc = $latest_json['volumeInfo']['description'];
$latest_image = htmlspecialchars($latest_json['volumeInfo']['imageLinks']['large']);
$latest_link = htmlspecialchars($latest_json['volumeInfo']['canonicalVolumeLink']);

echo '    <div id="latest">' . "\xA";
echo '      <h4>' . $latest_title . '</h4>' . "\xA";
echo '      <div class="latest_read"><a href = "' . $latest_link . '" target="_blank"><img src="' . $latest_image . '" alt="' . $latest_title . '" ></a></div>' . "\xA";
echo '      <div>' . $latest_desc . '</div>' . "\xA";
echo '    </div>' . "\xA";
echo '    <h4><a href="book_list.php">Browse our whole collection</a></h4>' . "\xA";
echo '    <h3>Search Books</h3>' . "\xA";
echo '    <div class="book_search_form">' . "\xA";
echo '      <form  method="post" action="book_search.php"  id="searchform">' . "\xA";
echo '        <input type="text" name="search_query">' . "\xA";
echo '        <select name="search_category">' . "\xA";
echo '          <option value="Book_Author">Author</option>' . "\xA";
echo '          <option value="Book_Title">Title</option>' . "\xA";
echo '        </select>' . "\xA";
echo '        <input type="submit" name="submit" value="Search">' . "\xA";
echo '      </form>' . "\xA";
echo '    </div>' . "\xA";
echo '  </div> <!-- End of description -->' . "\xA";

include 'library/featured_book_query.php';

echo '  <div class="right-side">' . "\xA";
echo '    <div class="slides-container">' . "\xA";
echo '      <h4>Featured Books</h4>' . "\xA";
echo '      <div id="slides">' . "\xA";

while ($featured_book = mysqli_fetch_row($featured_result)) {
  $book_id = $featured_book[1];
  $image = 'https://books.google.com/books/content?id=' . $book_id . '&amp;printsec=frontcover&amp;img=1&amp;zoom=0&amp;source=gbs_api&amp;key='.$apiKey;
  echo '        <a href="/books/book_info.php?id=' . $book_id . '"><img src="' . $image . '" alt="Featured #' . $i . '" class="image_thumb"></a>' . "\xA";
}

mysqli_free_result($featured_result);

echo '      </div>  <!-- End of slides -->' . "\xA";
echo '    </div>  <!-- End of slides-container -->' . "\xA";
echo '  </div>  <!-- End of right_side-->' . "\xA";
echo '</div>  <!-- End of main body -->' . "\xA";

require("library/footer.php"); 
?>