    <div id="footer">
        Web-Технологии, ПНИПУ, доц. Суворов А.О.<?php echo date("Y"); ?>
    </div>

	</body>
</html>
<?php
  // 5. Закрытие соединения
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
