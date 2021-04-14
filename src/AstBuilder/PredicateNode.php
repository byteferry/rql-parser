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
use ByteFerry\RqlParser\Exceptions\ParseException;

/**
 * Class PredicateNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class PredicateNode extends AstNode implements NodeInterface
{

    /**
     * @return mixed
     */
    public function between(){
        [$a, $b, $c] = $this->stage;
        $paramaterRegister =ParamaterRegister::getInstance();
        $paramaterRegister->add($a . '_from',$b);
        $paramaterRegister->add($a . '_to',$c);
        $this->output[0] = sprintf(' %s BETWEEN %s and %s ', $a, $b, $c);
        return $this->output[0];
    }

    /**
     * @return mixed
     */
    public function build(){
        $this->buildChildren();
        $operator = Symbols::$operators[$this->operator]??null;
        $paramaterRegister =ParamaterRegister::getInstance();

        /**
         * for extend other predicate
         */
        if(method_exists($this,$operator)){
            return $this->$operator();
        }

        [$a, $b] = $this->stage;
        if(null === $operator){
            throw new ParseException('The operators ' . $this->symbol . ' is not defined in the parser! ');
        }
        $paramaterRegister->add($a,$b);
        $this->output[0] = sprintf(' %s %s %s ', $a,$operator,$b);
        return $this->output[0];
    }

}
