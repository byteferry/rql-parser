<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: bardo
 * Date: 2021-04-10
 * Time: 13:42
 */

namespace ByteFerry\tests\Unit;

use ByteFerry\tests\TestCase;

use ByteFerry\RqlParser\Parser;

/**
 * Class SimpleQueryTest
 *
 * @package ByteFerry\tests\Unit
 */
final class SimpleQueryTest extends TestCase
{
//    /** @test */
//    public function TestAnyQuery(){
//        $rql_str= "any(User,only(id,name,age,gender,address),filter( and(  eq(age,19),  between(id, 100, 200)  )  ) )"; //,    //,
//        $result = Parser::parse($rql_str);
//        dd($result);
//    }

//    /** @test */
//    public function TestOneQuery(){
//        $rql_str= "one(User,only(id,name,age,gender,address),filter( and(  gt(age,19),  in(id, (100, 200))  )  ) )"; //,    //,
//        $result = Parser::parse($rql_str);
//        dd($result);
//    }

//    /** @test */
//    public function TestAllQuery(){
//        $rql_str= 'all(User,only(id,name,age,gender,address),filter(is(created_at, null())), search(Jhon),having(gt(sum(amount),0)))'; //,    //,
//        $result = Parser::parse($rql_str);
//        dd($result);
//    }

//    /** @test */
//    public function TestFirstQuery(){
//        $rql_str= 'first(User,only(id,name,age,gender,address),filter(is(created_at, null())), search(Jhon),sort(-id,+age),having(gt(sum(amount),0)),limit(0,20))'; //,    //,
//        $result = Parser::parse($rql_str);
//        dd($result);
//    }

//    /** @test */
//    public function TestAddQuery(){
//        $rql_str= 'create(User,data(name:"Jhon Smith",age:26,gender:1,addres:"No 235, Golden Street, MarkTown, New York, USA"))'; //,    //,
//        $result = Parser::parse($rql_str);
//        dd($result);
//    }

    /** @test */
    public function TestAggrQuery(){
        $rql_str= 'all(User,aggr(id,name,age,gender,address,avg(age)),filter(is(created_at, null())), search(Jhon),sort(-id,+age),having(gt(sum(amount),0)),limit(0,20))'; //,    //,
        $result = Parser::parse($rql_str);
        dd($result);
    }

}
