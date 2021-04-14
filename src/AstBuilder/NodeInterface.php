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
 * Interface NodeInterface
 *
 * @package ByteFerry\RqlParser\Ast
 */
interface NodeInterface
{

    /**
     * @param ListLexer $ListLexer
     *
     * @return int
     */
    public function load(ListLexer $ListLexer);

    /**
     * @return mixed
     */
    public function build();


}
