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

namespace ByteFerry\RqlParser\Exceptions;

/**
 * Class RegexException
 *
 * @package ByteFerry\RqlParser\exceptions
 */
class RegexException extends \Exception
{
    /**
     * @var int
     */
    public $errorCode;

    /**
     * @param int         $errorCode
     * @param string|null $additionalMessage
     */
    public function __construct(
        int $errorCode,
        string $additionalMessage = null
    ) {
        $this->errorCode = $errorCode;

        $errorMessage = $this->getErrorString($errorCode) ?? 'Unknown regex error';
        $additionalMessage = $additionalMessage ? " $additionalMessage" : '';

        parent::__construct("Regex error thrown: $errorMessage." . $additionalMessage);
    }

    /**
     * Gets an error string (const name) for the PCRE error code
     *
     * @param int $errorCode
     *
     * @return string|null|mixed
     */
    private function getErrorString(int $errorCode): ?string
    {
        $pcreConstants = get_defined_constants(true)['pcre'] ?? [];

        /*
         * NOTE: preg_last_error() returns an int, but there are constants
         * in PHP 7.3+ that are strings, bools, or otherwise. We can pretty
         * safely filter out the non-integers to fetch the appropriate
         * error constant name.
         */
        $pcreConstants = array_filter($pcreConstants, function ($code) {
            return is_int($code);
        });

        $errorStrings = array_flip($pcreConstants);

        return $errorStrings[$errorCode] ?? null;
    }
}
