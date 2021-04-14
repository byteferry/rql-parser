<?php
declare(strict_types=1);
/*
 * This file is part of the ByteFerry/Rql-Parser package.
 *
 * (c) BardoQi <67158925@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ByteFerry\Tests\Unit;

use ByteFerry\Tests\TestCase;
use  ByteFerry\RqlParser\Parser;
use  ByteFerry\RqlParser\Fragment;

/**
 * Class QueryInterfaceTest
 *
 * @package ByteFerry\Tests\Unit
 */
final class QueryInterfaceTest extends TestCase
{
    /** @test */
    public function testQueryInterface(){
        $rql_str= 'all(User,aggr(id,name,age,gender,address,avg(age)),filter(is(created_at, null()), search(Jhon),sort(-id,+age),having(gt(sum(amount),0)),limit(0,20)))'; //,    //,

        $result = Parser::parse($rql_str);
        /** @var \ByteFerry\RqlParser\Query $query */
        $query = $result[0];
        $this->assertEquals($query->getResourceName(),'User');
        $this->assertEquals($query->getColumns(),[0 => 'id',
            1 => 'name',
            2 => 'age',
            3 => 'gender',
            4 => 'address',
            5 => 'avg(age)']);
        $this->assertEquals($query->getColumnsOperator(),'aggr');
        $this->assertEquals($query->getGroupBy(),[
            0 => 'id',
            1 => 'name',
            2 => 'age',
            3 => 'gender',
            4 => 'address']);
        $this->assertEquals($query->getFilter(),' created_at is null ');
        $this->assertEquals($query->getParameters(),[
            'created_at' => NULL,
            'sum(amount)' => '0'
        ]);

        $this->assertEquals($query->getSearch(),'Jhon%');
        $this->assertEquals($query->getSort(),[
            [   0 => 'id',
                1 => 'DESC'
                ],
            [
                0 => 'age',
                1 => 'ASC',
            ]
        ]);
        $this->assertEquals($query->getHaving(),' sum(amount) > 0 ');
        $this->assertEquals($query->getLimit(),['0','20']);
        $this->assertEquals($query->getOperator(),'all');
        $this->assertEquals($query->getQueryType(),'Q_READ');
        $this->assertEquals($query->query_type,'Q_READ');
        $this->assertEquals($query->operator,'all');
        $this->assertTrue(isset($query->operator));
        $this->assertEquals($query->name,null);
    }

    /** @test */
    public function testFragment(){
        $rql_str= 'aggregate(id,sum(amount))'; //,    //,

        $result = Parser::parse($rql_str,true);
        /** @var \ByteFerry\RqlParser\Fragment $query */
        $query = $result[0];
        $this->assertTrue($query instanceof Fragment);
        $this->assertEquals($query->columns,["id","sum(amount)"]);
        $this->assertEquals($query->group_by,["id"]);
        $this->assertEquals($query->columns_operator,'aggregate');
        $this->assertFalse(isset($query->operator));
        $this->assertEquals($query->operator,null);
    }
}
