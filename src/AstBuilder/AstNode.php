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
use ByteFerry\RqlParser\Lexer\Token;

/**
 * abstract class of node of abstract syntax tree.
 *
 * Class AstNode
 */
abstract class AstNode
{
    /**
     * @var string
     */
    protected $operator;

    /**
     * @var string
     */
    protected $symbol;

    /**
     * keep the children nodes when load function is called .
     *
     * @var NodeInterface[]
     */
    protected $argument = [];

    /**
     * keep the built components.
     *
     * @var array
     */
    protected $stage = [];

    /**
     * keep the build result of children.
     *
     * @var array
     */
    protected $output = [];

    /**
     * @param $operator
     * @param $symbol
     */
    public function __construct($operator, $symbol)
    {
        $this->operator = $operator;
        $this->symbol = $symbol;
    }

    /**
     * @param $operator
     * @param $symbol
     *
     * @return \ByteFerry\RqlParser\AstBuilder\AstNode|static
     */
    public static function of($operator, $symbol)
    {
        return new static($operator,$symbol);
    }

    /**
     * @return void
     */
    protected function buildChildren()
    {
        /** @var NodeInterface $child */
        foreach ($this->argument as $child) {
            $this->stage[] = $child->build();
        }
    }

    /**
     * @param \ByteFerry\RqlParser\Lexer\ListLexer $ListLexer
     *
     * @return int|void
     */
    public function load(ListLexer $ListLexer)
    {

        /** @var Token $token */
        $token = $ListLexer->consume();

        for (; (false !== $token); $token = $ListLexer->consume()) {
            if ($ListLexer->isClose()) {
                return $ListLexer->getNextIndex();
            }
            /** @var NodeInterface $node */
            $node = NodeVisitor::visit($token->getSymbol());
            $node->load($ListLexer);

            $this->argument[] = $node;
            if ($ListLexer->isClose()) {
                return $ListLexer->getNextIndex();
            }
        }

        return $ListLexer->getNextIndex();
    }

    /**
     * @return string
     */
    public function getSymbol()
    {
        return $this->symbol;
    }

    /**
     * @return \Generator
     */
    public function pair()
    {
        for ($i = 0,$j = count($this->stage); $i < $j; $i += 2) {
            yield [$this->stage[$i], $this->stage[$i + 1]];
        }
    }

    /**
     * @param $ListLexer
     *
     * @return mixed
     */
    abstract public function build();
}
