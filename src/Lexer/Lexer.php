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
 * Class Lexer.
 */
class Lexer extends BaseObject
{
    /**
     * @var array
     */
    protected $symbol_keys;

    /**
     * @var int
     */
    protected $previous_type = -1;

    /**
     * @var ListLexer | null
     */
    protected $listLexer = null;

    /**
     * Lexer constructor.
     *
     * we need get the array of keys of the symbols first!
     */
    public function __construct()
    {
        $this->symbol_keys = Symbols::getSymbolsKey();
    }

    /**
     * The match data is in the target key and the offset!=-1.
     *
     * @param $match
     *
     * @return array
     */
    protected function getMatch($match)
    {
        foreach ($this->symbol_keys as $key) {
            if (isset($match[$key]) && (-1 !== $match[$key][1])) {
                return [$key => $match[$key]];
            }
        }

        return [];
    }

    /**
     * @param $match
     *
     * @return mixed
     */
    protected function addToken($match)
    {
        $key = key($match);

        [$symbol,$offset] = $match[$key];

        $this->listLexer->addItem(Token::from($key, $symbol, $this->previous_type));

        /**
         * set the next_token_type for last token.
         */
        $this->listLexer->setNextType($key);

        $this->previous_type = $key;

        return $offset + strlen($symbol);
    }

    /**
     * @param $rql_str
     *
     * @throws \ByteFerry\RqlParser\Exceptions\RegexException
     *
     * @return \ByteFerry\RqlParser\Lexer\ListLexer
     */
    public function tokenise($rql_str)
    {
        $this->listLexer = ListLexer::of();
        /**
         * using all the regular expressions.
         */
        $math_expression = Symbols::makeExpression();

        $rql_str = trim($rql_str);

        $end_pos = strlen($rql_str);

        for ($offset = 0; $offset < $end_pos;) {
            preg_match($math_expression, $rql_str, $result, PREG_OFFSET_CAPTURE, $offset);
            if (preg_last_error() !== PREG_NO_ERROR) {
                throw new ParseException(array_flip(get_defined_constants(true)['pcre'])[preg_last_error()]);
            }

            /**
             * get the result from matches.
             */
            $match = $this->getMatch($result);

            /**
             * update the offset.
             */
            $offset = $this->addToken($match);
        }

        if (0 !== $this->listLexer->getLevel()) {
            throw new ParseException('The bracket are not paired.');
        }

        return $this->listLexer;
    }
}
