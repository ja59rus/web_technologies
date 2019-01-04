<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/function.php"); ?>
<?php confirm_logged_in();?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
if (isset($_POST['submit'])) {

  $required_fields = array("username", "password");
  validate_presences($required_fields);
  
  $fields_with_max_lengths = array("username" => 30);
  validate_max_lengths($fields_with_max_lengths);
  
  if (empty($errors)) {

    $username = mysql_prep($_POST["username"]);
    $hashed_password = password_encrypt($_POST["password"]);
    
    $query  = "INSERT INTO users (";
    $query .= "  user_name, hashed_password";
    $query .= ") VALUES (";
    $query .= "  '{$username}', '{$hashed_password}'";
    $query .= ")";
    $result = mysqli_query($connection, $query);

    if ($result) {
      $_SESSION["message"] = "Пользователь создан.";
    } else {
      $_SESSION["message"] = "Пользователь не создан";
    }
  }
}

?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
  <div id="page">
    <?php echo message(); ?>
    <?php echo form_errors($errors); ?>
    <h2>Создание пользователя</h2>
    <form action="new_user.php" method="post">
      <p>Логин:
        <input type="text" name="username" value="" />
      </p>
      <p>Пароль:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Создать пользователя" />
    </form>
    <br />
  </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>
