<?php

namespace JsPackagerTest;

use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class MediaTypeTest extends PHPUnit_Framework_TestCase
{

    public function testConfigureStylesheetMediaType() {

        $tagger = new Tagger();

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should use media="screen" by default'
        );

        $tagger->setStylesheetMediaType('screen');

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" media="screen" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should use media="screen" by default'
        );

        $tagger->setStylesheetMediaType('print, screen');

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" media="print, screen" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should use media="screen" by default'
        );

        $tagger->setStylesheetMediaType(null);

    }

}