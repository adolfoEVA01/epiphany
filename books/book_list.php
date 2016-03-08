<?php
require "db_books.php";
include 'library/book_query.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <meta charset="utf-8" />
  <?php
    require 'comic_stylesheets.php';
    require 'comic_scripts.php';
  ?>
  <title>Epiphany Productions &ndash; Book Collection</title>
</head>

<body>
<?php
    $book_alpha = $_GET['id'];
?>
<div class="main-nav">
<?php include_once 'library/navigation-books.php'; ?>
</div>
<?php include 'library/book_codes.php'; ?>

<div class="main-body">
<?php
// Links per page
echo '<p align="center" style="margin-top:25px;">' . "\xA";
echo '<a href="book_list.php">#  </a>' . "\xA";
foreach (range('A', 'Z') as $char) {
  echo '<a href="?id=' . $char . '" class="myclass">  ' . $char . '</a>' . "\n";
}
echo '</p>' . "\xA";  

if ($book_alpha == '') {
  while ($book_list = mysqli_fetch_assoc($result)) {
    $book_title = $book_list['Book_Title'];
    $book_author = $book_list['Book_Author'];
    $book_desc = htmlspecialchars_decode($book_list['Description']);
    $word_count = strlen($book_desc);
    $book_image = 'https://books.google.com/books/content?id=' . $book_list['Google_ID'] . '&amp;printsec=frontcover&amp;img=1&amp;zoom=1&amp;source=gbs_api';
    if (is_numeric(substr($book_title, 0, 1))) {
          if ($word_count == 0) {
    echo '  <div class="no_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_list['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_list['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                <p>No description available</p>'. "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '      <div style="height:300px;">'. "\xA";
    echo '        <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_list['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '        <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '        <p>No description available' . $book_desc . '</p>'. "\xA";
    echo '      </div>'. "\xA";
    echo '  </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";    
    }
    else if ($word_count < 1000) {
    echo '  <div class="hundred_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_list['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_list['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                ' . $book_desc . "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="thousand_words">'. "\xA";
    echo '      <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_list['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '      <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '      <p>' . $book_desc . '</p>'. "\xA";
    echo '    </div>'. "\xA";
    echo '  </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";    
    }
    else {
    echo '  <div class="hundred_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_list['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_list['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                ' . $book_desc . "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="thousand_words">'. "\xA";
    echo '        <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_list['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '        <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '                ' . $book_desc . "\xA";
    echo '      </div>'. "\xA";
    echo '  </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";    
    }
    }
  }
}

else {
  include 'library/book_sort.php';
  //echo '      <div class="book_show">' . "\xA";
  while ($book_sorted = mysqli_fetch_assoc($book_sort)) {
    $book_title = $book_sorted['Book_Title'];
    $book_author = $book_sorted['Book_Author'];
    $book_desc = htmlspecialchars_decode($book_sorted['Description']);
    $word_count = strlen($book_desc);
    $book_image = 'https://books.google.com/books/content?id=' . $book_sorted['Google_ID'] . '&amp;printsec=frontcover&amp;img=1&amp;zoom=1&amp;source=gbs_api';
    if ($word_count == 0) {
    echo '  <div class="no_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_sorted['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_sorted['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                <p>No description available</p>'. "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="thousand_words">'. "\xA";
    echo '        <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_sorted['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '        <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '        <p>No description available' . $book_desc . '</p>'. "\xA";
    echo '      </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";    
    }
    else if ($word_count < 1000) {
    echo '  <div class="hundred_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_sorted['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_sorted['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                ' . $book_desc . "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="thousand_words">'. "\xA";
    echo '      <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_sorted['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '      <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '                ' . $book_desc . "\xA";
    echo '    </div>'. "\xA";
    echo '  </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";    
    }
    else {
    echo '  <div class="hundred_words">'. "\xA";
    echo '    <div class="thousand_words-img">'. "\xA";
    echo '                <a href="#' . $book_sorted['Google_ID'] . '"><img src="' . $book_image . '"></a>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="modal-window">'. "\xA";
    echo '        <div class="modalDialog" id="' . $book_sorted['Google_ID'] . '">'. "\xA";
    echo '            <div>'. "\xA";
    echo '                <a class="close" href="#close" title="Close">X</a>'. "\xA";
    echo '                ' . $book_desc . "\xA";
    echo '            </div>'. "\xA";
    echo '        </div>'. "\xA";
    echo '    </div>'. "\xA";
    echo '    <div class="thousand_words">'. "\xA";
    echo '        <p class="book_show_title"><a href = "/books/book_info.php?id=' . $book_sorted['Google_ID'] . '&amp;alpha=' . $book_alpha . '">' . $book_title . '</a></p>'. "\xA";
    echo '        <p>AUTHOR: ' . $book_author . '</p>'. "\xA";    
    echo '        ' . $book_desc . "\xA";
    echo '    </div>'. "\xA";
    echo '  </div>'. "\xA";
    echo '  <p class="glyph-images"><img src="../images/cellulose.png" alt="-------------" height="10" width="500"></p>'. "\xA";  
    }
  }
  echo '  </div>'. "\xA";
}
?>
<?php require("library/footer.php"); ?>