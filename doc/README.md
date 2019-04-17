# joy-yaf规章
# yaf扩展地址https://pecl.php.net/package/yaf/3.0.7/windows

## 目录结构
<pre><code>
+ joy-yaf
   + application
        + actions       // 分离出来的方法
        + controllers   // 控制器
            - Doc.php
            - Index.php
            - Psr.php
        + library       // 框架公共类库
            + Base
                - APi.php // 接口通用基类
                - Code.php // 返回码处理类
                - Curl.php // 请求封装类
                - Error.php // 框架错误处理类
                - Lang.php // 多语言处理类
                - Response.php // 相应处理类
                - Utils.php // 工具类
                - Validate.php // 参数校验类
            + Cache
                - JoyCache.php // 框架缓存统一处理类
                - Redis.php // Redis处理类
            + Db
                - JoyDb.php // 框架数据库统一处理类
            + Log
                - SeasLog.php // 框架日志封装类
            + RiskControl
                - Duration.php // 风控跟时间相关的处理类
            + Worker
        + models        // 数据层
        + modules       // 模块
            + Demo
                + actions
                    + Medoo
                        - debug.php // 数据库debug使用demo
                        - delete.php // 数据库delete使用demo
                        - ...
                + controllers
                    - AliyunMns.php // 阿里云消息服务使用demo
                    - Code.php // 返回码使用demo
                    - ...
                + lib // 业务逻辑封装目录，自动加载
                    - Common.php
        + plugins       // 插件
            - Base.php // 框架通用插件类
        + views         // 视图
            + index
                - index.phtml
        - Bootstrap.php // 引导文件
   + conf
        + lang
            + zh_cn // 多语言支持--中文语言包文件夹
                - Demo.ini // Demo模块语言包
                - Error.ini
                - RiskControl.ini
        - application.ini
        - code.ini
        - worker.ini
   + doc                // 框架文档目录
        + nginx
            - joy-yaf.conf
        + tools
            - yaf-classes-generator.php
            - yaf-classes-namespace.php
        - README.md
   + public
        + css
        + img
        + js
        - index-dev.php    //开发环境入口文件
        - index-pro.php    //线上环境入口文件
        - index-qa.php     //QA环境入口文件
   + vendor // 第三方扩展安装目录
        + AliyunMNS
        + canfan
        + conmposer
        + evenement
        + php-curl-class
        + react
        + workerman
        - autoload.php
   - composer.json
   - composer.lock
</code></pre>

## 配置文件
<pre><code>
[Yaf]
# dev qa product ...
yaf.environ = "dev"
yaf.use_namespace = 1
</code></pre>

## 文档规范
https://docs.phpdoc.org/references/phpdoc/index.html

Demo可参考controllers下的Doc.php控制器

## PHP标准规范
https://psr.phphub.org/

Demo可参考controllers下的Psr.php控制器

## Nginx配置规范、域名规范、项目命名规范

- nginx见doc/nginx目录
- 域名规范：主管统一定,接口xxx-api.xxx.com,后台xxx-admin.xxx.com
- 域名环境规范：开发环境统一加-dev,QA环境统一加-qa
- 项目命名规范：主管统一定,跟svn或者git项目名保持一致

## 发布和版本管理规范

详见内部SVN文档

## 框架调整
#### 引导文件初始化和全局处理
- 参考Bootstrap.php
#### 路由重写，兼容yii2
- 参考plugins/Base.php
#### 错误异常处理
- 参考modules/Demo/controllers/Error.php
#### 请求和响应处理
- 请求参考：modules/Demo/controllers/Request.php
- 响应参考：modules/Demo/controllers/Response.php

## 组件介绍

### ORM--Medoo
参考modules/Demo/controllers/Medoo.php

### Cache--Redis
参考modules/Demo/controllers/Redis.php

### Log--SeasLog
参考modules/Demo/controllers/SeasLog.php

### Validators--DIY reference yii2
参考modules/Demo/controllers/Validate.php

### Lang--DIY
参考modules/Demo/controllers/Translate.php

### Curl--php-curl-class
参考modules/Demo/controllers/Curl.php

### Code--DIY
参考modules/Demo/controllers/Code.php

## 业务要求
### RiskControl--DIY
参考library/RiskControl/Duration.php
