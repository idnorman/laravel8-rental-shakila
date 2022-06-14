<?php

if (! function_exists('formatDate')){
    function formatDate($date, $format = 'd-m-Y'){
        $timestamp = strtotime($date);
        return date($format, $timestamp);
    }
}

if(! function_exists('formatPrice')){
    function formatPrice($price){
        return "Rp. " . number_format($price, 2, ',', '.');
    }
}

if(! function_exists('currentPath')){
    function currentPath(){
        return $_SERVER['REQUEST_URI'];
    }
}