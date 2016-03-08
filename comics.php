<?php
require("db.php");
?>
<?php include 'library/comic_query.php';?>
<?php include 'library/comic_publishers.php';?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <title>Edit Your Comic</title>
    <?php
        require 'comic_stylesheets.php';
        require 'comic_scripts.php';
    ?>
</head>

<body>
<?php
    $comic_id=$_GET['id'];
?>
<?php include_once 'library/comic_edit.php';?>
<?php include_once 'library/navigation_bar.php';?>
    <h2>Comic Information</h2>
        <?php
        //Per Row
        $book_status = mysqli_fetch_row($edit_result);
        
        //Release the data
        mysqli_free_result($edit_result);
        
        // Run the query again
	$edit_result = mysqli_query($connection, $query);
        
        //Count the amount of columns
        $fieldcount = mysqli_num_fields($edit_result);
        $count = "";
        $missed = "";
        for ($i = 3; $i < $fieldcount; $i++) {
            if ($book_status[$i] == 'Purchased') 
            {
                $count .= $i - 5 . "    ";
            }
            else if ($book_status[$i] == 'Missing') 
            {
                $missed .= $i - 5 . "<br />";
            }
            else { continue; }
        }
        
        
        //$pub_logo will add the specific logo for the comic
        $pub_logo = "";
        if ($book_status[2] == 'DC Comics') {
            $pub_logo .= '<img src="../images/dc.png" alt="DC Comics">';
        }
        else if ($book_status[2] == 'Marvel Comics') {
            $pub_logo .= '<img src="../images/marvel.png" alt="Marvel Comics">';
        }
        else if ($book_status[2] == 'Image Comics') {
            $pub_logo .= '<img src="../images/image.png" alt="Image Comics">';
        }
        else if ($book_status[2] == 'Boom! Studios') {
            $pub_logo .= '<img src="../images/boom.png" alt="Boom! Studios"?';
        }
        else if ($book_status[2] == 'Valiant') {
            $pub_logo .= '<img src="../images/valiant.jpg" alt="Valiant">';
        }
        else {
             $pub_logo .=  $book_list[2];
        }

        $book_list = mysqli_fetch_assoc($edit_result);
        ?>
        <div id="edit_wrapper">
        <div class="left_column">
            <p align="center" class="edit-img"><img src="../images/<?php echo $book_list['Image'] ?>" alt=" <?php echo $book_list['Book'] ?> "></p>
            <p class="edit_desc"><?php echo $book_list['Description']; ?></p>
	</div>
	<form method="post" action="<?php $_PHP_SELF ?>">
	    <table class="edit_stuff" align="center">
	         <tr>
	             <td class="types">Book Name</td>
	             <td><?php echo $book_list['Book'] ?></td>	         
	         </tr>
	         <tr>
	             <td class="types">Publisher</td>
	             <td class="types"><?php echo $pub_logo ?></td>	         
	         </tr>
	         <tr>
	             <td class="types">Books Purchased</td>
	             <td><?php echo $count; ?></td>	         
	         </tr>
	         <tr>
	             <td class="types">Books Missing</td>
	             <td><?php echo $missed; ?></td>	         
	         </tr>
	         <tr><td colspan=2><div id="empty-cell"></div></td></tr>
	         <tr><td class="image" colspan=2><h4>Edit Existing Information</h4></td></tr>
	         <tr>
	             <td>
	                 <p class="types">Book # - Current Status</p>
	                 <p><select name="number_to_edit" id="number_to_edit">
                         <?php
                         echo "\n";
                         for ($i = 5; $i < $fieldcount; $i++) {
                             if ($book_status[$i] != NULL) 
                             {
                                 $missing_book = $i - 5;
                                 echo "<option value=\"Book_{$missing_book}\">{$missing_book} - {$book_status[$i]}</option>\n";
                             }
                         else { continue; }
                         }
                         ?>        
	                  </select></p>
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
	         <tr><td class="button_types" colspan=2><input name="update_old" type="submit" id="update_old" value="Edit Existing">    <button onclick="window.location.href='test.php';">Cancel</button>
	         </td></tr>
	         <tr><td class="image" colspan=2><h4>Insert New Book Information</h4></td></tr>
	         <tr>
	             <td>
	                 <p class="types">Book To Be Added: </p>
	                 <p><select name="book_added" id="book_added">
                         <?php
                         echo "\n";
                         for ($i = 5; $i < $fieldcount; $i++) {
                             if ($book_status[$i] == NULL) 
                             {
                                 $missing_book = $i - 5;
                                 echo "<option value=\"Book_{$missing_book}\">{$missing_book}</option>\n";
                             }
                         else { continue; }
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
	         <tr><td class="button_types" colspan=2><input name="update" type="submit" id="update" value="Insert New Information"></td></tr>
	    </table>	               
	</form>
	</div>
<?php
         //Quey to add a new book
         if(isset($_POST['update']))
         {
            $book_to_edit = addslashes($book_list['Book']);
            $number_to_edit = $_POST['book_added'];
            $status_to_update = $_POST['publisher_added'];
            echo '<p align="center">This is the book: <b>' . $book_to_edit . '</b> Number to edit: <b>' . $number_to_edit . '</b> Status to update: <b>' . $status_to_update . '</b></p>';
            
            //Build the query           
            $edit_old_query = "UPDATE comicBookList ";
            $edit_old_query .= "set $number_to_edit = '$status_to_update' ";
            $edit_old_query .= "where Book = '$book_to_edit' ";
            
            //Run the query
            $retval = mysqli_query($connection, $edit_old_query);
            
            if(!$retval )
            {
                 die ("The error is: " . mysqli_error($connection));
            }
            else
            {
            echo "<script>location.href = 'comic_edit.php?id=$comic_id';</script>";
            }
         }
         else
         {
             echo '<p align="center">This is my footer ' . $book_list['Book'] . '</p>';
         }
         
         //Query to edit a book
         if(isset($_POST['update_old']))
         {
            $book_to_edit = $book_list['Book']; 
            $number_to_edit = $_POST['number_to_edit'];
            $status_to_update = $_POST['purchased_option'];
            echo '<p align="center">' . $book_to_edit . '  ' . $number_to_edit . '  ' . $status_to_update . '</p>';
            
            //Build the query           
            $edit_old_query = "UPDATE comicBookList ";
            $edit_old_query .= "set $number_to_edit = '$status_to_update' ";
            $edit_old_query .= "where Book = '$book_to_edit' ";
            
            //Run the query
            $editval = mysqli_query($connection, $edit_old_query);
            
            if(!$editval)
            {
                 die ("The error is: " . mysqli_error($connection));
            }
            else
            {
            echo "<script>location.href = 'comic_edit.php?id=$comic_id';</script>";
            }
         }
         else
         {
             echo '<p align="center">This is the other footer ' . $book_list['Book'] . '</p>';
         }
      ?>
    <?php
        //Release the data
        mysqli_free_result($edit_result);
    ?>
</div>
</body>
</html>      