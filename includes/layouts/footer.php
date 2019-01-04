    <div id="footer">
        Web-Технологии, ПНИПУ, доц. Суворов А.О.<?php echo date("Y"); ?>
    </div>

	</body>
</html>
<?php
	if (isset($connection)) {
	  mysqli_close($connection);
	}
?>
