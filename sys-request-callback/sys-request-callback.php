<?php
	/*
	 * Plugin Name: SYS Request Callback for Payment
	 * Description: This plugin adds the option to request a callback regarding payment to the checkout.
	 * Version: 1.0.0
	 * Author: Sam Mckay
	 * Author URI: http://github.com/sammckay10
	*/

	/*
	 * Add WooCommerce Actions
	 * */
	add_action ( 'woocommerce_after_order_notes', 'request_callback_custom_field' );
	add_action ( 'woocommerce_checkout_update_user_meta', 'request_callback_custom_field_update_user_meta' );
	add_action ( 'woocommerce_checkout_update_order_meta', 'request_callback_custom_field_update_order_meta' );

	/*
	 * Add WooCommerce Filters
	 * */
	add_filter ( 'woocommerce_email_order_meta_keys', 'request_callback_custom_field_order_meta_keys' );

	/*
	 * Add field to checkout
	 * */
	function request_callback_custom_field ( $checkout )
	{
		echo '<div id="request_callback_custom_field">';

		/*
		 * Output the field
		 * */
		woocommerce_form_field (
			'request_callback', array (
			'type'        => 'checkbox',
			'required'    => false,
			'class'       => array ( 'wc__address__item' ),
			'label'       => __ ( 'Request call back regarding payment number' ),
			'placeholder' => __ ( '' ),
		), $checkout->get_value ( 'request_callback' )
		);
		echo '</div>';
	}

	/*
	 * Save the field value to user
	 * */
	function request_callback_custom_field_update_user_meta ( $user_id )
	{
		if ( $user_id && $_POST[ 'request_callback' ] )
		{
			update_user_meta ( $user_id, 'request_callback', esc_attr ( $_POST[ 'request_callback' ] ) );
		}
	}

	/*
	 * Save the field to order#
	 * */
	function request_callback_custom_field_update_order_meta ( $order_id )
	{
		if ( $_POST[ 'request_callback' ] )
		{
			update_post_meta ( $order_id, 'Request call back regarding payment', esc_attr ( $_POST[ 'request_callback' ] ) );
		}
	}

	/*
	 * Add the field to order emails
	 * */
	function request_callback_custom_field_order_meta_keys ( $keys )
	{
		if ( $_POST[ 'request_callback' ] )
		{
			echo '<table class="td" style="font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif; border-right: #e5e5e5 1px solid; width: 100%; border-bottom: #e5e5e5 1px solid; color: #616161; border-left: #e5e5e5 1px solid" cellSpacing="0" cellPadding="6" border="1">
			<tr>
				<th class="td" style="border-top: #e5e5e5 1px solid; border-right: #e5e5e5 1px solid; border-bottom: #e5e5e5 1px solid; color: #616161; padding-bottom: 12px; text-align: left; padding-top: 12px; padding-left: 12px; border-left: #e5e5e5 1px solid; padding-right: 12px" colSpan="2" scope="row" >Requested Call Back:</th >
				<td class="td" style="border-top: #e5e5e5 1px solid; border-right: #e5e5e5 1px solid; border-bottom: #e5e5e5 1px solid; color: #616161; padding-bottom: 12px; text-align: left; padding-top: 12px; padding-left: 12px; border-left: #e5e5e5 1px solid; padding-right: 12px" >Yes</td>
			</tr>
			</table>
			';
		}
	}