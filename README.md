#impress_sms
本教程是基于laravel5.0的,所以应该用的文件都备好了,所以刚学习的童鞋,
不要手多composer update,出了问题,问我我也是不会解决的,
毕竟我没时间更新.

把文件下下来后,在env配置自己的环境,你想要群发邮件,那就必须配email,
统一用QQ发,密码就是QQ的密码,其他的邮箱会多一步,问其他人,
毕竟写下了又一大窜了.不会的留issues,我尽量回复你,在群我不回.

找出
```
..\impress_sms\project\public\dist\ueditor\utf8-php\php\config.json
```
把
```
http://impress_sms.dev/
```
"批量"替换成你的域名,这样上传图片发图片路径才对.

最后,运行
```
php artisan migrate
```
现在你可以注册群发邮件或者群发手机了.手机群发的是基于云片网络的,
注册后把你相应的接口数据替换就可以了,路径
```
..\impress_sms\project\app\Services\SendSms.php
```
至于上传excel导入数据库的文件被我误删了,后续还原出来.
你可以任意修改代码,但是我保留最终解释权.
