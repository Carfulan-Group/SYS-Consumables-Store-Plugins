<?php
	/*
	 * Plugin Name: SYS Express Shipping
	 * Description: This plugin adds an express shipping option to WooCommerce
	 * Version: 1.0.0
	 * Author: Sam Mckay
	 * Author URI: http://github.com/sammckay10
	*/

	/**
	 * Check if WooCommerce is active
	 */
	if ( in_array ( 'woocommerce/woocommerce.php', apply_filters ( 'active_plugins', get_option ( 'active_plugins' ) ) ) )
	{

		/*
		 * SYS Express Shipping Option
		 **/
		function init_sys_express_shipping ()
		{
			if ( !class_exists ( 'SYS_Express_Shipping' ) )
			{
				class SYS_Express_Shipping extends WC_Shipping_Method
				{

					/**
					 * Constructor for your shipping class
					 *
					 * @access public
					 * @return void
					 */
					public function __construct ()
					{
						$this->id                 = 'sys_express_shipping'; // Id for your shipping method. Should be uunique.
						$this->method_title       = __ ( 'SYS Express Shipping' );  // Title shown in admin
						$this->method_description = __ ( '1-2 days express delivery.' ); // Description shown in admin

						$this->enabled = "yes"; // This can be added as an setting but for this example its forced enabled
						$this->title   = "SYS Express Shipping"; // This can be added as an setting but for this example its forced.

						$this->init ();
					}

					/**
					 * Init your settings
					 *
					 * @access public
					 * @return void
					 */
					function init ()
					{
						// Load the settings API
						$this->init_form_fields (); // This is part of the settings API. Override the method to add your own settings
						$this->init_settings (); // This is part of the settings API. Loads settings you previously init.

						// Save settings in admin if you have any defined
						add_action ( 'woocommerce_update_options_shipping_' . $this->id, array ( $this, 'process_admin_options' ) );
					}

					/**
					 * calculate_shipping function.
					 *
					 * @access public
					 * @param mixed $package
					 * @return void
					 */
					public function calculate_shipping ( $package )
					{
						$rate = array (
							'id'       => $this->id,
							'label'    => 'Express shipping (1-2 days)',
							'cost'     => '45.00',
							'calc_tax' => 'per_item'
						);

						// Register the rate
						$this->add_rate ( $rate );
					}
				}
			}
		}

		function add_sys_express_shipping ( $methods )
		{
			$methods[] = 'SYS_Express_Shipping';

			return $methods;
		}

		add_action ( 'woocommerce_shipping_init', 'init_sys_express_shipping' );
		add_filter ( 'woocommerce_shipping_methods', 'add_sys_express_shipping' );
	}
	
	
