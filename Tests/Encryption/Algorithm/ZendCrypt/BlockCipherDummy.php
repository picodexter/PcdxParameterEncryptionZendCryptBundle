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
 * BlockCipherDummy.
 */
class BlockCipherDummy extends BlockCipher
{
    /**
     * Constructor.
     */
    /** @noinspection PhpMissingParentConstructorInspection */
    public function __construct()
    {
    }
}
