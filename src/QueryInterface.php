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

/**
 * Interface QueryInterface
 *
 * @package ByteFerry\RqlParser
 *
 * @property array $container
 */
interface QueryInterface
{

    /**
     * @return QueryInterface
     */
    public static function of();

    /**
     * @param array $query
     *
     * @return \ByteFerry\RqlParser\QueryInterface
     */
    public function from($query);

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name);


    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name);


    /**
     * @return mixed
     */
    public function toArray();
}
