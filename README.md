# word-count

PHP port of [sylae/word-count](https://github.com/sylae/word-count). This *should* provide an accurate wordcount taking
into account apostrophes and hyphens and stuff. See iarna's project for disclaimers on what languages this method may
not work well with.

## Usage

`composer require uffe-code/word-count`

```php
<?php

use UffeCode\Wordcount;

$string = "This string has five words!";

$count = Wordcount::count($string); // int(5)
```

## Contributing

1. PSR-4.
2. Write tests.
3. Create a PR.

## License

MIT
