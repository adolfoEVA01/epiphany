<?php
require_once "session.php";
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
require_once 'head.php';
$comic_id=$_GET['id'];
$layout_context = "user";
$find_comics_by_id = find_comics_by_id($comic_id);
$title = $find_comics_by_id['Book'];
$author_1 = $find_comics_by_id['comic_author'];
$author_2 = $find_comics_by_id['comic_author2'];
$pub_logo = find_comic_publisher_logo($find_comics_by_id['Publisher']);

?>
<title>Epiphany Productions &mdash;<?php echo $title; ?></title>
</head>
<body>
<?php
include_once 'library/navigation-comics.php';
?>
  <h1><?php echo $title; ?></h1>
  <p class="types">By: <?php echo $find_comics_by_id['comic_author']; if ($find_comics_by_id['comic_author2'] != NULL) { ?> and <?php echo $find_comics_by_id['comic_author2']; }?></p>
<?php
$purchased_comic = 'Purchased';
$missing_comic = 'Missing';
$count = find_comic_status($comic_id, $purchased_comic);
$missed = find_comic_status($comic_id, $missing_comic);
$missed .= "<br />";
?>
  <div class="main-body">
    <div class="left_column">
      <p class="types"><?php echo $pub_logo; ?></p>
      <p class="edit_desc"><?php echo $find_comics_by_id['Description']; ?></p>

      <p class="additional-img">Other comics by <?php echo $author_1; ?> <br />
<?php
$author_result = find_comics_by_author($author_1);
while ($result = mysqli_fetch_assoc($author_result)) {
  $image = '<img src="/images/covers/'. $result['cover_image'] . '" alt="' . $result['book_name'] . '" style="padding: 5px">';
  $info .= '        <a href = "comic_info.php?id=' . $result['id'] . '">' . $image . ' </a>' . "\xA";
}
echo $info;
?>
      </p>
<?php       
if ($author_2 == NULL) {
  echo '<p class="additional-img"></p>';
}
else if ($author_2 != NULL) {
  $info = '<p class="additional-img">Other comics by ' . $author_2 . '<br />';
  $author_result = find_comics_by_author($author_2);
  while ($result = mysqli_fetch_assoc($author_result)) {
    $image = '<img src="/images/covers/'. $result['cover_image'] . '" alt="' . $result['book_name'] . '" style="padding: 5px">';
    $info .= '        <a href = "comic_info.php?id=' . $result['id'] . '">' . $image . ' </a>' . "\xA";
  }
  echo $info;
}
?>
    </p>
  </div>
  <div class="right_column">
    <p class="info_cover"><img src="/images/covers/<?php echo $find_comics_by_id['cover_image']; ?>" alt="<?php echo $title; ?>"></p>
    <h3 class="info_cover"><a href="comic_edit.php?id=<?php echo $comic_id; ?>">Edit <?php echo $title; ?></a></h3>
<?php
$FirstDay = date("Y-m-d", strtotime('sunday last week'));  
$LastDay = date("Y-m-d", strtotime('sunday this week'));  
$FirstDay2 = date("Y-m-d", strtotime('sunday this week'));  
$LastDay2 = date("Y-m-d", strtotime('sunday next week'));  

if ($find_comics_by_id['date1'] > $FirstDay && $find_comics_by_id['date1'] < $LastDay) {
  echo '      <p class="next_issue">Next issue will be available ' . $find_comics_by_id['date1'] . "\xA";
  if ($find_comics_by_id['date2'] != null) {
    echo'.  The following issue will come on: ' . $find_comics_by_id['date2'] . '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($find_comics_by_id['date1'] > $FirstDay2 && $find_comics_by_id['date1'] < $LastDay2) {
  $newDate = date("M d, Y", strtotime($find_comics_by_id['date1']));
  echo '      <p class="next_issue">Next issue available next week on ' . $newDate . "\xA";
  if ($find_comics_by_id['date2'] != null) {
    $newDate = date("M d, Y", strtotime($find_comics_by_id['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($find_comics_by_id['date1'] != null && $find_comics_by_id['date1'] < $FirstDay) {
  $newDate = date("M d, Y", strtotime($find_comics_by_id['date1']));
  echo '      <p class="next_issue">Last issue become available ' . $newDate . "\xA";
  if ($find_comics_by_id['date2'] != null) {
    $newDate = date("M d, Y", strtotime($find_comics_by_id['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($find_comics_by_id['date1'] != null && $find_comics_by_id['date1'] > $LastDay2) {
  $newDate = date("M d, Y", strtotime($find_comics_by_id['date1']));
  echo '      <p class="next_issue">Next issue will available on ' . $newDate . "\xA";
  if ($find_comics_by_id['date2'] != null) {
    $newDate = date("M d, Y", strtotime($find_comics_by_id['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else {
  echo '      <p class="next_issue">No current dates available</p>' . "\xA";
}  
?>
  </div>
</div>
<?php require("library/footer.php"); ?>