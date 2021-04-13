# ByteFerry RQL-Parser 
>ByteFerry RQL-Parser是一个将RQL查询语言的文本解析成PHP函数调用时可用的参数的解析器。

[![Build Status](https://travis-ci.org/byteferry/rql-parser.png?branch=master)](https://travis-ci.org/byteferry/rql-parser)
[![StyleCI](https://github.styleci.io/repos/293536215/shield?branch=master)](https://github.styleci.io/repos/293536215?branch=master)
[![Codecov branch](https://img.shields.io/codecov/c/github/byteferry/rql-parser/develop.svg?style=flat-square&logo=codecov)](https://codecov.io/github/byteferry/rql-parser)
[![Latest Stable Version](https://poser.pugx.org/byteferry/rql-parser/v)](//packagist.org/packages/byteferry/rql-parser)
[![Total Downloads](https://poser.pugx.org/byteferry/rql-parser/downloads)](//packagist.org/packages/byteferry/rql-parser)
[![License](https://poser.pugx.org/byteferry/rql-parser/license)](//packagist.org/packages/byteferry/rql-parser)
 

[English(英文)](https://github.com/byteferry/rql-parser)

此库包含以下几个部分：
- lexer用于将RQL代码转换成Token列表。
- 通过解析创建AST（抽象语法树）
- 通过简代的RQL的ABNF进行编译


## 特性

* 高性能，全部代码不到60KB.
* 完全遵循编译规范。
* 带语法检查，因而，对开发人员友好。 
* 不只支持读查询，同时也支持写查询。
* 支持 `filter` `sort` `search` 和 `pagination`。
* 经过phpUnit完全覆盖的单元测试。
* 零第三方依赖。所以，方便集成安装。 

## 为什么要用RQL 

* 同样的数据，RQL要比Json短很多。
* 简单易学。
* RQL让API更加灵活。
* RQL比GraphQL更适合于中小项目。
* RQL可以节省大量开发时间。

## 安装
```php
$ composer requrire byteferry/rql-Parser
```

## 用法

* 解析完整查询

```php
use ByteFerry/RqlParser/Parser;

    $rql_string = 'any(User,columns(id,name,age,gender,address),filter(eq(age,19)))';
    try{
        $query = Parser::parse( $rql_string);
    }catch(\Exception $e){
        // will catch  errror of parse or grammer checking.
    }

```
  
如果成功，将返回 QueryInterface 类型的对象。

* 解析查询片断


```php
use ByteFerry/RqlParser/Parser;

    $rql_string = 'filter(eq(age,19))';
    try{
        $query = Parser::parse( $rql_string, true);
    }catch(\Exception $e){
        // will catch  errror of parse or grammer checking.
    }

```

这里有个复杂的例子。 (并不是真正的查询，主要是让其返回所有的属性)
```php
        $rql_str= 'all(User,aggr(id,name,age,gender,address,avg(age)),filter(is(created_at, null()), search(Jhon),sort(-id,+age),having(gt(sum(amount),0)),limit(0,20)))'; //,    //,
        $result = Parser::parse($rql_str);
        // Returns：
        /** array (
             0 =>
             ByteFerry\RqlParser\Query::__set_state(array(
                'container' =>
               array (
                 'resource' => 'User',
                 'columns' =>
                 array (
                   0 => 'id',
                   1 => 'name',
                   2 => 'age',
                   3 => 'gender',
                   4 => 'address',
                   5 => 'avg(age)',
                 ),
                 'columns_operator' => 'aggr',
                 'group_by' =>
                 array (
                   0 => 'id',
                   1 => 'name',
                   2 => 'age',
                   3 => 'gender',
                   4 => 'address',
                 ),
                 'filter' =>
                 array (
                   0 => ' created_at is null ',
                 ),
                 'paramaters' =>
                 array (
                   'created_at' => NULL,
                   'sum(amount)' => '0',
                 ),
                 'search' => 'Jhon%',
                 'sort' =>
                 array (
                   0 =>
                   array (
                     0 => 'id',
                     1 => 'DESC',
                   ),
                   1 =>
                   array (
                     0 => 'age',
                     1 => 'ASC',
                   ),
                 ),
                 'having' =>
                 array (
                   0 => ' sum(amount) > 0 ',
                 ),
                 'limit' =>
                 array (
                   0 => '0',
                   1 => '20',
                 ),
                 'operator' => 'all',
                 'query_type' => 'Q_READ',
               ),
             )),
           )

        */

```

我们可以发现，解析器会自动解析出并返回GroupBy。同时，还返回了parematers，这是干什么的呢？这是给你做数据验证的。

## 文档
[在这里查看 RQL文档](https://byteferry.github.io/rql-parser/#/zh-cn/)


#### 贡献

1.  Fork此源码库
2.  创建 Feat_xxx 分支
3.  提交你的代码
4.  创建 Pull Request

### 捐赠 

如果你觉得此项目对你有用，那请你帮助买杯果汁。🍹
   
![donate](https://raw.githubusercontent.com/BardoQi/bmc/master/myqr_ch_sm.png)    
   
### 授权
  
MIT

Copyright [2020] ByteFerry [byteferry@qq.com](ByteFerry@qq.com)




