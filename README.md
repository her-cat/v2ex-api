<h1 align="center"> v2ex-api </h1>

<p align="center"> :palm_tree: 基于 V2EX API 的 PHP 组件.</p>

[![Build Status](https://travis-ci.org/her-cat/v2ex-api.svg?branch=master)](https://travis-ci.org/her-cat/v2ex-api)
[![StyleCI build status](https://github.styleci.io/repos/192050883/shield)](https://github.styleci.io/repos/192050883)
![GitHub](https://img.shields.io/github/license/her-cat/v2ex-api.svg)

## 安装

```shell
$ composer require her-cat/v2ex-api -vvv
```

## 使用

```php
use HerCat\V2exApi\V2exApi;

$v2ex = new V2exApi();
```

### 获取最热主题

```php
$response = $v2ex->getHotTopics();
```

示例：
```json
[
    {
        "node":{
            "avatar_large":"//cdn.v2ex.com/navatar/6e27/13a6/557_large.png?m=1473710080",
            "name":"life",
            "avatar_normal":"//cdn.v2ex.com/navatar/6e27/13a6/557_normal.png?m=1473710080",
            "title":"生活",
            "url":"https://www.v2ex.com/go/life",
            "topics":1291,
            "footer":null,
            "header":null,
            "title_alternative":"Life",
            "avatar_mini":"//cdn.v2ex.com/navatar/6e27/13a6/557_mini.png?m=1473710080",
            "stars":288,
            "root":false,
            "id":557,
            "parent_node_name":null
        },
        "member":{
            "username":"fyy5520",
            "website":"",
            "github":"",
            "psn":"",
            "avatar_normal":"//cdn.v2ex.com/gravatar/1e435c2a43b5af7191f09d401440e982?s=24&d=retro",
            "bio":"",
            "url":"https://www.v2ex.com/u/fyy5520",
            "tagline":"",
            "twitter":"",
            "created":1514864265,
            "avatar_large":"//cdn.v2ex.com/gravatar/1e435c2a43b5af7191f09d401440e982?s=24&d=retro",
            "avatar_mini":"//cdn.v2ex.com/gravatar/1e435c2a43b5af7191f09d401440e982?s=24&d=retro",
            "location":"",
            "btc":"",
            "id":278484
        },
        "last_reply_by":"PP",
        "last_touched":1560682334,
        "title":"30 岁大龄剩女日常吐槽",
        "url":"https://www.v2ex.com/t/574429",
        "created":1560665172,
        "content":"最近看到好多关于抨击大龄剩女的问题，",
        "content_rendered":"<p>最近看到好多关于抨击大龄剩女的问题，简直要生食其肉一般，也不知道为什么对这种群体有这么大恶意。</p>",
        "last_modified":1560665172,
        "replies":88,
        "id":574429
    }
]
```

### 获取最新主题

```php
$response = $v2ex->getLatestTopics();
```

示例：
> 返回结果跟 `获取最热主题` 一样

### 获取节点信息

```php
$response = $v2ex->getNode('python');
```

示例：
```json
{
    "avatar_large":"//cdn.v2ex.com/navatar/8613/985e/90_large.png?m=1560497984",
    "name":"python",
    "avatar_normal":"//cdn.v2ex.com/navatar/8613/985e/90_normal.png?m=1560497984",
    "title":"Python",
    "url":"https://www.v2ex.com/go/python",
    "topics":11624,
    "footer":"",
    "header":"这里讨论各种 Python 语言编程话题，也包括 Django，Tornado 等框架的讨论。这里是一个能够帮助你解决实际问题的地方。",
    "title_alternative":"Python",
    "avatar_mini":"//cdn.v2ex.com/navatar/8613/985e/90_mini.png?m=1560497984",
    "stars":8055,
    "root":false,
    "id":90,
    "parent_node_name":"programming"
}
```

### 获取用户信息

根据用户名获取用户信息

```php
$response = $v2ex->getMemberByUsername('hercat');
```

根据用户 ID 获取用户信息

```php
$response = $v2ex->getMemberByID(336714);
```

示例：
```json
{
    "username":"hercat",
    "website":null,
    "github":null,
    "psn":null,
    "avatar_normal":"//cdn.v2ex.com/gravatar/16a382effadf6405b4f2923be83e8d04?s=24&d=retro",
    "bio":null,
    "url":"https://www.v2ex.com/u/hercat",
    "tagline":null,
    "twitter":null,
    "created":1532747204,
    "status":"found",
    "avatar_large":"//cdn.v2ex.com/gravatar/16a382effadf6405b4f2923be83e8d04?s=24&d=retro",
    "avatar_mini":"//cdn.v2ex.com/gravatar/16a382effadf6405b4f2923be83e8d04?s=24&d=retro",
    "location":null,
    "btc":null,
    "id":336714
}
```

### 获取原始返回结果

方法最后一个参数为是否格式化结果，`bool` 类型 ：

```php
$response = $v2ex->getMemberByUsername('hercat', false);
```

### 参数说明

```php
array|string getHotTopics(bool $format = true)
array|string getLatestTopics(bool $format = true)
array|string getNode(string $name, bool $format = true)
array|string getMemberByUsername(string $username, bool $format = true)
array|string getMemberByID(int $id, bool $format = true)
```
> - $name - 节点名称，比如：“python”；
> - $username - 用户名称，比如：“hercat”；
> - $id - 用户 ID，比如：“336714”；
> - $format - 是否格式化返回结果。

## License

MIT