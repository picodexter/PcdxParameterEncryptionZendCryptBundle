<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests\Encryption\Algorithm\ZendCrypt;

use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\BlockCipherFactoryProxy;
use Zend\Crypt\BlockCipher;

class BlockCipherFactoryProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BlockCipherFactoryProxy
     */
    private $proxy;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->proxy = new BlockCipherFactoryProxy(BlockCipherFactoryDummy::class);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->proxy = null;
    }

    public function testFactorySuccessWithOptions()
    {
        $adapter = 'some_adapter';
        $options = [
            'these' => 'are',
            'some'  => 'some_options',
        ];

        $cipher = $this->proxy->factory($adapter, $options);

        $this->assertSame('factory', BlockCipherFactoryDummy::$lastCallMethodName);
        $this->assertSame(
            [$adapter, $options],
            BlockCipherFactoryDummy::$lastCallArguments
        );
        $this->assertInstanceOf(BlockCipher::class, $cipher);
    }

    public function testFactorySuccessWithoutOptions()
    {
        $adapter = 'some_adapter';

        $cipher = $this->proxy->factory($adapter);

        $this->assertSame('factory', BlockCipherFactoryDummy::$lastCallMethodName);
        $this->assertSame(
            [$adapter, []],
            BlockCipherFactoryDummy::$lastCallArguments
        );
        $this->assertInstanceOf(BlockCipher::class, $cipher);
    }
}
