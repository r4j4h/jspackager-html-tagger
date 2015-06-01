<?php

namespace JsPackagerTest;

use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class CacheBustTest extends PHPUnit_Framework_TestCase
{

    public function testConfigureCacheBust() {
        $tagger = new Tagger();


        // test off
        // configure cache bust to be on
        // test on
        // turn off
        // test off

    }

    public function testScriptsRespectCacheBustOption() {

        $tagger = new Tagger();

        $tag = $tagger->getScriptTag('myscript.js', "text");

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js?cb=text"></script>',
            $tag,
            'Tagger should contain end of lines by default'
        );


        $tagger->cacheBustKey = 'mtime';
        $tag = $tagger->getScriptTag('myscript.js', 123);

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js?mtime=123"></script>',
            $tag,
            'Tagger should not contain end of lines by default'
        );

    }

    public function testStylesheetsRespectCacheBustOption() {

        $tagger = new Tagger();

        $tag = $tagger->getStylesheetTag('myscript.css', "text");

        $this->assertEquals(
            '<link href="myscript.css?cb=text" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should not contain end of lines by default'
        );

        $tagger->cacheBustKey = 'mtime';
        $tag = $tagger->getStylesheetTag('myscript.css', 123);

        $this->assertEquals(
            '<link href="myscript.css?mtime=123" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should contain end of lines by default'
        );

    }
}