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
  <h2>Insert Comic</h2>
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
          <form method="post" action="">
          <table class="insert-table">
            <tr>
              <td>Comic to Add</td>
              <td><input name="book_to_add" type="text" id="book_to_add" maxlength="99"></td>
            </tr>
            <tr>
              <td>Author 1</td> 
              <td><input name="author_added" type="text" id="author_added" maxlength="99"></td>
            </tr>
            <tr>
              <td>Author 2</td>
              <td><input name="author_added2" type="text" id="author_added2" maxlength="99"></td>
            </tr>
            <tr>
              <td>Publisher</td>
              <td><select name="publisher_to_add" id="publisher_to_add">
<?php
  $find_all_comic_publishers = find_all_comic_publishers();
  while ($selection = mysqli_fetch_assoc($find_all_comic_publishers)) {
?>
                <option value="<?php echo $selection['Publisher']; ?>"><?php echo $selection['Publisher']; ?></option>
<?php } ?>
              </select></td>
            </tr>
            <tr>
              <td>Description</td>
              <td><textarea name="book_description" id="book_description"  rows="5" cols="75" placeholder="Enter your comic description..."></textarea></td>
            </tr>
            <tr>
              <td>Cover Image</td>
              <td><input name="cover_added" type="text" id="cover_added"></td>
            </tr>
            <tr>
              <td>Title Image</td>
              <td><input name="title_image" type="text" id="title_image"></td>
            </tr>
            <tr>
              <td>Purchased Books</td>
              <td>
                Issue 1<input name="pcomic1" type="checkbox" id="pcomic1" value="Yes" style="width:20px;" />
                Issue 2<input name="pcomic2" type="checkbox" id="pcomic2" value="Yes" style="width:20px;" />
                Issue 3<input name="pcomic3" type="checkbox" id="pcomic3" value="Yes" style="width:20px;" />
                Issue 4<input name="pcomic4" type="checkbox" id="pcomic4" value="Yes" style="width:20px;" />
                Issue 5<input name="pcomic5" type="checkbox" id="pcomic5" value="Yes" style="width:20px;" />
              </td>
            </tr>
            <tr>
              <td colspan=2>
                <input name="insert" type="submit" id="insert" value="insert">
              </td>
            </tr>                  
          </table>
        </form>

<?php
//Query to add a new book
require_once 'edit_query.php';
?>
  </div>
</div>
<?php require("library/footer.php"); ?>