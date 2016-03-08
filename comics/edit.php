<?php
require_once "session.php";
require "library/comic_head.php";
$comic_id=$_GET['id'];
require_once "users_functions.php";
//session_start(); // starts the session
confirm_logged_in();
$_SESSION['url'] = $_SERVER['REQUEST_URI'];
include_once 'library/comic_edit.php';

$edit_result = mysqli_query($connection, $query);
$comic_status = mysqli_fetch_assoc($edit_result);
?>
<title>Epiphany Productions &mdash; <?php echo $comic_status['Book']; ?></title>
</head>
<body>

<?php include_once 'library/navigation-comics.php'; ?>

  <h2>Comic Information</h2>
<?php
$count = "";
$missed = "";

for ($i = 0; $i < 30; $i++) {
  if ($comic_status[$i] == 'Purchased') {
    $count .= $i . "    ";
  }
  else if ($comic_status[$i] == 'Missing') {
    $missed .= $i . "<br />";
  }
  else { 
    continue;
  }
}

$pub_logo = "";

if ($comic_status['Publisher'] == 'Boom! Studios') {
  $pub_logo .= '<img src="/images/boom.png" alt="Boom! Studios"?';
}
else if ($comic_status['Publisher'] == 'Dark Horse Comics') {
  $pub_logo .= '<img src="/images/dark_horse.jpg" alt="Dark Horse Comics">';
}
else if ($comic_status['Publisher'] == 'DC Comics') {
  $pub_logo .= '<img src="/images/dc.png" alt="DC Comics">';
}
else if ($comic_status['Publisher'] == 'Image Comics') {
  $pub_logo .= '<img src="/images/image.png" alt="Image Comics">';
}
else if ($comic_status['Publisher'] == 'IDW Publishing') {
  $pub_logo .= '<img src="/images/idw-publishing.jpg" alt="IDW Publishing">';
}
else if ($comic_status['Publisher'] == 'Marvel Comics') {
  $pub_logo .= '<img src="/images/marvel.png" alt="Marvel Comics">';
}
else if ($comic_status['Publisher'] == 'Oni Press') {
  $pub_logo .= '<img src="/images/onipress.jpg" alt="Oni Press">';
}
else if ($comic_status['Publisher'] == 'Valiant') {
  $pub_logo .= '<img src="/images/valiant.jpg" alt="Valiant">';
}
else if ($comic_status['Publisher'] == 'Vertigo Comics') {
  $pub_logo .= '<img src="/images/vertigo.png" alt="Vertigo Comics">';
}
else {
  $pub_logo .=  $comic_status['Publisher'];
}

$book_list = mysqli_fetch_assoc($edit_result);
?>
  <div class="main-body">
    <div class="left_column">
      <p class="edit-img"><img src="/images/<?php echo $comic_status['Image']; ?>" alt="<?php echo $comic_status['Book']; ?>"></p>
      <p class="edit_desc"><?php echo $comic_status['Description']; ?></p>
<?php
$FirstDay = date("Y-m-d", strtotime('sunday last week'));  
$LastDay = date("Y-m-d", strtotime('sunday this week'));  

$FirstDay2 = date("Y-m-d", strtotime('sunday this week'));  
$LastDay2 = date("Y-m-d", strtotime('sunday next week'));  

if ($comic_status['date1'] > $FirstDay && $comic_status['date1'] < $LastDay) {
  echo '      <p class="next_issue">Next issue will be available ' . $comic_status['date1'] . "\xA";
  if ($comic_status['date2'] != null) {
    echo'.  The following issue will come on: ' . $comic_status['date2'] . '</p>' . "\xA";
  }
  else if ($comic_status['date2'] == '0000-00-00') {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($comic_status['date1'] > $FirstDay2 && $comic_status['date1'] < $LastDay2) {
  $newDate = date("M d, Y", strtotime($comic_status['date1']));
  echo '      <p class="next_issue">Next issue available next week on ' . $newDate . "\xA";
  if ($comic_status['date2'] != null) {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else if ($comic_status['date2'] == '0000-00-00') {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($comic_status['date1'] != null && $comic_status['date1'] < $FirstDay) {
  $newDate = date("M d, Y", strtotime($comic_status['date1']));
  echo '      <p class="next_issue">Last issue became available ' . $newDate . "\xA";
  if ($comic_status['date2'] != null) {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else if ($comic_status['date2'] == '0000-00-00') {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else if ($comic_status['date1'] != null && $comic_status['date1'] > $LastDay2) {
  $newDate = date("M d, Y", strtotime($comic_status['date1']));
  echo '      <p class="next_issue">Next issue will available on ' . $newDate . "\xA";
  if ($comic_status['date2'] != null) {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo'.  The following issue will come on ' . $newDate . '</p>' . "\xA";
  }
  else if ($comic_status['date2'] == '0000-00-00') {
    $newDate = date("M d, Y", strtotime($comic_status['date2']));
    echo '</p>' . "\xA";
  }
  else {
    echo '</p>' . "\xA";
  }
}
else {
  echo '      <p class="edit_desc">No current dates available</p>' . "\xA";
}

if ($comic_status['date1'] != null) {
  $newDate = date("Y-m-d", strtotime($comic_status['date1']));
  $date_output1 = '<input type="date" name="date_issue" value="' . $newDate .'">';  
}
else {
  $date_output1 = '<input type="date" name="date_issue" min="2015-11-02"">';  
}
if ($comic_status['date2'] != null) {
  $newDate = date("Y-m-d", strtotime($comic_status['date2']));
  $date_output2 = '<input type="date" name="fol_issue" value="' . $newDate .'">';  
}
else {
  $date_output2 = '<input type="date" name="fol_issue" value="NULL">';  
}
mysqli_free_result($edit_result);

include_once 'library/comic_more.php';

//Release the data
mysqli_free_result($author_result);              
mysqli_free_result($author_result2);              
echo $more_info;          
?>          
</div>
<div class="right_column">
  <h3><?php echo $comic_status['Book']; ?></h3>
  <p class="types">By: <?php echo $comic_status['comic_author']; ?>
<?php
if ($comic_status['comic_author2'] != NULL) {
  echo ' and ' .  $comic_status['comic_author2'];
}
else {
  echo '';
}

echo '  </p>' . "\xA";
echo '  <p class="types">' . $pub_logo . '</p>' . "\xA";
echo '    <form method="post" action="' . $_SERVER['PHP_SELF'] . '?id=' . $comic_id . '">' . "\xA";
echo '      <table id="comic-info-t">' . "\xA";
echo '        <tr><td class="empty-cell" colspan=2></td></tr>' . "\xA";
echo '        <tr class="comic-info"><td class="image" colspan=2><h4>Edit Existing Information</h4></td></tr>' . "\xA";
echo '        <tr class="comic-info"><td>' . "\xA";
echo '          <p class="types">Book # - Current Status</p>' . "\xA";
echo '          <p>' . "\xA";
echo '            <select name="number_to_edit" id="number_to_edit">' . "\xA";

for ($i = 0; $i <= 30; $i++) {
  if ($comic_status[$i] != NULL && $comic_status[$i] != '') {
    $recorded_book = $i;
    echo '              <option value="' . $recorded_book . '">' . $recorded_book . ' - ' . $comic_status[$i] . '</option>' . "\xA";
  }
  else {
    continue;
  }
}  
    
echo '            </select>' . "\xA";
echo '          </p>' . "\xA";
echo '        </td>' . "\xA";
echo '        <td>' . "\xA";
echo '          <p class="types">New Status</p>' . "\xA";
echo '          <p><select name="purchased_option" id="purchased_option">' . "\xA";
echo '            <option value="Purchased">Purchased</option>' . "\xA";
echo '            <option value="Missing">Missing</option>' . "\xA";
echo '            <option value="None">None</option>' . "\xA";
echo '            <option value="">Not Out Yet</option>' . "\xA";
echo '          </select></p>' . "\xA";
echo '        </td>' . "\xA";
echo '      </tr>' . "\xA";
echo '      <tr class="comic-info">' . "\xA";
echo '        <td class="button_types" colspan=2><input name="update_old" type="submit" id="update_old" value="Edit Existing" /></td>' . "\xA";
echo '      </tr>' . "\xA";
echo '      <tr><td class="empty-cell" colspan=2></td></tr>' . "\xA";
echo '      <tr class="comic-info"><td class="image" colspan=2><h4>Insert New Book Information</h4></td></tr>' . "\xA";
echo '      <tr class="comic-info">' . "\xA";
echo '        <td>' . "\xA";
echo '          <p class="types">Book To Be Added: </p>' . "\xA";
echo '          <p><select name="book_added" id="book_added">' . "\xA";

for ($i = 0; $i <= 30; $i++) {
  if ($comic_status[$i] == NULL || $comic_status[$i] == '') {
    $missing_book = $i;
    echo '              <option value="' . $missing_book . '">' . $missing_book . '</option>' . "\xA";
  }
  else {
    continue;
  }
}
       
echo '          </select></p>' . "\xA";
echo '        </td>' . "\xA";
echo '        <td>' . "\xA";
echo '          <p class="types">Desired Status </p>' . "\xA";
echo '          <p><select name="publisher_added" id="publisher_added">' . "\xA";
echo '            <option value="Purchased">Purchased</option>' . "\xA";
echo '            <option value="Missing">Missing</option>' . "\xA";
echo '            <option value="None">None</option>' . "\xA";
echo '          </select></p>' . "\xA";
echo '        </td>' . "\xA";
echo '      </tr>' . "\xA";
echo '      <tr class="comic-info"><td class="button_types" colspan=2><input name="update" type="submit" id="update" value="Insert New Information"></td></tr>' . "\xA";
echo '      <tr><td class="empty-cell" colspan=2></td></tr>' . "\xA";
echo '      <tr class="comic-info"><td class="image" colspan=2><h4>Dates For Comic</h4></td></tr>' . "\xA";
echo '      <tr class="comic-info">' . "\xA";
echo '        <td>' . "\xA";
echo '          <p>Next Issue</p>' . "\xA";
echo '          <p>' . $date_output1 . '</p>' . "\xA";
echo '        </td>' . "\xA";
echo '        <td>' . "\xA";
echo '          <p>Following Issue</p>' . "\xA";
echo '          <p>' . $date_output2 . '</p></td>' . "\xA";
echo '        </td>' . "\xA";
echo '      </tr>' . "\xA";
echo '      <tr class="comic-info"><td class="button_types" colspan=2><input name="update_date" type="submit" id="update_date" value="Update Dates for Comic"></td></tr>' . "\xA";
echo '      <tr><td class="empty-cell" colspan=2></td></tr>' . "\xA";echo '    </table>' . "\xA";
echo '  </form>' . "\xA";
echo '</div>' . "\xA";

//Quey to add a new book
if(isset($_POST['update'])) {
  $book_to_edit = addslashes($comic_status['Book']);
  $number_to_edit = $_POST['book_added'];
  $status_to_update = $_POST['publisher_added'];
  //echo '<p align="center">This is the book: <b>' . $book_to_edit . '</b> Number to edit: <b>' . $number_to_edit . '</b> Status to update: <b>' . $status_to_update . '</b></p>';
            
  //Build the query           
  $edit_old_query = "UPDATE comicBookList ";
  $edit_old_query .= "set `" . $number_to_edit . "` = ' " . $status_to_update . "' ";
  $edit_old_query .= "where Book = '" . $book_to_edit . "' ";
            
  //Run the query
  $retval = mysqli_query($connection, $edit_old_query);
            
  if(!$retval ) {
    echo '<p align="center">Nothing was updated</p><p>' . $edit_old_query . '</p>';
  }
  else {
    echo "<script>location.href = 'comic_info.php?id=$comic_id';</script>";
  }
}
else {
  echo '' . "\xA";
}         

//Query to edit a book
if(isset($_POST['update_old'])) {
  $book_to_edit = $comic_status['Book']; 
  $number_to_edit = $_POST['number_to_edit'];
  $status_to_update = $_POST['purchased_option'];
  //echo '<p align="center">' . $book_to_edit . '  ' . $number_to_edit . '  ' . $status_to_update . '</p>';
  
  //Build the query
  $edit_old_query = "UPDATE comicBookList ";
  $edit_old_query .= "set `" . $number_to_edit . "` = '" . $status_to_update . "' ";
  $edit_old_query .= "where Book = '" . $book_to_edit . "' ";
            
  //Run the query
  $editval = mysqli_query($connection, $edit_old_query);
            
  if(!$editval) {
    echo '<p align="center">Nothing was updated</p>';
    //die ("The error is: " . mysqli_error($connection));
  }
  else {
    echo "<script>location.href = 'comic_info.php?id=$comic_id';</script>";
  }
}
else {
  echo '' . "\xA";
}

if(isset($_POST['update_date'])) {
  $book_to_edit = $comic_status['id']; 
  $number_to_edit = $_POST['number_to_edit'];
  $date1_to_edit = $_POST['date_issue'];
  $date2_to_edit = $_POST['fol_issue'];
  $status_to_update = $_POST['purchased_option'];
  //echo '<p align="center">' . $book_to_edit . '  ' . $number_to_edit . '  ' . $status_to_update . '</p>';
  
  //Build the query
  $edit_old_query = "UPDATE comicBookList ";
  $edit_old_query .= "set `date1` = '" . $date1_to_edit . "' ";
  $edit_old_query .= ", `date2` = '" . $date2_to_edit . "' ";
  $edit_old_query .= "where `id` = '" . $book_to_edit . "' ";
            
  //Run the query
  $editval = mysqli_query($connection, $edit_old_query);
            
  if(!$editval) {
    echo '<p align="center">Nothing was updated</p><p align="center">'  . $edit_old_query .'</p>';
    //die ("The error is: " . mysqli_error($connection));
  }
  else {
    echo "<script>location.href = 'comic_info.php?id=$comic_id';</script>";
  }
}
else {
  echo '' . "\xA";
}

echo '</div>' . "\xA";

require("library/footer.php");

?>