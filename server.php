<?php 
include 'config.php';

$con = mysqli_connect("localhost","$DB_USER","$DB_PASSWORD");  
$db = mysqli_select_db($con,"$DB_NAME");  

if(isset($_POST['submitTOupdateRate'])){
    
    $r1 = $_POST['r1'];
    $r2 = $_POST['r2'];
    $r3 = $_POST['r3'];
    
    mysqli_query($con, "UPDATE rates SET value='$r1' WHERE id='1'");
    mysqli_query($con, "UPDATE rates SET value='$r2' WHERE id='2'");
    mysqli_query($con, "UPDATE rates SET value='$r3' WHERE id='3'");
    
    header("Location: $ADMIN_URL");
}


if(isset($_POST['submit'])){    
   
    $to = $SERVER_TO_EMAIL; // this is your Email address
    $from = $_POST['Email']; // email
    $subject = "Website Email message";  //message
    $sender = $_POST["Name"];   //name
    $senderPhone = $_POST["PhoneNumber"];     //mobile
    $comment = $_POST['Message'];

    $message = $sender . " , " . $senderPhone . ", wrote the following:" . "\n\n" . $comment;
    $query = "insert into form_data (name,phone,email,message) values ('$sender','$senderPhone','$from','$comment')";
    
    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    // echo "$to,$subject,$message,$headers";
    mail($to,$subject,$message,$headers);
    
    mysqli_query($con,$query);
    
    header("Location: $MAIN_URL");
}

//inserting new records
if(isset($_POST['submitTOinsert'])){    
    
    //taking input from form 
    $name = $_POST['name'];
    $code = $_POST['code'];  
    $category = $_POST['category'];  
    $productDetail = $_POST['productDetail'];
    $productDetail = substr($productDetail, 0, -1);
    $whatsapp = "https://api.whatsapp.com/send?phone=+919405233609&text=Hey, I want to buy $name - (Product Code = $code)&";

	$filename = $_FILES["image"]["name"]; 
	$tempname = $_FILES["image"]["tmp_name"];	 
	$folder = "images/products/".$filename; 	


    //creating query
    
    $query = "INSERT INTO `products` (`id`, `code`, `name`, `category`, `imageURL`, `whatsapp`, `product_detail`) VALUES (NULL, '$code', '$name', '$category', '$filename', '$whatsapp', '$productDetail')";

    //firing query
    mysqli_query($con, $query);
    
	// Now let's move the uploaded image into the folder: image 
    if (move_uploaded_file($tempname, $folder)) { 
        // echo "Image uploaded successfully"; 
    }else{ 
        // echo "Failed to upload image"; 
    } 
  
    header("Location: $ADMIN_URL");
} 

//deleting records corresponding to id
if(isset($_POST['submitTOdelete'])){    

    $id = $_POST['id']; 

    $delQuery = " DELETE FROM `products` WHERE `products`.`id` = $id";
   
    mysqli_query($con, $delQuery);

    // PHP program to delete image 
    $file_path = "images/products/".$ItemTodelete['filename']; 
    unlink($file_path);      

    header("Location: $ADMIN_URL");
}

//uploading Slideshow images
if(isset($_POST['submitTOupload'])){    
    
    //checking connection
    if($con){
        // echo "sucess";    
    }else{
        header("Location: $ADMIN_URL");
        // echo "failed";
    }

    //taking input from form 
	$filename = $_FILES["gallery_image"]["name"]; 
	$tempname = $_FILES["gallery_image"]["tmp_name"];	 
	$folder = "images/gallery/".$filename; 	
    
    mysqli_query($con,"INSERT INTO `gallery` (`id`, `filename`) VALUES (NULL, '$filename')");
    // echo $filename;

	// Now let's move the uploaded image into the folder: image 
    if (move_uploaded_file($tempname, $folder)) { 
        // echo "Image uploaded successfully"; 
    }else{ 
        // echo "Failed to upload image"; 
    } 
  
    header("Location: $ADMIN_URL");
} 

//Updating slideshow images ...
if(isset($_POST['submitTOupdateimage'])){    
    
    //checking connection
    if($con){
        // echo "sucess";    
    }else{
        // echo "failed";
    }

    //taking input from form 
    $id = $_POST['imageid'];
	$filename = $_FILES["gallery_image"]["name"]; 
	$tempname = $_FILES["gallery_image"]["tmp_name"];	 
	$folder = "images/gallery/".$filename; 	
    
    $resultQue = mysqli_query($con,"UPDATE gallery SET filename='$filename' WHERE id='$id'");
    
    if($resultQue){
        // echo "sucess ".$resultQue;
    }
    else{
        // echo "failed ".$con->error;
    }

	// Now let's move the uploaded image into the folder: image 
    if (move_uploaded_file($tempname, $folder)) { 
        // echo "Image uploaded successfully"; 
    }else{ 
        // echo "Failed to upload image"; 
    } 
  
    header("Location: $ADMIN_URL");
} 

//deleting slideshow images corresponding to id
if(isset($_POST['submitTOdeleteimage'])){    

    $id = $_POST['imageidTodelete']; 

    $delImageQuery = "DELETE FROM `gallery` WHERE `gallery`.`id` = $id";
   
    mysqli_query($con, $delImageQuery);    
    // PHP program to delete image 
    $file_path = "images/gallery/".$ItemTodelete['filename']; 
    unlink($file_path);  

    header("Location: $ADMIN_URL");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    
    <h1>Error: 404</h1>
    <h2>Page Not Found</h2>

</body>
</html>