<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests\Encryption\Encrypter;

use Exception;
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Encrypter\ZendCryptBlockCipherEncrypter;
use Zend\Crypt\BlockCipher;

class ZendCryptBlockCipherEncrypterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockCipher|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cipher;

    /**
     * @var ZendCryptBlockCipherEncrypter
     */
    private $encrypter;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->cipher = $this->createBlockCipherMock();

        $this->encrypter = new ZendCryptBlockCipherEncrypter($this->cipher);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->encrypter = null;
        $this->cipher = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException
     */
    public function testEncryptValueException()
    {
        $plainValue = 'some plain value';

        $this->cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($plainValue))
            ->will($this->throwException(new Exception()));

        $this->encrypter->encryptValue($plainValue);
    }

    public function testEncryptValueSuccessWithKey()
    {
        $plainValue = 'some plain value';
        $encryptionKey = 'some key';
        $prepDecryptedValue = 'decrypted value';

        $this->setUpBlockCipherSetKey($encryptionKey);

        $this->setUpBlockCipherEncrypt($plainValue, $prepDecryptedValue);

        $decryptedValue = $this->encrypter->encryptValue($plainValue, $encryptionKey);

        $this->assertSame($prepDecryptedValue, $decryptedValue);
    }

    public function testEncryptValueSuccessWithoutKey()
    {
        $plainValue = 'some plain value';
        $prepDecryptedValue = 'decrypted value';

        $this->setUpBlockCipherSetKey(null);

        $this->setUpBlockCipherEncrypt($plainValue, $prepDecryptedValue);

        $decryptedValue = $this->encrypter->encryptValue($plainValue);

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
     * Set up BlockCipher: encrypt.
     *
     * @param string $encryptedValue
     * @param string $decryptedValue
     */
    private function setUpBlockCipherEncrypt($encryptedValue, $decryptedValue)
    {
        $this->cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->returnValue($decryptedValue));
    }

    /**
     * Set up BlockCipher: setKey.
     *
     * @param string|null $encryptionKey
     */
    private function setUpBlockCipherSetKey($encryptionKey)
    {
        $this->cipher->expects($this->once())
            ->method('setKey')
            ->with($encryptionKey);
    }
}
