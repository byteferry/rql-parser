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
 * Class FilterMode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class FilterNode extends AstNode implements NodeInterface
{

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'filter';
    }


    /**
     * @return mixed
     */
    public function build(){
        $this->buildChildren();
        $this->output = [$this->getSymbol() => $this->stage];
        return $this->output;
    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return $this->output;
    }
}
