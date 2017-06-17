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

use Picodexter\ParameterEncryptionZendCryptBundle\Encryption\Algorithm\ZendCrypt\RsaFactoryProxy;
use Zend\Crypt\PublicKey\Rsa;

class RsaFactoryProxyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RsaFactoryProxy
     */
    private $proxy;

    /**
     * PHPUnit: setUp.
     */
    public function setUp()
    {
        $this->proxy = new RsaFactoryProxy(RsaFactoryDummy::class);
    }

    /**
     * PHPUnit: tearDown.
     */
    public function tearDown()
    {
        $this->proxy = null;
    }

    public function testFactorySuccess()
    {
        $options = [
            'some' => 'options',
        ];

        $cipher = $this->proxy->factory($options);

        $this->assertSame('factory', RsaFactoryDummy::$lastCallMethodName);
        $this->assertSame([$options], RsaFactoryDummy::$lastCallArguments);
        $this->assertInstanceOf(Rsa::class, $cipher);
    }
}
