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
 * Class LimitNode.
 */
class LimitNode extends AstNode implements NodeInterface
{
    /**
     * @return mixed
     */
    public function build()
    {
        $this->buildChildren();
        $this->output = ['limit' => [$this->stage[0], $this->stage[1] ?? 0]];

        return $this->output;
    }
}
