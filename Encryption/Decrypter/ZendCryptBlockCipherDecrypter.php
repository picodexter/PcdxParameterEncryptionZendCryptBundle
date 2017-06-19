<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Decrypter;

use Exception;
use Picodexter\ParameterEncryptionBundle\Encryption\Decrypter\DecrypterInterface;
use Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException;
use Zend\Crypt\BlockCipher;

/**
 * ZendCryptBlockCipherDecrypter.
 */
class ZendCryptBlockCipherDecrypter implements DecrypterInterface
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
    public function decryptValue($encryptedValue, $decryptionKey)
    {
        try {
            $this->cipher->setKey($decryptionKey);

            $decryptedValue = $this->cipher->decrypt($encryptedValue);

            return $decryptedValue;
        } catch (Exception $e) {
            throw new DecrypterException($e);
        }
    }
}
