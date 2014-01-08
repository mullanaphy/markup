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
     * Contract that defines our Markup classes.
     *
     * @package PHY\Markup\IMarkup
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     * @abstract
     */
    interface IMarkup
    {

        /**
         * Calls a tag based on $Markup->$tag();
         *
         * @param mixed $function
         * @param array $parameters
         * @return Element
         */
        public function __call($function, $parameters);

        /**
         * Returns a tag object based on $Markup->$tag
         *
         * @param string $function
         * @return Element
         */
        public function __get($function);

        /**
         * Cleans attributes of $attributes down to ones that are allowed for
         * $tag.
         *
         * @param string $tag
         * @param array $attributes
         * @return array
         */
        public function attributes($tag = null, $attributes = null);

        /**
         * Adds a tag to the lexicon. If tag is already defined it will add any
         * new attributes provided and set whether it is a void or not.
         *
         * @param string $tag
         * @param array $attributes
         * @param bool $void
         * @return IMarkup
         */
        public function add($tag = null, $attributes = null, $void = false);

        /**
         * See if a markup tag is available. If attribute is sent it will also
         * check to make sure that attribute exists.
         *
         * @param string $tag
         * @param string $attribute If used it will also look for attribute.
         * @return bool
         */
        public function has($tag, $attribute = null);

        /**
         * Remove a tag from the lexicon in use.
         *
         * IF Attributes are sent it will only remove attributes that are sent,
         * NOT the tag itself.
         *
         * @param string $tag
         * @param string $attribute If used it will only remove that attribute.
         * @return IMarkup
         */
        public function remove($tag = null, $attribute = null);

        /**
         * Return if a specific tag is a void.
         *
         * @param string $tag
         * @return bool
         */
        public function isTagVoid($tag);

        /**
         * Return a helper class for building HTML. You can also inject a new
         * helper if you ever have the need to overwrite the helper.
         *
         * @param IHelper $helper
         * @return IHelper
         */
        public function helper(IHelper $helper = null);

    }
