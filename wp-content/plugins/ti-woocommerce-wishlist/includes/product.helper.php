<?php
/**
 * Product function class
 *
 * @since             1.0.0
 * @package           TInvWishlist\Products
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Product function class
 */
class TInvWL_Product {

	/**
	 * Table name
	 *
	 * @var string
	 */
	private $table;
	/**
	 * Plugin name
	 *
	 * @var string
	 */
	private $_n;
	/**
	 * Wishlist object
	 *
	 * @var array
	 */
	public $wishlist;
	/**
	 * User id
	 *
	 * @var integer
	 */
	public $user;

	/**
	 * Constructor
	 *
	 * @global wpdb $wpdb
	 * @param array  $wishlist Object wishlist.
	 * @param string $plugin_name Plugin name.
	 */
	function __construct( $wishlist = array(), $plugin_name = TINVWL_PREFIX ) {
		global $wpdb;

		$this->wishlist	 = (array) $wishlist;
		$this->_n		 = $plugin_name;
		$this->table	 = sprintf( '%s%s_%s', $wpdb->prefix, $this->_n, 'items' );
		$user			 = wp_get_current_user();
		if ( $user->exists() ) {
			$this->user = $user->ID;
		} else {
			$this->user = $this->wishlist_author();
		}
	}

	/**
	 * Get wishlist id
	 *
	 * @return int
	 */
	function wishlist_id() {
		if ( is_array( $this->wishlist ) && array_key_exists( 'ID', $this->wishlist ) ) {
			return $this->wishlist['ID'];
		}
		return 0;
	}

	/**
	 * Get author wishlist
	 *
	 * @return int
	 */
	function wishlist_author() {
		if ( is_array( $this->wishlist ) && array_key_exists( 'author', $this->wishlist ) ) {
			return $this->wishlist['author'];
		}
		return 0;
	}

	/**
	 * Add\Update product
	 *
	 * @param array $data Object product.
	 * @return boolean
	 */
	function add_product( $data = array() ) {
		$_data = filter_var_array( $data, array(
			'product_id'	 => FILTER_VALIDATE_INT,
			'variation_id'	 => FILTER_VALIDATE_INT,
			'wishlist_id'	 => FILTER_VALIDATE_INT,
			'quantity'		 => FILTER_VALIDATE_INT,
		) );
		if ( empty( $_data['quantity'] ) ) {
			$_data['quantity'] = 1;
		}
		if ( empty( $_data['wishlist_id'] ) ) {
			$_data['wishlist_id'] = $this->wishlist_id();
		}
		$product_data = $this->check_product( $_data['product_id'], $_data['variation_id'], $_data['wishlist_id'] );
		if ( false === $product_data ) {
			return false;
		}
		if ( $product_data ) {
			$data['quantity'] = $product_data['quantity'] + $_data['quantity'];
			return $this->update( $data );
		} else {
			return $this->add( $data );
		}
	}

	/**
	 * Add product
	 *
	 * @global wpdb $wpdb
	 * @param array $data Object product.
	 * @return boolean
	 */
	function add( $data = array() ) {
		$default = array(
			'author'		 => $this->user,
			'date'			 => date( 'Y-m-d H:i:s' ),
			'in_stock'		 => false,
			'price'			 => 0,
			'product_id'	 => 0,
			'quantity'		 => 1,
			'variation_id'	 => 0,
			'wishlist_id'	 => $this->wishlist_id(),
		);
		$data	 = filter_var_array( $data, apply_filters( 'tinvwl_wishlist_product_add_field', array(
			'author'		 => FILTER_VALIDATE_INT,
			'product_id'	 => FILTER_VALIDATE_INT,
			'quantity'		 => FILTER_VALIDATE_INT,
			'variation_id'	 => FILTER_VALIDATE_INT,
			'wishlist_id'	 => FILTER_VALIDATE_INT,
		) ) );
		$data	 = array_filter( $data );

		$data = tinv_array_merge( $default, $data );

		if ( empty( $data['wishlist_id'] ) || empty( $data['product_id'] ) ) {
			return false;
		}

		$product_data = $this->product_data( $data['product_id'], $data['variation_id'] );

		if ( $data['quantity'] <= 0 || ! $product_data || empty( $data['author'] ) ) {
			return false;
		}

		if ( $product_data->is_sold_individually() ) {
			$data['quantity'] = 1;
		}

		$data = apply_filters( 'tinvwl_wishlist_product_add', $data );
		$data['product_id']		 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) );
		$data['variation_id']	 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) );
		$data['in_stock']		 = $product_data->is_in_stock();
		$data['price']			 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->price : $product_data->get_price() );

		global $wpdb;
		if ( $wpdb->insert( $this->table, $data ) ) { // @codingStandardsIgnoreLine WordPress.VIP.DirectDatabaseQuery.DirectQuery
			$id = $wpdb->insert_id;
			return $id;
		}
		return false;
	}

	/**
	 * Get products by wishlist
	 *
	 * @param array $data Request.
	 * @return array
	 */
	function get_wishlist( $data = array() ) {
		if ( ! array_key_exists( 'wishlist_id', $data ) ) {
			$data['wishlist_id'] = $this->wishlist_id();
		}
		if ( empty( $data['wishlist_id'] ) ) {
			return array();
		}

		return $this->get( $data );
	}

	/**
	 * Check existing product
	 *
	 * @param integer $product_id Product id.
	 * @param integer $variation_id Product variaton id.
	 * @param integer $wishlist_id If exist wishlist object, you can put 0.
	 * @return mixed
	 */
	function check_product( $product_id, $variation_id = 0, $wishlist_id = 0 ) {
		$product_id		 = absint( $product_id );
		$variation_id	 = absint( $variation_id );
		$wishlist_id	 = absint( $wishlist_id );

		if ( empty( $wishlist_id ) ) {
			$wishlist_id = $this->wishlist_id();
		}
		if ( empty( $wishlist_id ) || empty( $product_id ) ) {
			return false;
		}

		$product_data = $this->product_data( $product_id, $variation_id );

		if ( ! $product_data ) {
			return false;
		}

		$products = $this->get( array(
			'product_id'	 => ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) ),
			'variation_id'	 => ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) ),
			'wishlist_id'	 => $wishlist_id,
			'count'			 => 1,
		) );

		return array_shift( $products );
	}

	/**
	 * Get products
	 *
	 * @global wpdb $wpdb
	 * @param array $data Request.
	 * @return array
	 */
	function get( $data = array() ) {
		$default = array(
			'count'		 => 10,
			'field'		 => null,
			'offset'	 => 0,
			'order'		 => 'ASC',
			'order_by'	 => 'in_stock',
			'external'	 => true,
			'sql'		 => '',
		);

		foreach ( $default as $_k => $_v ) {
			if ( array_key_exists( $_k, $data ) ) {
				$default[ $_k ] = $data[ $_k ];
				unset( $data[ $_k ] );
			}
		}

		$default['offset'] = absint( $default['offset'] );
		$default['count']	 = absint( $default['count'] );
		if ( is_array( $default['field'] ) ) {
			$default['field'] = '`' . implode( '`,`', $default['field'] ) . '`';
		} elseif ( is_string( $default['field'] ) ) {
			$default['field']	 = array( 'ID', $default['field'] );
			$default['field']	 = '`' . implode( '`,`', $default['field'] ) . '`';
		} else {
			$default['field'] = '*';
		}
		$sql = "SELECT {$default[ 'field' ]} FROM `{$this->table}`";

		$where = '1';
		if ( ! empty( $data ) && is_array( $data ) ) {
			foreach ( $data as $f => $v ) {
				$s = is_array( $v ) ? ' IN ' : '=';
				if ( is_array( $v ) ) {
					$v	 = "'" . implode( "','", $v ) . "'";
					$v	 = "($v)";
				} else {
					$v = "'$v'";
				}
				$data[ $f ] = sprintf( '`%s`%s%s', $f, $s, $v );
			}
			$where = implode( ' AND ', $data );
			$sql .= ' WHERE ' . $where;
		}

		$sql .= sprintf( ' ORDER BY `%s` %s LIMIT %d,%d;', $default['order_by'], $default['order'], $default['offset'], $default['count'] );
		if ( ! empty( $default['sql'] ) ) {
			$replacer		 = $replace		 = array();
			$replace[0]	 = '{table}';
			$replacer[0]	 = $this->table;
			$replace[1]	 = '{where}';
			$replacer[1]	 = $where;

			foreach ( $default as $key => $value ) {
				$i = count( $replace );

				$replace[ $i ]	 = '{' . $key . '}';
				$replacer[ $i ]	 = $value;
			}

			$sql = str_replace( $replace, $replacer, $default['sql'] );
		}
		global $wpdb;
		$products = $wpdb->get_results( $sql, ARRAY_A ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.

		if ( empty( $products ) ) {
			return array();
		}

		foreach ( $products as $k => $product ) {
			if ( empty( $default['sql'] ) ) {
				$product = filter_var_array( $product, array(
					'ID'			 => FILTER_VALIDATE_INT,
					'wishlist_id'	 => FILTER_VALIDATE_INT,
					'product_id'	 => FILTER_VALIDATE_INT,
					'variation_id'	 => FILTER_VALIDATE_INT,
					'author'		 => FILTER_VALIDATE_INT,
					'date'			 => FILTER_DEFAULT,
					'quantity'		 => FILTER_VALIDATE_INT,
					'price'			 => FILTER_SANITIZE_NUMBER_FLOAT,
					'in_stock'		 => FILTER_VALIDATE_BOOLEAN,
				) );
				if ( ! tinv_get_option( 'product_table', 'colm_quantity' ) ) {
					$product['quantity'] = 1;
				}
			}
			if ( $default['external'] ) {
				$product_data = $this->product_data( $product['variation_id'], $product['product_id'] );
				if ( $product_data ) {
					$product['product_id']		 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) );
					$product['variation_id']	 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) );
				}
				$product['data'] = $product_data;
			}
			$products[ $k ] = apply_filters( 'tinvwl_wishlist_product_get', $product );
		}
		return $products;
	}

	/**
	 * Get product info
	 *
	 * @param integer $product_id Product id.
	 * @param integer $variation_id Product variation id.
	 * @return mixed
	 */
	function product_data( $product_id, $variation_id = 0 ) {
		$product_id		 = absint( $product_id );
		$variation_id	 = absint( $variation_id );

		if ( 'product_variation' == get_post_type( $product_id ) ) { // WPCS: loose comparison ok.
			$variation_id	 = $product_id;
			$product_id		 = wp_get_post_parent_id( $variation_id );
		}

		$product_data = wc_get_product( $variation_id ? $variation_id : $product_id );

		if ( ! $product_data || 'trash' === ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->post->post_status : get_post( $product_data->get_id() )->post_status ) ) {
			return null;
		}

		$product_data->variation_id = absint( ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) ) );
		return $product_data;
	}

	/**
	 * Update product
	 *
	 * @global wpdb $wpdb
	 * @param array $data Object product.
	 * @return boolean
	 */
	function update( $data = array() ) {
		$data	 = filter_var_array( $data, apply_filters( 'tinvwl_wishlist_product_update_field', array(
			'product_id'	 => FILTER_VALIDATE_INT,
			'quantity'		 => FILTER_VALIDATE_INT,
			'variation_id'	 => FILTER_VALIDATE_INT,
			'wishlist_id'	 => FILTER_VALIDATE_INT,
		) ) );
		$data	 = array_filter( $data );

		if ( ! array_key_exists( 'wishlist_id', $data ) ) {
			$data['wishlist_id'] = $this->wishlist_id();
		}
		if ( ! array_key_exists( 'variation_id', $data ) ) {
			$data['variation_id'] = 0;
		}

		if ( empty( $data['wishlist_id'] ) || empty( $data['product_id'] ) ) {
			return false;
		}
		$product_data = $this->product_data( $data['product_id'], $data['variation_id'] );
		if ( ! $product_data ) {
			return false;
		}

		if ( $product_data->is_sold_individually() ) {
			$data['quantity'] = 1;
		}

		$data = apply_filters( 'tinvwl_wishlist_product_update', $data );
		$data['product_id']		 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) );
		$data['variation_id']	 = ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) );
		$data['in_stock']		 = $product_data->is_in_stock();
		$data['price']			 = version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->price : $product_data->get_price();

		global $wpdb;
		return false !== $wpdb->update( $this->table, $data, array(
			'product_id'   => $data['product_id'],
			'variation_id' => $data['variation_id'],
			'wishlist_id'  => $data['wishlist_id'],
		) ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.
	}

	/**
	 * Remove product from wishlist
	 *
	 * @global wpdb $wpdb
	 * @param integer $wishlist_id If exist wishlist object, you can put 0.
	 * @param integer $product_id Product id.
	 * @param integer $variation_id Product variation id.
	 * @return boolean
	 */
	function remove_product_from_wl( $wishlist_id = 0, $product_id = 0, $variation_id = 0 ) {
		global $wpdb;
		if ( empty( $wishlist_id ) ) {
			$wishlist_id = $this->wishlist_id();
		}
		if ( empty( $wishlist_id ) ) {
			return false;
		}
		if ( empty( $product_id ) ) {
			return false !== $wpdb->delete( $this->table, array( 'wishlist_id' => $wishlist_id ) ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.
		}
		$product_data = $this->product_data( $product_id, $variation_id );
		if ( ! $product_data ) {
			return false;
		}
		$data	 = array(
			'wishlist_id'	 => $wishlist_id,
			'product_id'	 => ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) ),
			'variation_id'	 => ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) ),
		);
		$result	 = false !== $wpdb->delete( $this->table, $data ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.
		if ( $result ) {
			do_action( 'tinvwl_wishlist_product_removed_from_wishlist', $wishlist_id, ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->id : ( $product_data->is_type( 'variation' ) ? $product_data->get_parent_id() : $product_data->get_id() ) ), ( version_compare( WC_VERSION, '3.0.0', '<' ) ? $product_data->variation_id : ( $product_data->is_type( 'variation' ) ? $product_data->get_id() : 0 ) ) );
		}
		return $result;
	}

	/**
	 * Remove product
	 *
	 * @global wpdb $wpdb
	 * @param integer $product_id Product id.
	 * @return boolean
	 */
	function remove_product( $product_id = 0 ) {
		if ( empty( $product_id ) ) {
			return false;
		}

		global $wpdb;
		$result = false !== $wpdb->delete( $this->table, array( 'product_id' => $product_id ) ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.
		if ( $result ) {
			do_action( 'tinvwl_wishlist_product_removed_by_product', $product_id );
		}
		return $result;
	}

	/**
	 * Remove product by ID
	 *
	 * @global wpdb $wpdb
	 * @param integer $id Product id.
	 * @return boolean
	 */
	function remove( $id = 0 ) {
		if ( empty( $id ) ) {
			return false;
		}

		global $wpdb;
		$result = false !== $wpdb->delete( $this->table, array( 'ID' => $id ) ); // WPCS: db call ok; no-cache ok; unprepared SQL ok.
		if ( $result ) {
			do_action( 'tinvwl_wishlist_product_removed_by_id', $id );
		}
		return $result;
	}
}
