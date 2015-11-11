<?php

/**
 * form_email_from hook for Contao Open Source CMS
 *
 * Copyright (C) 2015 Fritz Michael Gschwantner
 *
 * @package form_email_from hook
 * @author  Fritz Michael Gschwantner <https://github.com/fritzmg>
 */


class FormEmailFrom extends \Controller
{
	public function prepareFormData( $arrSubmitted, $arrLabels, \Form $objForm, $arrFields )
	{
		// if form is not sent via email, do nothing
		if( !$objForm->sendViaEmail )
			return;

		// check if there is a form field which we use as the from address
		if( ( $objField = \FormFieldModel::findBy( array("pid = ?", "useFrom = '1'"), array( $objForm->id ) ) ) === null )
			return;

		// check if there is submitted data for the form field
		if( !isset( $arrSubmitted[ $objField->name ] ) )
			return;

		// get the email adress
		$email = $arrSubmitted[ $objField->name ];

		// check if submitted data is actually an email address
		if( !\Validator::isEmail( $email ) )
			return;

		// set the return address
		$GLOBALS['TL_ADMIN_EMAIL_ORIGINAL'] = $GLOBALS['TL_ADMIN_EMAIL'];
		$GLOBALS['TL_ADMIN_EMAIL'] = $email;

		// optionally check also for firstname and lastname
		$firstname = '';
		$lastname = '';

		foreach( $arrSubmitted as $name => $value )
		{
			if( in_array( strtolower( $name ), $GLOBALS['FORMEMAILFROM']['firstname'] ) )
				$firstname = $value;
			if( in_array( strtolower( $name ), $GLOBALS['FORMEMAILFROM']['lastname'] ) )
				$lastname = $value;
		}

		if( $firstname || $lastname )
		{
			$GLOBALS['TL_ADMIN_NAME_ORIGINAL'] = $GLOBALS['TL_ADMIN_NAME'];
			if( $firstname && $lastname )
				$GLOBALS['TL_ADMIN_NAME'] = $firstname.' '.$lastname;
			else
				$GLOBALS['TL_ADMIN_NAME'] = $firstname ?: $lastname; 
		}
	}

	public function processFormData( $arrSubmitted, $arrData, $arrFiles, $arrLabels, \Form $objForm )
	{
		if( isset( $GLOBALS['TL_ADMIN_NAME_ORIGINAL'] ) )
		{
			$GLOBALS['TL_ADMIN_NAME'] = $GLOBALS['TL_ADMIN_NAME_ORIGINAL'];
			unset( $GLOBALS['TL_ADMIN_NAME_ORIGINAL'] );
		}
		if( isset( $GLOBALS['TL_ADMIN_EMAIL_ORIGINAL'] ) )
		{
			$GLOBALS['TL_ADMIN_EMAIL'] = $GLOBALS['TL_ADMIN_EMAIL_ORIGINAL'];
			unset( $GLOBALS['TL_ADMIN_EMAIL_ORIGINAL'] );
		}
	}
}
