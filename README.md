<<<<<<< HEAD
# Tools
开发工具收集，只为更好的开发!


<h5>是否所有工具都需要配置?</h5>
并非如此，譬如 php Info, php 代码运行, 打个草稿等就不需要配置。

<h5>php 代码运行的意义是什么?</h5>
譬如你不清楚读取字符串的某位 $str = 'abcdefg' 是否可以使用 $str{1} 或者 $str[1]。当然，其他测试代码也可以相对快捷的得到答案。

<h5>如何配置并使用 webgrind?</h5>
首先, webgrind 使用的前提是安装 xdebug (自行检索安装),并配置好 xdebug 的 profile 项，如下：
xdebug.remote_enable = off
xdebug.profiler_enable = on
xdebug.profiler_enable_trigger = on
xdebug.profiler_output_name = cachegrind.out.%t.%p
xdebug.profiler_output_dir = "f:/laragon/tmp"

<h5>如何使用 mysql 日志追踪?</h5>
在 mysql.ini 配置文件中加入如下配置，并重启 mysql 服务
[v5.5以上的配置]
[mysqld]
general_log= ON
general_log_file = "E:/program/data/mysql_log.log"
--------------------------------------------------
[v5.5以下的配置]
log=E:/program/data/mysql_log.log

<h5>Tools 宗旨及愿景？</h5>
Tools 目前主要搜集了日常开发使用的部分，当然还有更多可以拓展的地方，希望更多的人能够加入并完善！

<h5>如何找到我？</h5>
如果你有任何疑问或者想把宝贵的意见告知我，请邮件联系 chenyuanqi90s@163.com
=======
# PHP-Tools
php 工具集合
>>>>>>> 26125fcd4626960a465310d7a1a865e6b376ae68
