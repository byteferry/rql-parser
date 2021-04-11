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
 * Class LogicNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class LogicNode extends AstNode implements NodeInterface
{

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'logic';
    }

    /**
     * @return mixed
     */
    public function build(){
        $this->buildChildren();

        if($this->symbol === 'not'){
            $argument = $this->stage[0];
            $this->output[0] = sprintf(' not (%s)' ,$argument);
            return $this->output[0] ;
        }
        [$a,$b] = $this->stage;
        $this->output[0] = sprintf('((%s) %s (%s))', $a, $this->symbol,$b);
        return $this->output[0] ;
    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return $this->output ;
    }
}
