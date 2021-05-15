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
 * Class AggregateNode.
 */
class AggregateNode extends AstNode implements NodeInterface
{
    /**
     * @return mixed
     */
    public function build()
    {
        $this->buildChildren();
        $this->output[0] = $this->operator.'('.$this->stage[0].')';

        return $this->output[0];
    }
}
