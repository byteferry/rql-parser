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

use ReflectionClass;
use ByteFerry\RqlParser\AstBuilder as Ast;
/**
 * Class Symbols
 *
 * @package ByteFerry\RqlParser
 */
class Symbols
{

    /**
     * The keys of Symbol List Of Lexer
     *
     * @var array
     */
    public const  T_WORD                =  'T_WORD';
    public const  T_STRING              =  'T_STRING';
    public const  T_OPEN_PARENTHESIS    =  'T_OPEN_PARENTHESIS';   // (
    public const  T_CLOSE_PARENTHESIS   =  'T_CLOSE_PARENTHESIS';  // )
    public const  T_PLUS                =  'T_PLUS';               // +
    public const  T_COMMA               =  'T_COMMA';              // ,
    public const  T_MINUS               =  'T_MINUS';              // -
    public const  T_COLON               =  'T_COLON';              // :

    /**
     * The Symbol List Of Lexer
     *
     * @var array
     */
    public static $symbol_expressions = [
        'T_WORD'                => '(?<T_WORD>\w+_*?\w*?)',                 // word
        'T_OPEN_PARENTHESIS'    => '(?<T_OPEN_PARENTHESIS>\({1})',          // (
        'T_CLOSE_PARENTHESIS'   => '(?<T_CLOSE_PARENTHESIS>\){1})',         // )
        'T_STRING'              => '(?<T_STRING>".*?")|(?<T_DOT>\.{1})',    // ".*"
        'T_COLON'               => '(?<T_COLON>:{1})',                      // :
        'T_COMMA'               => '(?<T_COMMA>,{1})',                      // ,
        'T_PLUS'                => '(?<T_PLUS>\+{1})',                      // +
        'T_MINUS'               => '(?<T_MINUS>\-{1})',                     // -
    ];

    /**
     * we use the rules to ensure the rql language is correct
     * we put the rules here only for doing the  maintenance conveniently
     * @var array
     */
    public static $rules = [
        'T_WORD' => ['T_OPEN_PARENTHESIS','T_CLOSE_PARENTHESIS','T_COMMA','T_COLON'],
        'T_STRING' => ['T_OPEN_PARENTHESIS','T_CLOSE_PARENTHESIS','T_COMMA','T_COLON'],
        'T_OPEN_PARENTHESIS' => ['T_WORD','T_STRING','T_PLUS','T_MINUS','T_CLOSE_PARENTHESIS'],
        'T_CLOSE_PARENTHESIS' =>['T_CLOSE_PARENTHESIS','T_COMMA'],
        'T_COLON'=>['T_WORD','T_STRING'],
        'T_COMMA'=>['T_WORD','T_STRING','T_OPEN_PARENTHESIS','T_PLUS','T_MINUS'],
        'T_PLUS'=>['T_WORD'],
        'T_MINUS'=>['T_WORD']
    ];


    /**
     * list of operator aliases
     * @var array
     */
    public static $type_alias = [
        'plus' =>'increment',
        'minus'=>'decrement',
        'cols'=>'columns',
        'only'=>'columns',
        'field'=>'columns',
        'select'=>'columns',
        'aggr'=>'aggregate',
        'mean'=>'avg',
        'nin' =>'out',
    ];

    /**
     * mapping the type to node type
     * @var array
     */
    public static $type_mappings = [
        'aggr' =>'N_COLUMN',
        'aggregate' =>'N_COLUMN',
        'all' =>'N_QUERY',
        'and' =>'N_LOGIC',
        'any' =>'N_QUERY',
        'arr' =>'N_ARRAY',
        'avg' =>'N_AGGREGATE',
        'between' =>'N_PREDICATE',
        'cols' =>'N_COLUMN',
        'columns' =>'N_COLUMN',
        'count' =>'N_QUERY',
        'create' =>'N_QUERY',
        'data' =>'N_DATA',
        'decrement' =>'N_QUERY',
        'delete' =>'N_QUERY',
        'distinct' =>'N_COLUMN',
        'empty' => 'N_CONSTANT',
        'eq' =>'N_PREDICATE',
        'except' =>'N_COLUMN',
        'exists' =>'N_QUERY',
        'false' => 'N_CONSTANT',
        'filter' =>'N_FILTER',
        'first' =>'N_QUERY',
        'ge' =>'N_PREDICATE',
        'gt' =>'N_PREDICATE',
        'having' =>'N_FILTER',
        'in' =>'N_PREDICATE',
        'increment' =>'N_QUERY',
        'is' => 'N_PREDICATE',
        'le' =>'N_PREDICATE',
        'like' =>'N_PREDICATE',
        'limit' =>'N_LIMIT',
        'lt' =>'N_PREDICATE',
        'max' =>'N_AGGREGATE',
        'mean' =>'N_AGGREGATE',
        'min' =>'N_AGGREGATE',
        'minus' =>'N_QUERY',
        'ne' =>'N_PREDICATE',
        'nin' =>'N_PREDICATE',
        'not' =>'N_LOGIC',
        'null'=>'N_CONSTANT',
        'one' =>'N_QUERY',
        'only' =>'N_COLUMN',
        'or' =>'N_LOGIC',
        'out' =>'N_PREDICATE',
        'plus' =>'N_QUERY',
        'search' =>'N_SEARCH',
        'select' =>'N_COLUMN',
        'sort' =>'N_SORT',
        'sum' =>'N_AGGREGATE',
        'true' => 'N_CONSTANT',
        'update' =>'N_QUERY',
        'values' =>'N_COLUMN',
    ];

    /**
     * mapping node type to class
     * @var array
     */
    public static $class_mapping = [
        'N_AGGREGATE' =>    Ast\AggregateNode::class,
        'N_ARRAY'=>         Ast\ArrayNode::class,
        'N_COLUMN' =>       Ast\ColumnsNode::class,
        'N_CONSTANT' =>     Ast\ConstantNode::class,
        'N_DATA' =>         Ast\DataNode::class,
        'N_FILTER' =>       Ast\FilterNode::class,
        'N_LIMIT' =>        Ast\LimitNode::class,
        'N_LOGIC' =>        Ast\LogicNode::class,
        'N_PREDICATE' =>    Ast\PredicateNode::class,
        'N_QUERY' =>        Ast\QueryNode::class,
        'N_SEARCH' =>       Ast\SearchNode::class,
        'N_SORT' =>         Ast\SortNode::class,
    ];

    /**
     * @var array
     */
    public static $operators = [
        'eq' => '=',
        'ne' => '<>',
        'gt' => '>',
        'ge' => '>=',
        'lt' => '<',
        'le' => '<=',
        'is' => 'is',
        'in' => 'in',
        'out' => 'not in',
        'like' => 'like',
        'between' => 'between',
        'contains' => 'contains'
    ];

    /**
     * Query type mapping
     * @var array
     */
    public static $query_type_mapping = [
        'all'           =>  'Q_READ',
        'any'           =>  'Q_READ',
        'count'         =>  'Q_READ',
        'create'        =>  'Q_WRITE',
        'decrement'     =>  'Q_WRITE',
        'delete'        =>  'Q_WRITE',
        'exists'        =>  'Q_READ',
        'first'         =>  'Q_READ',
        'increment'     =>  'Q_WRITE',
        'one'           =>  'Q_READ',
        'update'        =>  'Q_WRITE',
    ];

    /**
     * @return array
     * @throws \ReflectionException
     */
    public static function getSymbolsKey()
    {
        $reflect = new ReflectionClass(__CLASS__);
        return $reflect->getConstants();
    }

    /**
     * @return string
     */
    public static function makeExpression(){
        $expression = '/';
        $expression .= implode('|', self::$symbol_expressions);
        return $expression . '/';
    }
}
