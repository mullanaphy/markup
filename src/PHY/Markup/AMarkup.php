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
    abstract class AMarkup implements IMarkup
    {

        protected $helper = null;
        protected $events = [];
        protected $standard = [];
        protected $voids = [];
        protected $tags = [];

        /**
         * Remove the helper reference to try and help out PHP's garbage
         * collection.
         */
        public function __destruct()
        {
            $this->helper = null;
            unset($this->helper);
        }

        /**
         * {@inheritDoc}
         */
        public function __call($function, $parameters)
        {
            $function = strtolower($function);
            if (!in_array($function, array_keys($this->tags))) {
                throw new Exception('Tag <strong>'.strtoupper($function).'</strong> is not defined in <strong>'.str_replace('\PHY\Markup\\', '', get_class($this)).'</strong>');
            }
            if (in_array($function, $this->voids)) {
                $element = new Element($this, $function, ((isset($parameters[0]))
                    ? $this->attributes($function, $parameters[0])
                    : null), true);
            } else {
                $element = new Element($this, $function, ((isset($parameters[1]))
                    ? $this->attributes($function, $parameters[1])
                    : null), false);
                if (isset($parameters[0])) {
                    $element->append($parameters[0]);
                }
            }
            return $element;
        }

        /**
         * {@inheritDoc}
         */
        public function __get($function)
        {
            return $this->__call($function, []);
        }

        /**
         * {@inheritDoc}
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
         * {@inheritDoc}
         */
        public function add($tag = null, $attributes = null, $void = false)
        {
            if (!is_string($tag)) {
                throw new Exception('New tags must be a string.');
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
         * {@inheritDoc}
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
         * {@inheritDoc}
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
         * {@inheritDoc}
         */

        public function isTagVoid($tag)
        {
            return $this->has($tag) && in_array($tag, $this->voids);
        }

        /**
         * {@inheritDoc}
         */

        public function helper(IHelper $helper = null)
        {
            if (null !== $helper) {
                $this->helper = $helper;
            } else if (null === $this->helper) {
                $this->helper = new Helper($this);
            }
            return $this->helper;
        }

    }
