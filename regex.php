<?php 
$url = 'https://example.com/book/alan-quatermain';
// $emailText ="These are my email address hasin@somedomain.com and john@doe.com. Ok? ";
// $pattern = "~[\w]+@([\w]+.[\w]+)~";
// preg_match_all($pattern, $emailText, $matches);

// print_r($matches);

//extract alan-quatermain
$pattern = "~https://example.com/book/([\w-]+)~";
preg_match($pattern, $url, $matches);
print_r($matches);