var duration = 15;
var timer = 50;
var fadespeed = 0.02;

var ss  = document.getElementById("slideshow");
var ssimgs = ss.children;
var imagecount = ssimgs.length;
ss.innerHTML = ss.innerHTML + '<div id="slideshow1"></div><div id="slideshow2"></div>';
var ss1 = document.getElementById("slideshow1");
var ss2 = document.getElementById("slideshow2");

var load = 0;
var ver = 0;
var opacity = 0.0;
var time = 0;
var prevrad = 3.141;

function loadnext() {
    var ssn = ver < 0.5 ? ss2 : ss1;
    ssn.style.backgroundImage = "url(" + ssimgs[load].getAttribute("src") + ")";
    ver = 1 - ver;
    load = (load + 1) % imagecount;
}

function handlefade() {
    var fadeto = (ver < 0.5) ? -0.1 : 1.1;
    opacity = opacity * (1 - fadespeed) + fadeto * fadespeed;
    if(opacity > 0.0 && opacity < 1.0) {
        setTimeout(handlefade, 10);
        ss1.style.webkitFilter = "blur(" + (20 * ( opacity)) + "px)";
        ss2.style.webkitFilter = "blur(" + (20 * (1.0 - opacity)) + "px)";
    } else {
        opacity = Math.min(1.0, Math.max(0.0, opacity));
        ss1.style.webkitFilter = "";
        ss2.style.webkitFilter = "";
    }
    ss1.style.opacity = "" + (1.0-opacity);
    ss2.style.opacity = "" + opacity;
}

function handleresize() {
    var h = ss.offsetWidth / 1000 * 300;
    ss.style.height = "" + h + "px";
    ss2.style.top = "-" + h + "px";
}

loadnext();
setInterval(function() {
    var rad = time * (3.1415 / 180.0) / duration;
    var p = 50 - Math.cos(rad) * 40;
    ss1.style.backgroundPosition = "50% " + p + "%";
    ss2.style.backgroundPosition = "50% " + p + "%";
    if(rad % 3.1415 < prevrad % 3.1415) {
        handlefade();
    } else if(p > 50 && ver > 0.5) {
        loadnext();
    } else if(p < 50 && ver < 0.5) {
        loadnext();
    }
    prevrad = rad;
    time += 1000 / timer;
}, timer);

handleresize();
window.addEventListener("resize", handleresize);
