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


/**
 * Class DataNode
 *
 * @package ByteFerry\RqlParser\Ast
 */
class DataNode extends AstNode implements nodeInterface
{

    /**
     * @var array;
     */
    protected $data;

    /**
     * @return string
     */
    public function getNodeType()
    {
        return 'data';
    }

    /**
     * @return mixed
     */
    public function build(){
        $this->buildChildren();
        foreach($this->pair() as $item){
            [$property, $value] = $item;
            $this->output[$property] = trim($value,'""');
        }
        return ['data' => $this->output];
    }

    /**
     * @return mixed|void
     */
    public function toArray(){
        return ['data' => $this->output];
    }
}
