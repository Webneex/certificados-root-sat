<?php

namespace Webneex\CertificadosRootSat;

use phpseclib3\File\X509;

class CertificadosRootSat {

    const PRODUCCION = 1;
    const PRUEBAS = 2;

    public static function validar($env, $cer) {
        $list_valid = [];

        $x509 = new X509();

        $dh = opendir($base_dir = __DIR__ . '/../' . ($env === static::PRODUCCION ? 'produccion' : 'pruebas') . '/');
        while ($file = readdir($dh)) {
            if ($file[0] == '.') continue;

            $ca = file_get_contents($base_dir . $file);

            $x509->loadCA($ca);
            $x509->loadX509($cer);
            $valid = @$x509->validateSignature();
            if ($valid) {
                $list_valid[] = $file;
            }

        }

        return $list_valid;
    }
}