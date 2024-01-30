<?php
   include 'config.php';

   session_start();

   $con = mysqli_connect("localhost","$DB_USER","$DB_PASSWORD");  
   $db = mysqli_select_db($con,"$DB_NAME");  

   $gold_products_data = mysqli_query($con,"select * from products where category='Gold'");
   $silver_products_data = mysqli_query($con,"select * from products where category='Silver'");
   $other_products_data = mysqli_query($con,"select * from products where category='Other'");

   $gallery_image_data = mysqli_query($con,"select * from gallery");

   $rate_data = mysqli_query($con, "select * from rates");
    
    
?>    

<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>XYZ Jewellers</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
        <link rel="shortcut icon" href="images/logo/Logo1.png" type="image/x-icon">
      <!-- Link Swiper's CSS -->
      <link
         rel="stylesheet"
         href="https://unpkg.com/swiper/swiper-bundle.min.css"
      />
      <!-- bootstrap css -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/style2.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/
      libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
   </head>
   <!-- body -->
   <body class="main-layout" onload="removeMark()">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <marquee class="rates">
          <?php while($rate=mysqli_fetch_assoc($rate_data)) {?>
          <span><?php echo $rate['type'];?>:  <i class="fas fa-rupee-sign"></i> <?php echo $rate['value'];?></span> 
          <?php } ?>
          </marquee>
      <header>
         <!-- header inner -->
         <div class="header-top">
            <div class="header">
               <div class="container">
                  <div class="row navbar">
                     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                        <div class="full">
                           <div class="center-desk">
                              <div class="logo">
                                 <a href="index.php"><img src="images/logo/Logo1.png" alt="#" /></a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 menu_section">
                        <div class="menu-area">
                           <div class="limit-box">
                              <nav class="main-menu">
                                 <ul class="menu-area-main">
                                    <li class="active"> <a href="index.php">Home</a> </li>
                                    <li> <a href="#about">About us</a> </li>
                                    <li> 
                                       <a href="#" class="dropdown-toggle" data-toggle="dropdown">jewellery</a>
                                       <div class="dropdown-menu">
                                          <a class="dropdown-item" href="#gold">gold</a>
                                          <a class="dropdown-item" href="#silver">silver</a>
                                          <a class="dropdown-item" href="#other">other</a>
                                       </div>                                      
                                    </li>
                                    <li> <a href="#contact">Contact</a> </li>
                                 </ul>
                              </nav>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- end header inner -->
            <!-- end header -->
            <section class="slider_section">
               <div class="banner_main">
                  <div class="container">
                     <div class="row d_flex">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 ">
                           <div class="text-bg">
                              <h1>XYZ Jewellers</h1>
                              <!-- <strong class="land_bold">SINCE 1975 </strong>-->
                              <a href="#contact">Contact Us</a>
                           </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                           <div class="text-img">
                              <figure><img src="images/img.webp" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
         </section>
         </div>
      </header>
      <div class="aboutUs" id="about">
         <h1>About Us</h1>
         <div class="container">
            <div class="row">
               <div class="col">
                  <p><span>XYZ Jewellers</span> <?php echo $DESCRIPTION;?> </p>
               </div>
               <div class="col">
                  <img src="images/showrrom.png" alt="">
               </div>
            </div>
         </div>
      </div>

      <!-- Best  -->
      <div class="categories_block" id="jewellery">
         <h1>Categories</h1>
         <div class="gold" id="gold">
            <h2>Gold</h2>
            <div class="cardBox">
               <?php
                  while($gold_rows_product=mysqli_fetch_assoc($gold_products_data)){ 
                    ?>
                     <a href="product.php?id=<?php echo $gold_rows_product['id'];?>">               
                        <div class="card">
                           <img src="images/products/<?php echo $gold_rows_product['imageURL'] ?>" alt="">
                           <h3><?php echo $gold_rows_product['name']?></h3>
                           <!--<p>some dummy details</p>-->
                        </div>
                     </a>   
               <?php }?>
            </div>   
         </div>
         <div class="silver" id="silver">
            <h2>Silver</h2>
            <div class="cardBox">
               <?php
                  while($silver_rows_product=mysqli_fetch_assoc($silver_products_data)){ 
                     ?>
                     <a href="product.php?id=<?php echo $silver_rows_product['id'];?>">               
                        <div class="card">
                           <img src="images/products/<?php echo $silver_rows_product['imageURL'] ?>" alt="">
                           <h3><?php echo $silver_rows_product['name']?></h3>
                           <!--<p>some dummy details</p>-->
                        </div>
                     </a>   
               <?php }?>
            </div>   
         </div>
         <div class="gift" id="other">
            <h2>Other</h2>
            <div class="cardBox">
               <?php
                  while($other_rows_product=mysqli_fetch_assoc($other_products_data)){ 
                     ?>
                     <a href="product.php?id=<?php echo $other_rows_product['id'];?>">               
                        <div class="card">
                           <img src="images/products/<?php echo $other_rows_product['imageURL'] ?>" alt="">
                           <h3><?php echo $other_rows_product['name']?></h3>
                           <!--<p>some dummy details</p>-->
                        </div>
                     </a>   
               <?php }?>
            </div>   
         </div>
      </div>
      <!-- end Best -->
      <!-- Gallery -->
      <section class="gallery" id="gallery">
         <h1>Gallery</h1>
         <div class="swiper-container">
            <div class="swiper-wrapper">
               <?php
                  while($rows_gallery_image=mysqli_fetch_assoc($gallery_image_data)){ 
               ?>
               <div class="swiper-slide">
                 <img src="images/gallery/<?php echo $rows_gallery_image['filename'];?>" alt="">
               </div>
               <?php }?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <!-- Add Arrows -->
            <div class="controls">
               <div class="swiper-button-prev"></div>
               <div class="swiper-button-next"></div>
            </div>
         </div>
      </section>
      <!-- end Gallery -->
      <!-- contact -->
      <div id="contact" class="contact">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Contact us</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                  <div class="contact">
                     <form method="post" action="server.php" >
                        <div class="row">
                           <div class="col-sm-12">
                              <input required class="contactus" placeholder="Name" type="text" name="Name">
                           </div>
                           <div class="col-sm-12">
                              <input required class="contactus" placeholder="Phone Number" type="text" name="PhoneNumber">
                           </div>
                           <div class="col-sm-12">
                              <input required class="contactus" placeholder="Email" type="email" name="Email">
                           </div>
                           <div class="col-sm-12">
                              <textarea class="textarea" required placeholder="Message" type="text" name="Message"></textarea>
                           </div>
                           <div class="col-sm-12">
                              <input class="send" name="submit" type="submit" value="Submit">
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12">
                  <div class="rable-box">
                     <figure>
                     <img src="images/cac.png" alt="#" />
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end contact -->
      <!--  footer -->
      <footer>
         <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
               <h2>MENU</h2>
               <ul>
                  <li><a href="index.php">HOME</a></li>
                  <li><a href="#gold">PRODUCT</a></li>
                  <li><a href="#about">ABOUT</a></li>
                  <li><a href="#contact">CONTACT</a></li>
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
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
      <!-- Swiper JS -->
      <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" ></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

      <!-- Initialize Swiper -->
      <script>
         // Initialize Swiper
         var swiper = new Swiper(".swiper-container", {
           loop: true,
           autoplay: {
             delay: 4000,
           },
           navigation: {
             nextEl: ".swiper-button-next",
             prevEl: ".swiper-button-prev",
           },
           pagination: {
             el: ".swiper-pagination",
           },
         });
       
        
        function removeMark(){
            if(document.querySelector('img[alt="www.000webhost.com"]')){
               document.querySelector('img[alt="www.000webhost.com"]').style = "display: none;";
            }        
        }
      </script>
    
   </body>
</html>