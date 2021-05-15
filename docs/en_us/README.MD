# ByteFerry RQL-Parser 
>>ByteFerry RQL-Parser is used for parsing the RQL text to the paramaters with PHP array structure for the calling of php methods. 
  
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
  
if success, it will return a QueryInterface. 

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

