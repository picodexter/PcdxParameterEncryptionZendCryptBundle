<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests\Encryption\Decrypter;

use Exception;
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Decrypter\ZendCryptBlockCipherDecrypter;
use Zend\Crypt\BlockCipher;

class ZendCryptBlockCipherDecrypterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockCipher|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cipher;

    /**
     * @var ZendCryptBlockCipherDecrypter
     */
    private $decrypter;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->cipher = $this->createBlockCipherMock();

        $this->decrypter = new ZendCryptBlockCipherDecrypter($this->cipher);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->decrypter = null;
        $this->cipher = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException
     */
    public function testDecryptValueException()
    {
        $encryptedValue = 'some encrypted value';

        $this->cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->throwException(new Exception()));

        $this->decrypter->decryptValue($encryptedValue);
    }

    public function testDecryptValueSuccessWithKey()
    {
        $encryptedValue = 'some encrypted value';
        $decryptionKey = 'some key';
        $prepDecryptedValue = 'decrypted value';

        $this->setUpBlockCipherSetKey($decryptionKey);

        $this->setUpBlockCipherDecrypt($encryptedValue, $prepDecryptedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue, $decryptionKey);

        $this->assertSame($prepDecryptedValue, $decryptedValue);
    }

    public function testDecrpytValueSuccessWithoutKey()
    {
        $encryptedValue = 'some encrypted value';
        $prepDecryptedValue = 'decrypted value';

        $this->setUpBlockCipherSetKey(null);

        $this->setUpBlockCipherDecrypt($encryptedValue, $prepDecryptedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue);

        $this->assertSame($prepDecryptedValue, $decryptedValue);
    }

    /**
     * Create mock for BlockCipher.
     *
     * @return BlockCipher|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createBlockCipherMock()
    {
        return $this->getMockBuilder(BlockCipher::class)->disableOriginalConstructor()->getMock();
    }

    /**
     * Set up BlockCipher: decrypt.
     *
     * @param string $encryptedValue
     * @param string $decryptedValue
     */
    private function setUpBlockCipherDecrypt($encryptedValue, $decryptedValue)
    {
        $this->cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->returnValue($decryptedValue));
    }

    /**
     * Set up BlockCipher: setKey.
     *
     * @param string|null $decryptionKey
     */
    private function setUpBlockCipherSetKey($decryptionKey)
    {
        $this->cipher->expects($this->once())
            ->method('setKey')
            ->with($this->identicalTo($decryptionKey));
    }
}
