<?php
    $log_str = "";
    /**
     * mysql 日志分析配置说明
     * 1.在mysql.ini 中加入 log=D:/web/mysql.log  重启mysql
     * 2.[v5.5以上的配置]
     * [mysqld]
     * general_log= ON
     * general_log_file = "E:/program/data/mysql_log.log"
     */
    require_once('../config.php');
    $filename = $_CFG['mysql_log'];
    if ( !file_exists($filename) )
    {
        echo "log文件不存在, 请到 config.php 文件中配置";
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>mysql 日志分析</title>
    <link rel="stylesheet" href="../public/lib/elf/css/elf.css" />
    <script type="text/javascript" src="../public/style/js/jquery-1.8.2.min.js"></script>
</head>
<body>
<main class="elf">
    <div class="btn-group">
        <a href="index.php?act=del"><button class="ghost-dark ">清空日志</button></a>
        <a href="index.php?act=freshen<?php echo time(); ?>"><button class="ghost-dark ">重新载入</button></a>
    </div>
    <form class="forms">
    <?php
    //清空日志
    if ( isset($_GET['act']) && $_GET['act'] == 'del' )
    {
        $fp = @fopen($filename, "w+");
        if ( !is_writable($filename) )
        {
            die("log文件:".$filename."不可写，请检查！");
        }
        else
        {
            fwrite($fp, $log_str."\r\n");
        }
        @fclose($fp);

    }

    //查看日志
    if ( abs(filesize($filename) > (1024 * 1014 * 1)) )
    {
        file_put_contents($filename, $log_str);
    }
    $fp = @fopen($filename, "r") or exit("log文件打不开!");

    while ( !feof($fp) )
    {
        $str = fgets($fp);

        if ( preg_match("/Connect/", $str) )
        {
            echo '<input type="text" class="width-6 input-error" value="'.$str.'"/>';
        }

        $str = preg_replace('/([0-9]{1,} Query)|([0-9]{1,} Quit)/', "", $str);
        $str = preg_replace('/([0-9]{1,})\sInit/', "Init", $str);
        echo '<input type="text" class="width-6" value="'.$str.'"/>';
    }
    @fclose($fp);
    ?>
    </form>
</main>
</body>
</html>
