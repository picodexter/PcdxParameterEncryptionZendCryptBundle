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
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\RsaFactoryProxyInterface;

/**
 * ZendCryptRsaEncrypter.
 */
class ZendCryptRsaEncrypter implements EncrypterInterface
{
    /**
     * @var RsaFactoryProxyInterface
     */
    private $cipherFactory;

    /**
     * Constructor.
     *
     * @param RsaFactoryProxyInterface $cipherFactory
     */
    public function __construct(RsaFactoryProxyInterface $cipherFactory)
    {
        $this->cipherFactory = $cipherFactory;
    }

    /**
     * @inheritDoc
     */
    public function encryptValue($plainValue, $encryptionKey = null)
    {
        try {
            $cipher = $this->cipherFactory->factory([
                'public_key'    => $encryptionKey,
                'binary_output' => false,
            ]);

            $encryptedValue = $cipher->encrypt($plainValue);

            return $encryptedValue;
        } catch (Exception $e) {
            throw new EncrypterException($e);
        }
    }
}
