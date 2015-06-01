<?php

namespace JsPackager\Exception;

class ExtensionParsingException extends \Exception
{
    const ERROR_CODE = 415;

    private $itemTriedToParse;

    public function __construct($message, $extensionTriedToParse, Exception $previous = null) {
        $this->itemTriedToParse = $extensionTriedToParse;
        parent::__construct($message, self::ERROR_CODE, $previous );
    }

    public function getItemThatFailedToParse() {
        return $this->itemTriedToParse;
    }


}