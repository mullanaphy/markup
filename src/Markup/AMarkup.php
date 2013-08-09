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
     * Abstract class that takes care of our background functionality.
     *
     * @package PHY\Markup\AMarkup
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     * @abstract
     */
    abstract class AMarkup
    {

        protected $helper = null;
        protected $events = [];
        protected $standard = [];
        protected $voids = [];
        protected $tags = [];

        /**
         * Calls a tag based on $Markup->$tag();
         *
         * @param mixed $innerHTML
         * @param array $attributes
         * @return \PHY\Markup\Element
         */
        public function __call($function, $parameters)
        {
            $function = strtolower($function);
            if (!in_array($function, array_keys($this->tags))) {
                throw new \PHY\Markup\Exception('Tag <strong>'.strtoupper($function).'</strong> is not defined in <strong>'.str_replace('\PHY\Markup\\', '', get_class($this)).'</strong>');
            }
            if (in_array($function, $this->voids)) {
                $element = new \PHY\Markup\Element($this, $function, ((isset($parameters[0]))
                    ? $this->attributes($function, $parameters[0])
                    : null
                ), true);
            } else {
                $element = new \PHY\Markup\Element($this, $function, ((isset($parameters[1]))
                    ? $this->attributes($function, $parameters[1])
                    : null
                ), false);
                if (isset($parameters[0])) {
                    $element->append($parameters[0]);
                }
            }
            return $element;
        }

        /**
         * Returns a tag object based on $Markup->$tag
         *
         * @return \PHY\Markup\Element
         */
        public function __get($function)
        {
            return $this->__call($function, []);
        }

        /**
         * Cleans attributes of $attributes down to ones that are allowed for
         * $tag.
         *
         * @param string $tag
         * @param array $attributes
         * @return array
         */
        public function attributes($tag = null, $attributes = null)
        {
            if (null === $tag || !is_array($attributes)) {
                return;
            }
            $allowed = $this->standard + $this->events;
            $return = [];
            if (is_array($this->tags[$tag])) {
                $allowed = array_replace($allowed, $this->tags[$tag]);
            }
            foreach ($attributes as $key => $value) {
                if (array_key_exists($key, $allowed)) {
                    if (!is_array($allowed[$key])) {
                        $return[$key] = $value;
                    } else if (in_array($value, $allowed[$key])) {
                        $return[$key] = $value;
                    }
                } else if ('data' === $key && is_array($value)) {
                    foreach ($value as $k => $v) {
                        $return['data-'.$k] = $v;
                    }
                } else if (false !== strpos($key, 'data-')) {
                    $return[$key] = $value;
                }
            }
            return $return;
        }

        /**
         * Adds a tag to the lexicon. If tag is already defined it will add any
         * new attributes provided and set whether it is a void or not.
         *
         * @param string $tag
         * @param array $attributes
         * @param bool $void
         * @return \PHY\Markup\AMarkup
         */
        public function add($tag = null, $attributes = null, $void = false)
        {
            if (!is_string($tag)) {
                throw new \PHY\Markup\Exception('New tags must be a string.');
            }
            if (array_key_exists($tag, $this->tags)) {
                if (is_array($attributes)) {
                    if (is_array($this->tags[$tag])) {
                        foreach ($attributes as $key => $value) {
                            $this->tags[$tag][$key] = $value;
                        }
                        return true;
                    } else {
                        $this->tags[$tag] = $attributes;
                    }
                } else {
                    $this->tags[$tag] = true;
                }
                if ($void) {
                    $this->voids[] = $tag;
                } else {
                    foreach ($this->voids as $key => $value) {
                        if ($tag === $value) {
                            unset($this->voids[$key]);
                        }
                    }
                }
            } else {
                $this->tags[$tag] = null !== $attributes && (is_array($attributes) || true === $attributes)
                    ? $attributes
                    : true;
                if ($void) {
                    $this->voids[] = $tag;
                }
            }
            return $this;
        }

        /**
         * See if a markup tag is available. If attribute is sent it will also
         * check to make sure that attribute exists.
         *
         * @param string $tag
         * @param string $attribute If used it will also look for attribute.
         * @return bool
         */
        public function has($tag, $attribute = null)
        {
            if (is_scalar($attribute)) {
                if ($this->has($tag)) {
                    return array_key_exists($attribute, $this->tags[$tag]);
                }
            } else {
                return array_key_exists($tag, $this->tags);
            }
            return false;
        }

        /**
         * Remove a tag from the lexicon in use.
         *
         * IF Attributes are sent it will only remove attributes that are sent,
         * NOT the tag itself.
         *
         * @param string $tag
         * @param string $attribute If used it will only remove that attribute.
         * @return \PHY\Markup\AMarkup
         */
        public function remove($tag = null, $attribute = null)
        {
            if (array_key_exists($tag, $this->tags)) {
                if (is_scalar($attribute)) {
                    unset($this->tags[$tag][$attribute]);
                } else {
                    unset($this->tags[$tag]);
                    if (false !== ($void = array_search($tag, $this->voids))) {
                        unset($this->voids[$void]);
                    }
                }
            }
            return $this;
        }

        /**
         * Return if a specific tag is a void.
         * 
         * @param string $tag
         * @return bool
         */
        public function isTagVoid($tag)
        {
            return $this->has($tag) && in_array($tag, $this->voids);
        }

        /**
         * Return a helper class for building HTML. You can also inject a new
         * helper if you ever have the need to overwrite the helper.
         *
         * @param \PHY\Markup\Helper $helper
         * @return \PHY\Markup\Helper
         */
        public function helper(\PHY\Markup\Helper $helper = null)
        {
            if(null !== $helper) {
                $this->helper = $helper;
            } else if (null === $this->helper) {
                $this->helper = new \PHY\Markup\Helper($this);
            }
            return $this->helper;
        }

    }
