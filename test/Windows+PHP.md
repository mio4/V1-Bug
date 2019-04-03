### Windows 下PHP开发环境搭建

版本说明

```cmd
PHP 7.3.3 (cli)
nginx version: nginx/1.14.2
```

安装位置说明

```cmd
# PHP + Nginx
E:\SofwareEngineering\WNMP
```

进度

```cmd
1. 将PHP添加到Windows环境变量 √
2. PHP配置XDebug
	添加Xdebug.dll，修改php.ini √
3. 配置PHPStorm-Server
	
4. 安装Nginx
	配置nginx.conf文件 √
	添加到Windows环境变量 ×
	启动nginx
5. 配置fastcgi
	启动fastcgi
	E:\0Develop\php\php-7.1.10-Win32-VC14-x64>php-cgi.exe -b 127.0.0.1:9001
	php-cgi.exe -b 127.0.0.1:9000
```

