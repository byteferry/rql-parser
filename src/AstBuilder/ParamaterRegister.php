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

namespace ByteFerry\RqlParser\AstBuilder;

/**
 * Class ParamaterRegister
 *
 * It is used for keep the data of predicates for validation.
 *
 * @package ByteFerry\RqlParser\AstBuilder
 */
class ParamaterRegister
{
    /**
     * @var null | ParamaterRegister
     */
    public static $instance = null;

    /**
     * @var array
     */
    protected $container = [];

    /**
     * @return \app\libraries\AppDataRegister
     */
    public static function getInstance(){
        return self::$instance;
    }

    /**
     * @return array
     */
    public function toArray(){
        return $this->container;
    }

    /**
     * @return \ByteFerry\RqlParser\AstBuilder\ParamaterRegister|null
     */
    public static function newInstance(){
        self::$instance = new static();
        return self::$instance;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return void
     */
    public function add($key,$value){
        if('null' == $value){
            $value = null;
        }
        $this->container[$key]=$value;
    }
}
