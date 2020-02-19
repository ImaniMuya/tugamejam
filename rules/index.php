<!-- Rules -->
<html>
  <head>
      <title>Game Jam</title>
      <link rel = "stylesheet" type = "text/css" href = "../index.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    <?php include("../nav.php"); ?>
    <div class="header">
      <span class="bug">gamejam</span>
      <span class="headingS125"><strong>RULES</strong></span>      
    </div>
    <div class="flex_col">
      <div class="content flex_left">
        <p>Below are the rules of Game Jam</p>     ​
        <ul>
          <li>The GameJam is for Taylor University students and alumni only or by invitation.</li>
          <li>All game content must be created from scratch, except for music, sounds, and photos.  All used content must have appropriate license and be properly cited.</li>
          ​<li>Each team can have up to two programmers and an unlimited number of non-programming members.  Non-programming members can help with audio, images, stories, levels, etc, but they may not write code or scripts or program the gaming engine.</li>
          <li>We will have a soft start on Thursday at 6PM, where teams are registered, the theme is chosen, and game development may start except for coding (see clarification at end).  On Friday at 6PM, we will have a hard start.  No code written <emph>prior</emph> to the hard start can be used afterwards.  You are encouraged to practice before the hard start, but each team must start their code base over from scratch at the hard start.</li>
          <li>You may use any gaming engine or write your own!  Just be sure to provide instructions for running your game.  Engine code is the only exception to the no-code-before-hard-start rule above, however you must clear it with Dr. Denning first!</li>
          <li>Participation is free, but you must pay a competition fee in order to compete for the prizes and to consume the provided snacks and drinks.</li>
          <li>Each GameJam will have a particular theme.  How you integrate the theme into your game is up to you.</li>
          <li>The designated participation areas are Euler 217/218.</li>
        </ul>
      </div>
    </div>
  </body>
</html>

<script>
 function togglenav() {
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked')
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    /* Toggle between adding and removing the "active" class,
    to highlight the button that controls the panel */
    this.classList.toggle("active");

    /* Toggle between hiding and showing the active panel */
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}

</script>