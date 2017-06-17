<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt;

use Zend\Crypt\BlockCipher;

/**
 * BlockCipherFactoryProxyInterface.
 */
interface BlockCipherFactoryProxyInterface
{
    /**
     * Factory.
     *
     * @param string $adapter
     * @param array  $options
     *
     * @return BlockCipher
     */
    public function factory($adapter, $options = []);
}
