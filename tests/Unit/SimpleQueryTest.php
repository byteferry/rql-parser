<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: bardo
 * Date: 2021-04-10
 * Time: 13:42
 */

namespace ByteFerry\Tests\Unit;

use ByteFerry\Tests\TestCase;

use ByteFerry\RqlParser\Parser;

/**
 * Class SimpleQueryTest
 *
 * @package ByteFerry\tests\Unit
 */
final class SimpleQueryTest extends TestCase
{
    public $query_keys = [
        'all' =>['all(user,only(id,age))', '{"resource":"user","columns":["id","age"],"columns_operator":"only","group_by":[],"operator":"all","query_type":"Q_READ"}'],
        'any' =>['any(user,cols(id,name,age))','{"resource":"user","columns":["id","name","age"],"columns_operator":"cols","group_by":[],"operator":"any","query_type":"Q_READ"}'],
        'count' =>['count(user,cols(id))','{"resource":"user","columns":["id"],"columns_operator":"cols","group_by":[],"operator":"count","query_type":"Q_READ"}'],
        'create' =>['create(user,data(name:jhon,age:17))','{"resource":"user","data":{"name":"jhon","age":"17"},"operator":"create","query_type":"Q_WRITE"}'],
        'decrement' =>['decrement(Article,cols(read_count))','{"resource":"Article","columns":["read_count"],"columns_operator":"cols","group_by":[],"operator":"decrement","query_type":"Q_WRITE"}'],
        'delete' =>['delete(User,filter(eq(id,23)))','{"resource":"User","filter":[" id = 23 "],"paramaters":{"id":"23"},"operator":"delete","query_type":"Q_WRITE"}'],
        'distinct' =>['distinct(User_score,filter(gt(score,95)))','{"columns":["User_score",{"filter":[" score > 95 "],"paramaters":{"score":"95"}}],"columns_operator":"distinct","group_by":[]}'],
        'exists' =>['exists(user,filter(eq(mobile,1111)))','{"resource":"user","filter":[" mobile = 1111 "],"paramaters":{"mobile":"1111"},"operator":"exists","query_type":"Q_READ"}'],
        'first' =>['first(user,filter(gt(age,10)))','{"resource":"user","filter":[" age > 10 "],"paramaters":{"age":"10"},"operator":"first","query_type":"Q_READ"}'],
        'increment' =>['increment(Article,cols(read_count))','{"resource":"Article","columns":["read_count"],"columns_operator":"cols","group_by":[],"operator":"increment","query_type":"Q_WRITE"}'],
        'minus' =>['minus(Article,cols(read_count))','{"resource":"Article","columns":["read_count"],"columns_operator":"cols","group_by":[],"operator":"decrement","query_type":null}'],
        'one' =>['one(user,filter(eq(id,3)))','{"resource":"user","filter":[" id = 3 "],"paramaters":{"id":"3"},"operator":"one","query_type":"Q_READ"}'],
        'plus' =>['plus(Article,cols(read_count))','{"resource":"Article","columns":["read_count"],"columns_operator":"cols","group_by":[],"operator":"increment","query_type":null}'],
        'update' =>['update(user,data(age:18),filter(eq(id,3)))','{"resource":"user","data":{"age":"18"},"filter":[" id = 3 "],"paramaters":{"id":"3"},"operator":"update","query_type":"Q_WRITE"}']
    ];

    /** @test */
    public function testQuery(){
        foreach($this->query_keys as $key => $item){
            [$test_str,$compare] = $item;
            $result = Parser::parse($test_str);
            $this->assertEquals($compare,json_encode($result[0]->toArray()));
        }
    }

}
