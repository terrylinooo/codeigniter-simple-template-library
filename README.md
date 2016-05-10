
# Simple Template Library for Codeigniter

The simplest template libary for Codeigniter ever. The code is easy to understand and modify it for your needs.

### Installation

Download library.php to your library folder.

```php
$this->load->library(array('layout'));
```

### API Examples


####add_meta
add_meta($name, $value, $type = 'meta')

####add_css_file
add_css_file($tag_css, $path = '')

####add_css_files
add_css_files($tag_css = array(), $path = '')

```php
$this->layout->add_css_files(array('bootstrap.min.css','style.css'), base_url().'assets/css/');
```
Output
```html
    <link href="http://dictpedia.org/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="http://dictpedia.org/assets/css/style.css" rel="stylesheet" />
```

####add_css_rawtext
add_css_rawtext($content)

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

####add_js_file
add_js_file($tag_js, $path = '', $position = 'header')

####add_js_files
add_js_files($tag_js = array(), $path = '', $position = 'header')

####add_js_rawtext
add_js_rawtext($content, $position = 'header')

```php
$js_text = <<<EOF
alert('this is just a test');
EOF;
	$this->layout->add_js_rawtext($js_text, 'header');
		
}
```
