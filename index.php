<!-- Home -->
<?php include("timecodes.php"); ?>
<?php include("checklogin/index.php"); ?>



<html>
  <head>
      <title>Game Jam</title>
      <link rel="stylesheet" type="text/css" href="index.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include("nav.php"); ?>
    <div class="cover flex_col">
      <span class="heading"><strong>GAME JAM: SPRING 2020</strong></span>
      <span class="detailsheading ">March 12 - 14</span>
      <?php
        if($time > $tsBegin && $time < $tsEnd) {
          if($isloggedin){
            print "<span class='detailsheading' ><a href='teammembers'>Go to team page</a></span>";
          } else {
            print "<span class='detailsheading' ><a href='register'>Register Your Team!</a></span>";
          }
        }
        else if($time < $tsBegin || $time > $tsEnd) {
            // change out to use previous event paths
            print "<div class='detailsheading pt50'>Congratulations to our Spring 2019 winners</div>";
            print "<div class='flex_col pb'>";
            print "<ol><li class='white'>Bad Guy Simulator: The Heist by Edric Yu, Ryan Jones, Noah Lindsey (:(){ :|: & };:)</li>";
            print "<li class='white'>Gone Rogue by Zachary Winters and Connor Salter (MooBar)</li>";
            print "<li class='white'>Mech Heist by David Nurkkala (#1 Victory Royale)</li></ol>";
            print "<div class='flex_row standings'>";
            print "<div class='winnerpic' style='background-image: url(\"images/firstplace.jpg\");'></div>";
            print "<div class='winnerpic' style='background-image: url(\"images/secondplace.jpg\");'></div>";
            print "<div class='winnerpic' style='background-image: url(\"images/thirdplace.jpg\");'></div>";
            print "</div>";
            print "<div class='text flex_col' style='color: white;'> Superlative awards:";
            print "<ul><li class='white'>Best Writing and Best Art Awards: Man in the Van by Luke Brom, Tim Ours, Imani Muya, Caitlin Gaff (ILTC...Do you?)</li>";
            print "<li class='white'>Best Innovation Award: Heist by Scotti Bozarth, Alex Wardlow, Robert Swanson (Vicious Rabbit)</li></ul>";
            print "</div>";
            print "<div class='white'>click here to see the full event</div>";
            print "<br/>";
            print "</div>";
  
        }
      ?>  
    </div>
  </body>
</html>

<script>
 function togglenav() {
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked')                        
}
</script>