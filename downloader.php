<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$url = 'http://example.com/image.php';
$img = '/my/folder/flower.gif';
file_put_contents($img, file_get_contents($url));
?>
