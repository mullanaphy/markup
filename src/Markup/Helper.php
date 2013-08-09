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
     * Helper methods for various HTML tags.
     * NOTE: This does make some Twitter Bootstrap compatible tags.
     *
     * @package PHY\Markup\Helper
     * @category PHY\Markup
     * @license http://www.wtfpl.net/
     * @author John Mullanaphy <john@jo.mu>
     */
    class Helper
    {

        protected $markup = null;

        public function __construct(\PHY\Markup\AMarkup $markup)
        {
            $this->markup = $markup;
        }

        /**
         * Create a generic cancel button.
         *
         * @param string $value
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function cancel($value = null, array $attributes = [])
        {
            $attributes = $this->markup->attributes('button', $attributes);
            if (array_key_exists('class', $attributes)) {
                $attributes['class'] = 'btn btn-danger '.$attributes['class'];
            } else {
                $attributes['class'] = 'btn btn-danger';
            }
            return $this->markup->button
                    ->attributes($attributes)
                    ->append($value);
        }

        /**
         * Create a generic checkbox.
         *
         * @param string $name Name for the checkbox.
         * @param mixed $label innerHTML to add after the input box itself.
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function checkbox($name = null, $label = '', array $attributes = [])
        {
            $attributes = $this->markup->attributes('input', $attributes);
            if (is_string($name)) {
                $attributes['name'] = $name;
            }
            $attributes['type'] = 'checkbox';
            if (!array_key_exists('value', $attributes)) {
                $attributes['value'] = 1;
            }
            $checkbox = $this->markup->input($attributes);
            if ($label) {
                return $this->markup->label([$checkbox, $label], ['class' => 'checkbox']);
            } else {
                return $checkbox;
            }
        }

        /**
         * A generic definition tag.
         *
         * @param string $term Term to be defined.
         * @param mixed $definition Definition for $term.
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function definition($term = null, $definition = null, array $attributes = [])
        {
            if (null === $term || null === $definition) {
                return;
            }
            $attributes = $this->markup->attributes('dl', $attributes);
            $dl = $this->markup->dl->attributes($attributes);
            $dt = $this->markup->dt($term);
            $dl->append($dt);
            if (!is_array($definition)) {
                $definition = [$definition];
            }
            $i = 0;
            foreach ($definition as $item) {
                if (is_array($item)) {
                    $dd_attributes = $this->markup->attributes('dd', $item[1]);
                    if (!array_key_exists('id', $dd_attributes) && array_key_exists('id', $attributes)) {
                        $dd_attributes['id'] = $attributes['id'].'-dd-'.(++$i);
                    }
                    $item = $item[0];
                } else if (array_key_exists('id', $attributes)) {
                    $dd_attributes = ['id' => $attributes['id'].'-dd-'.(++$i)];
                } else {
                    $dd_attributes = null;
                }
                $dd = $this->markup->dd($item, $dd_attributes);
                $dl->append($dd);
            }
            return $dl;
        }

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
         * @return \PHY\Markup\Element
         */
        public function hidden($name = null, $value = null, array $attributes = [])
        {
            if (null === $name) {
                return;
            } else if (is_array($name)) {
                $inputs = [];
                $attributes = $value;
                foreach ($name as $k => $v) {
                    $inputs[] = $this->hidden($k, $v, $attributes);
                }
                return $inputs;
            }
            $attributes = $this->markup->attributes('input', $attributes);
            $attributes['name'] = $name;
            $attributes['type'] = 'hidden';
            $attributes['value'] = $value;
            return $this->markup->input($attributes);
        }

        /**
         * Return a generic img tag.
         *
         * @param string $src
         * @param string $title Optional
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function image($src = null, $title = null, array $attributes = [])
        {
            if (null === $src) {
                return;
            }
            $attributes = $this->markup->attributes('img', $attributes);
            if (null !== $title) {
                $attributes['alt'] = $title;
            }
            $attributes['src'] = $src;
            if (!array_key_exists('alt', $attributes)) {
                $attributes['alt'] = is_string($src)
                    ? $src
                    : '';
            }
            return $this->markup->img($attributes);
        }

        /**
         * Create an ordered list via a supplied array.
         *
         * @param array $content
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function ordered(array $content = null, array $attributes = [], $tag = 'ol')
        {
            if (null === $content) {
                return;
            } else if (!is_array($content)) {
                $content = [$content];
            }
            $attributes = $this->markup->attributes($tag, $attributes);
            $ol = $this->markup->$tag->attributes($attributes);
            $i = 0;
            foreach ($content as $item) {
                if (!$item) {
                    continue;
                } else if (is_array($item)) {
                    $li_attributes = $this->markup->attributes('li', $item[1]);
                    if (!array_key_exists('id', $li_attributes) && array_key_exists('id', $attributes)) {
                        $li_attributes['id'] = $attributes['id'].'-li-'.$i;
                    }
                    $item = $item[0];
                } else if (array_key_exists('id', $attributes)) {
                    $li_attributes = ['id' => $attributes['id'].'-li-'.$i];
                } else {
                    $li_attributes = null;
                }
                $li = $this->markup->li($item, $li_attributes);
                $ol->append($li);
                ++$i;
            }
            return $ol;
        }

        /**
         * Create a password input box.
         *
         * @param string $name
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function password($name = null, array $attributes = [])
        {
            if (null === $name) {
                return;
            }
            $attributes = $this->markup->attributes('input', $attributes);
            $attributes['type'] = 'password';
            $attributes['name'] = $name;
            return $this->markup->input($attributes);
        }

        /**
         * Create a group of radio buttons.
         *
         * @param string $name
         * @param array $values
         * @param array $attributes Optional. 'checked' => $key for choosing which radio is selected.
         * @return \PHY\Markup\Element
         */
        public function radio($name = null, array $values = null, array $attributes = [])
        {
            if (null === $name || !$values) {
                return;
            }
            $radio = [];
            $checked = is_array($attributes) && array_key_exists('checked', $attributes)
                ? $attributes['checked']
                : false;
            $attributes = $this->markup->attributes('label', $attributes);
            if (!is_array($attributes)) {
                $attributes = [];
            }
            if (array_key_exists('id', $attributes)) {
                $id = $attributes['id'];
                unset($attributes['id']);
            } else {
                $id = 'radio-'.$name;
            }
            if (!array_key_exists('class', $attributes)) {
                $attributes['class'] = 'radio';
            }
            foreach ($values as $key => $value) {
                if (is_array($value)) {
                    $attributes_input = array_key_exists('attributes', $value)
                        ? $this->markup->attributes('input', $value['attributes'])
                        : [];
                    if (array_key_exists('checked', $value) && $value['checked'] || $key == $checked) {
                        $attributes_input['checked'] = 'checked';
                    }
                    $attributes_input['name'] = $name;
                    $attributes_input['id'] = $id.'-'.$key;
                    $attributes_input['type'] = 'radio';
                    if (array_key_exists('content', $value)) {
                        $value = $value['content'];
                    } else {
                        $value = $key;
                    }
                    if (!array_key_exists('value', $attributes_input)) {
                        $attributes_input['value'] = $key;
                    }
                    $label = $this->markup->label([$this->markup->input($attributes_input), $value], $attributes);
                } else {
                    $label = $this->markup->label([
                        $this->markup->input(
                            ($key === $checked)
                                ? [
                                    'checked' => 'checked',
                                    'id' => $id.'-'.$key,
                                    'name' => $name,
                                    'type' => 'radio',
                                    'value' => $key
                                ]
                                : [
                                    'id' => $id.'-'.$key,
                                    'name' => $name,
                                    'type' => 'radio',
                                    'value' => $key
                                ]
                        ),
                        $value
                    ], $attributes);
                }
                $radio[] = $label;
            }
            return implode('', $radio);
        }

        /**
         * Create a generic reset input button.
         *
         * @param string $name
         * @param string $value
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function reset($name = null, $value = null, array $attributes = [])
        {
            $attributes = $this->markup->attributes('input', $attributes);
            $attributes['name'] = $name;
            $attributes['type'] = 'reset';
            $attributes['value'] = $value;
            if (array_key_exists('class', $attributes)) {
                $attributes['class'] = 'btn '.$attributes['class'];
            } else {
                $attributes['class'] = 'btn';
            }
            return $this->markup->input($attributes);
        }

        /**
         * Create a generic select drop box.
         *
         * @param string $name
         * @param array $values
         * @param array $attributes Optional. 'selected' => $key for choosing which option is selected.
         * @return \PHY\Markup\Markup
         */
        public function selectbox($name = null, array $values = [], array $attributes = [])
        {
            if (!count($values)) {
                return;
            }
            if (!array_key_exists('name', $attributes)) {
                $attributes['name'] = $name;
            }
            if (array_key_exists('selected', $attributes)) {
                $selected = $attributes['selected'];
                unset($attributes['selected']);
            } else {
                $selected = false;
            }
            $select = $this->markup->select->attributes($attributes);
            foreach ($values as $key => $value) {
                if (is_array($value) && array_key_exists('content', $value)) {
                    if (is_array($value['content'])) {
                        $optgroup = $this->markup->optgroup;
                        foreach ($value['content'] as $k => $v) {
                            $option = $this->markup->option($v['content'], (
                                ('selected' === $k || $k === $selected)
                                    ? ['selected' => 'selected', 'value' => ((array_key_exists('value', $v))
                                        ? $v['value']
                                        : $v['content'])]
                                    : ['value' => ((array_key_exists('value', $v))
                                        ? $v['value']
                                        : $v['content'])]
                                )
                            );
                            $optgroup->append($option);
                        }
                        $select->append($optgroup);
                    } else {
                        $option = $this->markup->option($value, (
                            ('selected' === $key || $key === $selected)
                                ? ['selected' => 'selected', 'value' => ((array_key_exists('value', $value))
                                    ? $value['value']
                                    : $value['content'])]
                                : ['value' => ((array_key_exists('value', $value))
                                    ? $value['value']
                                    : $value['content'])]
                            )
                        );
                        $select->append($option);
                    }
                } else {
                    if (is_array($value)) {
                        $optgroup = $this->markup->optgroup;
                        foreach ($value as $k => $v) {
                            $option = $this->markup->option($v, (
                                ('selected' === $k || $k === $selected)
                                    ? ['selected' => 'selected', 'value' => $v]
                                    : ['value' => $v]
                                )
                            );
                            $optgroup->append($option);
                        }
                        $select->append($optgroup);
                    } else {
                        $option = $this->markup->option($value, (
                            ('selected' === $key || $key === $selected)
                                ? ['selected' => 'selected', 'value' => $key]
                                : ['value' => $key]
                            )
                        );
                        $select->append($option);
                    }
                }
            }
            return $select;
        }

        /**
         * Create a generic submit button.
         *
         * @param string $name
         * @param string $value
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function submit($name = null, $value = null, array $attributes = [])
        {
            if (is_array($value)) {
                $attributes = $value;
                $value = $name;
                $name = false;
            } else if (null === $value) {
                $value = $name;
                $name = false;
            }
            $attributes = $this->markup->attributes('input', $attributes);
            if ($name) {
                $attributes['name'] = $name;
            }
            $attributes['type'] = 'submit';
            $attributes['value'] = $value;
            if (array_key_exists('class', $attributes)) {
                $attributes['class'] = 'btn btn-primary '.$attributes['class'];
            } else {
                $attributes['class'] = 'btn btn-primary';
            }
            return $this->markup->input($attributes);
        }

        /**
         * Create a generic textbox. If size = 1 it will be an input box, any
         * larger and it becomes a textarea.
         *
         * @param string $name
         * @param int $size
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function textbox($name = null, $size = 1, array $attributes = [])
        {
            if (null === $name) {
                return;
            }
            $value = array_key_exists('value', $attributes)
                ? $attributes['value']
                : null;
            if (array_key_exists('hint', $attributes)) {
                if (!$value) {
                    if (array_key_exists('class', $attributes)) {
                        $attributes['class'] = $attributes['class'].' hint';
                    } else {
                        $attributes['class'] = 'hint';
                    }
                    $value = $attributes['hint'];
                }
            }
            $attributes = $this->markup->attributes((($size <= 1)
                ? 'input'
                : 'textarea'
            ), $attributes);
            $attributes['name'] = $name;
            if ($size <= 1) {
                if (null !== $value) {
                    $attributes['value'] = htmlentities($value, ENT_QUOTES, 'UTF-8', false);
                }
                $attributes['type'] = 'text';
                $input = $this->markup->input($attributes);
            } else {
                if (!array_key_exists('cols', $attributes)) {
                    $attributes['cols'] = 15;
                }
                if (!array_key_exists('rows', $attributes)) {
                    $attributes['rows'] = $size;
                }
                $input = $this->markup->textarea->attributes($attributes);
                if ($value !== null) {
                    $input->append(htmlentities($value, ENT_QUOTES, 'UTF-8', false));
                }
            }
            return $input;
        }

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
         * @return \PHY\Markup\Element
         */
        public function timestamp(\DateTime $date, $format = 'Y-m-d H:i:s', array $attributes = [])
        {
            $attributes = $this->markup->attributes($attributes);
            $attributes['datetime'] = $date->format('c');
            if (array_key_exists('label', $attributes)) {
                $label = $attributes['label'];
            } else {
                $label = $date->format($format);
            }
            return $this->markup->time($label, $attributes);
        }

        /**
         * Create a generic unordered list out of an array.
         *
         * @param array $content
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function unordered($content = null, array $attributes = [])
        {
            return $this->ordered($content, $attributes, 'ul');
        }

        /**
         * Create a generic anchor tag.
         *
         * @param mixed $content innerHTML of the anchor tag.
         * @param string|array $link array will create a ?key=value structure
         * while the first value in the array will be the link itself.
         * @param array $attributes Optional
         * @return \PHY\Markup\Element
         */
        public function url($content = null, $link = null, $attributes = null)
        {
            if (null === $content || null === $link) {
                return;
            }
            if (is_array($link)) {
                if (is_string(key($link))) {
                    $url = '/';
                } else {
                    $url = array_shift($link);
                }
                if (count($link)) {
                    $get = [];
                    if (array_key_exists('#', $link)) {
                        $hash = '#'.$link['#'];
                        unset($link['#']);
                    } else {
                        $hash = null;
                    }
                    foreach ($link as $key => $value) {
                        if ($value !== null) {
                            $get[] = $key.'='.$value;
                        }
                    }
                    $link = $url.'?'.implode('&', $get).$hash;
                } else {
                    $link = $url;
                }
            } else if (strpos($link, '@')) {
                $link = 'mailto:'.$link;
            }
            $attributes = $this->markup->attributes('a', $attributes);
            if (!array_key_exists('title', $attributes) && (is_string($content) || is_numeric($content))) {
                $attributes['title'] = $content;
            }

            if ('#!' === substr($link, 0, 2)) {
                $link = str_replace('#!', '', $link);
                if (!array_key_exists('class', $attributes)) {
                    $attributes['class'] = 'ajax';
                } else {
                    $attributes['class'] .= ' ajax';
                }
                if (!array_key_exists('data', $attributes) || !is_array($attributes['data'])) {
                    $attributes['data'] = ['shebang' => 1];
                } else {
                    $attributes['data']['shebang'] = 1;
                }
            }
            if (false !== strpos($link, 'javascript:') && !array_key_exists('onclick', $attributes)) {
                $attributes['href'] = 'javascript:void(0);';
                $attributes['onclick'] = str_replace('javascript:', '', $link);
            } else {
                $attributes['href'] = $link;
            }
            return $this->markup->a($content, $attributes);
        }

    }
