<?php

$server = "wm49.wedos.net";
$username = "neco";
$password = "neco";
$database = "d5925_slovnik";
$table = "obrazky2";
$db = new mysqli($server, $username, $password,$database);
$result = $db->query("SELECT obr FROM obrazky2 ORDER BY id DESC"); 
?>

<?php if($result->num_rows > 0){ ?> 
    <div class="gallery"> 
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['obr']); ?>" /> 
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>




<html>
<head>

</head>
<body>
		<form action="uloz.php" method="post" enctype="multipart/form-data" >
			
			<div>
				<input type="file" name="image" >
        <input type="input" name="a" >
			</div>
			<input type="submit" name="submit"value="Save">
			
	
	</div>
	</form>
</body>
</html>