<?php
	/*
	 * Plugin Name: SYS Standard Shipping
	 * Description: This plugin adds a standard shipping option to WooCommerce
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
		 * SYS Standard Shipping Option
		 * */
		function init_sys_standard_shipping ()
		{
			if ( !class_exists ( 'SYS_Standard_Shipping' ) )
			{
				class SYS_Standard_Shipping extends WC_Shipping_Method
				{

					/**
					 * Constructor for your shipping class
					 *
					 * @access public
					 * @return void
					 */
					public function __construct ()
					{
						$this->id                 = 'sys_standard_shipping'; // Id for your shipping method. Should be uunique.
						$this->method_title       = __ ( 'SYS Standard Shipping' );  // Title shown in admin
						$this->method_description = __ ( '3-5 days standard delivery.' ); // Description shown in admin

						$this->enabled = "yes"; // This can be added as an setting but for this example its forced enabled
						$this->title   = "SYS Standard Shipping"; // This can be added as an setting but for this example its forced.

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
							'label'    => "Standard shipping (3-5 days)",
							'cost'     => '30.00',
							'calc_tax' => 'per_item'
						);

						// Register the rate
						$this->add_rate ( $rate );
					}
				}
			}
		}

		function add_sys_standard_shipping ( $methods )
		{
			$methods[] = 'SYS_Standard_Shipping';

			return $methods;
		}

		add_action ( 'woocommerce_shipping_init', 'init_sys_standard_shipping' );
		add_filter ( 'woocommerce_shipping_methods', 'add_sys_standard_shipping' );
	}
	
	
