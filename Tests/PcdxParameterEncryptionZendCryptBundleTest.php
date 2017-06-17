<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests;

use Picodexter\ParameterEncryptionZendCryptBundle\PcdxParameterEncryptionZendCryptBundle;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

class PcdxParameterEncryptionZendCryptBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorSuccess()
    {
        $bundle = new PcdxParameterEncryptionZendCryptBundle();

        $this->assertInstanceOf(BundleInterface::class, $bundle);
    }
}
