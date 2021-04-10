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
 * Class LimitNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class LimitNode extends AstNode implements NodeInterface
{

    /**
     * @var int
     */
    protected $skip_or_page = 0;

    /**
     * @var int
     */
    protected $max_count = 0;

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'limit';
    }

    /**
     * @return mixed
     */
    public function build(){

        $this->buildChildren();
        $this->output = ['limit'=>[$this->stage[0],$this->stage[1]??0]] ;
        return $this->output;

    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return $this->output;
    }
}
