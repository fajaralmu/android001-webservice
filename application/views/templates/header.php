<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Tasmi App :: <?=$judul?></title>
</head>
<body>
<div align="center">
    <a href=<?=base_url()."index.php/post/"?>>Post</a>
</div>
<div>
<?php if($logged_in){
?>
    <h3>Welcome <?=$session['username']?></h3>
    <a href=<?=base_url()."index.php/akun/keluar"?>>Logout</a>
<?php
}else{?>
    <a href=<?=base_url()."index.php/akun/"?>>Login</a>
<?php } ?>
</div>

<h1 align="center"><?=$judul?></h1>
<div style="width:30%; margin:auto; border: solid 2px; border-color:orange; padding: 10px">