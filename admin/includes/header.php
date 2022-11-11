<!DOCTYPE html>
<!-- Designined by CodingLab | www.youtube.com/codinglabyt -->
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <!--<title> Responsiive Admin Dashboard | CodingLab </title>-->
  <link rel="stylesheet" href="../css/style1.css">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
	<!-- Meta -->
	<meta charset="utf-8">
	<meta name="keywords" content="HTML5 Template" />
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Shop Home Page - PHP Ecommerce</title>

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon -->
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- CSS -->
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../js/isotope/isotope.css">
	<link rel="stylesheet" href="../js/flexslider/flexslider.css">
	<link rel="stylesheet" href="../js/owl-carousel/owl.carousel.css">
	<link rel="stylesheet" href="../js/owl-carousel/owl.theme.css">
	<link rel="stylesheet" href="../js/owl-carousel/owl.transitions.css">
	<link rel="stylesheet" href="../js/superfish/css/megafish.css" media="screen">
	<link rel="stylesheet" href="../js/superfish/css/superfish.css" media="screen">
	<link rel="stylesheet" href="../js/pikaday/pikaday.css">
	<link rel="stylesheet" href="../css/settings-panel.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/light.css">
	<link rel="stylesheet" href=".//css/responsive.css">

	<!-- JS Font Script -->
	<script src="http://use.edgefonts.net/bebas-neue.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<!-- Modernizer -->
	<script src="js/modernizr.custom.js"></script>

</head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <i class='fa fa-shopping-cart'></i>
      <span class="logo_name">myBasket</span>
    </div>
    <?php  $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); 
        ?>
    <ul class="nav-links">
      <li>
        <a href="index.php" <?php if($curPageName == "index.php") echo "class='active'"?> >
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="products.php" <?php if($curPageName == "products.php") echo "class='active'"?>>
          <i class='bx bx-box'></i>
          <span class="links_name" >Product</span>
        </a>
      </li>
      <li>
        <a href="orders.php" <?php if($curPageName == "orders.php") echo "class='active'"?>>
          <i class='bx bx-list-ul'></i>
          <span class="links_name">Order list</span>
        </a>
      </li>
      <li>
        <a href="categories.php" <?php if($curPageName == "categories.php") echo "class='active'"?>>
          <i class='bx bx-category'></i>
          <span class="links_name">Categories</span>
        </a>
      </li>
      <li>
        <a href="addproduct.php" <?php if($curPageName == "addproduct.php") echo "class='active'"?>>
          <i class='bx bx-coin-stack'></i>
          <span class="links_name">Add Product</span>
        </a>
      </li>
      <li>
        <a href="addcategory.php" <?php if($curPageName == "addcategory.php") echo "class='active'"?>>
          <i class='bx bxs-category'></i>
          <span class="links_name">Add Category</span>
        </a>
      </li>
      <li>
        <a href="customers.php" <?php if($curPageName == "customers.php") echo "class='active'"?>>
          <i class='bx bx-user'></i>
          <span class="links_name">Customers</span>
        </a>
      </li>
      <li>
        <a href="reviews.php" <?php if($curPageName == "reviews.php") echo "class='active'"?>>
          <i class='bx bx-message'></i>
          <span class="links_name">Reviews</span>
        </a>
      </li>
      
      <li class="log_out">
        <a href="logout.php">
          <i class='bx bx-log-out'></i>
          <span class="links_name">Log out</span>
        </a>
      </li>
    </ul>
  </div>