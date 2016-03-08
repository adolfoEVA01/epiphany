<?php
require_once 'head.php';
?>
<title>Epiphany Productions&mdash;COMICS</title>
</head>
<body>
<div class="main-nav">
<?php
include_once 'library/navigation-comics.php';
?>
</div>  <!-- End of Main Nav-->
<div class="main-body">
<?php $mix_output = ""; ?>
  <div id="Container">
    <div id="tabs"> 
      <div class="comic-filter">
        <span class="filter" data-filter="all" id="all-comics-text">All Comics</span>
      </div>
<?php
$container_publishers = find_all_comic_publishers();
while ($publisher_list = mysqli_fetch_assoc($container_publishers)) {
  $publisher_name = str_replace('!', '', preg_replace('/\s+/', '', $publisher_list['Publisher']));
  if ($publisher_list['pub_logo'] == NULL) {
    continue;
  }
  else {
?>
      <div class="comic-filter">
        <span class="filter" data-filter=".<?php echo $publisher_name; ?>" id="<?php echo $publisher_name; ?>">
          <img src="/images/<?php echo $publisher_list['pub_logo']; ?>" alt="<?php echo $publisher_list['Publisher']; ?>">
        </span>
      </div>
<?php
  }
}
?>
    </div>  <!-- End of tabs -->   
    <div class="Collection">
      <h2>ongoing series</h2>
<?php
$find_all_comics = find_all_comics();
while ($comic_list = mysqli_fetch_assoc($find_all_comics)) {
  $comic_publish = str_replace('!', '', preg_replace('/\s+/', '', $comic_list['Publisher']));
  if ($comic_list['comic_status'] == NULL) {
    $fieldcount = mysqli_num_fields($find_all_comics);
    $count = '';
    include 'library/comic_information.php';
  }
  else if ($comic_list['comic_status'] != NULL) {
    $fieldcount = mysqli_num_fields($find_all_comics);
    $count = '';
    $missed = '';
    include 'library/comic_information_closed.php';
  }
  else {
    continue;
  }
}
?>
<?php echo $mix_output; ?>
    </div>  <!-- End of Collection -->
    <div class="Collection">
<h2>completed or cancelled series</h2>
<?php echo $mix_output2; ?>
    </div>  <!-- End of Collection -->
  </div>  <!-- End of Container-->
</div>  <!-- End of Main Body-->
<?php
//Release the data
mysqli_free_result($find_all_comics);
require("library/footer.php");
?>