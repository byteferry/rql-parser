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

use ByteFerry\RqlParser\Fragment;
use ByteFerry\Tests\TestCase;
use  ByteFerry\RqlParser\Parser;
use  ByteFerry\RqlParser\Exceptions\ParseException;
/**
 * Class ExceptionTest
 *
 * @package ByteFerry\Tests\Unit
 */
final class ExceptionTest extends TestCase
{
    /** @test */
    public function testExceptions(){
        $rql_str= 'aggregate(id,,sum(amount))'; //,    //,
        try{
        $result = Parser::parse($rql_str,true);
        }catch(\Exception $e){
            $this->assertTrue($e instanceof ParseException);
        }

        $rql_str= 'aggregate(id,sum(amount)'; //,    //,
        try{
            $result = Parser::parse($rql_str,true);
        }catch(\Exception $e){
            $this->assertTrue($e instanceof ParseException);
        }

    }
}
