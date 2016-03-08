<?php require 'head.php'; ?>
<title>This is Epiphany Productions</title>
</head>
<body>
<?php
include_once 'library/navigation.php';
?>
<div class="main-body">
  <div class="top_description">
    <h2>This is Epiphany Productions</h2>
    <p>Welcome to Epiphany Productions! This website is a collaboration between Gustavo Cardona, web developer, comic book aficionado, and all-around science and tech enthusiast- and Soo Choi, a lover of books, media, and organization.</p>
    <p>This website allowed for a place for Gus to practice his web development skills in an environment where it is okay to change and experiment freely and for Soo to indulge in her type-A need to catalog her library of books and comics.</p>
    <p>Please feel free to look around, provide suggestions and feedback or get in <a href="mailto:gcardonav@gmail.com?Subject=Remarks%20on%20Epiphany%20Productions" target="_top">touch</a> with us! This website will continue to be a work in progress and we look forward to adding additional features soon.</p>
    <p>Enjoy your journey around the Epiphany universe</p>
    <p class="glyph-images"><img src="/images/cellulose.png" alt="-------------"></p>
  </div> <!-- End of top_description -->
  <div class="description">
    <h3>Epiphany&#8217;s Featured Books</h3>
<?php
$find_featured_books = find_featured_books();
while ($featured_book = mysqli_fetch_assoc($find_featured_books)) {
  $image = 'https://books.google.com/books/content?id=' . $featured_book['book_id'] . '&amp;printsec=frontcover&amp;img=1&amp;zoom=5&amp;source=gbs_api&amp;key=' . $apiKey;
?>
      <div class="sample_list"><div>
        <a href ="/books/book_info.php?id=<?php echo $featured_book['book_id']; ?>"><img src="<?php echo $image; ?>" alt="#<?php echo $featured_book['id']; ?>"></a>
      </div></div>
<?php
}
mysqli_free_result($find_featured_books);
?>
    </div> <!-- End of description -->
    <div class="right-side">
        <h3>Our Latest Comics</h3>
<?php
$find_latest_comics = find_latest_comics();
while ($comics_list = mysqli_fetch_assoc($find_latest_comics)) {
?>
          <div class="sample_list"><div><a href="comics/comic_info.php?id=<?php echo $comics_list['id']; ?>"><img src="/images/covers/<?php echo $comics_list['cover_image']; ?>" alt="<?php echo $comics_list['Book']; ?>"></a></div></div>
<?php
}
mysqli_free_result($find_latest_comics);
?>
      </div>  <!-- End of right side -->
      <p class="glyph-images"><img src="/images/cellulose.png" alt="-------------"></p>
      <div class="bottom_description">
        <h3>latest book added to our library</h3>
<?php
$find_latest_book_added = find_latest_book_added();
$latest_book = mysqli_fetch_assoc($find_latest_book_added);
$latest_book_image = 'https://books.google.com/books/content?id=' . $latest_book['Google_ID'] . '&amp;printsec=frontcover&amp;img=1&amp;zoom=5&amp;source=gbs_api&amp;key=' . $apiKey;
?>
        <h4><?php echo $latest_book['Book_Title']; ?></h4>
        <div class="bottom_description_image"><a href="/books/book_info.php?id=<?php echo $latest_book['Google_ID']; ?>"><img src="<?php echo $latest_book_image; ?>" alt="<php echo $latest_book['Book_Title']; ?>"></a></div>
        <div class="bottom_description_description"><?php echo $latest_book['Description']; ?></div>
<?php mysqli_free_result($find_latest_book_added); ?>
      </div>  <!-- End of Bottom Description -->
    </div>  <!-- End of main-body -->
<? require("library/footer.php"); ?>