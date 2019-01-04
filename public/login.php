<?php require_once("../includes/session.php");?>
<?php require_once("../includes/db_connection.php");?>
<?php require_once("../includes/function.php");?>
<?php require_once("../includes/validation_functions.php");?>
<?php
$username = "";
if (isset($_POST['submit'])) {
  $required_fields = array("username", "password");
  validate_presences($required_fields);
  if (empty($errors)) {
		$username = $_POST["username"];
		$password = $_POST["password"];
		$found_user = attempt_login($username, $password);
    if ($found_user) {
			$_SESSION["user_id"] = $found_user["user_id"];
			$_SESSION["username"] = $found_user["username"];
      redirect_to("index.php");
    } else {
      $_SESSION["message"] = "Пользователь с таким логином и паролем не найден.";
    }
  }
}
?>
<?php include("../includes/layouts/header.php");?>
<div id="main">
  <div id="page">
    <?php echo message();?>
    <?php echo form_errors($errors);?>
    <h2>Форма авторизации</h2>
    <form action="login.php" method="post">
      <p>Логин:
        <input type="text" name="username" value="<?php echo htmlentities($username); ?>" />
      </p>
      <p>Пароль:
        <input type="password" name="password" value="" />
      </p>
      <input type="submit" name="submit" value="Войти" />
    </form>
  </div>
</div>
<?php include("../includes/layouts/footer.php");?>