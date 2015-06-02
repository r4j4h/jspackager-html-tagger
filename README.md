Tagger is a simple bare bones converter from file paths to `<script>` and `<link>` HTML tags written in PHP.


Installation
=====

1. Install [Composer](https://getcomposer.org)
2. `composer require 'r4j4h/jspackager-html-tagger:1.0'`


Usage
=====

Basics
-----

```php
echo $tagger->getScriptTag('myscript.js');
```

```html
<script type="text/javascript" src="myscript.js"></script>
```

```php
echo $tagger->getStylesheetTag('myscript.css');
```

```html
<link href="myscript.css" rel="stylesheet" type="text/css" />
```


Custom Media Type for Stylesheets
-----

```php
$tagger->setStylesheetMediaType('screen');
echo $tagger->getStylesheetTag('myscript.css');
```

```html
<link href="myscript.css" media="screen" rel="stylesheet" type="text/css" />
```


Cache Bust
-----

```php
echo $tagger->getStylesheetTag('myscript.css', "text");
```

$this->assertEquals(
```html
<link href="myscript.css?cb=text" rel="stylesheet" type="text/css" />
```


```php
$tagger->cacheBustKey = 'mtime';
echo $tagger->getScriptTag('myscript.js', 123);
```

$this->assertEquals(
```html
<script type="text/javascript" src="myscript.js?mtime=123"></script>
```


Extension Based Detection
-----

```php
echo $tagger->getTag('myscript.js');
echo $tagger->getTag('myscript.css');
```

```html
<script type="text/javascript" src="myscript.js"></script>
<link href="myscript.css" rel="stylesheet" type="text/css" />
```
