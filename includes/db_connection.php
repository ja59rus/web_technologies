<?php
	define("DB_SERVER", "localhost");
	define("DB_USER", "mur101");
	define("DB_PASS", "password");
	define("DB_NAME", "mydb");

  $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

  if(mysqli_connect_errno()) {
    die("Ошибка подключения к базе данных: " .
         mysqli_connect_error() .
         " (" . mysqli_connect_errno() . ")"
    );
  }

