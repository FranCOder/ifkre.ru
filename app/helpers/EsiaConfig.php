<?php

namespace helpers;

use Ekapusta\OAuth2Esia\Provider\EsiaProvider;
use Ekapusta\OAuth2Esia\Security\Signer\OpensslPkcs7;

class EsiaConfig
{
    public static function getConfig()
    {
        return $provider = new EsiaProvider([
            'clientId'      => 'IFKRE',
            'redirectUri'   => 'http://ifkre.loc/lk',
            'defaultScopes' => ['id_doc', 'fullname'],
            // For work with test portal version
              'remoteUrl' => 'https://esia-portal1.test.gosuslugi.ru',
              'remoteCertificatePath' => EsiaProvider::RESOURCES.'esia.test.cer',
        ], [
            'signer' => new OpensslPkcs7(
                APP_FOLDER . '/esia/ifkre.cer',
                APP_FOLDER . '/esia/ifkre.key.pem')
        ]);
    }


    public static function get1cdb()
    {
        $db['dsn'] = sprintf(
            "%s:host=%s;port=%d;dbname=%s",
            getenv('DB_CONNECTION'),
            getenv('DB_HOST'),
            getenv('DB_PORT'),
            'ifkre_1c'
        );

        return new \DB\SQL($db['dsn'], getenv('DB_USER'), getenv('DB_PASS'));
    }
}