<?php
require_once "session.php";
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
require_once 'head.php';
confirm_logged_in();
$comic_id = $_GET['id'];

$find_comics_by_id = find_comics_by_id($comic_id);
$title = $find_comics_by_id['Book'];
$publisher = $find_comics_by_id['Publisher'];
$author_1 = $find_comics_by_id['comic_author'];
$author_2 = $find_comics_by_id['comic_author2'];
$pub_logo = find_comic_publisher_logo($find_comics_by_id['Publisher']);
$publishers = find_all_comic_publishers();
?>
<title>Epiphany Productions &mdash;<?php echo $title; ?></title>
</head>
<body>
<?php
$layout_context = "admin";
include_once 'library/navigation-comics.php';
?>
  <h2>Edit Information for <?php echo $title; ?></h2>
<?php
$purchased_comic = 'Purchased';
$missing_comic = 'Missing';
$count = find_comic_status($comic_id, $purchased_comic);
$missed = find_comic_status($comic_id, $missing_comic);;
$missed .= "<br />";

$FirstDay = date("Y-m-d", strtotime('sunday last week'));  
$LastDay = date("Y-m-d", strtotime('sunday this week'));  
$FirstDay2 = date("Y-m-d", strtotime('sunday this week'));  
$LastDay2 = date("Y-m-d", strtotime('sunday next week'));
?>
  <div class="main-body">
    <div class="left_column">
      <p class="edit-img"><img src="/images/<?php echo $find_comics_by_id['Image']; ?>" alt="<?php echo $find_comics_by_id['Book']; ?>"></p>
      <p class="glyph-images"><img src="/images/cellulose.png" alt="-------------"></p>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?id=<?php echo $comic_id; ?>">
        <p><textarea name="comic_description"><?php echo $find_comics_by_id['Description']; ?></textarea></p>
        <p>Comic Name:  <input type="text" name="comic_title" value="<?php echo $title; ?>" />
        <p>Author(s):  
          <input type="text" name="comic_author1" value="<?php echo $author_1; ?>" /> &mdash; 
          <input type="text" name="comic_author2" value="<?php if ($author_2 != NULL) { echo $author_2; } else if ($author_2 == NULL) { echo NULL; } ?>" />
        </p>
        <p>Publisher for <?php echo $title; ?> : 
          <select name="comic_publisher" id="comic_publisher">
<?php
$info = '';
  $find_all_comic_publishers = find_all_comic_publishers();
  while ($selection = mysqli_fetch_assoc($find_all_comic_publishers)) {
  if ($selection['Publisher'] == $publisher) {
?>
                <option value="<?php echo $selection['Publisher']; ?>"selected="<?php echo $publisher; ?>"><?php echo $selection['Publisher']; ?></option>
<?php
  }
  else {
?>
                <option value="<?php echo $selection['Publisher']; ?>"><?php echo $selection['Publisher']; ?></option>
<?php } }?>
          </select>
        </p>
        <p class="edit-img"><input name="update_comic_info" type="submit" id="update_comic_info" value="Edit Information" /></p>
      </form>
        <p>Other comics by <?php echo $author_1; ?><ul> 
          <!-- <select name="publisher_to_add" id="publisher_to_add"> -->
<?php
$author_result = find_comics_by_author($author_1);
while ($result = mysqli_fetch_assoc($author_result)) { $info .= '<li><a href="comic_info.php?id=' . $result['id'] . '">' . $result['Book'] . '</a></li>' . "\xA"; }
echo $info;
?>
            </ul>
          <!-- </select> -->
        </p>
<?php       
if ($author_2 == NULL) { echo '<p class="additional-img"></p>'; }
else if ($author_2 != NULL) {
?>
        <p>Other comics by <?php echo $author_2; ?><ul>
<?php
  $info = '';
  $author_result = find_comics_by_author($author_2);
  while ($result = mysqli_fetch_assoc($author_result)) { $info .= '<li><a href="comic_info.php?id=' . $result['id'] . '">' . $result['Book'] . '</a></li>' . "\xA"; }
  echo $info;
}
?>
          </ul>
        </p>
  </div>
  <div class="right_column">
    <h3>Update/Add comics for <?php echo $find_comics_by_id['Book']; ?></h3>
    <p class="types"><?php echo $pub_logo; ?></p>
      <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>?id=<?php echo $comic_id; ?>">
        <table id="comic-info-t">
          <tr><td class="empty-cell" colspan=2></td></tr>
          <tr class="comic-info"><td class="image" colspan=2><h4>Edit Existing Information</h4></td></tr>
          <tr class="comic-info"><td>
            <p class="types">Book # - Current Status</p>
              <p>
                <select name="number_to_edit" id="number_to_edit">
<?php
for ($i = 0; $i <= 30; $i++) {
  if ($find_comics_by_id[$i] != NULL && $find_comics_by_id[$i] != '') {
    echo '              <option value="' . $i . '">' . $i . ' - ' . $find_comics_by_id[$i] . '</option>' . "\xA";
  }
  else {
    continue;
  }
}
?>   
            </select>
          </p>
        </td>
        <td>
          <p class="types">New Status</p>
          <p><select name="purchased_option" id="purchased_option">
            <option value="Purchased">Purchased</option>
            <option value="Missing">Missing</option>
            <option value="None">None</option>
            <option value="">Not Out Yet</option>
          </select></p>
        </td>
      </tr>
      <tr class="comic-info">
        <td class="button_types" colspan=2><input name="update_old" type="submit" id="update_old" value="Edit Existing" /></td>
      </tr>
      <tr><td class="empty-cell" colspan=2></td></tr>
      <tr class="comic-info"><td class="image" colspan=2><h4>Insert New Book Information</h4></td></tr>
      <tr class="comic-info">
        <td>
          <p class="types">Book To Be Added: </p>
          <p><select name="book_added" id="book_added">
<?php
for ($i = 0; $i <= 30; $i++) {
  if ($find_comics_by_id[$i] == NULL || $find_comics_by_id[$i] == '') {
?>
              <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php
  }
  else {
    continue;
  }
}
?>    
          </select></p>
        </td>
        <td>
          <p class="types">Desired Status </p>
          <p><select name="publisher_added" id="publisher_added">
            <option value="Purchased">Purchased</option>
            <option value="Missing">Missing</option>
            <option value="None">None</option>
          </select></p>
        </td>
      </tr>
      <tr class="comic-info"><td class="button_types" colspan=2><input name="update" type="submit" id="update" value="Insert New Information"></td></tr>
      <tr><td class="empty-cell" colspan=2></td></tr>
      <tr class="comic-info"><td class="image" colspan=2><h4>Dates For Comic</h4></td></tr>
      <tr class="comic-info">
        <td>
          <p>Next Issue</p>
          <p><?php echo comic_date_output($find_comics_by_id['date1']); ?></p>
        </td>
        <td>
          <p>Following Issue</p>
          <p><?php echo comic_date_output($find_comics_by_id['date2']); ?></p></td>
        </td>
      </tr>
      <tr class="comic-info"><td class="button_types" colspan=2><input name="update_date" type="submit" id="update_date" value="Update Dates for Comic"></td></tr>
      <tr><td class="empty-cell" colspan=2></td></tr>    </table>
  </form>
</div>

<?php
//Query to add a new book
require_once 'edit_query.php';
?>
</div>
<?php require("library/footer.php"); ?>