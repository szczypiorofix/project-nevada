<?php

require_once '../App/Core/Autoloader.php';
\Core\AutoLoader::run(false);

\Core\Environment::set();
\Core\AppCore::start();
