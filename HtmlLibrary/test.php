<?php

$arr = ["id"=>"input1","id1"=>"input2"];
if (key_exists("id1", $arr)){
    unset($arr["id1"]);
}

echo count($arr);