<?php

require_once __DIR__ . '/../vendor/autoload.php';

use jpdik\Request;

$req = new Request("https://api.openweathermap.org/data/2.5");

$res = $req->get("/weather?q=São joão del rei&appid=d15abc236092bbf9dd28fa2c0a7a02a9");

if($res){
  echo json_encode($res);
}