<html>
<head>
  <link rel="stylesheet" type="text/css" href="flickity.css" />
  <link rel="stylesheet" type="text/css" href="index.css" />
  <script src="flickity.pkgd.js"></script>

  <style>
  /* external css: flickity.css */

  * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
  }

  body { font-family: sans-serif; }

  .gallery {
    background: #EEE;
  }

  .gallery-cell {
    width: 50%;
    height: 200px;
    margin-right: 10px;
    background: #8C8;
    counter-increment: gallery-cell;
  }

  /* cell number */
  .gallery-cell:before {
    display: block;
    text-align: center;
    content: counter(gallery-cell);
    line-height: 200px;
    font-size: 80px;
    color: white;
  }
  </style>
</head>

<body>
  <p><code>wrapAround: true</code></p>
  
  <!-- Flickity HTML init -->
  <div class="gallery js-flickity"
    data-flickity-options='{ "wrapAround": true }'>
    <div class="gallery-cell" style="background-image: url('images/firstplace.jpg');"></div>
    <div class="gallery-cell" style="background-image: url('images/secondplace.jpg');"></div>
    <div class="gallery-cell" style="background-image: url('images/thirdplace.jpg');"></div>
    <!-- <div class="gallery-cell"></div>
    <div class="gallery-cell"></div> -->
  </div> 
</body>
</html>
