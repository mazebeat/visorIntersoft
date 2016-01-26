<?php

class InitProcess
{
    public function init()
    {
        try {
            $init = new \XmlProcess();
            $init->readFile();

            $xml                                                      = $init->convertXmlToObject();
            $xml->DatosPoliza->InformacionPoliza->primerNombreTomador = self::validatePostField('primerNombreTomador');
            $xml->DatosPoliza->InformacionPoliza->direccionTomador    = self::validatePostField('direccionTomador');
            $xml->DatosPoliza->InformacionPoliza->ciudadTomador       = self::validatePostField('ciudadTomador');
            $xml->DatosPoliza->InformacionPoliza->numeroPoliza        = self::validatePostField('numeroPoliza');
            $xml->DatosPoliza->InformacionPoliza->numeroCertificado   = self::validatePostField('numeroCertificado');
            $xml->DatosPoliza->InformacionPoliza->numeroFactura       = self::validatePostField('numeroFactura');
            $xml->DatosPoliza->DatosRiesgo->numeroRiesgo              = self::validatePostField('numeroRiesgo');
            $xml->DatosPoliza->InformacionPoliza->fechaExpedicion     = self::validatePostField('fechaExpedicion');
            $xml->DatosPoliza->InformacionPoliza->tipoModificacion    = self::validatePostField('tipoModificacion');

            $_SESSION['XML'] = base64_encode($init->__toString());

            if ($_SESSION['XML'] != '') {
                $ws = new \WebService();
                $ws->setDriver($_SESSION['XML']);
                $ws->callWS();
                $result = $ws->getResult();
                if (isset($result)) {
                    $_SESSION['RESULT'] = $result;
                }
                $_SESSION['ERROR'] = $ws->getError();

                if (is_array($_SESSION['RESULT']) && count($_SESSION['RESULT'])) {
                    if (isset($result['return'])) {
                        $_SESSION['BASE64'] = $result['return'];
                        $_SESSION['ERROR']  = '';
                    } else {
                        $_SESSION['BASE64'] = '';
                        $_SESSION['ERROR']  = $_SESSION['ERROR'] . ' | No se encuentra variable "RetornoBase64"';
                    }
                }
            }
        } catch (Exception $e) {
            Logger::error($e);
        }
    }

    public static function validatePostField($name)
    {
        if (isset($_POST[$name]) && $_POST[$name] != '') {
            $data = trim($_POST[$name]);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

        return '';
    }

    public static function valueField($field)
    {
        if (array_key_exists($field, $_POST)) {
            echo $_POST[$field];
        }

        echo '';
    }


}