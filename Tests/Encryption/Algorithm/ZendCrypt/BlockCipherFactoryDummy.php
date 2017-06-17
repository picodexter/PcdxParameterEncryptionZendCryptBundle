<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests\Encryption\Algorithm\ZendCrypt;

/**
 * BlockCipherFactoryDummy.
 */
class BlockCipherFactoryDummy implements BlockCipherFactoryDummyInterface
{
    /**
     * @var string
     */
    public static $lastCallMethodName = '';

    /**
     * @var array
     */
    public static $lastCallArguments = [];

    /**
     * @inheritDoc
     */
    public static function factory($adapter, $options = [])
    {
        self::$lastCallMethodName = 'factory';
        self::$lastCallArguments = func_get_args();

        return new BlockCipherDummy();
    }
}
