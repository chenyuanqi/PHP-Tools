<?php
//加密解密
function encryptDecrypt($key, $string, $decrypt){
    if($decrypt){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
        return $decrypted;
    }else{
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}

//生成随机字符串
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
//获取文件扩展名
function getExtension($filename){
  $myext = substr($filename, strrpos($filename, '.'));
  return str_replace('.','',$myext);
}

//获取文件大小并格式化
function formatSize($size) {
    $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
    if ($size == 0) {
		return('n/a');
	} else {
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
	}
}

//PHP替换标签字符
function stringParser($string,$replacer){
    $result = str_replace(array_keys($replacer), array_values($replacer),$string);
    return $result;
}

//列出目录下的文件
function listDirFiles($DirPath){
    if($dir = opendir($DirPath)){
         while(($file = readdir($dir))!== false){
                if(!is_dir($DirPath.$file))
                {
                    echo "filename: $file<br />";
                }
         }
    }
}

//获取当前页面的url
function curPageURL() {
	$pageURL = 'http';
	if (!empty($_SERVER['HTTPS'])) {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}

//强制文件下载
function download($filename){
    if ((isset($filename))&&(file_exists($filename))){
       header("Content-length: ".filesize($filename));
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . $filename . '"');
       readfile("$filename");
    } else {
       echo "Looks like file does not exist!";
    }
}

/*
 Utf-8、gb2312都支持的汉字截取函数
 cut_str(字符串, 截取长度, 开始长度, 编码);
 编码默认为 utf-8
 开始长度默认为 0
*/
function cutStr($string, $sublen, $start = 0, $code = 'UTF-8'){
    if($code == 'UTF-8'){
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }else{
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i<$strlen; $i++){
            if($i>=$start && $i<($start+$sublen)){
                if(ord(substr($string, $i, 1))>129){
                    $tmpstr.= substr($string, $i, 2);
                }else{
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}


//获取用户真实IP
function getIp() {
	if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
		$ip = getenv("HTTP_CLIENT_IP");
	else
		if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else
			if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
				$ip = getenv("REMOTE_ADDR");
			else
				if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
					$ip = $_SERVER['REMOTE_ADDR'];
				else
					$ip = "unknown";
	return ($ip);
}


// 根据ip定位城市
function ip_find_city($clientIP){
    $IP = 'http://ip.taobao.com/service/getIpInfo.php?ip='.$clientIP;
    $IPinfo = json_decode(file_get_contents($IP));
    $province = $IPinfo->data->region;
    $city = $IPinfo->data->city;
    $data = $province.$city;
    return $data;
}


//防止注入
function injCheck($sql_str) {
	$check = preg_match('/select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile/', $sql_str);
	if ($check) {
		echo '非法字符！！'.$sql_str;
		exit;
	} else {
		return $sql_str;
	}
}

//页面提示跳转
function message($msgTitle,$message,$jumpUrl){
	$str = '<!DOCTYPE HTML>';
	$str .= '<html>';
	$str .= '<head>';
	$str .= '<meta charset="utf-8">';
	$str .= '<title>页面提示</title>';
	$str .= '<style type="text/css">';
	$str .= '*{margin:0; padding:0}a{color:#369; text-decoration:none;}a:hover{text-decoration:underline}body{height:100%; font:12px/18px Tahoma, Arial,  sans-serif; color:#424242; background:#fff}.message{width:450px; height:120px; margin:16% auto; border:1px solid #99b1c4; background:#ecf7fb}.message h3{height:28px; line-height:28px; background:#2c91c6; text-align:center; color:#fff; font-size:14px}.msg_txt{padding:10px; margin-top:8px}.msg_txt h4{line-height:26px; font-size:14px}.msg_txt h4.red{color:#f30}.msg_txt p{line-height:22px}';
	$str .= '</style>';
	$str .= '</head>';
	$str .= '<body>';
	$str .= '<div class="message">';
	$str .= '<h3>'.$msgTitle.'</h3>';
	$str .= '<div class="msg_txt">';
	$str .= '<h4 class="red">'.$message.'</h4>';
	$str .= '<p>系统将在 <span style="color:blue;font-weight:bold">3</span> 秒后自动跳转,如果不想等待,直接点击 <a href="{$jumpUrl}">这里</a> 跳转</p>';
	$str .= "<script>setTimeout('location.replace(\'".$jumpUrl."\')',2000)</script>";
	$str .= '</div>';
	$str .= '</div>';
	$str .= '</body>';
	$str .= '</html>';
	echo $str;
}


//时间长度转换
function changeTimeType($seconds) {
	if ($seconds > 3600) {
		$hours = intval($seconds / 3600);
		$minutes = $seconds % 3600;
		$time = $hours . ":" . gmstrftime('%M:%S', $minutes);
	} else {
		$time = gmstrftime('%H:%M:%S', $seconds);
	}
	return $time;
}


/**
 * 生成随机字符串
 * @param  length   $length       生成的字符串长度
 * @param  pool     $pool         需求池
 * @return string   #随机后的字符串
 * @author cyq <chenyuanqi90s@163.com>
 */
function random($length, $pool = ''){
    $random = '';
    if (empty($pool)) {
        $pool    = 'abcdefghkmnpqrstuvwxyz';
        $pool   .= '23456789';
    }
    srand ((double)microtime()*1000000);
    for($i = 0; $i < $length; $i++){
        $random .= substr($pool,(rand()%(strlen ($pool))), 1);
    }
    return $random;
}

/**
 * 短网址生成
 * @param  string   $input       生成前的字符串
 * @return string   #产生四段6位字符，取其一即可 (并非唯一)
 * @author cyq <chenyuanqi90s@163.com>
 *
 #重写入口规则 ：如http://t.cn/link.php?url=http://www.Alixixi.com/php-template-framework/832.html => http://t.cn/zHEYrvV
 *RewriteEngine On
 *RewriteBase /
 *RewriteRule ^/(.*)$ link.php?url=$1[L]
 */
function shorturl($input) {
    $base32 = array_merge(range('a', 'z'), range('A', 'Z'), range(0, 9));
    $hex = md5($input);
    $hexLen = strlen($hex);
    $subHexLen = $hexLen / 8;
    $output = array();
    for ($i = 0; $i < $subHexLen; $i++) {
        $subHex = substr ($hex, $i * 8, 8);
        $int = 0x3FFFFFFF & (1 * ('0x'.$subHex));
        $out = '';
        for ($j = 0; $j < 6; $j++) {
          $val = 0x0000001F & $int;
          $out .= $base32[$val];
          $int = $int >> 5;
        }
        $output[] = $out;
    }
    return $output;
}
/**
 * 加密解密
 * @param  string   $key          要加密或解密的字符串
 * @param  string   $string       二级加密或解密的字符串
 * @param  decrypt  $decrypt      是否加密
 * @return decrypted | encrypted  #加密/解密后的字符串
 * @author cyq <chenyuanqi90s@163.com>
 */
function encryptDecrypt($key, $string, $decrypt){
    if($decrypt){
        $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "12");
        return $decrypted;
    }else{
        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5($key))));
        return $encrypted;
    }
}


/**
 * 文章阅读数自增一
 * @param  string     $db           所在数据表名
 * @param  int      $id           表中id
 * @param  name     $name         需要自增的字段
 * @return void(0)
 * @author cyq <chenyuanqi90s@163.com>
 */
function readInc($db, $id, $name = 'click_num') {
    M($db)->where(array('id'=>$id))->setInc($name);
}


/**
 * 生成随机字符串
 * @param  number   $length    生成的字符串长度
 * @return string              #返回{$length}位随机字符
 * @author cyq <chenyuanqi90s@163.com>
 */
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


/**
 * Utf-8、gb2312支持的汉字截取函数
 * @param  string   $string    要截取的字符串
 * @param  number   $sublen    要截取的长度
 * @param  number   $start     开始截取的位置 ( 默认0 )
 * @param  string   $code      字符编码 ( 默认'UTF-8' )
 * @return string              #截取后的字符串
 * @author cyq <chenyuanqi90s@163.com>
 */
function cutStr($string, $sublen, $start = 0, $code = 'UTF-8'){
    if($code == 'UTF-8'){
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }else{
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i<$strlen; $i++){
            if($i>=$start && $i<($start+$sublen)){
                if(ord(substr($string, $i, 1))>129){
                    $tmpstr.= substr($string, $i, 2);
                }else{
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)<$strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}


/**
 * 时间转换为相应的英文月(如2015-01-01 01:01:01 => Jan)
 * @param  datetime   $datetime    具体日期时间
 * @return string                  #返回相应的英文月份并截取3位
 * @author cyq <chenyuanqi90s@163.com>
 */
function _date_to_en($datetime) {
    $month = date('F', strtotime($datetime));
    return substr($month, 0, 3);
}


/**
 *获取用户真实IP
 *@return 用户真实IP;
 */
function getIp() {
  if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")) {
      $ip = getenv("HTTP_CLIENT_IP");
  } else {
      if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) {
          $ip = getenv("HTTP_X_FORWARDED_FOR");
      } else {
          if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) {
              $ip = getenv("REMOTE_ADDR");
          } else {
              if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) {
                  $ip = $_SERVER['REMOTE_ADDR'];
              } else {
                  $ip = "unknown";
              }
          }
      }
  }

  return ($ip);
}


/**
 * 生成随机字符串
 * @param  length   $length       生成的字符串长度
 * @param  pool     $pool         需求池
 * @return string   #随机后的字符串
 * @author cyq <chenyuanqi90s@163.com>
 */
function random($length, $pool = ''){
    $random = '';
    if (empty($pool)) {
        $pool    = 'abcdefghkmnpqrstuvwxyz';
        $pool   .= '23456789';
    }
    srand ((double)microtime()*1000000);
    for($i = 0; $i < $length; $i++){
        $random .= substr($pool,(rand()%(strlen ($pool))), 1);
    }
    return $random;
}


/**
 *获取访客浏览器类型
 *@return 访客浏览器类型;
 */
function GetBrowser(){
    if(!empty($_SERVER['HTTP_USER_AGENT'])){
      $br = $_SERVER['HTTP_USER_AGENT'];
      if (preg_match('/MSIE/i',$br)) {
          $br = 'MSIE';
      } elseif (preg_match('/Firefox/i',$br)) {
          $br = 'Firefox';
      } elseif (preg_match('/Chrome/i',$br)) {
          $br = 'Chrome';
      } elseif (preg_match('/Safari/i',$br)) {
          $br = 'Safari';
      } elseif (preg_match('/Opera/i',$br)) {
          $br = 'Opera';
      } else {
          $br = 'Other';
      }
      return $br;
    } else {
      return "获取浏览器信息失败！";
    }
}


/**
 *获取访客浏览器语言
 *@return 访客浏览器语言;
 */
function GetLang() {
    if(!empty($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
      $lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
      $lang = substr($lang,0,5);
      if(preg_match("/zh-cn/i",$lang)) {
        $lang = "简体中文";
      } elseif(preg_match("/zh/i",$lang)) {
        $lang = "繁体中文";
      } else {
        $lang = "English";
      }
      return $lang;
    } else {
      return "获取浏览器语言失败！";
    }
}


/**
 *获取访客操作系统
 *@return 访客操作系统;
 */
function GetOs(){
    if(!empty($_SERVER['HTTP_USER_AGENT'])) {
        $OS = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/win/i',$OS)) {
            $OS = 'Windows';
        } elseif (preg_match('/mac/i',$OS)) {
            $OS = 'MAC';
        } elseif (preg_match('/linux/i',$OS)) {
            $OS = 'Linux';
        } elseif (preg_match('/unix/i',$OS)) {
            $OS = 'Unix';
        } elseif (preg_match('/bsd/i',$OS)) {
            $OS = 'BSD';
        } else {
            $OS = 'Other';
        }
        return $OS;
    } else {
      return "获取访客操作系统信息失败！";
    }
}


/**
 *正则手机号 /^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/
 *@param  需要验证的手机号码    $string
 *@return boolean;
 */
function RegularPhone($string){
    $resultStr = preg_match("/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/",$string);
    if(intval($resultStr) == 1){
        return TRUE;
    }
    else{
        return FALSE;
    }
}


/**
 *正则邮箱 /^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i
 *@param  需要验证的邮箱    $string
 *@return boolean;
 */
function RegularEmail($string){
    $resultStr = preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$string);
    if(intval($resultStr) == 1){
        return TRUE;
    }
    else{
        return FALSE;
    }
}


/**
 *正则身份证 /(^([d]{15}|[d]{18}|[d]{17}x)$)/
 *@param  需要验证的身份证号    $string
 *@return boolean;
 */
function RegularIdCard($string){
    $resultStr = preg_match("/(^([d]{15}|[d]{18}|[d]{17}x)$)/",$string);
    if(intval($resultStr) == 1){
        return TRUE;
    }
    else{
        return FALSE;
    }
}


/**
 *处理字符串信息
 *@param  需要处理的字符串    $string
 *@return string | null;
 */
function hStr($string){
    if(isset($string) && !empty($string)){
        return addslashes(strip_tags($string));
    }
    else{
        return "";
    }
}


/**
* PublicAction::getHttpHead() | get_headers($url)
* 获取HTTP头信息 (可用判断页面是否404)
* @param string  $url         URL地址
* @param bool    $isFormat    是否格式化输出
* @return array
*/
function getHttpHead($url, $isFormat = false) {
        $ch = curl_init();
        $options = array(
                CURLOPT_URL => $url,
                CURLOPT_HEADER => true,
                CURLOPT_NOBODY => true,
                CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $options);
        $result = curl_exec($ch);
        curl_close($ch);
        $tmpArr = explode("\n", $result);
        $resultArr = array();
        foreach ($tmpArr as $value) {
                $value = trim($value);
                if ($value != '') {
                        if ($isFormat == true) {
                                $arr = explode(':', $value);
                                $k = $arr;
                                $v = $arr;
                                $resultArr[$k] = $v;
                        } else {
                                array_push($resultArr, $value);
                        }
                }
        }
        return $resultArr;
}

// #利用curl获取httpCode码
function getHttpCode($url){
    $handle = curl_init($url);
    curl_setopt($handle,CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);
    return $httpCode;
}


/**
 *获取url信息
 *@param  获取的模式    $number
 *@return string | null;
 */
function _get_url_message($number = 1) {
    #测试网址:     http://localhost/blog/url.php?id=5
    switch (variable) {
      //获取域名或主机地址 #localhost
      case 0:
        $string = $_SERVER['HTTP_HOST'];
        break;

      //获取网页地址 #/blog/url.php
      case 1:
        $string = $_SERVER['PHP_SELF'];
        break;

      //获取网址参数 #id=5
      case 2:
        $string = $_SERVER["QUERY_STRING"];
        break;

      //获取用户代理
      case 3:
        $string = $_SERVER['HTTP_REFERER'];
        break;

      //获取完整的url #http://localhost/blog/url.php?id=5
      case 4:
        $string = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        // $string = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
        break;

      //包含端口号的完整url #http://localhost:80/blog/url.php?id=5
      case 5:
        $string = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        break;

      //只取路径 #http://localhost/blog
      case 6:
        $string = dirname('http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]);
        break;
    }
}


// 创建相应的文件夹
function createdir($dir = '') {
  if (!is_dir($dir)) {
    $temp = explode('/',$dir);
    $cur_dir = ”;
    for($i=0;$i<count($temp);$i++) {
      $cur_dir .= $temp[$i].'/';
      if (!is_dir($cur_dir)) {
        @mkdir($cur_dir,0777);
      }
    }
  }
}


/**
 * 把汉字转化为拼音 #trans('测试');
 * @name : PinYin
 * @author gary<9020@160it.com> :
 * @param :
 */
function trans($_String, $_Code = 'utf8') {
    $_DataKey = "a|ai|an|ang|ao|ba|bai|ban|bang|bao|bei|ben|beng|bi|bian|biao|bie|bin|bing|bo|bu|ca|cai|can|cang|cao|ce|ceng|cha" .
            "|chai|chan|chang|chao|che|chen|cheng|chi|chong|chou|chu|chuai|chuan|chuang|chui|chun|chuo|ci|cong|cou|cu|" .
            "cuan|cui|cun|cuo|da|dai|dan|dang|dao|de|deng|di|dian|diao|die|ding|diu|dong|dou|du|duan|dui|dun|duo|e|en|er" .
            "|fa|fan|fang|fei|fen|feng|fo|fou|fu|ga|gai|gan|gang|gao|ge|gei|gen|geng|gong|gou|gu|gua|guai|guan|guang|gui" .
            "|gun|guo|ha|hai|han|hang|hao|he|hei|hen|heng|hong|hou|hu|hua|huai|huan|huang|hui|hun|huo|ji|jia|jian|jiang" .
            "|jiao|jie|jin|jing|jiong|jiu|ju|juan|jue|jun|ka|kai|kan|kang|kao|ke|ken|keng|kong|kou|ku|kua|kuai|kuan|kuang" .
            "|kui|kun|kuo|la|lai|lan|lang|lao|le|lei|leng|li|lia|lian|liang|liao|lie|lin|ling|liu|long|lou|lu|lv|luan|lue" .
            "|lun|luo|ma|mai|man|mang|mao|me|mei|men|meng|mi|mian|miao|mie|min|ming|miu|mo|mou|mu|na|nai|nan|nang|nao|ne" .
            "|nei|nen|neng|ni|nian|niang|niao|nie|nin|ning|niu|nong|nu|nv|nuan|nue|nuo|o|ou|pa|pai|pan|pang|pao|pei|pen" .
            "|peng|pi|pian|piao|pie|pin|ping|po|pu|qi|qia|qian|qiang|qiao|qie|qin|qing|qiong|qiu|qu|quan|que|qun|ran|rang" .
            "|rao|re|ren|reng|ri|rong|rou|ru|ruan|rui|run|ruo|sa|sai|san|sang|sao|se|sen|seng|sha|shai|shan|shang|shao|" .
            "she|shen|sheng|shi|shou|shu|shua|shuai|shuan|shuang|shui|shun|shuo|si|song|sou|su|suan|sui|sun|suo|ta|tai|" .
            "tan|tang|tao|te|teng|ti|tian|tiao|tie|ting|tong|tou|tu|tuan|tui|tun|tuo|wa|wai|wan|wang|wei|wen|weng|wo|wu" .
            "|xi|xia|xian|xiang|xiao|xie|xin|xing|xiong|xiu|xu|xuan|xue|xun|ya|yan|yang|yao|ye|yi|yin|ying|yo|yong|you" .
            "|yu|yuan|yue|yun|za|zai|zan|zang|zao|ze|zei|zen|zeng|zha|zhai|zhan|zhang|zhao|zhe|zhen|zheng|zhi|zhong|" .
            "zhou|zhu|zhua|zhuai|zhuan|zhuang|zhui|zhun|zhuo|zi|zong|zou|zu|zuan|zui|zun|zuo";
    $_DataValue = "-20319|-20317|-20304|-20295|-20292|-20283|-20265|-20257|-20242|-20230|-20051|-20036|-20032|-20026|-20002|-19990" .
            "|-19986|-19982|-19976|-19805|-19784|-19775|-19774|-19763|-19756|-19751|-19746|-19741|-19739|-19728|-19725" .
            "|-19715|-19540|-19531|-19525|-19515|-19500|-19484|-19479|-19467|-19289|-19288|-19281|-19275|-19270|-19263" .
            "|-19261|-19249|-19243|-19242|-19238|-19235|-19227|-19224|-19218|-19212|-19038|-19023|-19018|-19006|-19003" .
            "|-18996|-18977|-18961|-18952|-18783|-18774|-18773|-18763|-18756|-18741|-18735|-18731|-18722|-18710|-18697" .
            "|-18696|-18526|-18518|-18501|-18490|-18478|-18463|-18448|-18447|-18446|-18239|-18237|-18231|-18220|-18211" .
            "|-18201|-18184|-18183|-18181|-18012|-17997|-17988|-17970|-17964|-17961|-17950|-17947|-17931|-17928|-17922" .
            "|-17759|-17752|-17733|-17730|-17721|-17703|-17701|-17697|-17692|-17683|-17676|-17496|-17487|-17482|-17468" .
            "|-17454|-17433|-17427|-17417|-17202|-17185|-16983|-16970|-16942|-16915|-16733|-16708|-16706|-16689|-16664" .
            "|-16657|-16647|-16474|-16470|-16465|-16459|-16452|-16448|-16433|-16429|-16427|-16423|-16419|-16412|-16407" .
            "|-16403|-16401|-16393|-16220|-16216|-16212|-16205|-16202|-16187|-16180|-16171|-16169|-16158|-16155|-15959" .
            "|-15958|-15944|-15933|-15920|-15915|-15903|-15889|-15878|-15707|-15701|-15681|-15667|-15661|-15659|-15652" .
            "|-15640|-15631|-15625|-15454|-15448|-15436|-15435|-15419|-15416|-15408|-15394|-15385|-15377|-15375|-15369" .
            "|-15363|-15362|-15183|-15180|-15165|-15158|-15153|-15150|-15149|-15144|-15143|-15141|-15140|-15139|-15128" .
            "|-15121|-15119|-15117|-15110|-15109|-14941|-14937|-14933|-14930|-14929|-14928|-14926|-14922|-14921|-14914" .
            "|-14908|-14902|-14894|-14889|-14882|-14873|-14871|-14857|-14678|-14674|-14670|-14668|-14663|-14654|-14645" .
            "|-14630|-14594|-14429|-14407|-14399|-14384|-14379|-14368|-14355|-14353|-14345|-14170|-14159|-14151|-14149" .
            "|-14145|-14140|-14137|-14135|-14125|-14123|-14122|-14112|-14109|-14099|-14097|-14094|-14092|-14090|-14087" .
            "|-14083|-13917|-13914|-13910|-13907|-13906|-13905|-13896|-13894|-13878|-13870|-13859|-13847|-13831|-13658" .
            "|-13611|-13601|-13406|-13404|-13400|-13398|-13395|-13391|-13387|-13383|-13367|-13359|-13356|-13343|-13340" .
            "|-13329|-13326|-13318|-13147|-13138|-13120|-13107|-13096|-13095|-13091|-13076|-13068|-13063|-13060|-12888" .
            "|-12875|-12871|-12860|-12858|-12852|-12849|-12838|-12831|-12829|-12812|-12802|-12607|-12597|-12594|-12585" .
            "|-12556|-12359|-12346|-12320|-12300|-12120|-12099|-12089|-12074|-12067|-12058|-12039|-11867|-11861|-11847" .
            "|-11831|-11798|-11781|-11604|-11589|-11536|-11358|-11340|-11339|-11324|-11303|-11097|-11077|-11067|-11055" .
            "|-11052|-11045|-11041|-11038|-11024|-11020|-11019|-11018|-11014|-10838|-10832|-10815|-10800|-10790|-10780" .
            "|-10764|-10587|-10544|-10533|-10519|-10331|-10329|-10328|-10322|-10315|-10309|-10307|-10296|-10281|-10274" .
            "|-10270|-10262|-10260|-10256|-10254";
    $_TDataKey = explode('|', $_DataKey);
    $_TDataValue = explode('|', $_DataValue);
    $_Data = (PHP_VERSION >= '5.0') ? array_combine($_TDataKey, $_TDataValue) : $this->_Array_Combine($_TDataKey, $_TDataValue);
    arsort($_Data);
    reset($_Data);
    if ($_Code != 'gb2312')
        $_String = $this->_U2_Utf8_Gb($_String);
    $_Res = '';
    for ($i = 0; $i < strlen($_String); $i++) {
        $_P = ord(substr($_String, $i, 1));
        if ($_P > 160) {
            $_Q = ord(substr($_String, ++$i, 1));
            $_P = $_P * 256 + $_Q - 65536;
        }
        $_Res .= $this->_Pinyin($_P, $_Data);
    }
    return preg_replace("/[^a-z0-9]*/", '', $_Res);
}

function _Pinyin($_Num, $_Data) {
    if ($_Num > 0 && $_Num < 160)
        return chr($_Num);
    elseif ($_Num < -20319 || $_Num > -10247)
        return '';
    else {
        foreach ($_Data as $k => $v) {
            if ($v <= $_Num)
                break;
        }
        return $k;
    }
}

function _U2_Utf8_Gb($_C) {
    $_String = '';
    if ($_C < 0x80)
        $_String .= $_C;
    elseif ($_C < 0x800) {
        $_String .= chr(0xC0 | $_C >> 6);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x10000) {
        $_String .= chr(0xE0 | $_C >> 12);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    } elseif ($_C < 0x200000) {
        $_String .= chr(0xF0 | $_C >> 18);
        $_String .= chr(0x80 | $_C >> 12 & 0x3F);
        $_String .= chr(0x80 | $_C >> 6 & 0x3F);
        $_String .= chr(0x80 | $_C & 0x3F);
    }
    return iconv('UTF-8', 'GB2312', $_String);
}

function _Array_Combine($_Arr1, $_Arr2) {
    for ($i = 0; $i < count($_Arr1); $i++)
        $_Res[$_Arr1[$i]] = $_Arr2[$i];
    return $_Res;
}


/**
 * 调试输出sql语句、sql错误、打印数组 #Output
 * @param  String | Array   $foo     要打印输出的对象
 * @param  number           $module    模式, 默认为1, 其他则以封装好的 dump 方法
 * @return $Str (String)
 * @author cyq <chenyuanqi90s@163.com>
 */
function O($foo, $module = 0) {
    header("content-type:text/html;charset=utf-8");
    echo '<div style="color: #F16B17; font-family: georgia, verdana, tahoma, arial, sans-serif; font-size: 13px; width: 980px; min-width: 600px; line-height: 23px;margin: 0 auto;padding: 16px; background: #f2f2f2; word-break: break-word;">';

    // 输出除数组、sql语句外字符串等
    if (1 == $module) {
        echo '<h3 style="color: #0f9c7c;">Happy programming！您要输出的变量信息如下：</h3><pre>';
        var_dump($foo);
        exit('</pre></div>');
    }

    if (is_array($foo)) {
        // 添加块样式
        echo '<h3 style="color: #0f9c7c;">Happy programming！您要输出的数组信息如下：</h3><pre>';
        print_r($foo);
        exit('</pre></div>');
    } else {
        echo '<h3 style="color: #0f9c7c;">Happy programming！您正在执行的sql语句:</h3>' . M($foo)->_sql();
        $err = M($foo)->getDbError();
        $err && exit('<hr /><h3 style="color: red;">We’re So Sorry! sql错误信息：</h3>' . $err);
        die();
    }
}



/**
 * 输出 Php 全局变量 #Output 『TP』
 * @param  number           $module    模式, 默认为0
 * @param  string           $else      使用非TP模式输出
 * @return $Str (String)
 * @author cyq <chenyuanqi90s@163.com>
 */
function P($module = 0, $else = null) {
    header("content-type:text/html;charset=utf-8");

    switch ($module) {
        case 0:
            $else ? var_dump($_REQUEST) : dump($_REQUEST);
            break;

        case 1:
            $else ? var_dump($_GET) : dump($_GET);;
            break;

        case 2:
            $else ? var_dump($_POST) : dump($_POST);
            break;

        case 3:
            $else ? var_dump($_SESSION) : dump($_SESSION);;
            break;

        case 4:
            $else ? var_dump($_COOKIE) : dump($_COOKIE);
            break;

        default:
            $else ? var_dump($_FILES) : dump($_FILES);
            break;
    }
}




/**
 * 强制文件下载
 * @param  $filename   文件地址
 * @return boolean;
 */
function download($filename){
    if ((isset($filename))&&(file_exists($filename))){
       header("Content-length: ".filesize($filename));
       header('Content-Type: application/octet-stream');
       header('Content-Disposition: attachment; filename="' . $filename . '"');
       readfile("$filename");
       return true;
    } else {
       return false;
    }
}


/**
 * 文件打包
 * @param  $filename   文件地址
 * @return boolean;
 */
function packup($fileArr = '', $cur_file = 'Data/', $save_path = 'Data/Zip/') {
    import('ORG.Util.FileToZip');

    $handler       = opendir($cur_file); //$cur_file 文件所在目录
    $download_file = array();
    $i             = 0;
    while (($filename = readdir($handler)) !== false) {
        if ($filename != '.' && $filename != '..') {
            // 是否压缩特定文件
            if ($fileArr && !in_array($filename, $fileArr)) {
                continue;
            }

            $download_file[$i++] = $filename;
        }
    }

    closedir($handler);
    $scandir = new traverseDir($cur_file, $save_path); //$save_path zip包文件目录
    $scandir->tozip($download_file);

}