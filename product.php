<?php

  include 'config.php';
  
  $con = mysqli_connect("localhost","$DB_USER","$DB_PASSWORD");  
  $db = mysqli_select_db($con,"$DB_NAME");  

  $product_id = $_GET['id'];
  $product_data = mysqli_query($con,"select * from products where id='".$product_id."'");

  $product = mysqli_fetch_assoc($product_data);

?>    

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- mobile metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="viewport" content="initial-scale=1, maximum-scale=1" />
    <!-- site metas -->
    <title>XYZ Jewellers</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/logo/Logo1.png" type="image/x-icon">
    <!-- Link Swiper's CSS -->
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css" />

    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css" />
    <!-- fevicon -->
    <link rel="icon" href="images/fevicon.png" type="image/gif" />
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
    <!-- Tweaks for older IEs-->
    <link
      rel="stylesheet"
      href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/
      libs/fancybox/2.1.5/jquery.fancybox.min.css"
      media="screen"
    />
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script
    ><![endif]-->
    <link rel="stylesheet" href="css/product.css" />
  </head>
  <!-- body -->
  <body class="main-layout" onload="removeMark()">
    <!-- loader  -->
    <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
    </div>
    <!-- end loader -->
    <!-- header-->
    <div class="header">
      <div class="logo">
        <a href="index.php"><img src="images/logo/Logo1.png" alt="#" /></a>
      </div>
      <a href="index.php">HOME</a>
    </div>
    <!-- end header-->

    <!-- Product section -->
    <div class="productSection">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img class="productImg" src="images/products/<?php echo $product['imageURL'];?>" alt="" />
          </div>
          <div class="col-md-6">
            <div class="contentBox">
              <h2><?php echo $product['name'];?></h2>
              <p>Product Code : <strong><?php echo $product['code'];?></strong></p>
              <p>For more detail Contact us on whatsapp :</p>
              <a target="_blank" href="<?php echo $product['whatsapp'];?>"><img src="images/whatsappIcon.png"></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <h2>Product details</h2>
            <table>
              <?php
                $productList = explode("#", $product['product_detail']);
                $i = 0;
                foreach ($productList as $productItem){
                  $productList[$i++] = explode(",", substr($productItem, 1, -1));
                }
                foreach ($productList as $productItem){
              ?>
              <tr>
                <td><?php echo $productItem[0];?></td>
                <td><?php echo $productItem[1];?></td>
              </tr>
              <?php }?>
            </table>
          </div>
          <div class="col-md-6">
            <div class="certificates">
              <h2>Certificates</h2>
              <p>
                Every piece of jewellery has been certified for
                purity/authenticity by BIS and International laboratories like
                IGI.
              </p>
              <a target="_blank" href="#">
                <img src="images/BIS-Logo.webp" alt="" />
              </a>
            </div>
            <a href="#">Product Policy</a>
          </div>
        </div>
      </div>
    </div>
    <!-- end Product section -->

    <!--  footer -->
    <footer>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2>MENU</h2>
              <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="index.php#gold">PRODUCT</a></li>
                <li><a href="index.php#about">ABOUT</a></li>
                <li><a href="index.php#contact">CONTACT</a></li>
              </ul>
            </div>
            <div class="col-md-6">
              <h2>Contact Us</h2>
              <ul>
                <li>
                  <span>Location :</span>
                  <a target="_blank" href="<?php echo $GMAP_URL; ?>"
                    ><i class="fas fa-map-marker-alt"></i> <?php echo $ADDRESS; ?>
                  </a>
                </li>
                <li>
                  <span>Call :</span>
                  <a href="tel:+91<?php echo $PHONE_NO;?>">
                    <i class="fas fa-phone-square-alt"></i> +91-<?php echo $PHONE_NO;?>
                  </a>
                </li>
                <li>
                  <span>Email :</span>
                  <a href="mailto:<?php echo $EMAIL;?>">
                    <i class="fas fa-envelope"></i>
                    <?php echo $EMAIL;?>
                  </a>
                </li>
                <li class="social-links">
                  <a target="_blank" href="<?php echo $FACEBOOK;?>">
                    <i class="fab fa-facebook-square"></i>
                  </a>
                  <a target="_blank" href="<?php echo $INSTAGRAM;?>"><i class="fab fa-instagram-square"></i></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="copyright">
          <div class="container">
            <p style="font-size: 15px;">2020 XYZ Jewellers desinged by <a href="#"style="color: #ff0047;font-weight: 600;">CODERPRENEUR</a></p>
          </div>
        </div>
      </div>
    </footer>
     <!-- end footer -->
    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/plugin.js"></script>
    <!-- sidebar -->1
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script>
         function removeMark(){
            document.querySelector('img[alt="www.000webhost.com"]').style = "display: none;";        
        }

    </script>
  </body>
</html>
