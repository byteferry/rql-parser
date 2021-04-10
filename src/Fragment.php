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
 * Class Fragment
 *
 * @package ByteFerry\RqlParser
 */
final class Fragment extends BaseObject
{

    /**
     * @var array
     */
    protected $container = [];


    /**
     * @param array $query
     *
     * @return \ByteFerry\RqlParser\Fragment
     */
    public static function from($query)
    {
        $instance = new static();
        $instance->container = $query;
        return $instance;
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        if (isset($this->container[$name])) {
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
    public function __set($name, $value)
    {
        $this->container[$name] = $value;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->container[$name]);
    }
}
