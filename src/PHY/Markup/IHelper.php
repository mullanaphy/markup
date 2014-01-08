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
     * Helper contract.
     *
     * @package PHY\Markup\Helper
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    interface IHelper
    {

        /**
         * Inject our Markup object.
         *
         * @param IMarkup $markup
         */
        public function __construct(IMarkup $markup);

        /**
         * Getter\Setter for IMarkup.
         *
         * @param IMarkup $markup
         * @return IMarkup
         */
        public function markup(IMarkup $markup = null);

        /**
         * Create a generic cancel button.
         *
         * @param string $value
         * @param array $attributes Optional
         * @return Element
         */
        public function cancel($value = null, array $attributes = []);

        /**
         * Create a generic checkbox.
         *
         * @param string $name Name for the checkbox.
         * @param mixed $label innerHTML to add after the input box itself.
         * @param array $attributes Optional
         * @return Element
         */
        public function checkbox($name = null, $label = '', array $attributes = []);

        /**
         * A generic definition tag.
         *
         * @param string $term Term to be defined.
         * @param mixed $definition Definition for $term.
         * @param array $attributes Optional
         * @return Element
         */
        public function definition($term = null, $definition = null, array $attributes = []);

        /**
         * A simple hidden input field.
         *
         * IF $name is an array, it will create hidden inputs as $key => $label
         * pairings and return an array of hidden fields while $value becomes
         * $attributes.
         *
         * @param string|array $name
         * @param string $value
         * @param array $attributes Optional
         * @return Element
         */
        public function hidden($name = null, $value = null, array $attributes = []);

        /**
         * Return a generic img tag.
         *
         * @param string $src
         * @param string $title Optional
         * @param array $attributes Optional
         * @return Element
         */
        public function image($src = null, $title = null, array $attributes = []);

        /**
         * Create an ordered list via a supplied array.
         *
         * @param array $content
         * @param array $attributes Optional
         * @param string $tag Default 'ol'
         * @return Element
         */
        public function ordered(array $content = null, array $attributes = [], $tag = 'ol');

        /**
         * Create a password input box.
         *
         * @param string $name
         * @param array $attributes Optional
         * @return Element
         */
        public function password($name = null, array $attributes = []);

        /**
         * Create a group of radio buttons.
         *
         * @param string $name
         * @param array $values
         * @param array $attributes Optional. 'checked' => $key for choosing which radio is selected.
         * @return Element
         */
        public function radio($name = null, array $values = null, array $attributes = []);

        /**
         * Create a generic reset input button.
         *
         * @param string $name
         * @param string $value
         * @param array $attributes Optional
         * @return Element
         */
        public function reset($name = null, $value = null, array $attributes = []);

        /**
         * Create a generic select drop box.
         *
         * @param string $name
         * @param array $values
         * @param array $attributes Optional. 'selected' => $key for choosing which option is selected.
         * @return Element
         */
        public function selectbox($name = null, array $values = [], array $attributes = []);

        /**
         * Create a generic submit button.
         *
         * @param string $name
         * @param string $value
         * @param array $attributes Optional
         * @return Element
         */
        public function submit($name = null, $value = null, array $attributes = []);

        /**
         * Create a generic textbox. If size = 1 it will be an input box, any
         * larger and it becomes a textarea.
         *
         * @param string $name
         * @param int $size
         * @param array $attributes Optional
         * @return Element
         */
        public function textbox($name = null, $size = 1, array $attributes = []);

        /**
         * Create a generic time tag.
         *
         * IF $date is an array, then the current time is used and no format
         * is set while $date is mapped to $attributes instead.
         *
         * IF there is no format then timestamp will come back as a relative
         * time difference from time().
         *
         * @param \DateTime $date
         * @param string $format
         * @param array $attributes
         * @return Element
         */
        public function timestamp(\DateTime $date, $format = 'Y-m-d H:i:s', array $attributes = []);

        /**
         * Create a generic unordered list out of an array.
         *
         * @param array $content
         * @param array $attributes Optional
         * @return Element
         */
        public function unordered($content = null, array $attributes = []);

        /**
         * Create a generic anchor tag.
         *
         * @param mixed $content innerHTML of the anchor tag.
         * @param string|array $link array will create a ?key=value structure
         * while the first value in the array will be the link itself.
         * @param array $attributes Optional
         * @return Element
         */
        public function url($content = null, $link = null, $attributes = null);

    }
