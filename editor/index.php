<style type="text/css">
    #e {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        font-size: 16px;
    }
</style>
<div id="e"></div>
<script src="../public/style/js/ace.js"></script>
<script src="../public/style/js/jquery-1.8.2.min.js"></script>
<script>
    var myKey = "SecretKeyz";
    $(document).ready(function () {
        var e = ace.edit("e");
        e.setTheme("ace/theme/solarized_light");
        e.getSession().setMode("ace/mode/markdown");
    });
</script>
