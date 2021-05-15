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
 * Class DataNode.
 */
class DataNode extends AstNode implements nodeInterface
{
    /**
     * @return mixed
     */
    public function build()
    {
        $this->buildChildren();
        foreach ($this->pair() as $item) {
            [$property, $value] = $item;
            $this->output[$property] = trim($value, '""');
        }

        return ['data' => $this->output];
    }
}
