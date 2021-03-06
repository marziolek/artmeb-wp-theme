<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'WC_Email_Customer_Invoice', false ) ) :

/**
 * Customer Invoice.
 *
 * An email sent to the customer via admin.
 *
 * @class       WC_Email_Customer_Invoice
 * @version     2.3.0
 * @package     WooCommerce/Classes/Emails
 * @author      WooThemes
 * @extends     WC_Email
 */
class WC_Email_Customer_Invoice extends WC_Email {

	/**
	 * Strings to find in subjects/headings.
	 *
	 * @var array
	 */
	public $find;

	/**
	 * Strings to replace in subjects/headings.
	 *
	 * @var array
	 */
	public $replace;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$this->id             = 'customer_invoice';
		$this->customer_email = true;

		$this->title          = _e( 'Customer invoice', 'woocommerce' );
		$this->description    = _e( 'Customer invoice emails can be sent to customers containing their order information and payment links.', 'woocommerce' );
		$this->template_html  = 'emails/customer-invoice.php';
		$this->template_plain = 'emails/plain/customer-invoice.php';

		// Call parent constructor
		parent::__construct();

		$this->manual         = true;
	}

	/**
	 * Get email subject.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_subject( $paid = false ) {
		if ( $paid ) {
			return _e( 'Your {site_title} order from {order_date}', 'woocommerce' );
		} else {
			return _e( 'Invoice for order {order_number} from {order_date}', 'woocommerce' );
		}
	}

	/**
	 * Get email heading.
	 *
	 * @since  3.1.0
	 * @return string
	 */
	public function get_default_heading( $paid = false ) {
		if ( $paid ) {
			return _e( 'Order {order_number} details', 'woocommerce' );
		} else {
			return _e( 'Invoice for order {order_number}', 'woocommerce' );
		}
	}

	/**
	 * Get email subject.
	 *
	 * @access public
	 * @return string
	 */
	public function get_subject() {
		if ( $this->object->has_status( array( 'completed', 'processing' ) ) ) {
			$subject = $this->get_option( 'subject_paid', $this->get_default_subject( true ) );
			$action  = 'woocommerce_email_subject_customer_invoice_paid';
		} else {
			$subject = $this->get_option( 'subject', $this->get_default_subject() );
			$action  = 'woocommerce_email_subject_customer_invoice';
		}
		return apply_filters( $action, $this->format_string( $subject ), $this->object );
	}

	/**
	 * Get email heading.
	 *
	 * @access public
	 * @return string
	 */
	public function get_heading() {
		if ( $this->object->has_status( wc_get_is_paid_statuses() ) ) {
			$heading = $this->get_option( 'heading_paid', $this->get_default_heading( true ) );
			$action  = 'woocommerce_email_heading_customer_invoice_paid';
		} else {
			$heading = $this->get_option( 'heading', $this->get_default_heading() );
			$action  = 'woocommerce_email_heading_customer_invoice';
		}
		return apply_filters( $action, $this->format_string( $heading ), $this->object );
	}

	/**
	 * Trigger the sending of this email.
	 *
	 * @param int $order_id The order ID.
	 * @param WC_Order $order Order object.
	 */
	public function trigger( $order_id, $order = false ) {
		if ( $order_id && ! is_a( $order, 'WC_Order' ) ) {
			$order = wc_get_order( $order_id );
		}

		if ( is_a( $order, 'WC_Order' ) ) {
			$this->object                  = $order;
			$this->recipient               = $this->object->get_billing_email();

			$this->find['order-date']      = '{order_date}';
			$this->find['order-number']    = '{order_number}';

			$this->replace['order-date']   = wc_format_datetime( $this->object->get_date_created() );
			$this->replace['order-number'] = $this->object->get_order_number();
		}

		if ( ! $this->get_recipient() ) {
			return;
		}

		$this->setup_locale();
		$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
		$this->restore_locale();
	}

	/**
	 * Get content html.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_html() {
		return wc_get_template_html( $this->template_html, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => false,
			'email'			=> $this,
		) );
	}

	/**
	 * Get content plain.
	 *
	 * @access public
	 * @return string
	 */
	public function get_content_plain() {
		return wc_get_template_html( $this->template_plain, array(
			'order'         => $this->object,
			'email_heading' => $this->get_heading(),
			'sent_to_admin' => false,
			'plain_text'    => true,
			'email'			=> $this,
		) );
	}

	/**
	 * Initialise settings form fields.
	 */
	public function init_form_fields() {
		$this->form_fields = array(
			'subject' => array(
				'title'         => __( 'Subject', 'woocommerce' ),
				'type'          => 'text',
				'desc_tip'      => true,
				/* translators: %s: list of placeholders */
				'description'   => sprintf( _e( 'Available placeholders: %s', 'woocommerce' ), '<code>{site_title}, {order_date}, {order_number}</code>' ),
				'placeholder'   => $this->get_default_subject(),
				'default'       => '',
			),
			'heading' => array(
				'title'         => __( 'Email heading', 'woocommerce' ),
				'type'          => 'text',
				'desc_tip'      => true,
				/* translators: %s: list of placeholders */
				'description'   => sprintf( _e( 'Available placeholders: %s', 'woocommerce' ), '<code>{site_title}, {order_date}, {order_number}</code>' ),
				'placeholder'   => $this->get_default_heading(),
				'default'       => '',
			),
			'subject_paid' => array(
				'title'         => __( 'Subject (paid)', 'woocommerce' ),
				'type'          => 'text',
				'desc_tip'      => true,
				/* translators: %s: list of placeholders */
				'description'   => sprintf( _e( 'Available placeholders: %s', 'woocommerce' ), '<code>{site_title}, {order_date}, {order_number}</code>' ),
				'placeholder'   => $this->get_default_subject( true ),
				'default'       => '',
			),
			'heading_paid' => array(
				'title'         => __( 'Email heading (paid)', 'woocommerce' ),
				'type'          => 'text',
				'desc_tip'      => true,
				/* translators: %s: list of placeholders */
				'description'   => sprintf( _e( 'Available placeholders: %s', 'woocommerce' ), '<code>{site_title}, {order_date}, {order_number}</code>' ),
				'placeholder'   => $this->get_default_heading( true ),
				'default'       => '',
			),
			'email_type' => array(
				'title'         => __( 'Email type', 'woocommerce' ),
				'type'          => 'select',
				'description'   => __( 'Choose which format of email to send.', 'woocommerce' ),
				'default'       => 'html',
				'class'         => 'email_type wc-enhanced-select',
				'options'       => $this->get_email_type_options(),
				'desc_tip'      => true,
			),
		);
	}
}

endif;

return new WC_Email_Customer_Invoice();
