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

use ByteFerry\RqlParser\Abstracts\BaseObject;
use ByteFerry\RqlParser\Exceptions\ParseException;


/**
 * Class TokenList
 *
 * @package ByteFerry\RqlParser\ListLexer
 */
class ListLexer extends BaseObject
{
    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var int
     */
    protected $level = 0;

    /**
     * @var int
     */
    protected $position = 0;



    /**
     * @param $token
     *
     * @return void
     */
    public function addItem(Token $token){
        if($token->getType() === Symbols::T_OPEN_PARENTHESIS){
            /**
             * for < ,( >  that is the array operator,
             * we'd insert a node 'arr'
             */
            if($token->getPrevType()===Symbols::T_COMMA){
                $this->items[$this->position++] = Token::makeArrayToken(Symbols::T_COMMA);
            }
            $token->setPrevType(Symbols::T_WORD);
            $this->level++;
        }
        if($token->getType() === Symbols::T_CLOSE_PARENTHESIS){
            $this->level--;
        }
        $token->setLevel($this->level);
        $this->items[$this->position++] = $token;
    }

    /**
     * @param $type
     *
     * @return void
     */
    public function setNextType($type){
        if(isset($this->items[$this->position-2])){
            $this->items[$this->position-2]->setNextType($type);
        }
    }

    /**
     * @return mixed
     */
    public function current(){
        return $this->items[$this->position];
    }

    /**
     * @return bool|mixed
     */
    public function consume(){
        /**
         * if got the end we must return;
         */
        if($this->isEnd()){
            return false;
        }
        /**
         * get the next token
         */
        $token = $this->items[++$this->position];
        /**
         * we only consume the word or string.
         */
        for(; $token->isPunctuation() && !$this->isEnd(); $token = $this->items[++$this->position]){
            /**
             * if we meet the close flag we must return.
             */
            if($token->isClose()){
                return $token;
            }
        }
        return $token;
    }


    /**
     * @return mixed
     */
    public function rewind()
    {
        $this->position = 0;
        return $this->items[$this->position];
    }

    /**
     *
     * @return int
     */
    public function getNextIndex()
    {
        return ++$this->position;
    }

    /**
     * @return mixed
     */
    public function getNextType(){
        return $this->items[$this->position]->getNextType();
    }

    /**
     * @return mixed
     */
    public function isClose(){
        return $this->items[$this->position]->isClose();
    }

    /**
     * @return bool
     */
    public function noArgs(){
        $token = $this->items[$this->position];
        return (($token->isOpen())&&($token->willClose()));
    }

    /**
     * @return bool
     */
    public function isEnd(){
        return $this->position+1 >= count($this->items);
    }

    /**
     * @param $step
     *
     * @return void
     */
    public function forward($step){
        $this->position += $step;
    }

    /**
     * @return int
     */
    public function getLevel(){
        return $this->level;
    }

}
