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
use Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException;
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

    public function testDecryptValueException()
    {
        $this->expectException(DecrypterException::class);

        $encryptedValue = 'some encrypted value';
        $decryptionKey = 'some key';

        $this->cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->throwException(new Exception()));

        $this->decrypter->decryptValue($encryptedValue, $decryptionKey);
    }

    public function testDecryptValueSuccess()
    {
        $encryptedValue = 'some encrypted value';
        $decryptionKey = 'some key';
        $prepDecryptedValue = 'decrypted value';

        $this->cipher->expects($this->once())
            ->method('setKey')
            ->with($this->identicalTo($decryptionKey));

        $this->cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->returnValue($prepDecryptedValue));

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue, $decryptionKey);

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
}
