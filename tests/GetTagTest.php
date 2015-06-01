<?php

namespace JsPackagerTest;

use JsPackager\Exception\ExtensionParsingException;
use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class GetTagTest extends PHPUnit_Framework_TestCase
{

    public function testGetTagHandlesScriptTag() {
        $tagger = new Tagger();

        $tag = $tagger->getTag('myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js"></script>',
            $tag,
            'Tagger should detect js extension and convert filepath to script tag pointing to file path'
        );
    }

    public function testGetTagHandlesStylesheetTag() {
        $tagger = new Tagger();

        $tag = $tagger->getTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should detect css extension and convert filepath to stylesheet tag pointing to file path'
        );
    }

    public function testGetTagThrowsOnTypeDetectionFailure() {
        $tagger = new Tagger();

        try {

            $tag = $tagger->getTag('myscript.gif');
            $this->fail('Should throw ExtensionParsingException');

        } catch ( ExtensionParsingException $e ) {

            $this->assertInstanceOf( 'JsPackager\Exception\ExtensionParsingException', $e );

            $this->assertEquals( $e->getItemThatFailedToParse(), 'myscript.gif' );

        }

    }

}