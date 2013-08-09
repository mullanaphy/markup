<?php

    /**
     * PHY\Markup
     * https://github.com/mullanaphy/markup
     *
     * LICENSE
     * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
     * http://www.wtfpl.net/
     */

    namespace PHY\Markup;

    /**
     * Work with only HTML4 tags and attributes.
     *
     *
     * @package PHY\Markup\XHTML
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class HTML4 extends \PHY\Markup\AMarkup
    {

        const DOCTYPE = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';
        const OPENER = '<html lang="en" xml:lang="en">';
        const CLOSER = '</html>';

        protected $standard = [
            'accesskey' => true,
            'class' => true,
            'dir' => [
                'ltr',
                'rtl'
            ],
            'id' => true,
            'lang' => true,
            'style' => true,
            'tabindex' => true,
            'title' => true,
            'xml:lang' => true
        ];
        protected $tags = [
            'a' => [
                'href' => true,
                'hreflang' => true,
                'media' => true,
                'ping' => true,
                'rel' => [
                    'alternate',
                    'archives',
                    'author',
                    'bookmark',
                    'contact',
                    'external',
                    'feed',
                    'first',
                    'help',
                    'icon',
                    'index',
                    'last',
                    'license',
                    'next',
                    'nofollow',
                    'noreferrer',
                    'pingback',
                    'prefetch',
                    'prev',
                    'search',
                    'stylesheet',
                    'sidebar',
                    'tag',
                    'up'
                ],
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ],
                'type' => true
            ],
            'abbr' => true,
            'acronym' => true,
            'address' => true,
            'area' => [
                'alt' => true,
                'coords' => true,
                'href' => true,
                'hreflang' => true,
                'media' => true,
                'ping' => true,
                'rel' => [
                    'alternate',
                    'archives',
                    'author',
                    'bookmark',
                    'contact',
                    'external',
                    'feed',
                    'first',
                    'help',
                    'icon',
                    'index',
                    'last',
                    'license',
                    'next',
                    'nofollow',
                    'noreferrer',
                    'pingback',
                    'prefetch',
                    'prev',
                    'search',
                    'stylesheet',
                    'sidebar',
                    'tag',
                    'up'
                ],
                'shape' => [
                    'rect',
                    'rectangle',
                    'circ',
                    'circle',
                    'poly',
                    'polygon'
                ],
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ],
                'type' => true
            ],
            'article' => [
                'cite' => true,
                'pubdate' => true
            ],
            'aside' => true,
            'audio' => [
                'autobuffer' => true,
                'autoplay' => true,
                'controls' => true,
                'src' => true
            ],
            'b' => true,
            'base' => [
                'href' => true,
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
            ],
            ],
            'bdo' => true,
            'blockquote' => [
                'site' => true
            ],
            'body' => true,
            'br' => true,
            'button' => true,
            'canvas' => [
                'height' => true,
                'width' => true
            ],
            'caption' => true,
            'cite' => true,
            'code' => true,
            'col' => [
                'span' => true
            ],
            'colgroup' => [
                'span' => true
            ],
            'command' => [
                'checked' => true,
                'disabled' => true,
                'icon' => true,
                'label' => true,
                'radiogroup' => true,
                'type' => [
                    'checkbox',
                    'command',
                    'radio'
            ],
            ],
            'datalist' => true,
            'dd' => true,
            'del' => [
                'cite' => true,
                'datetime' => true
            ],
            'details' => [
                'open' => true
            ],
            'dialog' => true,
            'dfn' => true,
            'div' => true,
            'dl' => true,
            'dt' => true,
            'em' => true,
            'embed' => [
                'height' => true,
                'src' => true,
                'type' => true,
                'width' => true
            ],
            'fieldset' => [
                'disabled' => true,
                'form' => true,
                'name' => true
            ],
            'figure' => true,
            'footer' => true,
            'form' => [
                'accept-charset' => true,
                'action' => true,
                'autocomplete' => [
                    'off',
                    'on'
                ],
                'enctype' => [
                    'application/x-www-form-urlencoded',
                    'multipart/form-data',
                    'text/plain'
                ],
                'method' => [
                    'delete',
                    'get',
                    'post',
                    'put'
                ],
                'name' => true,
                'novalidate' => true,
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ]
            ],
            'h1' => true,
            'h2' => true,
            'h3' => true,
            'h4' => true,
            'h5' => true,
            'h6' => true,
            'head' => true,
            'header' => true,
            'hgroup' => true,
            'hr' => true,
            'html' => [
                'manifest' => true,
                'xmlns' => true
            ],
            'i' => true,
            'iframe' => [
                'height' => true,
                'name' => true,
                'sandbox' => [
                    'allow-forms',
                    'allow-same-origin',
                    'allow-scripts'
                ],
                'seamless' => true,
                'src' => true,
                'width' => true
            ],
            'img' => [
                'alt' => true,
                'height' => true,
                'ismap' => true,
                'src' => true,
                'usemap' => true,
                'width' => true
            ],
            'input' => [
                'accept' => true,
                'alt' => true,
                'autocomplete' => [
                    'off',
                    'on'
                ],
                'autofocus' => true,
                'checked' => true,
                'disabled' => true,
                'form' => true,
                'formaction' => true,
                'formenctype' => [
                    'application/x-www-form-urlencoded',
                    'multipart/form-data',
                    'text/plain'
                ],
                'formmethod' => [
                    'delete',
                    'get',
                    'post',
                    'put'
                ],
                'formnovalidate' => [
                    'false',
                    'true'
                ],
                'formtarget' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ],
                'height' => true,
                'list' => true,
                'max' => true,
                'maxlength' => true,
                'min' => true,
                'multiple' => true,
                'name' => true,
                'pattern' => true,
                'placeholder' => true,
                'readonly' => true,
                'required' => true,
                'size' => true,
                'src' => true,
                'step' => true,
                'type' => [
                    'button',
                    'checkbox',
                    'color',
                    'date',
                    'datetime',
                    'datetime-local',
                    'email',
                    'file',
                    'hidden',
                    'image',
                    'month',
                    'number',
                    'password',
                    'radio',
                    'range',
                    'reset',
                    'search',
                    'submit',
                    'tel',
                    'text',
                    'time',
                    'url',
                    'week'
                ],
                'value' => true,
                'width' => true
            ],
            'ins' => true,
            'keygen' => [
                'autofocus' => true,
                'challenge' => true,
                'disabled' => true,
                'form' => true,
                'keytype' => true,
                'name' => true
            ],
            'kbd' => true,
            'label' => [
                'for' => true,
                'form' => true
            ],
            'legend' => true,
            'li' => [
                'value' => true
            ],
            'link' => [
                'href' => true,
                'hreflang' => true,
                'media' => [
                    'all',
                    'aural',
                    'braille',
                    'handheld',
                    'print',
                    'projection',
                    'screen',
                    'tty',
                    'tv'
                ],
                'rel' => [
                    'alternate',
                    'archives',
                    'author',
                    'feed',
                    'first',
                    'help',
                    'icon',
                    'index',
                    'last',
                    'license',
                    'next',
                    'pingback',
                    'prefetch',
                    'prev',
                    'search',
                    'stylesheet',
                    'sidebar',
                    'tag',
                    'up'
                ],
                'sizes' => true,
                'type' => [
                    'image/gif',
                    'text/css',
                    'text/javascript'
                ]
            ],
            'map' => [
                'name' => true
            ],
            'mark' => true,
            'menu' => [
                'label' => true,
                'type' => [
                    'context',
                    'toolbar',
                    'list'
                ]
            ],
            'meta' => [
                'charset' => true,
                'content' => true,
                'http-equiv' => [
                    'content-type',
                    'expires',
                    'refresh',
                    'set-cookie'
                ],
                'name' => true
            ],
            'meter' => [
                'high' => true,
                'low' => true,
                'max' => true,
                'min' => true,
                'optimum' => true,
                'value' => true
            ],
            'nav' => true,
            'noscript' => true,
            'object' => [
                'data' => true,
                'form' => true,
                'height' => true,
                'name' => true,
                'type' => true,
                'usemap' => true,
                'width' => true
            ],
            'ol' => [
                'reversed' => true,
                'start' => true
            ],
            'optgroup' => [
                'disabled' => true,
                'label' => true
            ],
            'option' => [
                'disabled' => true,
                'label' => true,
                'selected' => true,
                'value' => true,
            ],
            'output' => [
                'for' => true,
                'form' => true,
                'name' => true
            ],
            'p' => true,
            'param' => [
                'name' => true,
                'value' => true
            ],
            'pre' => true,
            'progress' => [
                'max' => true,
                'value' => true
            ],
            'q' => [
                'cite' => true
            ],
            'rp' => true,
            'rt' => true,
            'ruby' => true,
            'samp' => true,
            'script' => [
                'async' => true,
                'charset' => true,
                'defer' => true,
                'src' => true,
                'type' => [
                    'application/ecmascript',
                    'application/javascript',
                    'text/ecmascript',
                    'text/javascript',
                    'text/vbscript'
                ]
            ],
            'section' => [
                'cite' => true
            ],
            'select' => [
                'autofocus' => true,
                'disabled' => true,
                'form' => true,
                'multiple' => true,
                'name' => true,
                'size' => true
            ],
            'small' => true,
            'source' => [
                'media' => true,
                'src' => true,
                'type' => true
            ],
            'span' => true,
            'strong' => true,
            'style' => [
                'media' => [
                    'all',
                    'aural',
                    'braille',
                    'handheld',
                    'print',
                    'projection',
                    'screen',
                    'tty',
                    'tv'
                ],
                'scoped' => true,
                'type' => 'text/css'
            ],
            'sub' => true,
            'sup' => true,
            'table' => [
                'summary' => true
            ],
            'tbody' => true,
            'td' => [
                'colspan' => true,
                'headers' => true,
                'rowspan' => true
            ],
            'textarea' => [
                'autofocus' => true,
                'cols' => true,
                'disabled' => true,
                'form' => true,
                'maxlength' => true,
                'name' => true,
                'placeholder' => true,
                'readonly' => true,
                'required' => true,
                'rows' => true,
                'wrap' => [
                    'hard',
                    'soft'
            ],
            ],
            'tfoot' => true,
            'th' => [
                'colspan' => true,
                'headers' => true,
                'rowspan' => true,
                'scope' => [
                    'col',
                    'colgroup',
                    'row',
                    'rowgroup'
                ]
            ],
            'thead' => true,
            'time' => [
                'datetime' => true
            ],
            'title' => true,
            'tr' => true,
            'ul' => true,
            'var' => true,
            'video' => [
                'autobuffer' => true,
                'autoplay' => true,
                'controls' => true,
                'height' => true,
                'loop' => true,
                'src' => true,
                'width' => true
            ]
        ];
        protected $voids = [
            'area',
            'base',
            'br',
            'col',
            'command',
            'embed',
            'hr',
            'img',
            'input',
            'keygen',
            'link',
            'meta',
            'param',
            'source'
        ];

    }
