<?php

namespace NFePHP\Common\Exception;

/**
 * @category   NFePHP
 * @package    NFePHP\Common\Exception
 * @copyright  Copyright (c) 2008-2014
 * @license    http://www.gnu.org/licenses/lesser.html LGPL v3
 * @author     Roberto L. Machado <linux.rlm at gmail dot com>
 * @link       http://github.com/nfephp-org/sped-common for the canonical source repository
 */
class CertificateException extends \RuntimeException implements ExceptionInterface
{
    public static function unableToRead()
    {
        return new static('Não foi possível ler o certificado digital, ' . static::getOpenSSLError());
    }

    public static function unableToOpen()
    {
        return new static('Não foi possível abrir o certificado digital, ' . static::getOpenSSLError());
    }

    public static function signContent()
    {
        return new static(
            'Ocorreu um erro ao assinar o conteúdo com certificado digital, ' . static::getOpenSSLError()
        );
    }

    public static function getPrivateKey()
    {
        return new static('Ocorreu um erro ao ler chave privada do certificado digital, ' . static::getOpenSSLError());
    }

    public static function signatureFailed()
    {
        return new static(
            'Ocorreu um erro ao verificar assinatura do certificado digital, ' . static::getOpenSSLError()
        );
    }
    
    protected static function getOpenSSLError()
    {
        $error = 'verifique os erros: ';
        while ($msg = openssl_error_string()) {
            $error .= "($msg)";
        }
        return $error;
    }
}
