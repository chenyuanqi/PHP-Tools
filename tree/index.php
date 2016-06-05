<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
    <title>以树状姿势查看文件目录</title>
    <link rel="stylesheet" href="../public/lib/elf/css/elf.css" />
    <script type="text/javascript" src="../public/style/js/jquery-1.8.2.min.js"></script>
</head>

<body>
    <main class="elf">
        <form class="forms" action="" method="post" onsubmit="return false;" onkeydown="if(event.keyCode==13)dealPath();">
            <section>
                <div class="curtain centered">
                    <h4>Windows 命令行，推荐使用 cmder</h4>
                </div>
            </section>
            <section>
                <div class="btn-append">
                    <input name="path" type="text" placeholder="目录路径..." />
                    <span>
                        <button type="button" class="btn" onclick="dealPath();">Go</button>
                    </span>
                </div>
            </section>
        </form>
        <textarea id="output" cols="30" rows="30"></textarea>
    </main>
</body>
<script type="text/javascript">
    /**
     * 处理文件路径生成树状结构目录
     * @author vikey.chen
     */
    function dealPath(){
        var path = $('input[name=path]').val();
        if('' == path){
            return false;
        } else {
            $.ajax({
                type: "post",
                url: "./tree.php",
                data: {
                    'path':path
                },
                beforeSend: function(XMLHttpRequest){
                    $("#output").val('目录文件较多时，请耐心等待哦。。。');
                },
                success: function(data){
                    $("#output").val(data);
                },
                error: function(data){
                    console.log(data);
                }
            });
        }
    }
</script>
</html>

