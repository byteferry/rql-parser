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

use ByteFerry\RqlParser\Lexer\Symbols;
use ByteFerry\RqlParser\Lexer\ListLexer;

/**
 * Class SortNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class SortNode extends AstNode implements NodeInterface
{

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'sort';
    }

    /**
     * @param \ByteFerry\RqlParser\Lexer\ListLexer $ListLexer
     *
     * @return \Generator|void
     */
    protected function getArguments(ListLexer $ListLexer){

        $token = $ListLexer->consume();
        // the sort node will end with ')'
        // we only need consume the word token
        while(!$token->isClose()){
            $property = $token->getSymbol();
            $direction = 'ASC';

            // with prev type we could know the direction.
            if($token->getPrevType() === Symbols::T_MINUS){
                $direction = 'DESC';
            }
            yield [$property, $direction];
            $token = $ListLexer->consume();

        }

    }

    /**
     * @param \ByteFerry\RqlParser\Lexer\ListLexer $ListLexer
     *
     * @return int|void
     */
    public function load(ListLexer $ListLexer){
        /**
         * set resource_name value
         */
        foreach($this->getArguments($ListLexer) as $argument){
            $this->stage[] = $argument;
        }
        // return the $index, perhaps there are other queries still.
        return $ListLexer->getNextIndex();
    }

    /**
     * @return mixed
     */
    public function build(){
        $this->output = [$this->getNodeType() => $this->stage];
        return $this->output;
    }

}
