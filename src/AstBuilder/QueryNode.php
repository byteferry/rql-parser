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

use ByteFerry\RqlParser\Lexer\Symbols;

/**
 * abstract node of abstract syntax tree (AST)
 *
 * Class RqlNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class QueryNode extends AstNode implements NodeInterface
{

    /**
     * @param $array
     *
     * @return void
     */
    protected function addStage($array){
        foreach($array as $key => $item){
            $this->stage[$key] = $item;
        }
    }

    /**
     * @return void
     */
    protected function buildChildren(){
        /** @var NodeInterface $child */
        foreach($this->argument as $child){
            $result = $child->build();
            if(!is_array($result)){
                $this->stage['resource'] = $result;
            }else{
                $this->addStage($result);
            }
        }
    }

    /**
     * @return mixed
     */
    public function build(){

        $this->buildChildren();
        $this->output = $this->stage;
        $this->output['operator'] = $this->operator;
        $this->output['query_type'] = Symbols::$query_type_mapping[$this->symbol]??null;
        return $this->output;
    }

}
