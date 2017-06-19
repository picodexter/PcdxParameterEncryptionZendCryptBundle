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

use Traversable;
use Zend\Crypt\PublicKey\Rsa;

/**
 * RsaFactoryDummyInterface.
 */
interface RsaFactoryDummyInterface
{
    /**
     * RSA instance factory.
     *
     * @param  array|Traversable $options
     *
     * @throws Rsa\Exception\RuntimeException
     * @throws Rsa\Exception\InvalidArgumentException
     *
     * @return Rsa
     */
    public static function factory($options);
}
