<?php

require_once(APP . '/libs/nusoap/lib/nusoap.php');

/**
 * Class WebService
 */
class WebService
{
    private $client;
    private $method;
    private $params;
    private $error;
    private $result;

    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    public function getError()
    {
        return $this->error;
    }

    public function setError($error)
    {
        $this->error = utf8_encode($error);
    }

    public function getResult()
    {
        return $this->result;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @param $driver
     */
    public function setDriver($driver)
    {
        $params              = $this->getParams();
        $params['SetDriver'] = $driver;
        $this->setParams($params);
    }

    /**
     * WebService constructor.
     *
     * @param string $url
     * @param string $method
     */
    public function __construct($url = WS_URL, $method = WS_METHOD)
    {
        $this->client = new nusoap_client($url, 'wsdl');
        $this->params = array('SetDriver' => '', 'DriverName' => WS_DRIVERNAME, 'NamePub' => WS_NAMEPUB, 'RutaProperties' => WS_RUTAPROPERTIES);
        $this->method = $method;
        $this->error  = '';
        $this->result = array();
    }

    /**
     * @return mixed
     */
    public function callWS()
    {
        try {
            $client                   = $this->getClient();
            $client->soap_defencoding = 'UTF-8';
            $client->decode_utf8      = true;
            $err                      = $client->getError();

            if ($err) {
                $this->setError('Constructor Error: ' . $err);
                Logger::error($err);
            }

            $result = $client->call($this->getMethod(), $this->getParams());

            if ($this->getClient()->fault) {
                $this->setError('Fail[' . $result['faultcode'] . ']: ' . $result['faultstring']);
                Logger::error($result['faultstring']);
            } else {
                $err = $client->getError();
                if ($err) {
                    $this->setError('Error: ' . $err);
                    Logger::error($err);
                } else {
                    $this->setResult($result);

                    return $result;
                }

                // show soap request and response
//                echo "<h2>Request</h2>";
//                echo "<pre>" . htmlspecialchars($client->request, ENT_QUOTES) . "</pre>";
//                echo "<h2>Response</h2>";
//                echo "<pre>" . htmlspecialchars($client->response, ENT_QUOTES) . "</pre>";
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}