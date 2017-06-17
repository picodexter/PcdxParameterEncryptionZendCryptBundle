<?php

/*
 * This file is part of the PcdxParameterEncryptionZendCryptBundle package.
 *
 * (c) picodexter <https://picodexter.io/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Picodexter\ParameterEncryptionZendCryptBundle\Tests\DependencyInjection;

use Picodexter\ParameterEncryptionZendCryptBundle\DependencyInjection\PcdxParameterEncryptionZendCryptExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class PcdxParameterEncryptionZendCryptExtensionIntegrationTest extends \PHPUnit_Framework_TestCase
{
    public function testLoadSuccess()
    {
        $mergedConfig = [];
        $container = new ContainerBuilder();

        $extension = new PcdxParameterEncryptionZendCryptExtension();

        $extension->load($mergedConfig, $container);

        $serviceDefinition = $container->getDefinition(
            'pcdx_parameter_encryption_zend_crypt.encryption.algorithm.zend_crypt.block_cipher.factory_proxy'
        );

        $this->assertInstanceOf(Definition::class, $serviceDefinition);
    }
}
