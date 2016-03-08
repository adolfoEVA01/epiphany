<?php
require("library/users_head.php");

$username = "";

if (isset($_POST['submit'])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  $found_admin = attempt_login($username, $password);
  
  if ($found_admin) {
    $_SESSION["user_id"] = $found_admin["id"];
    $_SESSION["username"] = $found_admin["username"];    
    
    //am_i_admin();
    //redirect_to("users_manage.php");
    have_url();
  }
  else {
    $message = '<p class="notice">Username/password not found.</p>' . "\xA";
  }
}
else {
  // This is probably a GET request
  
} // end: if (isset($_POST['submit']))

$admin_set = find_all_users();
echo '<title>This is Epiphany Productions</title>' . "\xA";
echo '</head>' . "\xA";
echo '<body>' . "\xA";

include_once 'library/navigation.php';
include_once 'library/book_codes.php';
?>
<!--    <div class="main-body"> -->
      <div class="top_description">
        <h2>Manage Admins</h2>
    <h2>Login</h2>
    <form action="login.php" method="post">
      <p>Username:
        <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      <p>Password:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Submit" />
    </form>
    <?php echo $message; ?>
      </div> <!-- End of top_description -->
<?php 
//$george = have_url();
//echo $george; ?>
<!--   </div>  -->  <!-- End of main-body -->
<?php require("library/footer.php"); ?>