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


namespace ByteFerry\RqlParser\Lexer;

use ByteFerry\RqlParser\Exceptions\ParseException;
/**
 * Class Token
 *
 * @package ByteFerry\RqlParser
 */
class Token
{
    /**
     *
     * symbol type
     * @var int
     */
    protected $type = 0;

    /**
     * symbol content string
     * @var string
     */
    protected $symbol = '';

    /**
     * the lexer type of next node
     * @var int
     */
    protected $next_type = -1;

    /**
     * the lexer type of previous node
     * @var int
     */
    protected $previous_type = -1;

    /**
     * @var int
     */
    protected $level = 0;

    /**
     * @param     $type
     * @param     $symbol
     * @param int $previous_type
     *
     * @return  static
     */
    public static function from($type,$symbol,$previous_type = -1)
    {
        /**
         * ensure the syntax of the rql with simple ABNF definition
         */
        if(-1 !== $previous_type){
            if(!in_array($type,Symbols::$rules[$previous_type])){
                throw new ParseException('Syntex error in Node of ' .$symbol);
            }
        }


        $instance = new static();
        $instance->type = $type;
        $instance->symbol = $symbol;
        $instance->previous_type = $previous_type;
        return $instance;
    }

    /**
     * @param $previousType
     *
     * @return \ByteFerry\RqlParser\Lexer\Token
     */
    public static function makeArrayToken($previousType){
        $instance = new static();
        $instance->type = Symbols::T_WORD;
        $instance->symbol = 'arr';
        $instance->previous_type = $previousType;
        return $instance;
    }

    /**
     * @param $level
     *
     * @return void
     */
    public function setLevel($level){
        $this->level = $level;
    }

    /**
     * @param $type
     *
     * @return void
     */
    public function setNextType($type)
    {
        $this->next_type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     *
     * @return void
     */
    public function setPrevType($type){
        $this->previous_type=$type;
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @return bool
     */
    public function isOpen(){
        return $this->type === Symbols::T_OPEN_PARENTHESIS;
    }

    /**
     * @return bool
     */
    public function isClose(){
        return ($this->type === Symbols::T_CLOSE_PARENTHESIS);
    }

    /**
     * @return int
     */
    public function getPrevType(){
        return $this->previous_type;
    }

    /**
     * @return bool
     */
    public function isPunctuation(){
        return !( ($this->type === Symbols::T_WORD)
               || ($this->type === Symbols::T_STRING)
               );
    }

}
