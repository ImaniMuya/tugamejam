<!-- Home -->
<?php include("checklogin.php")?>

<html>
  <head>
      <title>Game Jam</title>
      <link rel="stylesheet" type="text/css" href="index.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include("nav.php"); ?>
    <div class="cover flex_col">
    <!-- <div id="slideshow">
      <img src="images/slideshow/firstplace.jpg"/>
      <img src="images/slideshow/secondplace.jpg"/>
      <img src="images/slideshow/thirdplace.jpg"/>
    </div -->
    <span class="heading"><strong>GAME JAM: SPRING 2020</strong></span>
    <span class="detailsheading">March 12 - 14</span>
    <?php 
        // if($isloggedin){
        //   print "<span class='detailsheading' ><a href='teammembers'>Go to team page</a></span>";
        // } else {
        //   print "<span class='detailsheading' ><a href='register'>Register Your Team!</a></span>";
        // }
      ?>    
    </div>
    <?php include("carousel.php")?>
  </body>
</html>

<script>
 function togglenav() {
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked')
                        
}
</script>