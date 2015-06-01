<?php

namespace JsPackagerTest;

use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class GetStylesheetTagTest extends PHPUnit_Framework_TestCase
{

    public function testGetStylesheetTag() {
        $tagger = new Tagger();

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should convert filepath to stylesheet tag pointing to file path'
        );

        $tag = $tagger->getStylesheetTag('some/path/myscript.css');

        $this->assertEquals(
            '<link href="some/path/myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should convert filepath to stylesheet tag pointing to file path'
        );

        $tag = $tagger->getStylesheetTag('https://www.somewhere.com/css/myscript.css');

        $this->assertEquals(
            '<link href="https://www.somewhere.com/css/myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should convert filepath to stylesheet tag pointing to file path'
        );
    }

}