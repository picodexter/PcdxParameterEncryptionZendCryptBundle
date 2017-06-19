Getting Started
===============

Prerequisites
-------------

You need Symfony 2.7+ with `PcdxParameterEncryptionBundle`_ already installed
and enabled (please refer to its own documentation).

Installation
------------

Step 1: Download the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

.. code-block:: terminal

    $ composer require picodexter/parameter-encryption-zend-crypt-bundle "~1"

This command requires you to have Composer installed globally, as explained
in the `installation chapter`_ of the Composer documentation.

Step 2: Enable the Bundle
~~~~~~~~~~~~~~~~~~~~~~~~~

Then, enable the bundle by adding it to the list of registered bundles
in the ``app/AppKernel.php`` file of your project:

.. code-block:: php

    <?php
    // app/AppKernel.php

    // ...
    class AppKernel extends Kernel
    {
        public function registerBundles()
        {
            $bundles = array(
                // ...

                new Picodexter\ParameterEncryptionZendCryptBundle\PcdxParameterEncryptionZendCryptBundle(),
            );

            // ...
        }

        // ...
    }

Step 3: Configuration
~~~~~~~~~~~~~~~~~~~~~

You can now use the following services in the PcdxParameterEncryptionBundle configuration:

*   encrypter:

    *   symmetric ciphers:

        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.3des``
            also known as Triple DES
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.aes``
            also known as Rijndael-128
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.blowfish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.cast.128``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.cast.256``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.des``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.rijndael.192``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.rijndael.256``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.saferplus``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.serpent``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.twofish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.aes``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.blowfish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.camellia``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.cast5``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.des``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.seed``

    *   asymmetric ciphers:

        *   ``pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.rsa``

*   decrypter:

    *   symmetric ciphers:

        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.3des``
            also known as Triple DES
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.aes``
            also known as Rijndael-128
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.blowfish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.cast.128``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.cast.256``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.des``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.rijndael.192``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.rijndael.256``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.saferplus``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.serpent``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.twofish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.aes``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.blowfish``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.camellia``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.cast5``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.des``
        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.seed``

    *   asymmetric ciphers:

        *   ``pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.rsa``

Example:

1.  Application configuration:

    .. configuration-block::

        .. code-block:: yaml

            # app/config/config.yml
            pcdx_parameter_encryption:
                algorithms:
                    -   id: 'zend_crypt_mcrypt_aes'
                        pattern:
                            type: 'value_prefix'
                            arguments:
                                -   '=#!PPE!zc:mcrypt:aes!#='
                        encryption:
                            service: 'pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.aes'
                            key: '%parameter_encryption.zend_crypt.mcrypt.aes.key%'
                        decryption:
                            service: 'pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.aes'
                            key: '%parameter_encryption.zend_crypt.mcrypt.aes.key%'
                    -   id: 'zend_crypt_openssl_rsa'
                        pattern:
                            type: 'value_prefix'
                            arguments:
                                -   '=#!PPE!zc:openssl:rsa!#='
                        encryption:
                            service: 'pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.rsa'
                            key: '%parameter_encryption.zend_crypt.openssl.rsa.key.encryption%'
                        decryption:
                            service: 'pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.rsa'
                            key: '%parameter_encryption.zend_crypt.openssl.rsa.key.decryption%'

        .. code-block:: xml

            <!-- app/config/config.xml -->
            <?xml version="1.0" encoding="UTF-8" ?>
            <container xmlns="http://symfony.com/schema/dic/services"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xmlns:ppe="https://picodexter.io/schema/dic/pcdx_parameter_encryption"
                xsi:schemaLocation="https://picodexter.io/schema/dic/pcdx_parameter_encryption
                    https://picodexter.io/schema/dic/pcdx_parameter_encryption/pcdx_parameter_encryption-1.0.xsd">

                <ppe:config>
                    <ppe:algorithm id="zend_crypt_mcrypt_aes">
                        <ppe:pattern type="value_prefix">
                            <ppe:argument>=#!PPE!zc:mcrypt:aes!#=</ppe:argument>
                        </ppe:pattern>
                        <ppe:encryption service="pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.aes">
                            <ppe:key>%parameter_encryption.zend_crypt.mcrypt.aes.key%</ppe:key>
                        </ppe:encryption>
                        <ppe:decryption service="pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.aes">
                            <ppe:key>%parameter_encryption.zend_crypt.mcrypt.aes.key%</ppe:key>
                        </ppe:decryption>
                    </ppe:algorithm>
                    <ppe:algorithm id="zend_crypt_openssl_rsa">
                        <ppe:pattern type="value_prefix">
                            <ppe:argument>=#!PPE!zc:openssl:rsa!#=</ppe:argument>
                        </ppe:pattern>
                        <ppe:encryption service="pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.rsa">
                            <ppe:key>%parameter_encryption.zend_crypt.openssl.rsa.key.encryption%</ppe:key>
                        </ppe:encryption>
                        <ppe:decryption service="pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.rsa">
                            <ppe:key>%parameter_encryption.zend_crypt.openssl.rsa.key.decryption%</ppe:key>
                        </ppe:decryption>
                    </ppe:algorithm>
                </ppe:config>
            </container>

        .. code-block:: php

            // app/config/config.php
            $container->loadFromExtension(
                'pcdx_parameter_encryption',
                [
                    'algorithms' => [
                        [
                            'id' => 'zend_crypt_mcrypt_aes',
                            'pattern' => [
                                'type' => 'value_prefix',
                                'arguments' => ['=#!PPE!zc:mcrypt:aes!#='],
                            ],
                            'encryption' => [
                                'service' => 'pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.mcrypt.aes',
                                'key' => '%parameter_encryption.zend_crypt.mcrypt.aes.key%',
                            ],
                            'decryption' => [
                                'service' => 'pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.mcrypt.aes',
                                'key' => '%parameter_encryption.zend_crypt.mcrypt.aes.key%',
                            ],
                        ],
                        [
                            'id' => 'zend_crypt_openssl_rsa',
                            'pattern' => [
                                'type' => 'value_prefix',
                                'arguments' => ['=#!PPE!zc:openssl:rsa!#='],
                            ],
                            'encryption' => [
                                'service' => 'pcdx_parameter_encryption_zend_crypt.encryption.encrypter.zend_crypt.openssl.rsa',
                                'key' => '%parameter_encryption.zend_crypt.openssl.rsa.key.encryption%',
                            ],
                            'decryption' => [
                                'service' => 'pcdx_parameter_encryption_zend_crypt.encryption.decrypter.zend_crypt.openssl.rsa',
                                'key' => '%parameter_encryption.zend_crypt.openssl.rsa.key.decryption%',
                            ],
                        ],
                    ],
                ]
            );

2.  Parameters:

    .. configuration-block::

        .. code-block:: yaml

            # app/config/parameters.yml
            parameters:
                parameter_encryption.zend_crypt.mcrypt.aes.key: 'YOUR_ENCRYPTION_KEY'
                parameter_encryption.zend_crypt.openssl.rsa.key.encryption: |
                    -----BEGIN PUBLIC KEY-----
                    [...]
                    -----END PUBLIC KEY-----
                parameter_encryption.zend_crypt.openssl.rsa.key.decryption: |
                    -----BEGIN PRIVATE KEY-----
                    [...]
                    -----END PRIVATE KEY-----

        .. code-block:: xml

            <!-- app/config/parameters.xml -->
            <?xml version="1.0" encoding="UTF-8" ?>
            <container xmlns="http://symfony.com/schema/dic/services"
                xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
                xsi:schemaLocation="http://symfony.com/schema/dic/services
                    http://symfony.com/schema/dic/services/services-1.0.xsd">

                <parameters>
                    <parameter key="parameter_encryption.zend_crypt.mcrypt.aes.key">YOUR_ENCRYPTION_KEY</parameter>
                    <parameter key="parameter_encryption.zend_crypt.openssl.rsa.key.encryption">
                        -----BEGIN PUBLIC KEY-----
                        [...]
                        -----END PUBLIC KEY-----
                    </parameter>
                    <parameter key="parameter_encryption.zend_crypt.openssl.rsa.key.decryption">
                        -----BEGIN PRIVATE KEY-----
                        [...]
                        -----END PRIVATE KEY-----
                    </parameter>
                </parameters>
            </container>

        .. code-block:: php

            // app/config/parameters.php
            $container->setParameter('parameter_encryption.zend_crypt.mcrypt.aes.key', 'YOUR_ENCRYPTION_KEY');
            $container->setParameter(
                'parameter_encryption.zend_crypt.openssl.rsa.key.encryption',
                '-----BEGIN PUBLIC KEY-----
                [...]
                -----END PUBLIC KEY-----'
            );
            $container->setParameter(
                'parameter_encryption.zend_crypt.openssl.rsa.key.decryption',
                '-----BEGIN PRIVATE KEY-----
                [...]
                -----END PRIVATE KEY-----'
            );

.. _PcdxParameterEncryptionBundle: https://github.com/picodexter/PcdxParameterEncryptionBundle
.. _installation chapter: https://getcomposer.org/doc/00-intro.md
