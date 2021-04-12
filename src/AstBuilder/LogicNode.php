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
        if($this->operator === 'not'){
            $this->output[] =  sprintf('%s %s', $this->operator, $this->stage[0] );
            return $this->output[0];
        }
        $this->output[] = '(' .implode(')'. $this->symbol .'(', $this->stage) .')';
        return $this->output[0];
    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return $this->output ;
    }
}
