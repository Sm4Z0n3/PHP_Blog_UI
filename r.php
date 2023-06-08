<?php
    $psw = $_POST["psw"];
$usw = $_POST["usw"];
$qq = $_POST["qq"];
$psw1 = 'i/'.$usw.'/psw.ini';
$usw1 = 'i/'.$usw.'/usw.ini';
$qq1 = 'i/'.$usw.'/qq.ini';
if(is_dir('i/'.$usw)) {
	echo "503";
} else {
	mkdir('i/'.$usw,0777);
	//密码写入
	if(!$fp = fopen($psw1,'a')) {
		//文件不存在
		exit;
	}
	if(fwrite($fp,$psw) === FALSE) {
		//写入失败
		echo '404';
		exit;
	}
	//写入成功
	fclose($fp);
	//账号写入
	if(!$fp = fopen($usw1,'a')) {
		//文件不存在
		exit;
	}
	if(fwrite($fp,$usw) === FALSE) {
		//写入失败
		exit;
	}
	//写入成功
	fclose($fp);

	//QQ写入
	if(!$fp = fopen($qq1,'a')) {
		//文件不存在
		exit;
	}
	if(fwrite($fp,$qq) === FALSE) {
		//写入失败
		echo '404';
		exit;
	}
	//写入成功
	fclose($fp);
	echo '200';
    echo '<script>document.cookie="usw='.$usw.'";document.cookie="qq='.$qq.'";</script>';
	echo '<meta http-equiv="refresh" content="0; url=/">';
}
?>