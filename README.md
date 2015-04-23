# 有道词典 For Linux命令行
Youdao Dictionary For Linux Command Line

> 在使用Linux Shell 的时候碰到不认识的单词怎么办？从现在起你不需要拷贝-粘贴到词典软件里查询了，一条简单的命令就可以帮助你翻译！

### fanyi 命令
输入命令 `fanyi capacity`：

        [root@elekids bin]# fanyi capacity
        能力

如果需要更加详细的网络翻译结果增加 `-d(detail) ` 参数即可：
        [root@elekids ~]# fanyi -d hostname
        主机名  hostname /'həust,neim/
        
        基本释义: n. 主机名称；主名
        
        网络释义:
        Hostname | 主机名称 显示 设置系统网络名
        Invalid Hostname | 其表现为 无效的主机名 无效主机名
        alias hostname | 别名主机名

###  获取该命令
        cd /bin 
        wget http://api.ijustplay.cn/youdao/fanyi
        chmod 777 fanyi
