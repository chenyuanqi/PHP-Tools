<?php
    ob_clean();
    header("Content-type: text/html; charset=gb2312");
    $path = $_POST['path'];
    if(empty($path) || !is_dir($path)){
        echo '请输入有效的路径！';
        exit();
    }

    exec("tree ".$path. " > history.php");
    $output = file_get_contents('./history.php');
    echo $output;
    exit();
