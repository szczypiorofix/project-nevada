<?php
/*
 * #############################################################################
 * ============== ALL THE PRETTY STUFF STARTS FROM HERE :) =====================
 * #############################################################################
 * 
 * MIT License
 * 
 * Copyright (c) 2018 Piotr Wróblewski
 * 
 */


/*
 * Load AutoLoader class.
 */
require_once '../App/Core/Autoloader.php';
/*
 * Run the AutoLoader class.
 */
\Core\AutoLoader::run(false);

/*
 * Set required environmental variables and constants.
 */
\Core\Environment::set();

/*
 * Start core application.
 */
\Core\AppCore::start();
