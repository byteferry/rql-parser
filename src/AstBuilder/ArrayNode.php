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
 * Class ArrayNode
 *
 * @package ByteFerry\RqlParser\AstBuilder
 */
class ArrayNode extends AstNode implements NodeInterface
{
    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'array';
    }

    /**
     * @return mixed
     */
    public function build(){
        $this->buildChildren();
        $this->output[0] =  ' (' . implode(', ', $this->stage) . ') ';
        return $this->output[0];
    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return $this->stage;
    }
}