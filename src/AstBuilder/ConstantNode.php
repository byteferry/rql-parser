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

use ByteFerry\RqlParser\Lexer\ListLexer;

/**
 * Class ValueNode
 *
 * @package ByteFerry\RqlParser\AstBuilder
 */
class ConstantNode extends AstNode implements NodeInterface
{

    /**
     * @return int
     */
    protected function true(){
        return 1;
    }

    /**
     * @return int
     */
    protected function false(){
        return 0;
    }

    /**
     * @return string
     */
    protected function null(){
        return 'null';
    }

    /**
     * @return string
     */
    protected function empty(){
        return '""';
    }

    /**
     * @param \ByteFerry\RqlParser\Lexer\ListLexer $ListLexer
     *
     * @return int|void
     */
    public function load(ListLexer $ListLexer){
        return $ListLexer->getNextIndex();
    }

    /**
     * @return mixed
     */
    public function build(){
        $symbol = $this->symbol;
        if(method_exists($this,$symbol)){
            $this->output[0] = $this->$symbol();
            return  $this->output[0];
        }
        $this->output[0] = $symbol;
        return  $this->output[0];
    }

}
