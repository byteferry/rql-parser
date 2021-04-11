<?php

/*
 * This file is part of the ByteFerry/Rql-Parser package.
 *
 * (c) BardoQi <67158925@qq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);


namespace ByteFerry\RqlParser\Abstracts;

/**
 * Class BaseObject
 *
 * @package ByteFerry\RqlParser\abstracts
 */
abstract class BaseObject
{

    /**
     * @return \ByteFerry\RqlParser\Abstracts\BaseObject|static
     */
    public static function of(){
        return new static();
    }

}
