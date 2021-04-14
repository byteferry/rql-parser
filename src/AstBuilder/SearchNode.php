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

namespace ByteFerry\RqlParser\AstBuilder;


/**
 * Class SearchNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class SearchNode extends AstNode implements NodeInterface
{

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'search';
    }

    /**
     * @return mixed
     */
    public function build(){

        $this->buildChildren();
        $query =  trim($this->stage[0],'\'""');
        if(trim($query,'%')===$query){
            $query .='%';
        }
        $this->output = [$this->getNodeType() =>$query];
        return $this->output;
    }

}
