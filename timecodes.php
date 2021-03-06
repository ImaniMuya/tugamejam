<?php
$time = date("Y.m.d H:i");

$tsBegin     = '2020.03.11 17:55';
$tsVote      = '2020.03.12 18:05';
$tsSoftStart = '2020.03.12 18:35';
$tsHardStart = '2020.03.13 18:00';
$tsOver      = '2020.03.14 22:00';
$tsEnd       = '2020.03.15 23:30';

$KB = 1024;
$MB = 1024*$KB;
$GB = 1024*$MB;
$maxfilesz = 0*$GB + 850*$MB;

function getCurrentTimestamp() { return date('Y.m.d H:i'); }
function timestampBefore($ts) { return strcmp(getCurrentTimestamp(), $ts) < 0; }
function timestampAfter($ts)  { return strcmp(getCurrentTimestamp(), $ts) > 0; }
function timestampBetween($ts0, $ts1) {
    if(timestampBefore($ts0)) return false;
    if(timestampBefore($ts1)) return true;
    return false;
}

function getGameState() {
    global $tsBegin, $tsVote, $tsSoftStart, $tsHardStart, $tsOver, $tsEnd;
    if(timestampBefore ($tsBegin))                   return 0; // gamejam is not started, yet
    if(timestampBetween($tsBegin,     $tsVote))      return 1; // open registration and theme proposal
    if(timestampBetween($tsVote,      $tsSoftStart)) return 2; // theme voting
    if(timestampBetween($tsSoftStart, $tsHardStart)) return 3; // theme is chosen, soft start
    if(timestampBetween($tsHardStart, $tsOver))      return 4; // hard start!
    if(timestampBetween($tsOver,      $tsEnd))       return 5; // gamejam is over; time to submit
    if(timestampAfter  ($tsEnd))                     return 6; // gamejam is ended
}

?>