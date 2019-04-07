

# Instruction-to-V1

## Alpha阶段

> Alpha阶段不使用框架，手工搭建MVC架构，熟悉网站开发流程

### 目录说明

![](https://github.com/mio4/V1-Bug/blob/feature-Mio-v0.1/bbs/imgs/1.png)

### 项目架构说明

![](https://github.com/mio4/V1-Bug/blob/feature-Mio-v0.1/bbs/imgs/2.png)

### 前后端交互逻辑举例

TODO

### 后端逻辑举例

TODO

## 其他说明

1. 密码为什么要加密？

   密码不能直接明文存储在网站后台服务器，因为如果遇到hacker进行SQL注入攻击，或者拿到了后台的权限，就可以直接查看数据库密码，非常不安全。

   暂时考虑使用MD5（原密码） + 盐（Salt：每一个用户对应的随机数散列值）的形式存放在数据库

2. 为什么前端对用户名密码进行校验后，后端还需要校验？

   因为如果对面不使用浏览器，而是使用请求构造工具（比如一些白帽子工具），可以绕过前端的信息校验，所以Double Check是很必要的。

3. 







---






# 草稿

### 版本说明

```cmd
PHP 7.0
Laravel 

```



```cmd
# 安装指定版本
composer create-project laravel/laravel=5.3.* demo --prefer-dist

```



### Laravel命令

```cmd
//生成Controller
php artisan make:controller ControllerName

```



---