<div class="container">
  <div class="slider">
    <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav"/>
    <input type="radio" name="slider" title="slide2" class="slider__nav"/>
    <input type="radio" name="slider" title="slide3" class="slider__nav"/>
    <input type="radio" name="slider" title="slide4" class="slider__nav"/>

    <div class="slider__inner">
      <?php

$files = scandir("../images/" . $event . "/");
echo "<!-- count = " . count($files) . " -->\n";
if(count($files) <= 1) {
    // ignore ..
    //echo '<div>To be added soon...</div>';
} else {
    $count = 0;
    $pagecount = 0;
    foreach($files as $k => $v) {
        $i = strpos($v, ".small.jpg");
        if($i === false) {
            // $v is the large image; skip it!
            continue;
        }
        if($count == 0) {
            print("<div class=\"slider__contents\">\n");
            $pagecount++;
        }
        $p = substr($v, 0, $i);
        print("<div class=\"slider__image\">");
        print("<a href=\"images/" . $event . "/" . $p . "\">");
        print("<img src=\"images/" . $event . "/" . $v . "\"/>");
        print("</a>");
        print("</div>\n");
        $count = ($count + 1) % 8;
        if($count == 0) {
            print("</div>\n");
            if($pagecount == 4) break;
        }
    }
    if($count != 0) {
        print("</div>\n");
    }
}

      ?>
</div>