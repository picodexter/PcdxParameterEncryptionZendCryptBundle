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
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\RsaFactoryProxyInterface;
use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Encrypter\ZendCryptRsaEncrypter;
use Zend\Crypt\PublicKey\Rsa;

class ZendCryptRsaEncrypterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RsaFactoryProxyInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    private $cipherFactory;

    /**
     * @var ZendCryptRsaEncrypter
     */
    private $encrypter;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->cipherFactory = $this->createRsaFactoryProxyInterfaceMock();

        $this->encrypter = new ZendCryptRsaEncrypter($this->cipherFactory);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->encrypter = null;
        $this->cipherFactory = null;
    }

    /**
     * @expectedException \Picodexter\ParameterEncryptionBundle\Exception\Encryption\EncrypterException
     */
    public function testEncryptValueException()
    {
        $plainValue = 'some plain value';

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory(null, $cipher);

        $cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($plainValue))
            ->will($this->throwException(new Exception()));

        $this->encrypter->encryptValue($plainValue);
    }

    public function testEncryptValueSuccessWithKey()
    {
        $plainValue = 'some plain value';
        $encryptionKey = 'some key';
        $prepEncryptedValue = 'decrypted value';

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory($encryptionKey, $cipher);

        $this->setUpCipherEncrypt($cipher, $plainValue, $prepEncryptedValue);

        $encryptedValue = $this->encrypter->encryptValue($plainValue, $encryptionKey);

        $this->assertSame($prepEncryptedValue, $encryptedValue);
    }

    public function testEncryptValueSuccessWithoutKey()
    {
        $plainValue = 'some plain value';
        $prepEncryptedValue = 'decrypted value';

        $cipher = $this->createRsaMock();

        $this->setUpCipherFactoryFactory(null, $cipher);

        $this->setUpCipherEncrypt($cipher, $plainValue, $prepEncryptedValue);

        $encryptedValue = $this->encrypter->encryptValue($plainValue);

        $this->assertSame($prepEncryptedValue, $encryptedValue);
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
     * Set up cipher: encrypt.
     *
     * @param Rsa|\PHPUnit_Framework_MockObject_MockObject $cipher
     * @param string                                       $plainValue
     * @param string                                       $encryptedValue
     */
    private function setUpCipherEncrypt(Rsa $cipher, $plainValue, $encryptedValue)
    {
        $cipher->expects($this->once())
            ->method('encrypt')
            ->with($this->identicalTo($plainValue))
            ->will($this->returnValue($encryptedValue));
    }

    /**
     * Set up cipher factory: factory.
     *
     * @param string|null $encryptionKey
     * @param Rsa         $cipher
     */
    private function setUpCipherFactoryFactory($encryptionKey, Rsa $cipher)
    {
        $this->cipherFactory->expects($this->once())
            ->method('factory')
            ->with(
                $this->identicalTo([
                    'public_key'    => $encryptionKey,
                    'binary_output' => false,
                ])
            )
            ->will($this->returnValue($cipher));
    }
}
