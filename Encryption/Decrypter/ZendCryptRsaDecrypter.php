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
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\RsaFactoryProxyInterface;

/**
 * ZendCryptRsaDecrypter.
 */
class ZendCryptRsaDecrypter implements DecrypterInterface
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
    public function decryptValue($encryptedValue, $decryptionKey)
    {
        try {
            $cipher = $this->cipherFactory->factory([
                'private_key'   => $decryptionKey,
                'binary_output' => false,
            ]);

            $decryptedValue = $cipher->decrypt($encryptedValue);

            return $decryptedValue;
        } catch (Exception $e) {
            throw new DecrypterException($e);
        }
    }
}
