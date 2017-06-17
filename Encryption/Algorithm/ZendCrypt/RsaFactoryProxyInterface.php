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

use Traversable;
use Zend\Crypt\PublicKey\Rsa;
use Zend\Crypt\PublicKey\Rsa\Exception\InvalidArgumentException;
use Zend\Crypt\PublicKey\Rsa\Exception\RuntimeException;

/**
 * RsaFactoryProxyInterface.
 */
interface RsaFactoryProxyInterface
{
    /**
     * RSA instance factory.
     *
     * @param array|Traversable $options
     *
     * @throws RuntimeException
     * @throws InvalidArgumentException
     *
     * @return Rsa
     */
    public function factory($options);
}
