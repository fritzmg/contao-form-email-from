<?php

/**
 * form_email_from hook for Contao Open Source CMS
 *
 * Copyright (C) 2015 Fritz Michael Gschwantner
 *
 * @package form_email_from hook
 * @author  Fritz Michael Gschwantner <https://github.com/fritzmg>
 */


$GLOBALS['TL_DCA']['tl_form_field']['fields']['useFrom'] = array
(
	'label'     => &$GLOBALS['TL_LANG']['tl_form_field']['useFrom'],
	'exclude'   => true,
	'inputType' => 'checkbox',
	'eval'      => array( 'tl_class' => 'w50' ),
	'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form_field']['fields']['mandatory']['eval']['tl_class'] = 'w50';

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['text'] = str_replace( 'mandatory', 'mandatory,useFrom', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['text'] );
