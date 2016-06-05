<?php
    require_once('../config.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>查找替换</title>
    <link rel="stylesheet" href="../public/lib/elf/css/elf.css" />
    <script type="text/javascript" src="../public/style/js/jquery-1.8.2.min.js"></script>
</head>

<body>
    <main class="elf">
        <form class="forms" action="" method="post" onkeydown="if(event.keyCode==13)dealReplace();">
            <textarea id="content" name="content" cols="30" rows="10" placeholder="请填写替换内容..."></textarea>
            <fieldset style="margin-top: 2.5rem;">
                <legend>查找替换</legend>
                <section>
                    <div class="input-prepend">
                        <input name="search" type="text"  placeholder="搜索内容" />
                    </div>
                </section>
                <section>
                    <div class="btn-append">
                        <input name="replace" type="text" placeholder="替换为..." />
                        <span>
                            <button type="button" class="btn" onclick="dealReplace();">Go</button>
                        </span>
                    </div>
                </section>
                <section>
                    <select name="rule" class="select" multiple>
                        <?php foreach($_CFG['regex_rule'] as $key => $val){?>
                            <option value="<?php echo $key;?>">‘<?php echo $val['search'];?>’ 替换为 ‘<?php echo $val['replace'];?>’</option>
                        <?php }?>
                    </select>
                </section>
                <section>
                    <button type="button" class="ghost-dark round" onclick="dealRule();">执行自定义规则</button>
                    <button type="button" class="ghost-dark round" onclick="$('#content').val('')">清空文本域</button>
                </section>
            </fieldset>
        </form>
    </main>
</body>
<script type="text/javascript">
    /**
     * 查找替换处理
     * @param search  string 查找词
     * @param replace string 替换词
     * @returns {boolean}
     * @author vikey.chen
     */
    function dealReplace(search, replace) {
        //@转义
        if(!search){
            search  = $('input[name=search]').val().replace(/\\/g, '\\\\');
        }else{
            search  = search.replace(/\\/g, '\\\\');
        }
        if(!replace){
            replace = $('input[name=replace]').val();
        }
        var content = $('#content').val();
        //@正则中的变量
        var regex   = new RegExp(search, "gim");

        if ('' === content || '' === search) {
            return false;
        } else {
            $('#content').val(content.replace(regex, replace));
        }
    }

    /**
     * 执行规则
     * @returns {boolean}
     * @author vikey.chen
     */
    function dealRule() {
        var rule = $('select[name=rule]').val();
        var ruleConf = <?php echo $_CFG['regex_rule'] ? json_encode($_CFG['regex_rule']) : 0;?>;
        if (null == rule || 0 == rule.length || 0 == ruleConf) {
            return false;
        } else {
            $(rule).each(function (k, v) {
                var search = ruleConf[v].search;
                var replace = ruleConf[v].replace;
                dealReplace(search, replace);
            })
        }
    }
</script>
</html>

