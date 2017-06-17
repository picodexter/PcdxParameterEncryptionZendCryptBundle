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

use Zend\Crypt\BlockCipher;

/**
 * BlockCipherFactoryDummyInterface.
 */
interface BlockCipherFactoryDummyInterface
{
    /**
     * Factory
     *
     * @param  string      $adapter
     * @param  array       $options
     * @return BlockCipher
     */
    public static function factory($adapter, $options = []);
}
