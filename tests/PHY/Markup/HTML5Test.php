<?php

    /**
     * PHY\Markup
     * https://github.com/mullanaphy/markup
     *
     * LICENSE
     * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
     * http://www.wtfpl.net/
     */

    namespace PHY\Markup\Tests;

    use \PHY\Markup\HTML5 as Markup;

    /**
     * Test our HTML5 class.
     *
     * @package PHY\Markup\Tests\HTML5Test
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class HTML5Test extends \PHPUnit_Framework_TestCase
    {

        public function testCanvasEmpty()
        {
            $markup = new Markup;
            $canvas = $markup->canvas;
            $this->assertEquals('<canvas></canvas>', $canvas->toString());
        }

        public function testCanvasCorrectAttributes()
        {
            $markup = new Markup;
            $canvas = $markup->canvas->attributes([
                'height' => 300,
                'width' => 300
            ]);
            $this->assertEquals('<canvas height="300" width="300"></canvas>', $canvas->toString());
        }

        public function testCanvasIncorrectAttributes()
        {
            $markup = new Markup;
            $canvas = $markup->canvas->attributes([
                'height' => 300,
                'width' => 300,
                'other' => 300
            ]);
            $this->assertEquals('<canvas height="300" width="300"></canvas>', $canvas->toString());
        }

        public function testCanvasContent()
        {
            $markup = new Markup;
            $canvas = $markup->canvas('Inner Content', [
                'height' => 300,
                'width' => 300
            ]);
            $this->assertEquals('<canvas height="300" width="300">Inner Content</canvas>', $canvas->toString());
        }

        public function testAddAttribute()
        {
            $markup = new Markup;
            $markup->add('canvas', ['other' => true]);
            $canvas = $markup->canvas('Inner Content', [
                'height' => 300,
                'width' => 300,
                'other' => 'value'
            ]);
            $this->assertEquals('<canvas height="300" width="300" other="value">Inner Content</canvas>', $canvas->toString());
        }

        public function testRemoveAttribute()
        {
            $markup = new Markup;
            $markup->add('canvas', ['other' => true]);
            $markup->remove('canvas', 'other');
            $canvas = $markup->canvas('Inner Content', [
                'height' => 300,
                'width' => 300,
                'other' => 'value'
            ]);
            $this->assertEquals('<canvas height="300" width="300">Inner Content</canvas>', $canvas->toString());
        }

        public function testRemoveTag()
        {
            $markup = new Markup;
            $markup->remove('canvas');
            $canvas = $markup->canvas('Inner Content', [
                'height' => 300,
                'width' => 300,
                'other' => 'value'
            ]);
            $this->assertEquals('<canvas height="300" width="300">Inner Content</canvas>', $canvas->toString());
        }

    }
