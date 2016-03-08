<?php
if(isset($_POST['update_comic_info'])) {
  $book_to_edit = addslashes($find_comics_by_id['Book']);
  $number_to_edit = $_POST['book_added'];
  $description_to_update = mysqli_real_escape_string($conn_comics, $_POST['comic_description']);
  $comic_to_update = mysqli_real_escape_string($conn_comics, $_POST['comic_title']);
  $comic_author1  = mysqli_real_escape_string($conn_comics, $_POST['comic_author1']);
  $comic_author2  = mysqli_real_escape_string($conn_comics, $_POST['comic_author2']);
  $publisher_to_add  = $_POST['comic_publisher'];
            
  //Build the query           
  $query = "UPDATE comicBookList ";
  $query .= "set `Description` = '" . $description_to_update . "' ";
  $query .= ", `Book` = '" . $comic_to_update . "' ";
  $query .= ", `comic_author` = '" . $comic_author1 . "' ";
  $query .= ", `comic_author2` = '" . $comic_author2 . "' ";
  $query .= ", `Publisher` = '" . $publisher_to_add . "' ";
  $query .= "where Book = '" . $book_to_edit . "' ";
     
  //Run the query
  $retval = mysqli_query($conn_comics, $query);
            
  if(!$retval ) {
    echo '<p align="center">Nothing was updated</p><p>' . $query . '</p>';
  }
  else {
    echo "<script>location.href = 'comic_info.php?id=$comic_id';</script>";
    //echo '<p align="center">Update</p><p>' . $query . '</p>';
  }
}
else {
  echo '' . "\xA";
}         

if(isset($_POST['update'])) {
  $book_to_edit = addslashes($find_comics_by_id['Book']);
  $number_to_edit = $_POST['book_added'];
  $status_to_update = $_POST['publisher_added'];
            
  //Build the query           
  $edit_old_query = "UPDATE comicBookList ";
  $edit_old_query .= "set `" . $number_to_edit . "` = ' " . $status_to_update . "' ";
  $edit_old_query .= "where Book = '" . $book_to_edit . "' ";
            
  //Run the query
  $retval = mysqli_query($conn_comics, $edit_old_query);
            
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
  $book_to_edit = $find_comics_by_id['Book']; 
  $number_to_edit = $_POST['number_to_edit'];
  $status_to_update = $_POST['purchased_option'];
  //echo '<p align="center">' . $book_to_edit . '  ' . $number_to_edit . '  ' . $status_to_update . '</p>';
  
  //Build the query
  $edit_old_query = "UPDATE comicBookList ";
  $edit_old_query .= "set `" . $number_to_edit . "` = '" . $status_to_update . "' ";
  $edit_old_query .= "where Book = '" . $book_to_edit . "' ";
            
  //Run the query
  $editval = mysqli_query($conn_comics, $edit_old_query);
            
  if(!$editval) {
    echo '<p align="center">Nothing was updated</p>';
    //die ("The error is: " . mysqli_error($connection));
  }
  else {
    echo "<script>location.href = 'comic_edit.php?id=$comic_id';</script>";
  }
}
else {
  echo '' . "\xA";
}
?>