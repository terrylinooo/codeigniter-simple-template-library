<?php
/**
 * @name        CodeIgniter Simple Template Library
 * @author      Terry Lin
 * @link        http://www.pcdiy.com
 * @license     MIT License Copyright (c) 2016 Terry Lin
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Layout
{

    private $tag_meta          = '';
    private $tag_css           = '';
    private $tag_header_js     = '';
    private $tag_footer_js     = '';
    
    private $rawtext_css       = '';
    private $rawtext_header_js = '';
    private $rawtext_footer_js = '';

    public $pre_space          = "    ";
    public $title              = '';
    public $body_attribute     = '';

    public $meta_default = array(
        'author'      => '',
        'viewport'    => 'width=device-width, initial-scale=1.0',
        'keywords'    => '',
        'description' => '',
        'canonical'   => '',
        'robots'      => ''
    );

    public $meta_twitter = array(
        'url'         => '',
        'site'        => '',
        'creator'     => '',
        'card'        => '', // summary_large_image
        'title'       => '',
        'description' => '',
        'image_src'   => ''
    );

    public $meta_facebook = array(
        'site_name'   => '',
        'url'         => '',
        'title'       => '',
        'type'        => '',
        'description' => '',
        'image'       => '',
        'admins'      => '',
        'app_id'      => ''
    );

    public static $instance;

    public function __construct()
    {
        self::$instance = null;
    }

    /**
     * Instance()
     * Singleton pattern
     * The instance is made for easy use the function call.
     */

    public static function instance()
    {
        if (!self::$instance) {
            self::$instance = new layout();
        }
        return self::$instance;
    }
    /**
     * Add a meta tag
     *
     * @param string $name
     * @param string $value
     * @param string $type
     */

    public function add_meta($name, $value, $type = 'meta')
    {
        switch ($type) {
            case 'meta':
                self::instance()->tag_meta .= self::instance()->pre_space . '<meta name="' . $name . '" content="' . $value . '" />' . "\n";
                break;
            case 'link':
                self::instance()->tag_meta .= self::instance()->pre_space . '<link rel="' . $name . '" href="' . $value . '" />' . "\n";
                break;
        }
    }

    /**
     * Add a custom meta tag
     *
     * @param string $type
     * @param array $attribute
     */

    public function add_custom_meta($type, $attribute = array())
    {
        $attr_array = array();

        foreach ($attribute as $key => $value) {
            $attr_array[] = $key . '="' . $value . '"';
        }
        $attr_string = implode(' ', $attr_array);

        self::instance()->tag_meta .= self::instance()->pre_space . '<' . $type . ' ' . $attr_string . ' />' . "\n";
    }

    /**
     * Add single css file
     *
     * @param string $tag_css
     */

    public function add_css_file($tag_css, $path = '')
    {
        if (!empty($path)) {
            $path = rtrim($path, '/') . '/';
        }
        self::instance()->tag_css .= self::instance()->pre_space . '<link rel="stylesheet" href="' . $path . $tag_css . '" />' . "\n";
    }

    /**
     * Add multiple css files at once
     *
     * @param array $tag_css
     */

    public function add_css_files($tag_css = array(), $path = '')
    {
        if (!empty($path)) {
            $path = rtrim($path, '/') . '/';
        }
        if (is_array($tag_css)) {
            foreach ($tag_css as $value) {
                self::instance()->tag_css .= self::instance()->pre_space . '<link href="' . $path . $value . '" rel="stylesheet" />' . "\n";
            }
        }
    }

    /**
     * Add raw text to css section in header
     *
     * @param string $content
     */

    public function add_css_rawtext($content)
    {
        self::instance()->rawtext_css .= "\n" . $content . "\n";
    }
    /**
     * Add single js file
     *
     * @param string $tag_js
     * @param string $path
     * @param string $position
     * @param string $attr - default: null [ async, defer ]
     */

    public function add_js_file($tag_js, $path = '', $position = 'header', $attr = '')
    {
        $attr = ' ' . $attr;
        if (!empty($path)) {
            $path = rtrim($path, '/') . '/';
        }
        switch ($position) {
            case 'header':
                self::instance()->tag_header_js .= self::instance()->pre_space . '<script src="' . $path . $tag_js . '"' . $attr . '></script>' . "\n";
                break;
            case 'footer':
                self::instance()->tag_footer_js .= self::instance()->pre_space . '<script src="' . $path . $tag_js . '"' . $attr . '></script>' . "\n";
                break;
        }
    }

    /**
     * Add multiple js files at once
     *
     * @param string $tag_js
     * @param string $path
     * @param string $position
     * @param string $attr - default: null [ async, defer ]
     */

    public function add_js_files($tag_js = array(), $path = '', $position = 'header', $attr = '')
    {
        $attr = ' ' . $attr;
        if (!empty($path)) {
            $path = rtrim($path, '/') . '/';
        }
        if (is_array($tag_js)) {
            switch ($position) {
                case 'header':
                    foreach ($tag_js as $value) {
                        self::instance()->tag_header_js .= self::instance()->pre_space . '<script src="' . $path . $value . '"' . $attr . '></script>' . "\n";
                    }
                    break;
                case 'footer':
                    foreach ($tag_js as $value) {
                        self::instance()->tag_footer_js .= self::instance()->pre_space . '<script src="' . $path . $value . '"' . $attr . '></script>' . "\n";
                    }
                    break;
            }
        }
    }

    /**
     * Add raw text to javascript section
     *
     * @param string $tag_js
     * @param string $path
     * @param string $position
     */

    public function add_js_rawtext($content, $position = 'header')
    {
        switch ($position) {
            case 'header':
                self::instance()->rawtext_header_js .= "\n" . $content . "\n";
                break;
            case 'footer':
                self::instance()->rawtext_footer_js .= "\n" . $content . "\n";
                break;
        }
    }

    /**
     * Output default title to prevent "Undefined variable" error
     *
     * @return string
     */

    public function get_title()
    {
        return self::instance()->title;
    }
    
    /**
     * Set values to the Built-in meta tags
     *
     * @param string $key
     * @param string $value
     * @param string $type
     */

    public function set_meta($key, $value, $type = 'default')
    {
        if ($type != 'default' and $type != 'facebook' and $type != 'twitter') {
            return false;
        }
        $key_name = "meta_{$type}";
        self::instance()->{$key_name}[$key] = $value;
    }
    /**
     * Set title
     *
     * @param string $type
     * @param array $attribute
     */

    public function set_title($title)
    {
        self::instance()->title = $title;

        return self::instance()->title;
    }

    /**
     * Output data in head
     *
     * @return string
     */

    public function get_header()
    {
        self::instance()->meta_default();
        self::instance()->meta_twitter();
        self::instance()->meta_facebook();

        $_header = self::instance()->tag_meta . self::instance()->tag_css . self::instance()->tag_header_js;

        if (!empty(self::instance()->rawtext_header_js)) {
            $_header .= '<script>' . "\n";
            $_header .= self::instance()->rawtext_header_js . "\n";
            $_header .= '</script>' . "\n";
        }

        if (!empty(self::instance()->rawtext_css)) {
            $_header .= '<style>' . "\n";
            $_header .= self::instance()->rawtext_css . "\n";
            $_header .= '</style>' . "\n";
        }

        return $_header;
    }

    /**
     * Output data in footer
     *
     * @return string
     */

    public function get_footer()
    {
        $_footer = self::instance()->tag_footer_js;

        if (!empty(self::instance()->rawtext_footer_js)) {
            $_footer .= '<script>' . "\n";
            $_footer .= self::instance()->rawtext_footer_js . "\n";
            $_footer .= '</script>' . "\n";
        }

        return $_footer;
    }


    /**
     * Get attributes from HTML body tag
     *
     * @return string
     */

    public function get_body_attr()
    {
        return self::instance()->body_attribute;
    }


    /**
     * Set attributes to HTML body tag
     *
     * @param string $type
     * @param array $attribute
     */

    public function set_body_attr($attribute = array())
    {
        $attr_array = array();

        foreach ($attribute as $key => $value) {
            $attr_array[] = $key . '="' . $value . '"';
        }
        $attr_string = implode(' ', $attr_array);

        self::instance()->body_attribute .= $attr_string;
    }

    /****************************************************************
     * Private functions                                            *
     ****************************************************************/

    private function meta_default()
    {
        foreach (self::instance()->meta_default as $key => $value) {
            if ($value != '') {
                if ($key == 'canonical') {
                    self::instance()->tag_meta .= self::instance()->pre_space . '<link rel="' . $key . '" href="' . $value . '" />' . "\n";
                } else {
                    self::instance()->tag_meta .= self::instance()->pre_space . '<meta name="' . $key . '" content="' . $value . '" />' . "\n";
                }
            }
        }
    }

    private function meta_twitter()
    {
        foreach (self::instance()->meta_twitter as $key => $value) {
            if ($value != '') {
                if ($key == 'image_src') {
                    $key = 'image:src';
                }

                self::instance()->tag_meta .= self::instance()->pre_space . '<meta name="twitter:' . $key . '" content="' . $value . '" />' . "\n";
            }
        }
    }

    private function meta_facebook()
    {
        foreach (self::instance()->meta_facebook as $key => $value) {
            if ($value != '') {
                if ($key == 'admins' or $key == 'app_id') {
                    $property = 'fb';
                } else {
                    $property = 'og';
                }

                self::instance()->tag_meta .= self::instance()->pre_space . '<meta property="' . $property . ':' . $key . '" content="' . $value . '" />' . "\n";
            }
        }
    }

}
function CI_title()
{
    return layout::instance()->get_title();
}

function CI_head()
{
    return layout::instance()->get_header();
}

function CI_footer()
{
    return layout::instance()->get_footer();
}

function CI_body_attr()
{
    if (!empty(layout::instance()->get_body_attr())) {
        return ' ' . layout::instance()->get_body_attr();
    }
}
