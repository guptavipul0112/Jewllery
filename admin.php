<?php  
include 'config.php';

// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("Location: $LOGIN_URL");
    exit;
}

$con = mysqli_connect("localhost","$DB_USER","$DB_PASSWORD");  
$db = mysqli_select_db($con,"$DB_NAME");  

$query = "select * from products";
$data = mysqli_query($con,$query);
$gallery_image_data = mysqli_query($con,"select * from gallery");
$rate_data = mysqli_query($con,"select * from rates");

?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="images/logo/Logo1.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Admin</title>
    <style>
      *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        /* border: 1px solid #fff; */
      }
      body{
        padding: 50px 10px;
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        background-color: #222;
        color: #fff;
      }
      hr{
        background-color: #555;
        height: 4px;
        border-radius: 4px;   
      }
      .result_section{
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
      }
      .table{
        display: block;
        overflow-x: scroll;
        scroll-behavior: smooth;
        width: fit-content;
      }
      .table::-webkit-scrollbar {
        /* width: 13px; */
        height: 8px;
        padding: 2px 0;
        background-color: transparent;
      }
      .table::-webkit-scrollbar-button{
        /* width: 20px; */
        width: 1px;
        background-color: transparent;
      }
      .table::-webkit-scrollbar-track{
        /* width: 50px; */
        background-color: transparent;
      }
      .table::-webkit-scrollbar-track-piece{
        /* width: 0px; */
        background-color: transparent;
      }
      .table::-webkit-scrollbar-thumb{
        /* width: 5px; */
        height: 5px;
        background-color: #323232;
        border-radius: 7px;
        border: 0.5px solid rgba(225, 225, 225, 0.4);
        border-bottom: none;
        border-right: none;
        box-shadow: 0 0 2px rgba(225, 225, 225, 0.3);
      }
      .table::-webkit-scrollbar-corner{
        display: none;
      }
      h1,h2{
        text-align: center;
        margin: 30px;
      }
      label{
        font-size: 14px;
        font-weight: 600;
        margin-left: 10px;
      }
      form{
        position: relative;
        max-width: 600px; 
      }
      select{
        color: #000;
      }
      option{
        color: #000;
      }
      .logOut{
        display: flex;
        justify-content: center;
        align-items: center;
        align-self: center;
      }
      .slideshow_section{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
      }
      .slideshow{
        position: relative;
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        height: 70vh;
        overflow-y: scroll;
        justify-content: center;
        align-items: center;
        background-color: #333;
        box-shadow: inset 0 0 20px rgba(0, 0, 0, 0.4),
                    0 0 20px rgba(225, 225, 225, 0.4),;
      }
      .slideshow p{
        position: absolute;
        top: 10px;
        left: 15px;
        color: #fff;
        z-index: 3;
      }
      .slideshow img{
        position: relative;
        width: 400px;
        margin: 10px;
      }
      .table-responsive{
        display: flex;
        justify-content: center;    
      }
    .goldRates{
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .goldRates form{
        flex:1;
    }
    .form-check {
        padding: 1.25rem;
    }
      </style>
  </head>
  <body onload="removeMark()">
    <h1>Welcome Admin!!</h1>
    <form class="logOut" action="form/logout.php" method="post">
      <input class="btn btn-primary" name="log_out" type="submit" value="Log Out">
    </form>
    <hr>
    <div class="goldRates">
      <form class="formContainer" method="post" action="server.php" enctype="multipart/form-data" autocomplete="off">
        <h1>Update Rate</h1>
        <?php 
            while($rate=mysqli_fetch_assoc($rate_data)){ 
                if($rate['type'] == "visible"){ ?>
                <div class="input form-check">
                    <input style="width: 25px; height: 25px;" type="checkbox" class="form-check-input" name="r<?php echo $rate['id'];?>" 
                    <?php if($rate['value'] == "true"){
                        echo "checked";            
                    }?> />
                    <label style="font-size: 20px" class="form-check-label"><?php echo $rate['type'];?></label>
                </div>    
                <?php } else{ ?>
                <div class="input form-group">
                    <label><?php echo $rate['type'];?></label><br>
                    <input type="text" class="form-control" name="r<?php echo $rate['id'];?>" value="<?php echo $rate['value'];?>" required />
                </div>
                <?php } } ?>    
        <input type="submit" name="submitTOupdateRate" class="btn btn-primary" value="UPDATE" />
      </form>
    </div>
    <div class="result_section">
      <h2>Product List</h2>
      <div class="table-responsive">
      <table class="table table-dark table-striped table-bordered">
        <tr>
          <th>id</th>
          <th>Product Code</th>
          <th>Name</th>
          <th>Category</th>
          <th>Product Detail</th>
          <th>Image</th>
        </tr>
        <?php
          while($rows=mysqli_fetch_assoc($data)){          
        ?>
        <tr>
          <td><?php echo $rows['id']; ?></td>
          <td><?php echo $rows['code']; ?></td>
          <td><?php echo $rows['name']; ?></td>
          <td><?php echo $rows['category']; ?></td>
          <td><?php echo str_replace(")","",str_replace("(","",str_replace(","," : ",str_replace("#","<br>",$rows['product_detail']))));?></td>
          <td><img src="images/products/<?php echo $rows['imageURL'];?>" width="100"/></td>
        </tr>
        <?php } ?>
      </table>

      </div>
      <form class="formContainer" onsubmit="if(document.getElementById('productDetail').value == ''){ alert('Please add product details !! '); return false;}" method="post" action="server.php" enctype="multipart/form-data" autocomplete="off">
        <h1>Add new product</h1>

        <div class="input form-group">
          <label>Name</label><br>
          <input class="form-control" name="name" type="text" required/>
        </div>
        
        <div class="input form-group">
          <label>Code</label><br>
          <input class="form-control" name="code" type="text" required/>
        </div>
        
        <div class="input form-group">
          <label>Category</label><br>
          <select class="form-control" name="category" required>
              <option>Gold</option>
              <option>Silver</option>
              <option>Other</option>
          </select>
        </div>
        
        <div class="input form-group">
          <label>Product_detail</label><br>
          <input type="text" id="productDetail" name="productDetail" hidden>
          <table id="productList" class="table table-dark table-striped table-bordered">
              <tr>
                <td>Name</td>
                <td>Value</td>
                <td></td>
              </tr>
              <tr>
                <td><input class="form-control" id="productDetailname" type="text"></td>
                <td><input class="form-control" id="productDetailvalue" type="text"></td>
                <td><button class="btn btn-primary" onclick="addItemToProductList()">ADD</button></td>
              </tr>
          </table>
        </div>
        
        <div class="input form-group">
          <label>Image</label><br>
          <div class="custom-file" style="transform: translateX(-5px);">
            <label class="custom-file-label">Choose Image</label>
            <input type="file" class="custom-file-input" name="image" id="customFile" required />
          </div>
        </div>
        
        <input type="submit" name="submitTOinsert" class="btn btn-primary" value="INSERT" />
      </form>

      <form action="server.php" method="post" onsubmit="if(!confirm('Are you sure you want to delete this record?')){return false;}">
        <h1>Delete Product</h1>
        <div class="input form-group">
          <label>ID</label><br>
          <input class="form-control" name="id" type="text" required/>
        </div>
        <input type="submit" name="submitTOdelete" class="btn btn-primary" value="DELETE" />
      </form>
    </div>
    <br><br><hr>

    <!-- Gallery -->
    <div class="slideshow_section">
      <h1>Gallery Images</h1>
      <div class="slideshow">
        <?php
          while($rows_gallery_image=mysqli_fetch_assoc($gallery_image_data)){          
        ?>
          <div style="position: relative;">
            <p><?php echo $rows_gallery_image['id']; ?></p>
            <img src="images/gallery/<?php echo $rows_gallery_image['filename'];?>">
          </div>           
        <?php } ?>
      </div>  
      <!-- Add new image -->
      <form class="formContainer" method="post" action="server.php" enctype="multipart/form-data" autocomplete="off">
        <h1>Add new image</h1>
          <div class="input form-group">
            <label>Image</label><br>
            <div class="custom-file" style="transform: translateX(-5px);">
              <label class="custom-file-label">Choose Image</label>
              <input type="file" class="custom-file-input" name="gallery_image" id="customFile" required />
            </div>
          </div>        
        <input type="submit" name="submitTOupload" class="btn btn-primary" value="UPLOAD" />
      </form>
      <!-- Update image -->
      <form class="formContainer" method="post" action="server.php" enctype="multipart/form-data" autocomplete="off">
        <h1>Update image</h1>
        <div class="input form-group">
          <label>ID</label><br>
          <input class="form-control" name="imageid" type="number" min="1" required/>
        </div>        
        <div class="input form-group">
          <label>Image</label><br>
          <div class="custom-file" style="transform: translateX(-5px);">
            <label class="custom-file-label">Choose Image</label>
            <input type="file" class="custom-file-input" name="gallery_image" id="customFile" required />
          </div>
        </div>
        <input type="submit" name="submitTOupdateimage" class="btn btn-primary" value="UPDATE" />
      </form>
      <!-- Delete image -->
      <form class="formContainer" method="post" action="gallery.php" enctype="multipart/form-data" autocomplete="off" onsubmit="if(!confirm('Are you sure you want to delete this image?')){return false;}">
        <h1>Delete image</h1>
        <div class="input form-group">
          <label>ID</label><br>
          <input class="form-control" name="imageidTodelete" type="number" min="1" required/>
        </div>
        <input type="submit" name="submitTOdeleteimage" class="btn btn-primary" value="DELETE" />
      </form>
    </div>
    <hr>
<script>

// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

function addItemToProductList(){
    const productDetailInput = document.querySelector("#productDetail");
    const productList = document.querySelector("#productList");
    let name = productList.querySelector("tr #productDetailname").value;
    let value = productList.querySelector("tr #productDetailvalue").value;
    if(name != "" && value != ""){

        productList.innerHTML += `<tr>
                                    <td>${name}</td>
                                    <td>${value}</td>
                                    <td></td>
                                  </tr>`;
        productDetailInput.value += "("+ name + "," + value + ")#";
    }
    else{
        alert('fill all details');
    }
}

function removeMark(){
  if(document.querySelector('img[alt="www.000webhost.com"]')){
    document.querySelector('img[alt="www.000webhost.com"]').style = "display: none;";        
  }
}


</script>
</body>
</html>
