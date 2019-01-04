<?php
function confirm_query($result_set) {
    if (!$result_set) {
        die("Сбой запроса базы данных");
    }
}
//Проверяет наличие расширенных прав у пользователя
function exist_user_group($user_id) {
    global $connection;
    $user_group_id=1;//Группа с расширенными правами
    $safe_user_id = mysqli_real_escape_string($connection, $user_id);

    $query  = "SELECT u.user_id
                 FROM users u,
                      user_link_groups ulg
                WHERE u.user_id=ulg.user_id 
                  and ulg.user_group_id={$user_group_id}
                  and u.user_id = {$safe_user_id}";
    $user_query = mysqli_query($connection, $query);
    confirm_query($user_query);
    if($user = mysqli_fetch_assoc($user_query)) {
        return 1;
    } else {
        return 0;
    }
}
?>
<?php
	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}
	function mysql_prep($string) {
		global $connection;

		$escaped_string = mysqli_real_escape_string($connection, $string);
		return $escaped_string;
	}

	function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "Пожалуйста, исправьте следующие ошибки:";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

	function find_user_by_username($username) {
		global $connection;

		$safe_username = mysqli_real_escape_string($connection, $username);

		$query  = "SELECT *
		           FROM users u
		          WHERE u.user_name = '{$safe_username}'";
		$user_set = mysqli_query($connection, $query);
		confirm_query($user_set);
		if($user = mysqli_fetch_assoc($user_set)) {
			return $user;
		} else {
			return null;
		}
	}

	function password_encrypt($password) {
  	$hash_format = "$2y$10$";
	  $salt_length = 22;
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($password, $format_and_salt);
		return $hash;
	}

	function generate_salt($length) {

	  $unique_random_string = md5(uniqid(mt_rand(), true));

	  $base64_string = base64_encode($unique_random_string);

	  $modified_base64_string = str_replace('+', '.', $base64_string);

	  $salt = substr($modified_base64_string, 0, $length);

		return $salt;
	}

	function password_check($password, $existing_hash) {

	  $hash = crypt($password, $existing_hash);
	  if ($hash === $existing_hash) {
	    return true;
	  } else {
	    return false;
	  }
	}

	function attempt_login($username, $password) {
		$user = find_user_by_username($username);
		if ($user) {
			if (password_check($password, $user["hashed_password"])) {
				return $user;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function logged_in() {
		return isset($_SESSION['user_id']);
	}

	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("login.php");
		}
	}
?>