<?php
$server = "wm49.wedos.net";
$username = "neco";
$password = "neco";
$database = "d5925_slovnik";
$table = "obrazky2";

$a  = $_POST['a'];
$fname = $a;


$db = new mysqli($server, $username, $password,$database);

$status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            echo "OK";
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database  
            //$insert = $db->query("INSERT into obrazky2 ( popis) VALUES ( 'ahoj')"); 
            $insert = $db->query("INSERT into obrazky2 (obr, popis) VALUES ('$imgContent', '$fname')");
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
    echo $statusMsg;

?>