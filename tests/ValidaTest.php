<?php

use Webneex\CertificadosRootSat\CertificadosRootSat;

final class ValidaTest extends PHPUnit_Framework_TestCase {

    public function testValidaPruebas() {

        $cer = file_get_contents(__DIR__ . '/CSD_Pruebas_CFDI_BAJF541014RB3.cer');
        $result = CertificadosRootSat::validar(CertificadosRootSat::PRUEBAS, $cer);

        $this->assertTrue(!!$result, 'Certificado debe ser válido');
    }

    public function testValidaPruebasEnProduccion() {

        $cer = file_get_contents(__DIR__ . '/CSD_Pruebas_CFDI_BAJF541014RB3.cer');
        $result = CertificadosRootSat::validar(CertificadosRootSat::PRODUCCION, $cer);

        $this->assertFalse(!!$result, 'Certificado debe ser inválido');
    }

    public function testValidaProduccion() {

        $cer = file_get_contents(__DIR__ . '/00001000000412684314.cer');
        $result = CertificadosRootSat::validar(CertificadosRootSat::PRODUCCION, $cer);

        $this->assertTrue(!!$result, 'Certificado debe ser válido');
    }

    public function testValidaProduccionEnPruebas() {

        $cer = file_get_contents(__DIR__ . '/00001000000412684314.cer');
        $result = CertificadosRootSat::validar(CertificadosRootSat::PRUEBAS, $cer);

        $this->assertFalse(!!$result, 'Certificado debe ser inválido');
    }
}
