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

    use \PHY\Markup\Raw as Markup;

    /**
     * Test our Raw class as well as all Abstract functionality.
     *
     * @package PHY\Markup\Tests\RawTest
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class Raw extends \PHPUnit_Framework_TestCase
    {

        public function testAddVoidTag()
        {
            $markup = new Markup;
            $markup->add('void', [], true);
            $void = $markup->void;
            $this->assertEquals('<void />', $void->toString());
            $void = $markup->void();
            $this->assertEquals('<void />', $void->toString());
        }

        public function testAddVoidTagWithAttributes()
        {
            $markup = new Markup;
            $markup->add('void', ['key' => true], true);
            $void = $markup->void->attributes([
                'key' => 'value',
                'other' => 'otherValue'
                ]);
            $this->assertEquals('<void key="value" />', $void->toString());
            $void = $markup->void([
                'key' => 'value',
                'other' => 'otherValue'
                ]);
            $this->assertEquals('<void key="value" />', $void->toString());
        }

        public function testAddTag()
        {
            $markup = new Markup;
            $markup->add('tag', []);
            $tag = $markup->tag('Inner HTML');
            $this->assertEquals('<tag>Inner HTML</tag>', $tag->toString());
        }

        public function testAddTagWithAttributes()
        {
            $markup = new Markup;
            $markup->add('tag', ['key' => true]);
            $tag = $markup->tag('Inner HTML', [
                'key' => 'value',
                'other' => 'otherHtml'
                ]);
            $this->assertEquals('<tag key="value">Inner HTML</tag>', $tag->toString());
        }

        public function testRemoveVoid()
        {
            $markup = new Markup;
            $markup->add('void', [], true);
            $markup->remove('void');
            $this->assertFalse($markup->has('void'));
        }

        public function testRemoveTag()
        {
            $markup = new Markup;
            $markup->add('tag');
            $markup->remove('tag');
            $this->assertFalse($markup->has('tag'));
        }

        public function testIsTagVoid()
        {
            $markup = new Markup;
            $markup->add('void', [], true);
            $this->assertTrue($markup->isTagVoid('void'));
        }

        public function testAttributes()
        {
            $markup = new Markup;
            $markup->add('tag', [
                'mixed' => true,
                'enum' => [
                    'one',
                    'two',
                    'three'
                ]
            ]);
            $tag = $markup->tag('Inner HTML', ['mixed' => 'string', 'enum' => 'one']);
            $this->assertEquals('<tag mixed="string" enum="one">Inner HTML</tag>', $tag->toString());
            $tag->enum('two');
            $this->assertEquals('<tag mixed="string" enum="two">Inner HTML</tag>', $tag->toString());
            $tag->enum('four');
            $this->assertEquals('<tag mixed="string" enum="two">Inner HTML</tag>', $tag->toString());
            $tag->enum(false);
            $this->assertEquals('<tag mixed="string">Inner HTML</tag>', $tag->toString());
            $tag->mixed();
            $this->assertEquals('<tag>Inner HTML</tag>', $tag->toString());
            $tag->mixed('test', 'it', 'out');
            $this->assertEquals('<tag mixed="test it out">Inner HTML</tag>', $tag->toString());
            $tag->mixed(['test', 'it', 'out']);
            $this->assertEquals('<tag mixed="test it out">Inner HTML</tag>', $tag->toString());
        }

        public function testDataAttributes()
        {
            $markup = new Markup;
            $markup->add('tag');
            $tag = $markup->tag('Inner HTML', ['data' => ['zero' => 0]]);
            $tag->data([
                'one' => 1,
                'two' => 2
            ]);
            $this->assertEquals('<tag data-zero="0" data-one="1" data-two="2">Inner HTML</tag>', $tag->toString());
            $tag->data(['three' => ['have', 'three', 'values']]);
            $this->assertEquals('<tag data-zero="0" data-one="1" data-two="2" data-three="have three values">Inner HTML</tag>', $tag->toString());
            $tag->dataFour(4);
            $this->assertEquals('<tag data-zero="0" data-one="1" data-two="2" data-three="have three values" data-four="4">Inner HTML</tag>', $tag->toString());
            $tag->dataFour(false);
            $this->assertEquals('<tag data-zero="0" data-one="1" data-two="2" data-three="have three values">Inner HTML</tag>', $tag->toString());
        }

    }
