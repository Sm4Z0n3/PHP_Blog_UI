<?php $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$keyword = '/index.php/';
$new_url = preg_replace($keyword, "", $url);
if($new_url != $url){
    echo '<meta http-equiv="refresh" content="0; url='.$new_url.'">';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php echo(file_get_contents("Html/head"))?>
    </head>

    <body onload="setTimeout(showPage, 5)">
        <ul class="menu">
            <li onclick="reload()">刷新</li>
            <li>博客</li>
            <li>关于</li>
            <li>权限</li>
            <li onclick="logout()">登出</li>
        </ul>

        <div id="sidebar" onmouseover="expand()" onmouseout="collapse()">
            <?php 
            if(isset($_COOKIE['usw'])) {
                date_default_timezone_set('Asia/Shanghai');
                $hour = date('H');
                if ($hour >= 6 && $hour < 9) {
                $wel = "早上好！";
                } elseif ($hour >= 9 && $hour < 12) {
                $wel = "上午好！";
                } elseif ($hour >= 12 && $hour < 14) {
                $wel = "中午好！";
                } elseif ($hour >= 14 && $hour < 18) {
                $wel = "下午好！";
                } elseif ($hour >= 18 && $hour < 20) {
                $wel = "傍晚好！";
                } elseif ($hour >= 20 && $hour < 22) {
                $wel = "晚上好！";
                } else {
                $wel = "凌晨好！";
                }
                $re = str_replace("{USERNAME}",$_COOKIE['usw'],file_get_contents("Html/User-sid"));
                $re = str_replace("{WELCOME}",$wel,$re);
                $re = str_replace("{QQ}",$_COOKIE['qq'],$re);
                echo $re;
            } else {
                echo file_get_contents("Html/Visitor-sid");
            }
            ?>
        </div>

        <div id="loader">
            <?php echo file_get_contents("Html/loader")?>
        </div>

        <div id="main" class="main">
            <!--<?php $id=$_POST['id']?>-->
            <?php
            if (isset($_POST['p'])) {
            if($_POST['p'] == "Blog" && $id == "")
            {
                $path = "page/" . $_POST['p'];
                echo file_get_contents($path);
                echo '<div id="blog">';
                $dir = "blog/i"; 
                $files = scandir($dir); 
                $data = array();
                echo "<!--";
                foreach ($files as $file) { 
                    if($file != "." && $file != ".."){
                        preg_match('/-(.*?)\./', $file, $matches); 
                        $title = $matches[1];
                        $mtime = filemtime("blog/i/" . $file); 
                        $date = date("Y-m-d H:i", $mtime);
                        array_push($data, array("name" => $file, "title" => $title, "time" => $date));
                    }
                }
                $json = json_encode($data);
                $array = json_decode($json, true);
                echo "-->";
                foreach ($array as $item) {
                    $div = "<form class='input_to_a' action='./' method='post'>
                    <div class='blog-post'>
                        <input type='text' style='display:none;' value='Blog' name='p'>
                    <a name='".$item["title"]."' onclick='dl_st(this)'></a>
                    <h1>" . $item["title"] . "</h1>
                    <input type='submit' value='".$item["name"]."' name='id'>
                    <p>Post Date(UTC/GMT+08:00):" . $item["time"] . "</p>
                    <p>".substr(file_get_contents("blog/i/".$item["name"]), 0, 50)."</p>
                    </div>
                    </form>";
                    echo $div;
                }
                echo '</div>';
            }else{
                    if($id != ""){
                        $path = "blog/i/" . $_POST['id'];
                        $file = file_get_contents($path);
                        if ($file) {
                            echo file_get_contents($path);
                        } else {
                            echo "无法打开文件";
                        }
                    }else{
                        $path = "page/" . $_POST['p'];
                        $file = file_get_contents($path);
                        if ($file) {
                            echo file_get_contents($path);
                        } else {
                            echo "无法打开文件";
                        }
                    }
            }

            } else {
                echo file_get_contents("page/Home");
            }
            ?>
        </div>
    </body>

    <video autoplay muted loop id="myVideo">
         <source src="assect/bg0.mp4" type="video/mp4">
    </video>

    <footer>
        <form class="aform" action="./" method="post">
            <input type="submit" value="Home" name="p">
            <input type="submit" value="Product" name="p" >
            <input type="submit" value="Blog" name="p" >
            <input type="submit" value="About" name="p" >
            <input type="submit" value="Contact" name="p" >
        </form>
    </footer>

    <script src="script/menu"></script>
</html>