<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: bardo
 * Date: 2021-04-11
 * Time: 19:19
 */

namespace ByteFerry\Tests\Unit;

use ByteFerry\Tests\TestCase;
use  ByteFerry\RqlParser\Parser;
/**
 * Class KeyTest
 *
 * @package ByteFerry\tests\Unit
 */
final class KeyTest extends TestCase
{
    protected $test_keys = [
        'aggr' =>['aggr(id,sum(amount))','{"columns":["id","sum(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'aggregate' =>['aggregate(id,sum(amount))','{"columns":["id","sum(amount)"],"columns_operator":"aggregate","group_by":["id"]}'],
        'and' =>['and(gt(age,20),lt(id,300),is(name,null()))','"( age > 20 )and( id < 300 )and( name is null )"'],
        'arr' =>['in(id,(1,34,2,4))','" id in  (1, 34, 2, 4)  "'],
        'avg' =>['aggr(id,avg(amount))', '{"columns":["id","avg(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'between' =>['between(age,18,55)','" age BETWEEN 18 and 55 "'],
        'cols' =>['cols(id,age)','{"columns":["id","age"],"columns_operator":"cols","group_by":[]}'],
        'columns' =>['columns(id,age,name)','{"columns":["id","age","name"],"columns_operator":"columns","group_by":[]}'],
        'data' =>['data(id:17,score:33)','{"data":{"id":"17","score":"33"}}'],
        'empty' => ['is(name,empty())','" name is \"\" "'],
        'eq' =>['eq(age,17)','" age = 17 "'],
        'except' =>['except(password)','{"columns":["password"],"columns_operator":"except","group_by":[]}'],
        'false' => ['filter(false())','{"filter":[0],"paramaters":[]}'],
        'filter' =>['filter(eq(age,11))','{"filter":[" age = 11 "],"paramaters":{"age":"11"}}'],
        'ge' =>['ge(age,35)','" age >= 35 "'],
        'gt' =>['gt(age,15)','" age > 15 "'],
        'having' =>['having(ge(sum(amount),100))','{"having":[" sum(amount) >= 100 "],"paramaters":{"sum(amount)":"100"}}'],
        'in' =>['in(id,(1,3,5))','" id in  (1, 3, 5)  "'],
        'is' => ['is(name,null())','" name is null "'],
        'le' =>['le(age,3)','" age <= 3 "'],
        'like' =>['like(name,"ad%")','" name like \"ad%\" "'],
        'limit' =>['limit(1,20)','{"limit":["1","20"]}'],
        'lt' =>['lt(age,15)','" age < 15 "'],
        'max' =>['aggr(id,max(amount))','{"columns":["id","max(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'mean' =>['aggr(id,mean(amount))','{"columns":["id","avg(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'min' =>['aggr(id,min(amount))','{"columns":["id","min(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'ne' =>['ne(age,15)','" age <> 15 "'],
        'nin' =>['nin(age,(15,25,35))','" age not in  (15, 25, 35)  "'],
        'not' =>['is(name,not(null()))','" name is not null "'],
        'null' =>['is(name,not(null()))','" name is not null "'],
        'only' =>['only(id,name,age,email)','{"columns":["id","name","age","email"],"columns_operator":"only","group_by":[]}'],
        'or' =>['or(eq(age,18),eq(gender,1))','"( age = 18 )or( gender = 1 )"'],
        'out' =>['out(id,(1,3,5))','" id not in  (1, 3, 5)  "'],
        'search' =>['search("jh%")','{"search":"jh%"}'],
        'select' =>['select(id,name,age)','{"columns":["id","name","age"],"columns_operator":"select","group_by":[]}'],
        'sort' =>['sort(+age,-name)','{"sort":[["age","ASC"],["name","DESC"]]}'],
        'sum' =>['aggr(id,sum(amount))','{"columns":["id","sum(amount)"],"columns_operator":"aggr","group_by":["id"]}'],
        'true' => ['eq(deleted,true())','" deleted = 1 "'],
        'values' =>['values(name)','{"columns":["name"],"columns_operator":"values","group_by":[]}'],
    ];

    /** @test */
    public function testKeys(){
        foreach($this->test_keys as $key => $item){
            [$test_str,$compare] = $item;
            $result = Parser::parse($test_str,true);
            $this->assertEquals($compare,json_encode($result[0]->toArray()));
        }
    }
}
