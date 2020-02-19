<html>
  <head>
      <title>Game Jam</title>
      <link rel = "stylesheet" type = "text/css" href = "../index.css" />
      <link rel = "stylesheet" type = "text/css" href = "carasoule.css" />
      <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
  <body>
    <?php include("../nav.php"); ?>
    <div class="header flex_col">
      <span class="heading"><strong>GAME JAM: SPRING 2019</strong></span>
      <span class="detailsheading">April 4-6. The theme was "heist". 20 participants on 8 teams.</span>
    </div>
    <div class="section flex_col">
      <span class="title"><strong>Winners!</strong></span>
      <div class="winnerimgscont">
        <div><img class="winnerpic" src="../images/firstplace.jpg"/></div>
        <div><img class="winnerpic" src="../images/secondplace.jpg"/></div>
        <div ><img class="winnerpic" src="../images/thirdplace.jpg"/></div>
      </div>
      <div class="sectiontext">
      </br>
        <p>Congratulations to the winning teams!</p>
        <p>1. <strong>Bad Guy Simulator: The Heist</strong> by Edric Yu, Ryan Jones, Noah Lindsey (:(){ :|: & };:)</p>
        <p>2. <strong>Gone Rogue</strong> by Zachary Winters and Connor Salter (MooBar)</p>
        <p>3. <strong>Mech Heist</strong> by David Nurkkala (#1 Victory Royale)</p>
      </br>
      </br>
        <p>Superlative Awards go to:</p>
        <p>Best Writing and Best Art Awards: <strong>Man in the Van</strong></p>
        <p class="tabbed">by Luke Brom, Tim Ours, Imani Muya, Caitlin Gaff (ILTC...Do you?)</p>
        <p>Best Innovation Award: <strong>Heist</strong> by Scotti Bozarth, Alex Wardlow, Robert Swanson (Vicious Rabbit)</p>
      </div>
    </div>
    <div class="section flex_col">
      <span class="title"><strong>Pictures!</strong></span>
      <?php $event="s2019"; include("carasoule.php"); ?>    
    </div>
    <div class="section flex_right">
      <span class="title"><strong>Teams!</strong></span>
      <span class="detailsteam ml">The list below shows each team along with its members and the name, summary, and a screenshot of their game.
      </span>
      <div class="team">
        <div class="teamimg"><img src="img0.png"/></div>
        <div class="teaminfo">
          <span class="s30">gfxcoder</span>
          <table class="detailsteam">
          <tr>
            <td>Game</td>
            <td>:</td>
            <td>Cat Thief</td>
          </tr>
          <tr>
            <td>Summary</td>
            <td>:</td>
            <td>a ancient gem was stolen from you. You have to steal it back. 
              They say two wrong don't make a right but what should you do?</td>
          </tr>
          <tr>
            <td>Playing</td>
            <td>:</td>
            <td>just play</td>
          </tr>
          <tr>
            <td>Submission</td>
            <td>:</td>
            <td><a>Zip</a></td>
          </tr>
          <tr>
            <td>URL</td>
            <td>:</td>
            <td><a>link</a></td>
          </tr>
          <tr>
            <td>Downloads</td>
            <td>:</td>
            <td>10</td>
          </tr>
          <tr>
            <td>Members</td>
            <td>:</td>
            <td>Dr. Denning, Linus Denning, Samuel Denning</td>
          </tr>
        </table>
        </div>
        </div>
        <div class="team">
          <div class="teamimg"><img src="tempsquare.jpg"/></div>
          <div class="teaminfo">
          <span class="s30">Joseph the Broseph</span>
          <table class="detailsteam">
          <tr>
            <td>Game</td>
            <td>:</td>
            <td>Bunker Spelunker</td>
          </tr> 
          <tr>
            <td>Summary</td>
            <td>:</td>
            <td>Go into an underground vault and punch everything.</td>
          </tr>
          <tr>
            <td>Playing</td>
            <td>:</td>
            <td>WASD to move. Space to punch.</td>
          </tr>
          <tr>
            <td>Submission</td>
            <td>:</td>
            <td><a>Zip</a></td>
          </tr>
          <tr>
            <td>URL</td>
            <td>:</td>
            <td><a>link</a></td>
          </tr>
          <tr>
            <td>Downloads</td>
            <td>:</td>
            <td>10</td>
          </tr>
          <tr>
            <td>Members</td>
            <td>:</td>
            <td>Dr. Denning, Linus Denning, Samuel Denning</td>
          </tr>
        </table>
        </div>
    </div>
  </body>
</html>

<script>
 function togglenav() {                          
   document.getElementById('navcol').classList.toggle('tucked');
   document.getElementById('navicon').classList.toggle('tucked');                      
}

  function scaleWidth() {
    let cont = document.getElementsByClassName("section flex_col");

  }
</script>