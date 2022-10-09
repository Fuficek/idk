<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$id = $_POST['id'];
		$filename = $_FILES['photo']['name'];

		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT * FROM products WHERE id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();

		if(!empty($filename)){
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$new_filename = $slug.'1.'.$ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$new_filename);	
			}
		try{
			$stmt = $conn->prepare("UPDATE products SET photo=:photo WHERE id=:id");
			$stmt->execute(['photo'=>$new_filename, 'id'=>$id]);
			$_SESSION['success'] = 'Product photo updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		if(!empty($filename2)){
				$ext = pathinfo($filename2, PATHINFO_EXTENSION);
				$new_filename2 = $slug.'2.'.$ext;
				move_uploaded_file($_FILES['photo_two']['tmp_name'], '../images/'.$new_filename2);	
			}

		if(!empty($filename3)){
				$ext = pathinfo($filename3, PATHINFO_EXTENSION);
				$new_filename3 = $slug.'3.'.$ext;
				move_uploaded_file($_FILES['photo_three']['tmp_name'], '../images/'.$new_filename3);	
			}

		if(!empty($filename4)){
				$ext = pathinfo($filename4, PATHINFO_EXTENSION);
				$new_filename4 = $slug.'4.'.$ext;
				move_uploaded_file($_FILES['photo_four']['tmp_name'], '../images/'.$new_filename4);	
			}
		if(!empty($filenameblob)){
				$ext = pathinfo($filenameblob, PATHINFO_EXTENSION);
				$new_filenameblob = $slug.'blob.'.$ext;
				move_uploaded_file($_FILES['photo_blob']['tmp_name'], '../images/'.$new_filenameblob);	
			}
		
		try{
			$stmt = $conn->prepare("UPDATE products SET photo=:photo WHERE id=:id");
			$stmt->execute(['photo'=>$new_filename, 'id'=>$id]);
			$_SESSION['success'] = 'Product photo updated successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = $e->getMessage();
		}

		$pdo->close();

	}
	else{
		$_SESSION['error'] = 'Select product to update photo first';
	}

	header('location: products.php');
?>