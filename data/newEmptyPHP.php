<?php
//$f = fopen('users.txt');
$lines = file('users.txt');

foreach ($lines as $line=>$text) {
    $arr[$line] = unserialize($text);
}
//$arr[0]['igor'] = 'admin';
$str = serialize($arr);
echo "<pre>";
echo $str."</br>";
var_dump($arr);

$array = array("blue"=>"red", "red"=>"green", "green"=>"blue", "blue"=>"color", "blue"=>"night");
print_r(array_search($array, "green"));



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

