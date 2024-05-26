<?php

$conn = mysqli_connect('localhost', 'root', '', 'exam');

if(!$conn){
    echo "cant connect";
}