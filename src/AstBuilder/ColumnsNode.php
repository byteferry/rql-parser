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
 * Class ColumnsNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class ColumnsNode extends AstNode implements NodeInterface
{

    /**
     * @return array
     */
    protected function buildChildren(){
        $groupBy=[];
        /** @var NodeInterface $child */
        foreach($this->argument as $child){
            $this->stage[] = $child->build();
            if(($this->operator === 'aggregate')&&($child instanceof ConstantNode)){
                $groupBy[] = $child->getSymbol();
            }
        }
        return $groupBy;
    }

    /**
     * @return mixed
     */
    public function build(){
        $groupBy = $this->buildChildren();
        $this->output['columns'] = $this->stage;
        $this->output['columns_operator'] = $this->getSymbol();
        $this->output['group_by'] = $groupBy;
        return $this->output;
    }

}
