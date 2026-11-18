<?php

namespace App\Traits;

use SimpleXMLElement;

trait ApiResponseTrait
{
    protected function dynamicResponse($data, $statusCode = 200, $rootElement = 'response')
    {
        $acceptHeader = request()->header('Accept');

        if (strpos($acceptHeader, 'application/xml') !== false || strpos($acceptHeader, 'text/xml') !== false) {
            $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><{$rootElement}/>");
            $this->arrayToXml($data, $xml);

            return response($xml->asXML(), $statusCode)
                ->header('Content-Type', 'application/xml');
        }

        return response()->json($data, $statusCode);
    }

    private function arrayToXml($data, &$xmlData)
    {
        foreach ($data as $key => $value) {
            if (is_numeric($key)) {
                $key = 'item';
            }
            if (is_array($value)) {
                $subnode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subnode);
            } else {
                $xmlData->addChild("$key", htmlspecialchars("$value"));
            }
        }
    }
}