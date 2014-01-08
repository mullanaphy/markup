<?php

    /**
     * PHY\Markup
     * https://github.com/mullanaphy/markup
     *
     * LICENSE
     * DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
     * http://www.wtfpl.net/
     */

    namespace PHY;

    use PHY\Markup\IMarkup;
    use PHY\Markup\Exception;

    /**
     * Factory builder for Markup.
     *
     * @package PHY\Markup
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class Markup
    {

        /**
         * Create a Markup instance based on the language.
         *
         * @param string $markup
         * @return IMarkup
         * @throws Exception
         */
        public static function create($markup = 'HTML5')
        {
            $class = '\\PHY\\Markup\\'.$markup;
            if (class_exists($class)) {
                return new $class;
            } else {
                throw new Exception('Could not find markup language for "'.$markup.'"');
            }
        }

    }

