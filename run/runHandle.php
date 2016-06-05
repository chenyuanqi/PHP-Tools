<?php
	$code = $_POST['php_code'];
    if ( !strstr($code, '<?php') )
    {
        $code = '<?php'.PHP_EOL.$code;
    }

    file_put_contents('runHistory.php', $code);
    header("Location:./runHistory.php");
