<?php

namespace JsPackagerTest;

use JsPackager\Tagger;
use PHPUnit_Framework_TestCase;

class GetScriptTagTest extends PHPUnit_Framework_TestCase
{

    public function testGetScriptTag() {
        $tagger = new Tagger();

        $tag = $tagger->getScriptTag('myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="myscript.js"></script>',
            $tag,
            'Tagger should convert filepath to script tag pointing to file path'
        );

        $tag = $tagger->getScriptTag('some/path/myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="some/path/myscript.js"></script>',
            $tag,
            'Tagger should convert filepath to script tag pointing to file path'
        );

        $tag = $tagger->getScriptTag('http://www.somewhere.com/js/myscript.js');

        $this->assertEquals(
            '<script type="text/javascript" src="http://www.somewhere.com/js/myscript.js"></script>',
            $tag,
            'Tagger should convert filepath to script tag pointing to file path'
        );
    }

}