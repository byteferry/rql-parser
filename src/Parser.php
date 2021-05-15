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

namespace ByteFerry\RqlParser;

use ByteFerry\RqlParser\AstBuilder\NodeInterface;
use ByteFerry\RqlParser\AstBuilder\NodeVisitor;
use ByteFerry\RqlParser\AstBuilder\ParamaterRegister;
use ByteFerry\RqlParser\Lexer\Lexer;
use ByteFerry\RqlParser\Lexer\ListLexer;
use ByteFerry\RqlParser\Lexer\Token;

/**
 * Class Parser.
 */
class Parser
{
    /**
     * @var NodeInterface[]
     */
    protected $node_list = [];

    /**
     * @param \ByteFerry\RqlParser\Lexer\ListLexer $tokens
     *
     * @return \ByteFerry\RqlParser\AstBuilder\NodeInterface[]
     */
    protected function load(ListLexer $ListLexer)
    {
        $ListLexer->rewind();
        /** @var Token $token */
        $token = $ListLexer->current();

        for (; (false !== $token); $token = $ListLexer->consume()) {
            $symbol = $token->getSymbol();
            /** @var NodeInterface $node */
            $node = NodeVisitor::visit($symbol);

            $node->load($ListLexer);
            $this->node_list[] = $node;
        }

        return $this->node_list;
    }

    /**
     * @param bool $is_segmaent
     *
     * @return QueryInterface
     */
    protected static function getOutputObject($is_fragmaent = false)
    {
        if (false === $is_fragmaent) {
            return Query::of();
        }

        return Fragment::of();
    }

    /**
     * @param      $string
     * @param bool $is_fragmaent
     *
     * @throws \ByteFerry\RqlParser\Exceptions\RegexException
     *
     * @return array
     */
    public static function parse($string, $is_fragmaent = false)
    {

        /** @var ListLexer $tokens */
        $tokens = Lexer::of()->tokenise($string);

        $instance = new static();

        ParamaterRegister::newInstance();

        /** @var NodeInterface[] $node_list */
        $node_list = $instance->load($tokens);
        $ir_list = [];

        /** @var NodeInterface $node */
        foreach ($node_list as $node) {
            $ir_list[] = $node->build();
        }

        $queries = [];
        foreach ($ir_list as $ir) {
            $query = self::getOutputObject($is_fragmaent);
            $queries[] = $query->from($ir);
        }
//        dd(json_encode($queries[0]->toArray()));
        return $queries;
    }
}
