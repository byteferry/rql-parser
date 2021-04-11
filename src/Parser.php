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

use ByteFerry\RqlParser\AstBuilder\NodeVisitor;
use ByteFerry\RqlParser\Lexer\Lexer;
use ByteFerry\RqlParser\AstBuilder\NodeInterface;
use ByteFerry\RqlParser\Lexer\Token;
use ByteFerry\RqlParser\Lexer\ListLexer;


/**
 * Class Parser
 *
 * @package ByteFerry\RqlParser
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
    protected function load(ListLexer $ListLexer){
        $ListLexer->rewind();
        /** @var Token $token */
        $token = $ListLexer->current();

        for(; (false !== $token); $token = $ListLexer->consume()){

            $symbol = $token->getSymbol();
            /** @var NodeInterface $node */
            $node = NodeVisitor::visit($symbol);

            $node->load($ListLexer);
            $this->node_list[] = $node;
        }
        return $this->node_list;
    }

    /**
     * @param $string
     *
     * @return Query[];
     * @throws \ByteFerry\RqlParser\Exceptions\RegexException
     */
    public static function parse($string)
    {
        /** @var ListLexer $tokens */
        $tokens = Lexer::of()->tokenise($string);

        $instance = new static();

        /** @var NodeInterface[] $node_list */
        $node_list = $instance->load($tokens);
        $ir_list = [] ;

        /** @var NodeInterface $node */
        foreach($node_list as $node){
            $ir_list[] = $node->build();
        }

        $queries = [];
        foreach ($ir_list as $ir) {
            $queries[] = Query::from($ir);
        }
        dd($queries);
        return $queries;
    }
}
