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

namespace ByteFerry\RqlParser;

use ByteFerry\RqlParser\Abstracts\BaseObject;

/**
 * Class Query
 *
 * @package ByteFerry\RqlParser
 */
class Query extends BaseObject implements QueryInterface
{

    /**
     * @var array
     */
    protected $container = [];


    /**
     * @param array $query
     *
     * @return \ByteFerry\RqlParser\Query
     */
    public function from($query)
    {
        $this->container = $query;
        return $this;
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name){
        if(isset($this->container[$name])){
            return $this->container[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @param $value
     *
     * @return void
     */
    public function __set($name,$value){
        $this->container[$name] = $value;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name){
        return isset($this->container[$name]);
    }

    /**
     * @return array|mixed
     */
    public function toArray(){
        return $this->container;
    }

    /**
     * @return mixed|null
     */
    public function  getOperator(){
        return $this->container['operator']??null;
    }

    /**
     * @return mixed|null
     */
    public function  getQueryType(){
        return $this->container['query_type']??null;
    }

    /**
     * @return string
     */
    public function getResourceName(){
        return $this->container['resource']??null;
    }

    /**
     * @return array
     */
    public function getColumns(){
        return $this->container['columns']??null;
    }

    /**
     * @return mixed|null
     */
    public function getColumnsOperator(){
        return $this->container['columns_operator']??null;
    }

    /**
     * @return mixed|null
     */
    public function getGroupBy(){
        return $this->container['group_by']??null;
    }

    /**
     * @return mixed|null
     */
    public function getFilter(){
        return $this->container['filter']??null;
    }

    /**
     * @return mixed|null
     */
    public function getSearch(){
        return $this->container['search']??null;
    }

    /**
     * @return mixed|null
     */
    public function getSort(){
        return $this->container['sort']??null;
    }

    /**
     * @return mixed|null
     */
    public function getHaving(){
        return $this->container['having']??null;
    }

    /**
     * @return mixed|null
     */
    public function getLimit(){
        return $this->container['limit']??null;
    }

}
