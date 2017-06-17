# PcdxParameterEncryptionZendCryptBundle

This bundle is an add-on for the
[PcdxParameterEncryptionBundle](https://github.com/picodexter/PcdxParameterEncryptionBundle)
and enables simple usage of it in combination with the Composer package
[zendframework/zend-crypt](https://github.com/zendframework/zend-crypt).

[![Latest Stable Version](https://img.shields.io/packagist/v/picodexter/parameter-encryption-zend-crypt-bundle.svg?style=flat)](https://packagist.org/packages/picodexter/parameter-encryption-zend-crypt-bundle)
[![Build Status](https://img.shields.io/travis/picodexter/PcdxParameterEncryptionZendCryptBundle/master.svg?style=flat)](https://travis-ci.org/picodexter/PcdxParameterEncryptionZendCryptBundle)
[![Code Coverage](https://img.shields.io/coveralls/picodexter/PcdxParameterEncryptionZendCryptBundle/master.svg?style=flat)](https://coveralls.io/github/picodexter/PcdxParameterEncryptionZendCryptBundle)

## Features

You will be able to use the following ciphers:

### Symmetric Ciphers

*   Provided by OpenSSL extension:

    *   AES-256
    *   Blowfish
    *   DES
    *   Camellia-256
    *   CAST-128 / CAST5
    *   SEED

*   Provided by mcrypt extension:

    *   AES / Rijndael-128
    *   Blowfish
    *   DES
    *   3DES / Triple DES
    *   CAST-128 / CAST5
    *   CAST-256
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
