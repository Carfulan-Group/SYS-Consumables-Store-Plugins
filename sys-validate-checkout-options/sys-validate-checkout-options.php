<?php
	/*
	 * Plugin Name: SYS Validate Checkout Options
	 * Description: This plugin checks that either the "Purchase Order" field or "Request a Call Back" field are complete before submitting the checkout form.
	 * Version: 1.0.0
	 * Author: Sam Mckay
	 * Author URI: http://github.com/sammckay10
	*/

	add_action ( 'woocommerce_checkout_process', 'validate_custom_checkout_fields' );

	/*
	 * Process the checkout
	 * */
	function validate_custom_checkout_fields ()
	{
		global $woocommerce;
		if ( !$_POST[ 'purchase_order' ] AND !$_POST[ 'request_callback' ] )
		{
			wc_add_notice ( sprintf ( __ ( "Please enter a purchase order number or request a call back regarding payment.", "English" ) ), 'error' );
		}
	}