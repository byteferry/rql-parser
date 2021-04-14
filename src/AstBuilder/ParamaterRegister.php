<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: bardo
 * Date: 2021-04-12
 * Time: 23:05
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
