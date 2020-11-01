<?php

// Headers
header('content-type: application/json; charset=utf-8');
header("access-control-allow-origin: *");

set_time_limit(30000);

include("imdb.php");

$tt = $_REQUEST["i"];
$i = new IMDb();
$mArr = $i->getMovieInfo($tt);
echo json_encode($mArr);
