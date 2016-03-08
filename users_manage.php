<?php
require("library/users_head.php");
confirm_logged_in();
am_i_admin();
$admin_set = find_all_users();
echo '<title>This is Epiphany Productions</title>' . "\xA";
echo '</head>' . "\xA";
echo '<body>' . "\xA";

include_once 'library/navigation.php';
include_once 'library/book_codes.php';
?>
<!--    <div class="main-body"> -->
      <div class="top_description">
        <?php echo message(); ?>
        <h2>Manage Admins</h2>
        <table align="center">    
          <tr>
            <th style="text-align: left; width: 200px;">ID</th>
            <th style="text-align: left; width: 200px;">Username</th>
            <th style="text-align: left;">Name</th>
            <th style="text-align: left;">Email Address</th>
            <th style="text-align: left;">Actions</th>
          </tr>
        <?php 
        while($admin = mysqli_fetch_assoc($admin_set)) {
        ?>
          <tr>
            <td><?php echo htmlentities($admin["id"]); ?></td>
            <td><?php echo htmlentities($admin["username"]); ?></td>
            <td><?php echo htmlentities($admin["last_name"]) . ', ' . htmlentities($admin["first_name"]); ?></td>
            <td><?php echo htmlentities($admin["email_address"]); ?></td>
            <td><a href="users_edit.php?id=<?php echo urlencode($admin["id"]); ?>">Edit</a></td>
          </tr>
        <?php } ?>
        </table>
        <p class="glyph-images"><img src="/images/cellulose.png" alt="-------------"></p>
        <p><a href="users_new.php">Add New User</a></p>
        <p><a href="users_logout.php">Logout</a></p>

      </div> <!-- End of top_description -->

<!--   </div>  -->  <!-- End of main-body -->
<?php require("library/footer.php"); ?>