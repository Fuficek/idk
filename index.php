<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>
    
    <section class="section">
        <div class="slider">
            <div class="slide">
                <input type="radio" name="radio-btn" id="radio1">
                <input type="radio" name="radio-btn" id="radio2">
                <input type="radio" name="radio-btn" id="radio3">

                <div class="st first">
                    <img alt="Fotka banneru - Nike Air Jordan 1 LOW" src="IMG/Banners/650pLOW.png">
                </div>

                <div class="st">
                    <img alt="Fotka banneru - Nike Air Jordan 1 HIGH" src="IMG/Banners/650pHIGH.png">
                </div>

                <div class="st">
                    <img alt="Fotka banneru - Nike Dunk" src="IMG/Banners/ChunkyDunkyBanner.png">
                </div>

                <div class="nav-auto">
                    <div class="a-b1"></div>
                    <div class="a-b2"></div>
                    <div class="a-b3"></div>
                </div>
                <div class="nav-m">
                    <label for="radio1" class="m-btn"></label>
                    <label for="radio2" class="m-btn"></label>
                    <label for="radio3" class="m-btn"></label>
                </div>
            </div>
        </div>
    </section>

    <h1 class="nazev-kategorie">Nově vydáno</h1>
    <p class="podtext">
        Zde najdete nově vydanou obuv, včetně bot které připravujeme.
    </p>

        <div class="horizontal-scroll">
            <div class="horiz-box">
                <img src="IMG/Air1Jordan-Thumbnails/Bleached.webp" class="horiz-box-fotka">
            </div>
            <div class="horiz-box">
                <img src="IMG/Air1Jordan-Thumbnails/Bleached.webp" class="horiz-box-fotka">
            </div>
            <div class="horiz-box">
                <img src="IMG/Air1Jordan-Thumbnails/Bleached.webp" class="horiz-box-fotka">
            </div>
            <div class="horiz-box">
                <img src="IMG/Air1Jordan-Thumbnails/Bleached.webp" class="horiz-box-fotka">
            </div>
            <div class="horiz-box">
                <img src="IMG/Air1Jordan-Thumbnails/Bleached.webp" class="horiz-box-fotka">
            </div>
        </div>

        <script type="text/javascript">
        var counter=1;
        setInterval(function(){
            document.getElementById('radio' + counter).checked=true;
            counter++;
            if(counter > 3){
                counter = 1;
            }
        },9000);
    </script>
    <div class="mezera"></div>

		       		<?php
		       			$month = date('m');
		       			$conn = $pdo->open();

		       			try{
		       			 	$inc = 3;	
						    $stmt = $conn->prepare("SELECT *, SUM(quantity) AS total_qty FROM details LEFT JOIN sales ON sales.id=details.sales_id LEFT JOIN products ON products.id=details.product_id WHERE MONTH(sales_date) = '$month' GROUP BY details.product_id ORDER BY total_qty DESC LIMIT 6");
						    $stmt->execute();
						    foreach ($stmt as $row) {
						    	$image = (!empty($row['photo'])) ? 'images/'.$row['photo'] : 'images/noimage.jpg';
						    	$inc = ($inc == 3) ? 1 : $inc + 1;
	       						if($inc == 1) echo "<div class='row'>";
	       						echo "
	       							<div class='col-sm-4'>
	       								<div class='box box-solid'>
		       								<div class='box-body prod-body'>
		       									<img src='".$image."' width='100%' height='230px' class='thumbnail'>
		       									<h5><a href='product.php?product=".$row['slug']."'>".$row['name']."</a></h5>
		       								</div>
		       								<div class='box-footer'>
		       									<b>&#36; ".number_format($row['price'], 2)."</b>
		       								</div>
	       								</div>
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
	        </div>
	      </section>
	     
	    </div>
	  </div>
  
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
</body>
</html>