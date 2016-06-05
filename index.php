<!DOCTYPE html>
<html lang="zh">

<head>
    <title>开发工具集</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description" content="content">
    <meta name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,user-scalable=no">
    <link rel="stylesheet" href="./public/lib/bootstrap-3.3.5/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="./public/style/css/style-min.css"/>
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.php">开发工具集</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                 <li><a href="#php">PHP</a></li>
                 <li><a href="#mysql">数据</a></li>
                 <li><a href="#others">其他</a></li>
                 <li><a href="#src">片段</a></li>
                 <li><a href="#ext">补注</a></li>
                 <li class="active"><a href="./README.md" target="_blank">帮助？</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="navbar navbar-inverse"></div>
<div class="container">
    <div class="list-con">
        <div class="page-header">
            <h1><a name="php" id="php">PHP</a></h1>
        </div>
        <div class="tags-list">
            <a href="./phpinfo/" target="_blank" class="tag">php Info</a>
            <a href="./probe/" target="_blank" class="tag">php 探针</a>
            <a href="./webgrind/" target="_blank" class="tag">php 性能分析 [webgrind]</a>
            <a href="./run/" target="_blank" class="tag">php 代码运行</a>
        </div>
    </div>
    <div class="list-con">
        <div class="page-header">
            <h1><a name="mysql" id="mysql">Datas</a></h1>
        </div>
        <div class="tags-list">
            <a href="./memcached/" target="_blank" class="tag">memcached</a>
            <a href="./phpRedisAdmin/" target="_blank" class="tag">phpRedisAdmin</a>
            <a href="./phpMyAdmin/" target="_blank" class="tag">phpMyAdmin</a>
            <a href="./mysqlLog/" target="_blank" class="tag">mysql 日志追踪</a>
            <a href="./mysqlData/" target="_blank" class="tag">mysql 数据字典</a>
        </div>
    </div>
    <div class="list-con">
        <div class="page-header">
            <h1><a name="others" id="others">Others</a></h1>
        </div>
        <div class="tags-list">
            <a href="./pallet/" target="_blank" class="tag">调色板</a>
            <a href="./replace/" target="_blank" class="tag">查找替换</a>
            <a href="./tree/" target="_blank" class="tag">树状目录</a>
            <a href="./note/" target="_blank" class="tag">来篇小记</a>
            <a href="./editor/" target="_blank" class="tag">打个草稿</a>
        </div>
    </div>
    <div class="list-con">
        <div class="page-header">
            <h1><a name="src" id="src">Src</a></h1>
        </div>
        <div class="tags-list">
            <a href="./src/http.html" target="_blank" class="tag">HTTP状态码</a>
            <a href="./src/operator.html" target="_blank" class="tag">PHP 运算符</a>
            <a href="./src/php.md" target="_blank" class="tag">PHP 代码片段</a>
            <a href="./src/css.md" target="_blank" class="tag">CSS 代码片段</a>
            <a href="./src/js.md" target="_blank" class="tag">JS 代码片段</a>
            <a href="./src/reg.md" target="_blank" class="tag">常用正则表达式</a>
        </div>
    </div>
    <div class="list-con">
        <div class="page-header">
            <h1><a name="ext" id="ext">Ext</a></h1>
        </div>
        <div class="tags-list">
            <p class="text-muted">1、php 代码格式化使用 phpstorm 的 Ctrl + Alt + L (在线可选 http://beta.phpformatter.com/)</p>
            <p class="text-primary">2、api 接口调试使用 chrome 的应用 paw 或 postman</p>
            <p class="text-success">3、抓包工具使用 Fiddler</p>
            <p class="text-info">4、代码比对工具 BCompare</p>
            <p class="text-warning">5、WEB 前端助手 -- https://www.baidufe.com/ (chrome plugin)</p>
            <p class="text-danger">6、前端开发工具箱 -- http://www.box3.cn/  (离线请使用其 chrome plugin)</p>
            <p class="text-muted">7、安卓模拟器使用 夜神模拟器</p>
            <p class="text-primary">8、IOS 模拟器使用 Safari</p>
            <p class="text-success">9、笔记及备忘使用 印象笔记</p>
            <p class="text-info">10、可视化工具：redis 使用 RedisClient，mongo 使用 MongoVUE，mysql 使用 navicat 查看</p>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
        <p>©所谓工具，不过是开发更简单！</p>
    </div>
</div>
</body>

</html>
