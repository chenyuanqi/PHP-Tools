<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP 代码，跑起来！</title>
    <link rel="stylesheet" href="../public/lib/elf/css/elf.css" />
</head>

<body>
    <main class="elf">
        <form class="forms" action="./runHandle.php" method="post" target="run_iframe" onkeydown="if(event.keyCode==13)this.submit();">
            <button class="disabled">运行代码：</button>
            <textarea id="php_code" name="php_code" cols="30" rows="10" autofocus><?php echo file_get_contents( './runHistory.php');?></textarea>
        </form>

        <button class="disabled">运行结果：</button>
        <div class="blocks-2">
            <iframe id="run_iframe" name="run_iframe" src="./runHistory.php" style="width:99%;height:600px;"></iframe>
        </div>
    </main>
</body>
</html>
