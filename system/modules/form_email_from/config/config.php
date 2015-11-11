<?php

/**
 * form_email_from hook for Contao Open Source CMS
 *
 * Copyright (C) 2015 Fritz Michael Gschwantner
 *
 * @package form_email_from hook
 * @author  Fritz Michael Gschwantner <https://github.com/fritzmg>
 */


$GLOBALS['FORMEMAILFROM']['firstname'] = array(
	'firstname',
	'vorname'
);

$GLOBALS['FORMEMAILFROM']['lastname'] = array(
	'lastname',
	'nachname'
);

$GLOBALS['TL_HOOKS']['prepareFormData'][] = array( 'FormEmailFrom', 'prepareFormData' );
$GLOBALS['TL_HOOKS']['processFormData'][] = array( 'FormEmailFrom', 'processFormData' );
