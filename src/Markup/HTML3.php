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
     * Work with only HTML3.2 tags and attributes. Works well for email flyers.
     *
     * @package PHY\Markup\XHTML
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class HTML3 extends \PHY\Markup\AMarkup
    {

        const DOCTYPE = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">';
        const OPENER = '<html>';
        const CLOSER = '</html>';

        protected $standard = [
            'class' => true,
            'id' => true,
            'style' => true,
            'tabindex' => true,
            'title' => true
        ];
        protected $tags = [
            'address' => true,
            'applet' => [
                'align' => [
                    'bottom',
                    'left',
                    'middle',
                    'right',
                    'top'
                ],
                'alt' => true,
                'code' => true,
                'codebase' => true,
                'height' => true,
                'hspace' => true,
                'name' => true,
                'vspace' => true,
                'width' => true
            ],
            'area' => [
                'alt' => true,
                'coords' => true,
                'href' => true,
                'nohref' => true,
                'shape' => [
                    'circle',
                    'poly',
                    'rect'
                ]
            ],
            'a' => [
                'href' => true,
                'name' => true,
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
                'rev' => true,
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ]
            ],
            'base' => [
                'href' => true
            ],
            'basefont' => [
                'size' => true
            ],
            'big' => true,
            'blockquote' => true,
            'body' => [
                'alink' => true,
                'background' => true,
                'bgcolor' => true,
                'link' => true,
                'text' => true,
                'vlink' => true
            ],
            'br' => true,
            'b' => true,
            'caption' => [
                'align' => [
                    'bottom',
                    'top'
                ]
            ],
            'center' => true,
            'cite' => true,
            'code' => true,
            'dd' => true,
            'dfn' => true,
            'dir' => [
                'compact' => true
            ],
            'div' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'dl' => [
                'compact' => true
            ],
            'dt' => true,
            'em' => true,
            'font' => [
                'color' => true,
                'size' => true
            ],
            'form' => [
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
                'target' => [
                    '_blank',
                    '_parent',
                    '_self',
                    '_top'
                ]
            ],
            'h1' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'h2' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'h3' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'h4' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'h5' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'h6' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'head' => true,
            'hr' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ],
                'noshade' => true,
                'size' => true,
                'width' => true
            ],
            'html' => [
                'version' => true
            ],
            'img' => [
                'align' => [
                    'bottom',
                    'left',
                    'middle',
                    'right',
                    'top'
                ],
                'alt' => true,
                'border' => true,
                'height' => true,
                'hspace' => true,
                'ismap' => true,
                'src' => true,
                'usemap' => true,
                'vspace' => true,
                'width' => true
            ],
            'input' => [
                'align' => [
                    'bottom',
                    'left',
                    'middle',
                    'right',
                    'top'
                ],
                'checked' => true,
                'maxlength' => true,
                'name' => true,
                'size' => true,
                'src' => true,
                'type' => [
                    'checkbox',
                    'file',
                    'hidden',
                    'image',
                    'password',
                    'radio',
                    'reset',
                    'submit',
                    'text'
                ],
                'value' => true
            ],
            'isindex' => [
                'prompt' => true
            ],
            'i' => true,
            'kbd' => true,
            'li' => [
                'type' => [
                    1,
                    'a',
                    'A',
                    'circle',
                    'disc',
                    'i',
                    'I',
                    'square'
                ],
                'value' => true
            ],
            'link' => [
                'href' => true,
                'rel' => true,
                'rev' => true,
                'title' => true
            ],
            'map' => [
                'string' => true
            ],
            'menu' => [
                'compact' => true
            ],
            'meta' => [
                'content' => true,
                'http-equiv' => true,
                'name' => true
            ],
            'ol' => [
                'compact' => true,
                'start' => true,
                'type' => [
                    1,
                    'a',
                    'A',
                    'i',
                    'I'
                ]
            ],
            'option' => [
                'selected' => true,
                'value' => true
            ],
            'param' => [
                'name' => true,
                'value' => true
            ],
            'pre' => [
                'width' => true
            ],
            'p' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ]
            ],
            'samp' => true,
            'script' => true,
            'select' => [
                'multiple' => true,
                'name' => true,
                'size' => true
            ],
            'small' => true,
            'strike' => true,
            'strong' => true,
            'style' => [
                'type' => true
            ],
            'sub' => true,
            'sup' => true,
            'table' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ],
                'border' => true,
                'cellpadding' => true,
                'cellspacing' => true,
                'width' => true
            ],
            'td' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ],
                'colspan' => true,
                'height' => true,
                'nowrap' => true,
                'rowspan' => true,
                'valign' => [
                    'bottom',
                    'middle',
                    'top'
                ],
                'width' => true
            ],
            'textarea' => [
                'cols' => true,
                'name' => true,
                'rows' => true
            ],
            'th' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ],
                'colspan' => true,
                'height' => true,
                'nowrap' => true,
                'rowspan' => true,
                'valign' => [
                    'bottom',
                    'middle',
                    'top'
                ],
                'width' => true
            ],
            'title' => true,
            'tr' => [
                'align' => [
                    'center',
                    'left',
                    'right'
                ],
                'valign' => [
                    'bottom',
                    'middle',
                    'top'
                ]
            ],
            'tt' => true,
            'ul' => [
                'compact' => true,
                'type' => [
                    'circle' => true,
                    'disc' => true,
                    'square' => true
                ]
            ],
            'u' => true,
            'var' => true
        ];
        protected $voids = [
            'area',
            'base',
            'basefont',
            'br',
            'hr',
            'img',
            'input',
            'isindex',
            'link',
            'meta',
            'param'
        ];

    }
