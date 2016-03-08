<?php
require("db_books.php");
?>
<?php include 'library/book_query.php';?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once 'library/book_search.php';
?>

<html>
<head>
    <title>This is Epiphany Books - <?php echo $book_name; ?></title>
    <?php
        require 'comic_stylesheets.php';
        require 'comic_scripts.php';
    ?>
<style>
.left_side {
     float:left;
     width:25%;
}
</style>
</head>

<body>

<?php include_once 'library/navigation-books.php';?>
<div class="main-body">
    <p><?php echo $more_info; ?></p>
</div>
</body>
</html>      