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
        $encryptionKey = 'some key';

        $this->cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($plainValue))
            ->will($this->throwException(new Exception()));

        $this->encrypter->encryptValue($plainValue, $encryptionKey);
    }

    public function testEncryptValueSuccess()
    {
        $plainValue = 'some plain value';
        $encryptionKey = 'some key';
        $prepEncryptedValue = 'decrypted value';

        $this->cipher->expects($this->once())
            ->method('setKey')
            ->with($this->identicalTo($encryptionKey));

        $this->cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($plainValue))
            ->will($this->returnValue($prepEncryptedValue));

        $decryptedValue = $this->encrypter->encryptValue($plainValue, $encryptionKey);

        $this->assertSame($prepEncryptedValue, $decryptedValue);
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
}
