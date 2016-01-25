<?php

class XmlProcess
{
    private $xml;
    private $file;
    private $simplexml;

    public function getXml()
    {
        return $this->xml;
    }

    public function setXml($xml)
    {
        $this->xml = $xml;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getSimplexml()
    {
        return $this->simplexml;
    }

    public function setSimplexml($simplexml)
    {
        $this->simplexml = $simplexml;
    }

    /**
     * Home constructor.
     */
    public function __construct()
    {
        $this->file = HOME . '/base.xml';
    }

    public function readFile($file = null)
    {
        try {
            if (is_null($file)) {
                $file = $this->getFile();
            }

            if (!file_exists($file)) {
                throw new Exception('Archivo XML no encontrado');
            }

            $this->setXml(file_get_contents($file));

            return $this->getXml();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function convertXmlToObject($xml = null)
    {
        try {
            if (is_null($xml)) {
                $xml = $this->getXml();
            }

            if (!is_null($xml) && !empty($xml)) {
                $this->setSimplexml(new SimpleXMLElement($xml));
            }

            return $this->getSimplexml();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function __toString()
    {
        try {
            return utf8_encode($this->getSimplexml()->asXml());
        } catch (\Exception $e) {
            throw $e;
        }
    }
}