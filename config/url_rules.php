<?php

return [
    'editor' =>  'editor/index',
    'api/<controlApiModule:\w+>/<controlApiEndpoint:\w+>/<controlApiOperation:\w+>' => 'control/api/index',
    'api/<controlApiModule:\w+>/<controlApiEndpoint:\w+>' => 'control/api/index',
];