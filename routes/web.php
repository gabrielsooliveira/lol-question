<?php

foreach (glob(__DIR__ . '/web/*.php') as $routeFile) {
    require $routeFile;
}
