<style>
	li {
		//background-color:blue;
		display:inline;
	}
	li:hover{
		background-color:orange;
	}
	a{
		text-decoration:none;
	}
</style>
<?php

$table = 'pengguna';
$data = array();
$data = array('id'=>'2','username'=>'fajar', 'pass'=>'123', 'tipe'=>'a');
$where_array = array();
$where_array = array('id'=>'2','username'=>'fajar');


$sql2="INSERT INTO `".$table."`(";
	foreach ($data as $item=>$value):
		$sql2.="`".$item."`";
			if(next($data) != NULL)
				$sql2.= ",";
	endforeach;
	$sql2.=") VALUES (";
	foreach ($data as $item=>$value):
		$sql2.="'".$value."'";
			if(next($data) != NULL)
				$sql2.= ",";
	endforeach;
	$sql2.=")";

	echo $sql2;
	echo "<br/>";
	
$sql3 = "UPDATE `".$table."` SET ";
	foreach ($data as $item=>$value):
		$sql3.="`".$item."`='".$value."'";
			if(next($data) != NULL)
				$sql3.= ",";
	endforeach;
$sql3 .= " WHERE ";

	foreach ($where_array as $item=>$value):
		$sql3.="`".$item."`='".$value."'";
			if(next($where_array) != NULL)
				$sql3.= " AND ";
	endforeach;

	echo $sql3;
	echo "<br/>";
	
$sql4 = "DELETE FROM `".$table."` WHERE ";
	foreach ($where_array as $item=>$value):
		$sql4.="`".$item."`='".$value."'";
			if(next($where_array) != NULL)
				$sql4.= " AND ";
	endforeach;
	
	echo $sql4;
	echo "<br/>";
	
	
$sql5 = "SELECT * FROM `".$table."` WHERE ";
	foreach ($where_array as $item=>$value):
		$sql5.="`".$item."`='".$value."'";
			if(next($where_array) != NULL)
				$sql5.= " AND ";
	endforeach;
	
	echo $sql5;
	echo "<br/>";


?>
<ul style="list-style:inline; list-direction:inline; background-color:yellow; padding:10px">
	<li><a href="beranda">Beranda</a></li>
	|
	<li><a href=<?php echo base_url()."index.php/akun/edit/".$username;?> >Edit User</a></li>
	|
	<li><a href=<?php echo base_url()."index.php/akun/post";?> >posting baru</a></li>
	|
	<li><a href=<?php echo base_url()."index.php/akun/mypost";?>>posting saya</a></li>
	|
	<li><a href=<?php echo base_url()."index.php/akun/keluar";?>>keluar</a></li>

</ul>

