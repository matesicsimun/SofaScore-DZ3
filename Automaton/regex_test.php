<?php




$definitions = ["slovaibrojke"=>"^[[:alnum:]]*", "broj"=>"\\d+"];
$arr2 = ["slovaibrojke"=>"!", "broj"=>"nigga"];

$input = "simun<slovaibrojke>matesic<broj>student<znakovi>Racunarstva<nesto>";

foreach ($arr2 as $key => $value){
    //check if definition matches value
    if (!preg_match("/".$definitions[$key]."/", $value)){
        $input = preg_replace("/<$key>/", "-Value $key not valid-", $input);
    }
    else{
        $pattern = "/<".$key.">/";
        $input = preg_replace($pattern, $value, $input);
    }

}

$matches = [];
$checkRegex = "/<(.*?)>/";
if (preg_match_all($checkRegex, $input, $matches) > 0){
    print_r($matches);
    foreach ($matches[1] as $match){
        $input = preg_replace("/<".$match.">/", "-Missing param $match-", $input);
    }
}

echo $input;

echo "\n";
if (preg_match("/^[a-zA-Z0-9_.-]*$/", "!")){
    echo "true";
}


if (preg_match("/Simun[[:alnum:]]*Matesic/", "Simun123123asdasdMatesic")){
    echo "DADA";
}

if (preg_match("/^12345$/", "12345")){
    echo "YES";
}

