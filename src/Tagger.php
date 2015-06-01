<?php

namespace JsPackager;

use JsPackager\Exception\ExtensionParsingException;

class Tagger
{

    /**
     * @var bool If true, newlines are included with the script tag.
     */
    public $includingEndOfLine = false;


    /**
     * @var string The key used for the cache bust value, if used
     */
    public $cacheBustKey = 'cb';


    /**
     * @var null|string
     */
    private $stylesheetMediaAttributeValue = null;


    /**
     * @param $path
     * @param null|string $cacheBustValue If not null, is added as a query parameter for cache busting
     * @return string
     * @throws ExtensionParsingException
     */
    public function getTag($path, $cacheBustValue = null) {

        if (preg_match('/.js$/i', $path)) {
            $path = $this->getScriptTag( $path, $cacheBustValue );

        } else if (preg_match('/.css$/i', $path)) {
            $path = $this->getStylesheetTag( $path, $cacheBustValue );

        } else {
            throw new ExtensionParsingException( "Failed to determine correct tag to generate", $path, null );
        }

        return $path;
    }


    /**
     * @param string $webAccessiblePath
     * @param null|string $cacheBustValue If not null, is added as a query parameter for cache busting
     * @return string
     */
    public function getStylesheetTag($webAccessiblePath, $cacheBustValue = null )
    {
        $webAccessiblePath = $this->applyCacheBustToString($webAccessiblePath, $cacheBustValue);
        $mediaTypeOverride = $this->getStylesheetMediaTypeAsAttributeForTag();
        $tag = '<link href="' . $webAccessiblePath . '"' . $mediaTypeOverride . 'rel="stylesheet" type="text/css" />';
        $tag = $this->potentiallyIncludeEndOfLine($tag);
        return $tag;
    }


    /**
     * @param $webAccessiblePath
     * @param null|string $cacheBustValue If not null, is added as a query parameter for cache busting
     * @return string
     */
    public function getScriptTag($webAccessiblePath, $cacheBustValue = null )
    {
        $webAccessiblePath = $this->applyCacheBustToString($webAccessiblePath, $cacheBustValue);
        $tag = '<script type="text/javascript" src="' . $webAccessiblePath . "\"></script>";
        $tag = $this->potentiallyIncludeEndOfLine($tag);
        return $tag;
    }


    /**
     * @param string $path
     * @param null|string $cacheBustValue If not null, is added as a query parameter for cache busting
     * @return string
     */
    protected function applyCacheBustToString($path, $cacheBustValue)
    {
        if ($cacheBustValue !== null) {
            $path .= '?' . $this->cacheBustKey . '=' . $cacheBustValue;
            return $path;
        }
        return $path;
    }


    /**
     * Add a newline to $tag if the includingEndOfLine option is on.
     *
     * @param $tag
     * @return string
     */
    protected function potentiallyIncludeEndOfLine($tag)
    {
        if ($this->includingEndOfLine) {
            $tag = $tag . PHP_EOL;
        }
        return $tag;
    }


    /**
     * @return null|string
     */
    public function getStylesheetMediaType()
    {
        return $this->stylesheetMediaAttributeValue;
    }

    public function getStylesheetMediaTypeAsAttributeForTag()
    {
        $stylesheetMediaType = $this->getStylesheetMediaType();
        if ( is_null( $stylesheetMediaType ) ) {
            return ' ';
        } else {
            return ' media="' . $stylesheetMediaType . '" ';
        }
    }

    /**
     * @param null|string $stylesheetMediaType
     */
    public function setStylesheetMediaType($stylesheetMediaType = null)
    {
        $this->stylesheetMediaAttributeValue = $stylesheetMediaType;
    }

}