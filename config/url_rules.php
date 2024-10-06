<?php

return [
    'editor' =>  'editor/index',
    'api/<controlApiModule:[a-zA-Z\-]+>/<controlApiEndpoint:[a-zA-Z\-]+>/<controlApiOperation:[a-zA-Z\-]+>' => 'control/api/index',
    'api/<controlApiModule:[a-zA-Z\-]+>/<controlApiEndpoint:[a-zA-Z\-]+>' => 'control/api/index',
];