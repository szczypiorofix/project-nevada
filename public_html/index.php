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
 * @param true - run maintenance page, false - run in default mode
 */
\Core\AppCore::start(true);
