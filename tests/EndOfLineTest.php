<?php

namespace JsPackagerTest;

use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class EndOfLineTest extends PHPUnit_Framework_TestCase
{

    public function testScriptsRespectEndOfLineOption() {

        $tagger = new Tagger();

        $tag = $tagger->getScriptTag('myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js"></script>',
            $tag,
            'Tagger should not contain end of lines by default'
        );

        $tagger->includingEndOfLine = true;

        $tag = $tagger->getScriptTag('myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js"></script>' . PHP_EOL,
            $tag,
            'Tagger should contain end of lines by default'
        );

        $tagger->includingEndOfLine = false;

        $tag = $tagger->getScriptTag('myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js"></script>',
            $tag,
            'Tagger should respect flag when toggled'
        );

    }

    public function testStylesheetsRespectEndOfLineOption() {

        $tagger = new Tagger();

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should not contain end of lines by default'
        );

        $tagger->includingEndOfLine = true;

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />' . PHP_EOL,
            $tag,
            'Tagger should contain end of lines by default'
        );

        $tagger->includingEndOfLine = false;

        $tag = $tagger->getStylesheetTag('myscript.css');

        $this->assertEquals(
            '<link href="myscript.css" rel="stylesheet" type="text/css" />',
            $tag,
            'Tagger should respect flag when toggled'
        );

    }

}