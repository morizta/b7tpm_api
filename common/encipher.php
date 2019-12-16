<?php
// function for creating 
function doEncrypt($plain_text){
return hash('sha256' , (string)$plain_text);
}