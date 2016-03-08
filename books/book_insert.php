<?php
require "db_books.php";
include 'library/book_query.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv='X-UA-Compatible' content='IE=edge' />
  <meta charset="utf-8" />
  <?php
    require 'comic_stylesheets.php';
    require 'comic_scripts.php';
  ?>
  <title>Epiphany Productions &ndash; Book Collection</title>
<?php include 'library/book_codes.php'; ?>
</head>

<body>
<?php
$book_alpha = $_GET['id'];
?>
<div class="main-nav">
<?php include_once 'library/navigation-books.php'; ?>
</div>

<div class="main-body">
<?php echo $notice; ?>
<?php echo $notice_result; ?>
<?php   echo '<p>' . sizeof($isbn_array) . '</p>'; ?>
</div>
<?php require("library/footer.php"); ?>