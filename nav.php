<?php include("checklogin.php"); ?>
<div id="navcol" class="tucked">
  <div id="navbtn" onclick="togglenav()">
    <div id="navicon" class="tucked">
        <div></div>
      </div>
    </div>
  <div class="navlinkcont">
    <span class="navlinks" class="openbracket"><a href="/~gamejamdev/wip">Home</a></span>
    <?php 
    // make case with time stamp
    if($isloggedin) {
      print "<span class='navlinks' class='openbracket'><a href='/~gamejamdev/teammembers'>My Team</a></span>";
    } 
    else {
      print "<span class='navlinks' class='openbracket'><a href='/~gamejamdev/register'>Register</a></span>";
    }
    ?>
    <span class="navlinks"><a href="/~gamejamdev/wip/rules">Rules</a></span>
    <span class="navlinks"><a href="/~gamejamdev/wip/resources">Resources</a></span>
    <span class="navlinks"><a href="/~gamejamdev/wip/events/f2019/">F2019</a></span>
    <!-- <div id=navdropdown class="navlinks"><a>Past Events</a>
      <div class="navdropdowncontent"><a href="/~gamejamdev/events/event_s2019.php">S2019</a></div>
      <div class="navdropdowncontent"><a>F2018</a></div>
      <div class="navdropdowncontent"><a>S2018</a></div>
      <div class="navdropdowncontent"><a>F2017</a></div>
      <div class="navdropdowncontent"><a>S2017</a></div>
      <div class="navdropdowncontent"><a>F2016</a></div>
    </div> -->
  </div>
</div>

<script>
 function togglenav() {                          
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked')
                        
}
</script>