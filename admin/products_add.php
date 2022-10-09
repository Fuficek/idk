<?php
	include 'includes/session.php';
	include 'includes/slugify.php';

	if(isset($_POST['add'])){
		$name = $_POST['name'];
		$slug = slugify($name);
		$category = $_POST['category'];
		$price = $_POST['price'];
		$description = $_POST['description'];
		$filename = $_FILES['photo']['name'];
		$filename_two = $_FILES['photo_two']['name'];
		$filename_three = $_FILES['photo_three']['name'];
		$filename_four = $_FILES['photo_four']['name'];
		$filename_blob = $_FILES['photo_blob']['name'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM products WHERE slug=:slug");
		$stmt->execute(['slug'=>$slug]);
		$row = $stmt->fetch();

		if($row['numrows'] > 0){
			$_SESSION['error'] = 'Product already exist';
		}
		else{
			if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename = $slug.'.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
			}
			else{
				$new_filename = '';
			}
			if(!empty($filename_two)){
				$ext = pathinfo($filename_two, PATHINFO_EXTENSION);
				$new_filename_two = $slug.'2.'.$ext;
				move_uploaded_file($_FILES['photo_two']['tmp_name'], '../images/'.$new_filename_two);	
			}
			else{
				$new_filename_two = '';
			}
			if(!empty($filename_three)){
				$ext = pathinfo($filename_three, PATHINFO_EXTENSION);
				$new_filename_three = $slug.'3.'.$ext;
				move_uploaded_file($_FILES['photo_three']['tmp_name'], '../images/'.$new_filename_three);	
			}
			else{
				$new_filename_three = '';
			}
			if(!empty($filename_four)){
				$ext = pathinfo($filename_four, PATHINFO_EXTENSION);
				$new_filename_four = $slug.'4.'.$ext;
				move_uploaded_file($_FILES['photo_four']['tmp_name'], '../images/'.$new_filename_four);	
			}
			else{
				$new_filename_four = '';
			}
			if(!empty($filename_blob)){
				$ext = pathinfo($filename_blob, PATHINFO_EXTENSION);
				$new_filename_blob = $slug.'blob.'.$ext;
				move_uploaded_file($_FILES['photo_blob']['tmp_name'], '../images/'.$new_filename_blob);	
			}
			else{
				$new_filename_blob = '';
			}

			try{
				$stmt = $conn->prepare("INSERT INTO products (category_id, name, description, slug, price, photo, photo_two, photo_three, photo_four, photo_blob) VALUES (:category, :name, :description, :slug, :price, :photo, :photo_two, :photo_three, :photo_four, :photo_blob)");
				$stmt->execute(['category'=>$category, 'name'=>$name, 'description'=>$description, 'slug'=>$slug, 'price'=>$price, 'photo'=>$new_filename, 'photo_two'=>$new_filename_two, 'photo_three'=>$new_filename_three, 'photo_four'=>$new_filename_four, 'photo_blob'=>$new_filename_blob]);
				$_SESSION['success'] = 'User added successfully';

			}
			catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up product form first';
	}

	header('location: products.php');

?>