# ByteFerry RQL-Parser 
>ByteFerry RQL-Parser is used for parsing the RQL text to the paramaters with PHP array structure for the calling of php methods. 

[![Build Status](https://travis-ci.org/byteferry/rql-parser.png?branch=master)](https://travis-ci.org/byteferry/rql-parser)
[![StyleCI](https://github.styleci.io/repos/173471239/shield?branch=master)](https://github.styleci.io/repos/173471239?branch=master)
[![Codecov branch](https://img.shields.io/codecov/c/github/byteferry/rql-parser/develop.svg?style=flat-square&logo=codecov)](https://codecov.io/github/byteferry/rql-parser)
[![Latest Stable Version](https://poser.pugx.org/byteferry/rql-parser/v)](//packagist.org/packages/byteferry/rql-parser)
[![Total Downloads](https://poser.pugx.org/byteferry/rql-parser/downloads)](//packagist.org/packages/byteferry/rql-parser)
[![License](https://poser.pugx.org/byteferry/rql-parser/license)](//packagist.org/packages/byteferry/rql-parser)
 


[中文(Chinese)](https://github.com/byteferry/rql-parser/blob/master/README.cn.md)

This library consists of the following parts: 
- lexer for tokenization RQL code
- parser for creating abstract syntax tree
- builder using simplized ABNF of RQL


## Features

* High performance. The size of source code is less than 60KB. 
* It is fully according the compile specification. 
* Friendly for development with the checking of RQL grammer. 
* Support the both reading and writing query.
* Support `filter` `sort` `search` and `pagination`
* Fully  tested with phpUnit.
* Zero dependencies. 

## Why RQL 

* For the same data, RQL has much fewer bytes than JSON.
* Simple and easy to learn.
* RQL will make the API interface more flexible
* RQL is more suitable for small and medium-sized projects than GraphQL. 
* RQL can save you more development time.

## Installation
```php
$ composer requrire byteferry/rql-Parser
```

## Usage

* parser a full query

```php
use ByteFerry/RqlParser/Parser;

    $rql_string = 'any(User,columns(id,name,age,gender,address),filter(eq(age,19)))';
    try{
        $query = Parser::parse( $rql_string);
    }catch(\Exception $e){
        // will catch  errror of parse or grammer checking.
    }

```
  
if sucess, it will return a QueryInterface. 

* parser a query segment of RQL query


```php
use ByteFerry/RqlParser/Parser;

    $rql_string = 'filter(eq(age,19))';
    try{
        $query = Parser::parse( $rql_string, true);
    }catch(\Exception $e){
        // will catch  errror of parse or grammer checking.
    }

```

Here is a complex example. (Not a real query, but returns all properties)
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

We could see that the parser add groupby automatically, and returns the property parematers for validation.

## Documentation
[RQL Documentation](https://byteferry.github.io/rql-parser/#/en-us/)


#### Contribution

1.  Fork the repository
2.  Create Feat_xxx branch
3.  Commit your code
4.  Create Pull Request
  
### Donation
  
If you find this project useful, you can buy author a glass of juice 🍹
    
![donate](https://raw.githubusercontent.com/BardoQi/bmc/master/myqr_en_sm.png)     

### License
  
MIT

Copyright [2020] ByteFerry [byteferry@qq.com](ByteFerry@qq.com)
