<?php require_once("../includes/session.php"); ?>
<?php require_once('../includes/db_connection.php');?>
<?php require_once('../includes/function.php');?>
<?php confirm_logged_in();?>
<?php require_once('../includes/layouts/header.php'); ?>
<div id="main">
    <div id="logout">
      <a href="new_user.php">Создать пользователя</a>
        </br>
      <a href="logout.php">Выход</a>
    </div>
</div>
<?php require_once('../includes/layouts/footer.php'); ?>
