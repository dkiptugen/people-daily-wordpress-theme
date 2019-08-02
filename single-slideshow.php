<?php
/*
 *  Template Name: single-slideshow
 *
 *  @Package people daily
 *
 */
get_header();
$slideshohid =  get_the_ID();
$data        =  get_slideshow_pictures($slideshohid);
var_dump($data);
get_footer();
?>