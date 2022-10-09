<?php include 'includes/session.php'; ?>
<?php
	$slug = $_GET['category'];

	$conn = $pdo->open();

	try{
		$stmt = $conn->prepare("SELECT * FROM category WHERE cat_slug = :slug");
		$stmt->execute(['slug' => $slug]);
		$cat = $stmt->fetch();
		$catid = $cat['id'];
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	$pdo->close();

?>
<?php include 'includes/header.php'; ?>
<body>

	<?php include 'includes/navbar.php'; ?>
	<style>
		.container .box::before{
	content: '<?php echo $cat['name']; ?>';
    position: absolute;
    left: 0;
    right: 0;
    margin: 0 auto;
    top: 25%;
    text-align: center;
    font-weight: 900;
    color: var(--textcolor);
    transition: 0.75s;
    opacity: 0;}
</style>
	      <!-- Main content -->
		            <h1 class="nazev-kategorie"><?php echo $cat['name']; ?></h1>
					<div class="container">
		       		<?php
		       			
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT * FROM products WHERE category_id = :catid");
						    $stmt->execute(['catid' => $catid]);
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       								<div class='box no-shadow'>
										    <a href='product.php?product=".$row['slug']."' class='name'>".$row['name']."</a>
											<a href='product.php?product=".$row['slug']."' class='buy btn41-43 btn-42'>Více info</a>
											<div class='circle'><img src='IMG/ShoeProduct/blob-paint.svg' alt='BLOB'></div>
											<a href='product.php?product=".$row['slug']."' class='box-odkaz'><img src='".$image."' class='product-shoe' alt='Fotka boty'></a>
	       								</div>
	       						";
	       						if($inc == 3) echo "</div>";
						    }
						    if($inc == 1) echo "<div class='col-sm-4'></div><div class='col-sm-4'></div></div>"; 
							if($inc == 2) echo "<div class='col-sm-4'></div></div>";
						}
						catch(PDOException $e){
							echo "There is some problem in connection: " . $e->getMessage();
						}

						$pdo->close();

		       		?> 
  
</div>
<?php include 'includes/footer.php'; ?>
<?php include 'includes/scripts.php'; ?>
<script src="vanilla-tilt.min.js"></script>
<script>
    	VanillaTilt.init(document.querySelectorAll(".box"), {
            max: 25,
            speed: 400
        });
</script> 
</body>
</html>