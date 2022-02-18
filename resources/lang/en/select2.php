<?php

return [
    'errorLoading' => 'return "The results could not be loaded.";',
    'inputTooLong' => 'var n = e.input.length - e.maximum,r = "Please delete " + n + " character";return 1 != n && (r += "s"), r;',
    'inputTooShort' => 'return "Please enter " + (e.minimum - e.input.length) + " or more characters";',
    'loadingMore' => 'return "Loading more results…";',
    'maximumSelected' => 'var n = "You can only select " + e.maximum + " item";return 1 != e.maximum && (n += "s"), n;',
    'noResults' => 'return "No results found";',
    'searching' => 'return "Searching…";',
    'removeAllItems' => 'return "Remove all items";'
];