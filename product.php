<?php include 'includes/session.php'; ?>
<?php
	$conn = $pdo->open();

	$slug = $_GET['product'];

	try{
		 		
	    $stmt = $conn->prepare("SELECT *, products.name AS prodname, category.name AS catname, products.id AS prodid FROM products LEFT JOIN category ON category.id=products.category_id WHERE slug = :slug");
	    $stmt->execute(['slug' => $slug]);
	    $product = $stmt->fetch();
		
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//page view
	$now = date('Y-m-d');
	if($product['date_view'] == $now){
		$stmt = $conn->prepare("UPDATE products SET counter=counter+1 WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid']]);
	}
	else{
		$stmt = $conn->prepare("UPDATE products SET counter=1, date_view=:now WHERE id=:id");
		$stmt->execute(['id'=>$product['prodid'], 'now'=>$now]);
	}

?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue layout-top-nav">
<script>
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
	<?php include 'includes/navbar.php'; ?>
	<div class="pagecontent">
        <div class="product">
            <div class="product-images">
                <img class="product-img" src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>">
                <div class="other-pics">
                    <img class="low-img" src="<?php echo (!empty($product['photo_two'])) ? 'images/'.$product['photo_two'] : 'images/noimage.jpg'; ?>">
					<img class="low-img" src="<?php echo (!empty($product['photo'])) ? 'images/'.$product['photo'] : 'images/noimage.jpg'; ?>">
                    <img class="low-img" src="<?php echo (!empty($product['photo_three'])) ? 'images/'.$product['photo_three'] : 'images/noimage.jpg'; ?>">
                    <img class="low-img" src="<?php echo (!empty($product['photo_four'])) ? 'images/'.$product['photo_four'] : 'images/noimage.jpg'; ?>">
                </div>
            </div>
            <div class="product-name">
                <div class="name">
                <h1><?php echo $product['prodname']; ?></h1>
                <h2><?php echo $product['catname']; ?></h2>
                </div>
                <div class="button">
                <a href="https://discord.gg/XfzsV3gW7w" target="_blank" class="btn41-43 btn-42">
                    Discord
                </a>
                </div>
            </div>
        </div>
        <div class="text">
            <h3><?php echo $product['catname']; ?></h3>
            <p>Boty značky Nike ze série Dunk se poprvé objevili v roce 1985. Boty ze začátku sloužili jako basketbalové tenisky, ale
                postupem času se z nich stala volnočasová obuv. V dnešní době už existuje více typů těchto bot - Dunk Low, Dunk Mid a Dunk High nebo Dunk SB, typ určený na skateboarding.
                Boty mají několik desítek barevných variant a existuje i mnoho speciálních edic, např. Ben & Jerry's Chunky Dunky nebo Heineken Low.
            </p>
            <h3><?php echo $product['prodname']; ?></h3>
            <p><?php echo $product['description']; ?></p>
        </div>
    </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>

<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
	$('#add').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		quantity++;
		$('#quantity').val(quantity);
	});
	$('#minus').click(function(e){
		e.preventDefault();
		var quantity = $('#quantity').val();
		if(quantity > 1){
			quantity--;
		}
		$('#quantity').val(quantity);
	});

});
</script>
</body>
</html>