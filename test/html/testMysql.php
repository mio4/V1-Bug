<?php
	$hostname = "127.0.0.1";
	$username = "root";
	$password = "123456";
	$conn = mysqli_connect($hostname,$username,$password);
	mysqli_select_db($conn,"mybatis");
	$sql = "select * from tb_card";
	//查询结果
	$result = mysqli_query($conn,$sql);
	if(! $result ){
		die('无法读取数据: ' . mysqli_error($conn));
	}
	
	print_r($result);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
		echo $row['CODE'] . " ";
	}

	//释放结果集
	mysqli_free_result($result);
	//关闭数据库连接
	mysqli_close($conn);
?>