# PcdxParameterEncryptionZendCryptBundle

This bundle is an add-on for the
[PcdxParameterEncryptionBundle](https://github.com/picodexter/PcdxParameterEncryptionBundle)
and enables simple usage of it in combination with the Composer package
[zendframework/zend-crypt](https://github.com/zendframework/zend-crypt).

[![Latest Stable Version](https://img.shields.io/packagist/v/picodexter/parameter-encryption-zend-crypt-bundle.svg?style=flat)](https://packagist.org/packages/picodexter/parameter-encryption-zend-crypt-bundle)
[![Build Status](https://img.shields.io/travis/picodexter/PcdxParameterEncryptionZendCryptBundle/master.svg?style=flat)](https://travis-ci.org/picodexter/PcdxParameterEncryptionZendCryptBundle)
[![Code Coverage](https://img.shields.io/coveralls/picodexter/PcdxParameterEncryptionZendCryptBundle/master.svg?style=flat)](https://coveralls.io/github/picodexter/PcdxParameterEncryptionZendCryptBundle)

## Features

zend-crypt 2.x supports the mcrypt extension only.

zend-crypt 3.x supports both the OpenSSL and the mcrypt extension.

The **mcrypt extension has been deprecated as of PHP 7.1** and was moved to
PECL as of PHP 7.2.

Depending on the factors mentioned above, you will be able to use the following
ciphers:

### Symmetric Ciphers

*   Provided by OpenSSL extension:

    *   AES-256
    *   Blowfish
    *   Camellia-256
    *   CAST-128 / CAST5
    *   DES
    *   SEED

*   Provided by mcrypt extension:

    *   AES / Rijndael-128
    *   Blowfish
    *   CAST-128 / CAST5
    *   CAST-256
    *   DES
    *   3DES / Triple DES
    *   Rijndael-192
    *   Rijndael-256
    *   SAFER+
    *   Serpent
    *   Twofish

### Asymmetric Ciphers

*   Provided by OpenSSL extension:

    *   RSA

## Documentation

The documentation source files are located in the `Resources/doc/` directory of
this bundle.

## Installation

Please refer to the [Getting Started guide](Resources/doc/getting-started.rst).

## License

This bundle is released under the [MIT license](LICENSE).
