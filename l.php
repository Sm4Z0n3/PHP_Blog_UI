<script src="script/swal"></script>
<!--
<?php
    $usw = $_POST['usw'];
    $psw = $_POST['psw'];
    //$usw = $_GET['usw'];
    //$psw = $_GET['psw'];
    $stu = "1";
    $dir = './i/' . $usw;
    if (is_dir($dir)) {
        $usw_ini = file_get_contents($dir . '/usw.ini');
        $psw_ini = file_get_contents($dir .  '/psw.ini');
        $qq = file_get_contents($dir .  '/qq.ini');
        if ($usw_ini == $usw && $psw_ini == $psw) {
            $stu = '<script>
            document.cookie="usw='.$usw.'";
            document.cookie="qq='.$qq.'";
            swal("登录成功,状态码: 200");</script>
            ';
            
        } else {
            $stu = "<script>swal('登录错误,原因:密码输入错误')</script>";
        }
    } else {
        $stu = "<script>swal('登录错误,原因:用户名不存在')</script>";
    }
?>
-->
<?php
echo $stu.'<meta http-equiv="refresh" content="0; url=/">';
?>