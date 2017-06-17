<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Encrypter;

use Exception;
use Picodexter\ParameterEncryptionBundle\Encryption\Encrypter\EncrypterInterface;
use Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException;
use Zend\Crypt\BlockCipher;

/**
 * ZendCryptBlockCipherEncrypter.
 */
class ZendCryptBlockCipherEncrypter implements EncrypterInterface
{
    /**
     * @var BlockCipher
     */
    private $cipher;

    /**
     * Constructor.
     *
     * @param BlockCipher $cipher
     */
    public function __construct(BlockCipher $cipher)
    {
        $this->cipher = $cipher;
    }

    /**
     * @inheritDoc
     */
    public function encryptValue($plainValue, $encryptionKey = null)
    {
        try {
            $this->cipher->setKey($encryptionKey);

            $encryptedValue = $this->cipher->encrypt($plainValue);

            return $encryptedValue;
        } catch (Exception $e) {
            throw new EncrypterException($e);
        }
    }
}
