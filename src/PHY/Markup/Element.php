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
     * The actual Markup element object. This is where the magic happens.
     *
     * @package PHY\Markup\Element
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class Element
    {

        private $markup;
        private $attributes = [];
        private $content = [];
        private $tag = 'div';
        private $void = false;

        /**
         * Creates a Markup_Element based on provided data.
         *
         * @param IMarkup $markup
         * @param string $tag
         * @param array $attributes
         * @param bool $void
         */
        public function __construct(IMarkup $markup, $tag = 'div', $attributes = [], $void = false)
        {
            $this->markup = $markup;
            if (is_array($attributes)) {
                $this->attributes = $attributes;
            }
            $this->tag = strtolower((string)$tag);
            $this->void = (bool)$void;
            return $this;
        }

        /**
         * Remove the markup reference to try and help out PHP's garbage
         * collection.
         */
        public function __destruct()
        {
            $this->markup = null;
            unset($this->markup);
        }

        /**
         * Sets an attribute based on $tag->$key($value);
         */
        public function __call($key, $parameters)
        {
            if ('data' === substr($key, 0, 4)) {
                $key = strtolower(preg_replace('#(.)([A-Z])#', "$1-$2", $key));
            }
            if (1 === func_num_args() || (2 === func_num_args() && !$parameters || ($parameters && false === $parameters[0]))) {
                unset($this->attributes[$key]);
            } else {
                foreach ($parameters as $k => $parameter) {
                    if (is_array($parameter)) {
                        $parameters[$k] = implode(' ', $parameter);
                    }
                }
                $this->attributes([$key => implode(' ', $parameters)]);
            }
            return $this;
        }

        /**
         * Returns any readonly and defined values.
         */
        public function __get($key)
        {
            if (property_exists($this, $key)) {
                return $this->$key;
            }
        }

        /**
         * Generates the HTML and will recursively generate HTML out of inner
         * content.
         *
         * @return string
         */
        public function __toString()
        {
            return $this->toString();
        }

        /**
         * Generates the HTML and will recursively generate HTML out of inner
         * content.
         *
         * @return string
         */
        public function toString()
        {
            if ($this->void) {
                return '<'.$this->tag.$this->createAttributes().' />';
            } else {
                return '<'.$this->tag.$this->createAttributes().'>'.$this->recursivelyStringify($this->content).'</'.$this->tag.'>';
            }
        }

        /**
         * Generates the HTML and will recursively generate HTML out of inner
         * content.
         *
         * @return string
         */
        public function toHtml()
        {
            return $this->toString();
        }

        /**
         * Return our element as an array.
         *
         * @return array
         */
        public function toArray()
        {
            return [
                'tag' => $this->tag,
                'void' => $this->void,
                'attributes' => $this->attributes,
                'content' => $this->recursivelyArrayify($this->content)
            ];
        }

        /**
         * Return our element as a JSON object.
         *
         * @return string
         */
        public function toJson()
        {
            return json_encode($this->toArray());
        }

        /**
         * Append content into an element.
         *
         * @param mixed $content
         * @return Element
         */
        public function append($content = null)
        {
            if (null === $content) {
                return;
            } else if (is_array($content)) {
                foreach ($content as $row) {
                    $this->content[] = $row;
                }
            } else {
                $this->content[] = $content;
            }
            return $this;
        }

        /**
         * Change attributes of an element.
         *
         * @param array $attributes
         * @return Element
         */
        public function attributes(array $attributes)
        {
            $this->attributes = array_replace($this->attributes, $this->markup->attributes($this->tag, $attributes));

            return $this;
        }

        /**
         * Define any data-$key = $value settings based on a $key => $value
         * array.
         *
         * @param array $data
         * @return Element
         */
        public function data(array $data)
        {
            foreach ($data as $key => $value) {
                $this->attributes['data-'.$key] = $value;
            }
            return $this;
        }

        /**
         * Returns whether this element has no innerHTML or not.
         *
         * @return bool
         */
        public function isEmpty()
        {
            return !count($this->content);
        }

        /**
         * Set the Markup class to be used internally.
         *
         * @param IMarkup $markup
         * @return Element
         */
        public function markup(IMarkup $markup)
        {
            $this->markup = $markup;
            return $this;
        }

        /**
         * Prepend content into an element.
         *
         * @param mixed $content
         * @return Element
         */
        public function prepend($content = null)
        {
            if (null === $content) {
                return;
            } else if (is_array($content)) {
                foreach (array_reverse($content) as $row) {
                    array_unshift($this->content, $row);
                }
            } else {
                array_unshift($this->content, $content);
            }
            return $this;
        }

        /**
         * Change the tag type of an element.
         *
         * @param string $tag
         * @return Element
         */
        public function tag($tag = 'div')
        {
            $this->tag = strtolower((string)$tag);
            return $this;
        }

        /**
         * Change whether this element is a void or not.
         *
         * @param bool $void
         * @return Element
         */
        public function void($void = true)
        {
            $this->void = (bool)$void;
            return $this;
        }

        /**
         * This parses $key => $value attributes into a HTML $key="$value"
         * string.
         *
         * @return string HTML attributes.
         * @ignore
         */
        private function createAttributes()
        {
            $return = [];
            foreach ($this->attributes as $key => $value) {
                if ('data' === $key && is_array($value)) {
                    foreach ($value as $k => $v) {
                        $return[] = 'data-'.$k.'="'.htmlentities(is_array($v)
                                ? implode(' ', $v)
                                : $v, ENT_QUOTES, 'UTF-8', false).'"';
                    }
                } else {
                    $return[] = $key.'="'.htmlentities(is_array($value)
                            ? implode(' ', $value)
                            : $value, ENT_QUOTES, 'UTF-8', false).'"';
                }
            }
            return count($return)
                ? ' '.implode(' ', $return)
                : false;
        }

        /**
         * Recursively converts Markup objects into HTML by using
         * Element::__toString();
         *
         * @param mixed $content
         * @return string
         * @ignore
         */
        private function recursivelyStringify($content = null)
        {
            $return = [];
            if (false === $content || null === $content) {
                return;
            } else if (!is_array($content)) {
                $return[] = $content;
            } else {
                foreach ($content as $element) {
                    $return[] = $this->recursivelyStringify($element);
                }
            }
            return implode('', $return);
        }

        /**
         * Recursively converts Markup objects into arrays by using
         * Element::toArray();
         *
         * @param mixed $content
         * @return array
         * @ignore
         */
        private function recursivelyArrayify($content = null)
        {
            $return = [];
            if (false === $content || null === $content) {
                return;
            } else if ($content instanceof Element) {
                $return[] = $content->toArray();
            } else if (!is_array($content)) {
                $return[] = $content;
            } else {
                foreach ($content as $element) {
                    $return[] = $this->recursivelyArrayify($element);
                }
            }
            return $return;
        }
    }
