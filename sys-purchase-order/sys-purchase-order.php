<?php
	/*
	 * Plugin Name: SYS Purchase Order
	 * Description: This plugin adds a purchase order option to the checkout
	 * Version: 1.0.0
	 * Author: Sam Mckay
	 * Author URI: http://github.com/sammckay10
	*/

	/*
	 * Add WooCommerce Actions
	 * */
	add_action ( 'woocommerce_after_order_notes', 'purchase_order_custom_field' );
	add_action ( 'woocommerce_checkout_update_user_meta', 'purchase_order_custom_field_update_user_meta' );
	add_action ( 'woocommerce_checkout_update_order_meta', 'purchase_order_custom_field_update_order_meta' );

	/*
	 * Add WooCommerce Filters
	 * */
	add_filter ( 'woocommerce_email_order_meta_keys', 'purchase_order_custom_field_order_meta_keys' );

	/*
	 * Add P.O field to checkout
	 * */
	function purchase_order_custom_field ( $checkout )
	{
		echo '<div id="purchase_order_custom_field">';

		/*
		 * Output the P.O field
		 * */
		woocommerce_form_field (
			'purchase_order', array (
			'type'        => 'text',
			'required'    => false,
			'class'       => array ( 'wc__address__item' ),
			'label'       => __ ( 'Purchase Order Number' ),
			'placeholder' => __ ( 'P.O' ),
		), $checkout->get_value ( 'purchase_order' )
		);
		echo '</div>';
	}

	/*
	 * Save P.O value to user
	 * */
	function purchase_order_custom_field_update_user_meta ( $user_id )
	{
		if ( $user_id && $_POST[ 'purchase_order' ] )
		{
			update_user_meta ( $user_id, 'purchase_order', esc_attr ( $_POST[ 'purchase_order' ] ) );
		}
	}

	/*
	 * Save P.O to order#
	 * */
	function purchase_order_custom_field_update_order_meta ( $order_id )
	{
		if ( $_POST[ 'purchase_order' ] )
		{
			update_post_meta ( $order_id, 'Purchase Order', esc_attr ( $_POST[ 'purchase_order' ] ) );
		}
	}

	/*
	 * Add P.O to order emails
	 * */
	function purchase_order_custom_field_order_meta_keys ( $keys )
	{
		if ( $_POST[ 'purchase_order' ] )
		{
			echo '<table class="td" style="font-family: \'Helvetica Neue\', Helvetica, Roboto, Arial, sans-serif; border-right: #e5e5e5 1px solid; width: 100%; border-bottom: #e5e5e5 1px solid; color: #616161; border-left: #e5e5e5 1px solid" cellSpacing="0" cellPadding="6" border="1">
			<tr>
				<th class="td" style="border-top: #e5e5e5 1px solid; border-right: #e5e5e5 1px solid; border-bottom: #e5e5e5 1px solid; color: #616161; padding-bottom: 12px; text-align: left; padding-top: 12px; padding-left: 12px; border-left: #e5e5e5 1px solid; padding-right: 12px" colSpan="2" scope="row" >Purchase Order:</th >
				<td class="td" style="border-top: #e5e5e5 1px solid; border-right: #e5e5e5 1px solid; border-bottom: #e5e5e5 1px solid; color: #616161; padding-bottom: 12px; text-align: left; padding-top: 12px; padding-left: 12px; border-left: #e5e5e5 1px solid; padding-right: 12px" >' . $_POST[ 'purchase_order' ] . '</td>
			</tr>
			</table>
			';
		}
	}