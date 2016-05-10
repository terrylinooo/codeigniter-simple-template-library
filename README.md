
# Simple Template Library for Codeigniter

The simplest template libary for Codeigniter ever. The code is easy to understand and modify it for your needs.

### Installation

Download library.php to your library folder.

```php
$this->load->library(array('layout'));
$this->layout->add_css_files(array('bootstrap.min.css','style.css'), base_url().'assets/css/');
```

### Examples

```php
$this->layout->add_css_files(array('bootstrap.min.css','style.css'), base_url().'assets/css/');
```

```php
$css_text = <<<EOF

.text {
	font-size: 12px;
	background-color: #eeeeee;
}
EOF;
		$this->layout->add_css_rawtext($css_text);
		
	}
```

###API

add_meta($name, $value, $type = 'meta')
add_css_file($tag_css, $path = '')
add_css_files($tag_css = array(), $path = '')
add_css_rawtext($content)
add_js_file($tag_js, $path = '', $position = 'header')
add_js_files($tag_js = array(), $path = '', $position = 'header')
add_js_rawtext($content, $position = 'header')
