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
 * BlockCipherFactoryProxy.
 */
class BlockCipherFactoryProxy implements BlockCipherFactoryProxyInterface
{
    /**
     * @var string
     */
    private $fullyQualifiedClassName;

    /**
     * Constructor.
     *
     * @param string $completeClassName
     */
    public function __construct($completeClassName = BlockCipher::class)
    {
        $this->fullyQualifiedClassName = $completeClassName;
    }

    /**
     * @inheritDoc
     */
    public function factory($adapter, $options = [])
    {
        return forward_static_call_array(
            [$this->fullyQualifiedClassName, 'factory'],
            [$adapter, $options]
        );
    }
}
