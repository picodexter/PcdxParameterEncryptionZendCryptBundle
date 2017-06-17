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
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\RsaFactoryProxyInterface;
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Decrypter\ZendCryptRsaDecrypter;
use Zend\Crypt\PublicKey\Rsa;

class ZendCryptRsaDecrypterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RsaFactoryProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cipherFactory;

    /**
     * @var ZendCryptRsaDecrypter
     */
    private $decrypter;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->cipherFactory = $this->createRsaFactoryProxyInterfaceMock();

        $this->decrypter = new ZendCryptRsaDecrypter($this->cipherFactory);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->decrypter = null;
        $this->cipherFactory = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\DecrypterException
     */
    public function testDecryptValueException()
    {
        $encryptedValue = 'some encrypted value';

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory(null, $cipher);

        $cipher->expects($this->once())
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

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory($decryptionKey, $cipher);

        $this->setUpCipherDecrypt($cipher, $encryptedValue, $prepDecryptedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue, $decryptionKey);

        $this->assertSame($prepDecryptedValue, $decryptedValue);
    }

    public function testDecryptValueSuccessWithoutKey()
    {
        $encryptedValue = 'some encrypted value';
        $prepDecryptedValue = 'decrypted value';

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory(null, $cipher);

        $this->setUpCipherDecrypt($cipher, $encryptedValue, $prepDecryptedValue);

        $decryptedValue = $this->decrypter->decryptValue($encryptedValue);

        $this->assertSame($prepDecryptedValue, $decryptedValue);
    }

    /**
     * Create mock for RsaFactoryProxyInterface.
     *
     * @return RsaFactoryProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createRsaFactoryProxyInterfaceMock()
    {
        return $this->getMockBuilder(RsaFactoryProxyInterface::class)->getMock();
    }

    /**
     * Create mock for Rsa.
     *
     * @return Rsa|\PHPUnit_Framework_MockObject_MockObject
     */
    private function createRsaMock()
    {
        return $this->getMockBuilder(Rsa::class)->getMock();
    }

    /**
     * Set up cipher: decrypt.
     *
     * @param Rsa|\PHPUnit_Framework_MockObject_MockObject $cipher
     * @param string                                       $encryptedValue
     * @param string                                       $decryptedValue
     */
    private function setUpCipherDecrypt(Rsa $cipher, $encryptedValue, $decryptedValue)
    {
        $cipher->expects($this->once())
            ->method('decrypt')
            ->with($this->identicalTo($encryptedValue))
            ->will($this->returnValue($decryptedValue));
    }

    /**
     * Set up cipher factory: factory.
     *
     * @param string|null $decryptionKey
     * @param Rsa         $cipher
     */
    private function setUpCipherFactoryFactory($decryptionKey, $cipher)
    {
        $this->cipherFactory->expects($this->once())
            ->method('factory')
            ->with(
                $this->identicalTo([
                    'private_key'   => $decryptionKey,
                    'binary_output' => false,
                ])
            )
            ->will($this->returnValue($cipher));
    }
}
