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

use ByteFerry\RqlParser\Exceptions\ParseException;
use ByteFerry\RqlParser\Lexer\Symbols;

/**
 * Class NodeVisitor
 *
 * @package ByteFerry\RqlParser\Ast
 */
class NodeVisitor
{

    /**
     * @param $name
     *
     * @return mixed
     */
    protected static function fromAlias($name)
    {
        return Symbols::$type_alias[$name]??$name;
    }

    /**
     * @param $operator
     *
     * @return mixed
     */
    protected static function getNodeType($operator)
    {
        return Symbols::$type_mappings[$operator]??null;
    }

    /**
     * @param $node_type
     *
     * @return mixed|null
     */
    protected static function getClass($node_type)
    {
        return Symbols::$class_mapping[$node_type]??Symbols::$class_mapping['N_CONSTANT'];
    }


    /**
     * @param $symbol
     *
     * @return \ByteFerry\RqlParser\AstBuilder\NodeInterface;
     */
    public static function visit($symbol){
        $operator = self::fromAlias($symbol);
        $node_type = self::getNodeType($operator);
        $node_class = self::getClass($node_type);
        if(null === $node_class){
            throw new ParseException('Node class of ' .$node_type.' not found!');
        }
        return $node_class::of($operator,$symbol);
    }
}
