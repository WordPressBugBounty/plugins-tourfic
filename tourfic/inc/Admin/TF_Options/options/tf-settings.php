<?php
// don't load directly
defined( 'ABSPATH' ) || exit;

use \Tourfic\Classes\Helper;
use \Tourfic\App\TF_Review;


if ( file_exists( TF_ADMIN_PATH . 'TF_Options/options/tf-menu-icon.php' ) ) {
	require_once TF_ADMIN_PATH . 'TF_Options/options/tf-menu-icon.php';
} else {
	// $menu_icon = TF_ASSETS_ADMIN_URL . 'images/icons/tourfic-settings.svg';
}

if ( !function_exists( 'tf_search_page_default' ) ) {
    function tf_search_page_default() {
        $args = array(
            'post_type'      => 'page',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        );

        $loop = new WP_Query( $args );
        if ( $loop->have_posts() ) {
            foreach ( $loop->posts as $post ) {
                if ( $post->post_name == 'tf-search' ) {
                    return $post->ID;
                }
            }
        }
        return;
    }
}

if ( ! function_exists( 'tf_wishlist_page_default') ) {
	function tf_wishlist_page_default() {
		$args = array(
			'post_type'      => 'page',
			'posts_per_page' => - 1,
			'post_status' => 'publish',
		);

		$loop = new WP_Query( $args );
		if( $loop->have_posts() ) {
			foreach( $loop->posts as $post ) {
				if( $post->post_name == 'tf-wishlist') {
					return $post->ID;
				}				
			}
		}
		return;
	}
}

TF_Settings::option( 'tf_settings', array(
	'title'    => __( 'Tourfic Settings ', 'tourfic' ),
	'icon'     => $menu_icon,
	'position' => 26,
	'sections' => array(
		'general'               => array(
			'title'  => __( 'General', 'tourfic' ),
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'      => 'general-notice-heading',
					'type'  => 'heading',
					'label' => __( 'General Settings', 'tourfic' ),
					'subtitle'   => __( 'This section contains the general settings for Tourfic.', 'tourfic' ),
				),
				array(
					'id'      => 'general-option-notice-one',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-general-settings/", array( 'utm_medium' => 'settings_doc_general-settings' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'       => 'disable-services',
					'type'     => 'imageselect',
					'label'    => esc_html__( 'Disable Post Types', 'tourfic' ),
					'subtitle' => esc_html__( 'Tick the image to disable the Post Type you don\'t need.', 'tourfic' ),
					'multiple' => true,
					'img-width'=> '100',
					'img-height'=> '100',
					'options'  => array(
						'hotel' => array(
							'title' => 'Hotel',
							'url'   => TF_ASSETS_ADMIN_URL . "images/hotel.png",
						),
						'tour' 		=> array(
							'title'	=> 'Tour',
							'url' 	=> TF_ASSETS_ADMIN_URL."images/tour.png",
						),
						'apartment'  => array(
							'title' => 'Apartment',
							'url'   => TF_ASSETS_ADMIN_URL . "images/apartment.png",
						),
						'carrentals'  => array(
							'title' => 'Car',
							'url'   => TF_ASSETS_ADMIN_URL . "images/carrentals.png",
						),
					),
				),
				array(
					'id'       => 'tf-date-format-for-users',
					'type'     => 'select',
					'label'    => __( 'Select Date Format', 'tourfic' ),
					'subtitle' => __( 'Choose the display format for the date as seen by the user upon selection.', 'tourfic' ),
					'options'  => array(
						'Y/m/d'  => __( 'YYYY/MM/DD', 'tourfic' ),
						'd/m/Y'  => __( 'DD/MM/YYYY', 'tourfic' ),
						'm/d/Y' => __('MM/DD/YYYY', 'tourfic'),
						'Y-m-d' => __( 'YYYY-MM-DD', 'tourfic' ),
						'd-m-Y'  => __( 'DD-MM-YYYY', 'tourfic' ),
						'm-d-Y' => __('MM-DD-YYYY', 'tourfic'),
						'Y.m.d'  => __( 'YYYY.MM.DD', 'tourfic' ),
						'd.m.Y'  => __( 'DD.MM.YYYY', 'tourfic' ),
						'm.d.Y' => __('MM.DD.YYYY', 'tourfic'),
					),
					'default'    => 'Y/m/d',
				),
				array(
					'id'       => 'tf-week-day-flatpickr',
					'type'     => 'select',
					'label'    => __( 'Select First Day of Week', 'tourfic' ),
					'subtitle' => __( 'Select a Day, that will show in the DatePickr of Frontend', 'tourfic' ),
					'options'  => array(
						'0' => __('Sunday', 'tourfic'),
						'1' => __('Monday', 'tourfic'),
						'2' => __('Tuesday', 'tourfic'),
						'3' => __('Wednesday', 'tourfic'),
						'4' => __('Thursday', 'tourfic'),
						'5' => __('Friday', 'tourfic'),
						'6' => __('Saturday', 'tourfic')
					),
					'default'    => '0',
				),
				array(
					'id'       => 'tf-quick-checkout',
					'type'     => 'switch',
					'label'    => __( 'Enable Quick Checkout', 'tourfic' ),
					'subtitle' => __( 'This option allows you to complete the checkout process directly from the single service page, without navigating to the checkout page. Note: The Instantio plugin is required, and this option is only for woocommerce payment system.', 'tourfic' ),
				),
			),
		),

		// Template Settings
		'tf-template-settings' => array(
			'title'  => esc_html__( 'Template', 'tourfic' ),
			'icon'   => 'fa-solid fa-newspaper',
			'fields' => array(
				array(
					'id'       => 'template_heading',
					'type'     => 'heading',
					'label'    => esc_html__( 'Template Settings', 'tourfic' ),
					'subtitle' => esc_html__( 'Select your preferred template from our current offering of two options, with more on the way!', 'tourfic' ),
				),
				array(
					'id'    => 'tf-template',
					'type'  => 'tab',
					'label' => esc_html__('Hotel, Tour, Apartment & Car Template', 'tourfic'),
					'tabs'  => array(
						array(
							'id'     => 'hotel_template',
							'title'  => esc_html__( 'Hotel', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'post_dependency' => 'hotel',
							'fields' => array(
								array(
									'id'      => 'hotel-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Hotel Single Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'single-hotel',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Single Hotel Template', 'tourfic' ),
									'subtitle'   => esc_html__( 'You have the option to override this from the settings specific to each individual hotel page.', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-design-1.png",
											'preview_link' => esc_url('https://tourfic.com/preview/hotels/tuvo-suites-hotel/'),
										),
										'design-2' 	=> array(
											'title'	=> esc_html__('Design 2', 'tourfic'),
											'url' 	=> TF_ASSETS_ADMIN_URL."images/template/preview-single-design-2.png",
											'preview_link' => esc_url('https://tourfic.com/preview/hotels/melbourne-mastlereagh/'),
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-default.png",
											'preview_link' => esc_url('https://tourfic.com/preview/hotels/rio-ontho-palace/'),
										),
									),
									'default'  => 'design-1',
								),
								//design 1
								array(
									'id'         => 'single-hotel-layout',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Hotel Template Sections', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can change the order of sections by dragging and dropping them.', 'tourfic' ),
									'dependency' => array( 'single-hotel', '==', 'design-1' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Features', 'tourfic' ),
											'slug'   => 'features',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Room', 'tourfic' ),
											'slug'   => 'rooms',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Facilities', 'tourfic' ),
											'slug'   => 'facilities',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'FAQ', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Review', 'tourfic' ),
											'slug'   => 'review',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Terms & Conditions', 'tourfic' ),
											'slug'   => 'trams-condition',
											'status' => 1,
										),
									),
								),
								//design 2
								array(
									'id'         => 'single-hotel-layout-part-1',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Hotel Template Sections Part 1', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-hotel', '==', 'design-2' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Features', 'tourfic' ),
											'slug'   => 'features',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Room', 'tourfic' ),
											'slug'   => 'rooms',
											'status' => 1,
										)
									),
								),
								array(
									'id'         => 'single-hotel-layout-part-2',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Hotel Template Sections Part 2', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-hotel', '==', 'design-2' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Facilities', 'tourfic' ),
											'slug'   => 'facilities',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Review', 'tourfic' ),
											'slug'   => 'review',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'FAQ', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Terms & Conditions', 'tourfic' ),
											'slug'   => 'trams-condition',
											'status' => 1,
										),
									),
								),
								array(
									'id'      => 'hotel-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Hotel Archive & Search Result Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'hotel-archive',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Archive & Search Result Template', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-1.png",
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-2.png",
										),
										'design-3' => array(
											'title' => esc_html__('Design 3', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-3.png",
											'is_pro'=> true,
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-default.png",
										),
									),
									'default'  => 'design-1',
								),
								array(
									'id'      => 'hotel_archive_design_2_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this hotel archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'hotel-archive', '==', 'design-2' ),
								),
								array(
									'id'      => 'hotel_archive_design_3_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this hotel archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'hotel-archive', '==', 'design-3' ),
								),
								array(
									'id'         => 'hotel_archive_view',
									'type'       => 'select',
									'label'      => esc_html__( 'Archive Layout', 'tourfic' ),
									'options'    => array(
										'list' => esc_html__( 'List', 'tourfic' ),
										'grid' => esc_html__( 'Grid', 'tourfic' ),
									),
									'default'    => 'List',
									'dependency' => array( 'hotel-archive', '!=', 'design-2' ),
								),
							
								array(
									'id'      => 'hotel_archive_notice',
									'type'    => 'notice',
									'content' => esc_html__( 'Edit the sidebar filter from Appearance -> Widgets', 'tourfic' ),
								),
							),
						),
						array(
							'id'     => 'tour_template',
							'title'  => esc_html__( 'Tour', 'tourfic' ),
							'post_dependency' => 'tour',
							'fields' => array(
								array(
									'id'      => 'tour-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Tour Single Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'single-tour',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Single Tour Template', 'tourfic' ),
									'subtitle'   => esc_html__( 'You have the option to override this from the settings specific to each individual tour page.', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-design-1.png",
											'preview_link' => esc_url('https://tourfic.com/preview/tours/amplified-nz-tour/'),
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-design-2.png",
											'preview_link' => esc_url('https://tourfic.com/preview/tours/ancient-trails-of-japan/'),
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-default.png",
											'preview_link' => esc_url('https://tourfic.com/preview/tours/magical-russia/'),
										),
									),
									'default'  => 'design-1',
								),
                                //design 1
							
								array(
									'id'         => 'single-tour-layout',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Tour Template Sections', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can change the order of sections by dragging and dropping them.', 'tourfic' ),
									'dependency' => array( 'single-tour', '==', 'design-1' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Gallery', 'tourfic' ),
											'slug'   => 'gallery',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Price', 'tourfic' ),
											'slug'   => 'price',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Information', 'tourfic' ),
											'slug'   => 'information',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Highlights', 'tourfic' ),
											'slug'   => 'highlights',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Include Exclude', 'tourfic' ),
											'slug'   => 'include-exclude',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Itinerary', 'tourfic' ),
											'slug'   => 'itinerary',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Map', 'tourfic' ),
											'slug'   => 'map',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'FAQ', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Terms & Conditions', 'tourfic' ),
											'slug'   => 'trams-condition',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Review', 'tourfic' ),
											'slug'   => 'review',
											'status' => 1,
										),
									),
								),
                                //design 2
								
								array(
									'id'         => 'single-tour-layout-part-1',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Tour Template Sections Part 1', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-tour', '==', 'design-2' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Information', 'tourfic' ),
											'slug'   => 'information',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Highlights', 'tourfic' ),
											'slug'   => 'highlights',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Include & Exclude', 'tourfic' ),
											'slug'   => 'include-exclude',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Itinerary', 'tourfic' ),
											'slug'   => 'itinerary',
											'status' => 1,
										)
									),
								),
								array(
									'id'         => 'single-tour-layout-part-2',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Tour Template Sections Part 2', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-tour', '==', 'design-2' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'FAQ', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Review', 'tourfic' ),
											'slug'   => 'review',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Terms & Conditions', 'tourfic' ),
											'slug'   => 'trams-condition',
											'status' => 1,
										),
									),
								),
								array(
									'id'      => 'tour-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Tour Archive & Search Result Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'tour-archive',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Archive & Search Result Template', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-1.png",
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-2.png",
										),
										'design-3' => array(
											'title' => esc_html__('Design 3', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-3.png",
											'is_pro'=> true,
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-default.png",
										),
									),
									'default'  => 'design-1',
								),
								array(
									'id'      => 'tour_archive_design_2_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this tour archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'tour-archive', '==', 'design-2' ),
								),
								array(
									'id'      => 'tour_archive_design_3_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this tour archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'tour-archive', '==', 'design-3' ),
								),
								array(
									'id'         => 'tour_archive_view',
									'type'       => 'select',
									'label'      => esc_html__( 'Archive Layout', 'tourfic' ),
									'options'    => array(
										'list' => esc_html__( 'List', 'tourfic' ),
										'grid' => esc_html__( 'Grid', 'tourfic' ),
									),
									'default'    => 'List',
									'dependency' => array( 'tour-archive', '!=', 'design-2' ),
								),
								
								array(
									'id'      => 'tour_archive_notice',
									'type'    => 'notice',
									'content' => esc_html__( 'Edit the sidebar filter from Appearance -> Widgets', 'tourfic' ),
								),
							),
						),
						array(
							'id'     => 'apartment_template',
							'title'  => esc_html__( 'Apartment', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'post_dependency' => 'apartment',
							'fields' => array(
								array(
									'id'      => 'apartment-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Apartment Single Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'single-apartment',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Single Apartment Template', 'tourfic' ),
									'subtitle'   => esc_html__( 'You have the option to override this from the settings specific to each individual apartment page.', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-apt-design-1.png",
											'preview_link' => esc_url('https://tourfic.com/preview/apartments/2-bedroom-apartment-in-gamle-oslo/'),
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-apt-default.png",
											'preview_link' => esc_url('https://tourfic.com/preview/apartments/barcelo-residences-dubai-marina/'),
										),
									),
									'default'  => 'design-1',
								),
							
								array(
									'id'         => 'single-aprtment-layout-part-1',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Apartment Template Sections Part 1', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-apartment', '==', 'design-1' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Highlights ', 'tourfic' ),
											'slug'   => 'features',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Apartment Rooms', 'tourfic' ),
											'slug'   => 'rooms',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Place offer', 'tourfic' ),
											'slug'   => 'offer',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'House Rules', 'tourfic' ),
											'slug'   => 'rules',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Amenities', 'tourfic' ),
											'slug'   => 'facilities',
											'status' => 1,
										)
									),
								),
								array(
									'id'         => 'single-aprtment-layout-part-2',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => esc_html__( 'Single Apartment Template Sections Part 2', 'tourfic' ),
									'subtitle'   => esc_html__( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-apartment', '==', 'design-1' ),
									'default'    => array(
										array(
											'label'  => esc_html__( 'Review', 'tourfic' ),
											'slug'   => 'review',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'FAQ', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										),
										array(
											'label'  => esc_html__( 'Terms & Conditions', 'tourfic' ),
											'slug'   => 'trams-condition',
											'status' => 1,
										),
									),
								),
								array(
									'id'      => 'apartment-title',
									'type'    => 'heading',
									'content' => esc_html__( 'Apartment Archive & Search Result Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'apartment-archive',
									'type'     => 'imageselect',
									'label'    => esc_html__( 'Select Archive & Search Result Template', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-2.png",
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-design-3.png",
											'is_pro'=> true,
										),
										'default'  => array(
											'title' => esc_html__('Legacy', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-default.png",
										),
									),
									'default'  => 'default',
								),
								array(
									'id'      => 'apartment_archive_design_1_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this tour archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'apartment-archive', '==', 'design-1' ),
								),
								array(
									'id'      => 'apartment_archive_design_2_bannar',
									'type'    => 'image',
									'label'    => esc_html__( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => esc_html__( 'Upload Banner Image for this tour archive template.', 'tourfic' ),
									'library' => 'image',
									'dependency' => array( 'apartment-archive', '==', 'design-2' ),
								),
								array(
									'id'         => 'apartment_archive_view',
									'type'       => 'select',
									'label'      => esc_html__( 'Archive Layout', 'tourfic' ),
									'options'    => array(
										'list' => esc_html__( 'List', 'tourfic' ),
										'grid' => esc_html__( 'Grid', 'tourfic' ),
									),
									'default'    => 'List',
									'dependency' => array( 'apartment-archive', '!=', 'design-1' ),
								),
							
								array(
									'id'      => 'apartment_archive_notice',
									'type'    => 'notice',
									'content' => esc_html__( 'Edit the sidebar filter from Appearance -> Widgets', 'tourfic' ),
								),
							),
						),
						array(
							'id'     => 'car_template',
							'title'  => __( 'Car', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'post_dependency' => 'carrentals',
							'fields' => array(
								array(
									'id'      => 'car-title',
									'type'    => 'heading',
									'content' => __( 'Car Single Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'single-car',
									'type'     => 'imageselect',
									'label'    => __( 'Select Single Car Template', 'tourfic' ),
									'subtitle'   => __( 'You have the option to override this from the settings specific to each individual apartment page.', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-single-car-design-1.png",
											'preview_link' => esc_url('https://tourfic.com/preview/cars/honda-city/'),
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-coming-soon.png",
											'disabled' => true
										),
									),
									'default'  => 'design-1',
								),
							
								array(
									'id'         => 'single-car-layout',
									'type'       => 'switch_group',
									'column'  	 => 4,
									'label'      => __( 'Single Car Template Sections', 'tourfic' ),
									'subtitle'   => __( 'You can able to change section positions by Drag & Drop.', 'tourfic' ),
									'dependency' => array( 'single-car', '==', 'design-1' ),
									'default'    => array(
										array(
											'label'  => __( 'Description', 'tourfic' ),
											'slug'   => 'description',
											'status' => 1,
										),
										array(
											'label'  => __( 'Car info', 'tourfic' ),
											'slug'   => 'car-info',
											'status' => 1,
										),
										array(
											'label'  => __( 'Benefits', 'tourfic' ),
											'slug'   => 'benefits',
											'status' => 1,
										),
										array(
											'label'  => __( 'Include/Exclude', 'tourfic' ),
											'slug'   => 'inc-exc',
											'status' => 1,
										),
										array(
											'label'  => __( 'Location', 'tourfic' ),
											'slug'   => 'location',
											'status' => 1,
										),
										array(
											'label'  => __( 'FAQs', 'tourfic' ),
											'slug'   => 'faq',
											'status' => 1,
										)
									),
								),
								
								array(
									'id'      => 'car-title',
									'type'    => 'heading',
									'content' => __( 'Car Archive & Search Result Page', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'       => 'car-archive',
									'type'     => 'imageselect',
									'label'    => __( 'Select Archive & Search Result Template', 'tourfic' ),
									'options'  => array(
										'design-1' => array(
											'title' => esc_html__('Design 1', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-archive-car-design-1.png",
										),
										'design-2' => array(
											'title' => esc_html__('Design 2', 'tourfic'),
											'url'   => TF_ASSETS_ADMIN_URL . "images/template/preview-coming-soon.png",
											'disabled' => true
										),
									),
									'default'  => 'design-1',
								),
								array(
									'id'      => 'car_archive_design_1_bannar',
									'type'    => 'image',
									'label'    => __( 'Archive & Search Result Banner Image', 'tourfic' ),
									'subtitle' => __( 'Upload Banner Image for this tour archive template.', 'tourfic' ),
									'library' => 'image',
									// 'dependency' => array( 'car-archive', '==', 'design-1' ),
								),
								array(
									'id'         => 'car_archive_view',
									'type'       => 'select',
									'label'      => __( 'Archive Layout', 'tourfic' ),
									'options'    => array(
										'grid' => __( 'Grid', 'tourfic' ),
										'list' => __( 'List', 'tourfic' ),
									),
									'default'    => 'grid',
									// 'dependency' => array( 'car-archive', '==', 'design-1' ),
								),
								array(
									'id'         => 'car_archive_driver_min_age',
									'type'       => 'number',
									'label'      => __( 'Archive Filter: Driver Minimum Age', 'tourfic' ),
									'subtitle'      => __( "This setting allows you to display the driver's minimum age on the archive and search results pages.", 'tourfic' ),
									'default'    => 18,
								),
								array(
									'id'         => 'car_archive_driver_max_age',
									'type'       => 'number',
									'label'      => __( 'Archive Filter: Driver Maximum Age', 'tourfic' ),
									'subtitle'      => __( "This setting allows you to display the driver's maximum age on the archive and search results pages.", 'tourfic' ),
									'default'    => 40,
								),
								
								array(
									'id'      => 'car_archive_notice',
									'type'    => 'notice',
									'content' => __( 'Edit the sidebar filter from Appearance -> Widgets', 'tourfic' ),
								),
							),
						),
					),
				),
				array(
					'id'       => 'container_heading',
					'type'     => 'heading',
					'label'    => esc_html__( 'Container Settings', 'tourfic' ),
					'subtitle' => esc_html__( 'Select your preferred container layout', 'tourfic' ),
				),
				array(
					'id'       => 'tf-container',
					'type'     => 'imageselect',
					'label'    => esc_html__( 'Select Container Layout', 'tourfic' ),
					'img-width'=> '120',
					'img-height'=> '120',
					'options'  => array(
						'boxed' => array(
							'title' => esc_html__('Boxed', 'tourfic'),
							'url'   => TF_ASSETS_ADMIN_URL . "images/boxed.png",
						),
						'full-width' => array(
							'title'	=> esc_html__('Full width', 'tourfic'),
							'url' 	=> TF_ASSETS_ADMIN_URL."images/full-width.png",
						),
					),
					'default'  => 'boxed',
				),
				array(
					'id'       => 'tf-container-width',
					'type'     => 'number',
					'label'    => esc_html__( 'Container Width (px)', 'tourfic' ),
					'default'  => '1280',
					'dependency'  => array( 'tf-container', '==', 'boxed' ),
					'attributes' => array(
						'min' => '770',
						'max' => '1920',
						'step'=> '10'
					),
				),
			),
		),

		//Appearance
		'appearance'               => array(
			'title'  => esc_html__( 'Appearance', 'tourfic' ),
			'icon'   => 'fas fa-palette',
			'fields' => array(
				array(
					'id'       => 'appearance_heading',
					'type'     => 'heading',
					'label'    => esc_html__( 'Preset Colors', 'tourfic' ),
					'subtitle' => esc_html__( 'These colors will be used throughout your website. Choose between these presets or create your own custom palette.', 'tourfic' ),
				),
				array(
					'id'       => 'color-palette-template',
					'type'     => 'colorpalette',
					'inline'   => true,
					'options'  => array(
						'design-1' => array(
							'title' => 'Palette 1',
							'colors' => [
								'#0E3DD8',
								'#0A2B99',
								'#1C2130',
								'#494D59'
							]
						),
						'design-2' => array(
							'title' => 'Palette 2',
							'colors' => [
								'#B58E53',
								'#917242',
								'#30281C',
								'#595349'
							]
						),
						'design-3' => array(
							'title' => 'Palette 3',
							'colors' => [
								'#F97415',
								'#C75605',
								'#30241C',
								'#595049'
							]
						),
						'design-4' => array(
							'title' => 'Palette 4',
							'colors' => [
								'#003061',
								'#002952',
								'#1C2630',
								'#495159'
							]
						),
						'custom' => array(
							'title' => 'Custom Palette',
							'colors' => function_exists('tf_custom_color_palette_values') ? tf_custom_color_palette_values() : '',
						)
					),
					'default'  => 'design-1',
				),
				// Design 1 Fields
				array(
					'id'       => 'tf-d1-brand',
					'label'   => esc_html__( 'Brand Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#0E3DD8',
						'dark' => '#0A2B99',
						'lite' => '#C9D4F7',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'dark' => esc_html__( 'Dark', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-1' ),
					),
				),
				array(
					'id'       => 'tf-d1-text',
					'label'   => esc_html__( 'Text Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'heading' => '#1C2130',
						'paragraph' => '#494D59',
						'lite' => '#F3F5FD',
					),
					'colors'   => array(
						'heading' => esc_html__( 'Heading', 'tourfic' ),
						'paragraph' => esc_html__( 'Paragraph', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-1' ),
					),
				),
				array(
					'id'       => 'tf-d1-border',
					'label'   => esc_html__( 'Border Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#16275F',
						'lite' => '#D1D7EE',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-1' ),
					),
				),
				array(
					'id'       => 'tf-d1-filling',
					'label'   => esc_html__( 'Filling Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'background' => '#ffffff',
						'foreground' => '#F5F7FF',
					),
					'colors'   => array(
						'background' => esc_html__( 'Background', 'tourfic' ),
						'foreground' => esc_html__( 'Foreground', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-1' ),
					),
				),
				// Design 2 Fields
				array(
					'id'       => 'tf-d2-brand',
					'label'   => esc_html__( 'Brand Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#B58E53',
						'dark' => '#917242',
						'lite' => '#FAEEDC',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'dark' => esc_html__( 'Dark', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-2' ),
					),
				),
				array(
					'id'       => 'tf-d2-text',
					'label'   => esc_html__( 'Text Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'heading' => '#30281C',
						'paragraph' => '#595349',
						'lite' => '#FDF9F3',
					),
					'colors'   => array(
						'heading' => esc_html__( 'Heading', 'tourfic' ),
						'paragraph' => esc_html__( 'Paragraph', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-2' ),
					),
				),
				array(
					'id'       => 'tf-d2-border',
					'label'   => esc_html__( 'Border Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#5F4216',
						'lite' => '#EEE2D1',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-2' ),
					),
				),
				array(
					'id'       => 'tf-d2-filling',
					'label'   => esc_html__( 'Filling Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'background' => '#ffffff',
						'foreground' => '#FDF9F3',
					),
					'colors'   => array(
						'background' => esc_html__( 'Background', 'tourfic' ),
						'foreground' => esc_html__( 'Foreground', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-2' ),
					),
				),
				// Design 3 Fields
				array(
					'id'       => 'tf-d3-brand',
					'label'   => esc_html__( 'Brand Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#F97415',
						'dark' => '#C75605',
						'lite' => '#FDDCC3',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'dark' => esc_html__( 'Dark', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-3' ),
					),
				),
				array(
					'id'       => 'tf-d3-text',
					'label'   => esc_html__( 'Text Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'heading' => '#30241C',
						'paragraph' => '#595049',
						'lite' => '#FDF7F3',
					),
					'colors'   => array(
						'heading' => esc_html__( 'Heading', 'tourfic' ),
						'paragraph' => esc_html__( 'Paragraph', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-3' ),
					),
				),
				array(
					'id'       => 'tf-d3-border',
					'label'   => esc_html__( 'Border Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#5F3416',
						'lite' => '#EEDDD1',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-3' ),
					),
				),
				array(
					'id'       => 'tf-d3-filling',
					'label'   => esc_html__( 'Filling Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'background' => '#ffffff',
						'foreground' => '#FFF9F5',
					),
					'colors'   => array(
						'background' => esc_html__( 'Background', 'tourfic' ),
						'foreground' => esc_html__( 'Foreground', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-3' ),
					),
				),
				// Design 4 Fields
				array(
					'id'       => 'tf-d4-brand',
					'label'   => esc_html__( 'Brand Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#003061',
						'dark' => '#002952',
						'lite' => '#C2E0FF',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'dark' => esc_html__( 'Dark', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-4' ),
					),
				),
				array(
					'id'       => 'tf-d4-text',
					'label'   => esc_html__( 'Text Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'heading' => '#1C2630',
						'paragraph' => '#495159',
						'lite' => '#F3F8FD',
					),
					'colors'   => array(
						'heading' => esc_html__( 'Heading', 'tourfic' ),
						'paragraph' => esc_html__( 'Paragraph', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-4' ),
					),
				),
				array(
					'id'       => 'tf-d4-border',
					'label'   => esc_html__( 'Border Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'default' => '#163A5F',
						'lite' => '#D1DFEE',
					),
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-4' ),
					),
				),
				array(
					'id'       => 'tf-d4-filling',
					'label'   => esc_html__( 'Filling Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'default'  => array(
						'background' => '#ffffff',
						'foreground' => '#F5FAFF',
					),
					'colors'   => array(
						'background' => esc_html__( 'Background', 'tourfic' ),
						'foreground' => esc_html__( 'Foreground', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'design-4' ),
					),
				),
				// Custom Palette
				array(
					'id'       => 'tf-custom-brand',
					'label'   => esc_html__( 'Brand Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'dark' => esc_html__( 'Dark', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'custom' ),
					),
				),
				array(
					'id'       => 'tf-custom-text',
					'label'   => esc_html__( 'Text Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'colors'   => array(
						'heading' => esc_html__( 'Heading', 'tourfic' ),
						'paragraph' => esc_html__( 'Paragraph', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'custom' ),
					),
				),
				array(
					'id'       => 'tf-custom-border',
					'label'   => esc_html__( 'Border Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'colors'   => array(
						'default' => esc_html__( 'Default', 'tourfic' ),
						'lite' => esc_html__( 'Lite', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'custom' ),
					),
				),
				array(
					'id'       => 'tf-custom-filling',
					'label'   => esc_html__( 'Filling Color', 'tourfic' ),
					'type'     => 'color',
					'multiple' => true,
					'inline'   => true,
					'colors'   => array(
						'background' => esc_html__( 'Background', 'tourfic' ),
						'foreground' => esc_html__( 'Foreground', 'tourfic' ),
					),
					'dependency'   => array(
						array( 'color-palette-template', '==', 'custom' ),
					),
				),
			)
		),

		// Tour Options
		'tour'                  => array(
			'title'  => __( 'Tour Options', 'tourfic' ),
			'icon'   => 'fas fa-umbrella-beach',
			'post_dependency' => 'tour',
			'fields' => array(),
		),
		'single_tour'           => array(
			'title'  => __( 'Single Page', 'tourfic' ),
			'parent' => 'tour',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'       => 'signle_tour_heading',
					'type'     => 'heading',
					'label'    => __( 'Global Settings for Single Tours Page', 'tourfic' ),
					'subtitle' => __( 'These options can be overridden from Single Tour Settings.', 'tourfic' ),
				),
				array(
					'id'      => 'tour-option-notice-one',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),

				array(
					'id'        => 't-review',
					'type'      => 'switch',
					'label'     => __( 'Disable Review Section', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 't-share',
					'type'      => 'switch',
					'label'     => __( 'Disable Share Option', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),
				array(
					'id'        => 't-related',
					'type'      => 'switch',
					'label'     => __( 'Disable Related Tour Section', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'       => 'rt-title',
					'type'     => 'text',
					'label'    => __( 'Related Tour Title', 'tourfic' ),
					'subtitle' => __( "This title will be displayed as the section title in the 'Related Tours' section on individual tour pages.", 'tourfic' ),
					'default'  => __( 'You might also like', 'tourfic' ),
					'dependency'  => array(
						array( 't-related', '==', 'false' ),
					),
				),
				array(
					'id'       => 'rt-description',
					'type'     => 'text',
					'label'    => __( 'Related Tour Description', 'tourfic' ),
					'subtitle' => __( "This Description will be displayed as the Description in the 'Related Tours' section on individual tour pages.", 'tourfic' ),
					'default'  => __( 'Travel is my life. Since 1999, I have been traveling around the world nonstop. If you also love travel, you are in the right place!', 'tourfic' ),
					'dependency'  => array(
						array( 't-related', '==', 'false' ),
					),
				),
				array(
					'id'      => 'rt_display',
					'type'    => 'radio',
					'label'   => __( 'Related Tour display logic', 'tourfic' ),
					'options' => array(
						'auto'     => __( 'Auto', 'tourfic' ),
						'selected' => __( 'Selected', 'tourfic' )
					),
					'default' => 'auto',
					'inline'  => true,
					'dependency'  => array(
						array( 't-related', '==', 'false' ),
					),
				),
				array(
					'id'         => 'tf-related-tours',
					'type'       => 'select2',
					'multiple'   => 'true',
					'label'      => __( 'Choose Your Related Tours', 'tourfic' ),
					'subtitle' => __( 'Select the tour you wish to feature in the “Related Tour” section on each single tour page.', 'tourfic' ),
					'options'    => 'posts',
					'query_args' => array(
						'post_type'      => 'tf_tours',
						'posts_per_page' => - 1,
					),
					'dependency' => array (
						array( 'rt_display', '==', 'selected' ),
						array( 't-related', '==', 'false' ),
					),
				),
				array(
					'id'       => 't-enquiry-email',
					'type'     => 'text',
					'label'    => __( 'Email for Enquiry Form', 'tourfic' ),
					'subtitle' => __( 'Enter the email address that will receive all submissions from the enquiry form.', 'tourfic' ),
				),
				array(
					'id'        => 't-auto-draft',
					'type'      => 'switch',
					'label'     => __( 'Expired Tours for Backend', 'tourfic' ),
					'subtitle'  => __( 'If this option is activated, the tour will automatically expire after the set date. The status will update every 24 hours.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 't-show-expire-tour',
					'type'      => 'switch',
					'label'     => __( 'Show All Tours (Publish + Expired)', 'tourfic' ),
					'subtitle'  => __( "Enabling this option will display all tours, regardless of whether their status is 'Published' or 'Expired'.", 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 't-hide-start-price',
					'type'      => 'switch',
					'label'     => __( 'Hide Starting Price', 'tourfic' ),
					'subtitle'  => __( 'By enabling this feature, the starting price will be concealed from the tour listings.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'       => 'tour_archive_price_minimum_settings',
					'type'     => 'select',
					'label'    => __( 'Show Minimum Price', 'tourfic' ),
					'options'  => array(
						'all'   => __( 'All', 'tourfic' ),
						'adult'   => __( 'Adult', 'tourfic' ),
						'child'   => __( 'Child', 'tourfic' ),
					),
					'default'    => 'All',
				),
				array(
					'id'       => 'tour_booking_form_button_text',
					'type'     => 'text',
					'label'    => __( 'Change Booking Form Button Text', 'tourfic' ),
					'subtitle'  => __( 'With this option, you can change the text of the booking form button on the single tour pages.', 'tourfic' ),
					'default'    => __('Book Now', 'tourfic'),
				),
			),
		),
		// Itinerary Settings
		'tour_itinerary'        => array(
			'title'  => __( 'Itinerary Settings', 'tourfic' ),
			'parent' => 'tour',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'   => 'itinerary-builder-setings',
					'type' => 'tab',
					'tabs' => array(
						array(
							'id'     => 'itinerary-builder-setting',
							'title'  => 'Itinerary Builder Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'tour-option-notice-three',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="' . Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#itinerary", array( 'utm_medium' => 'settings_doc_tour-itinerary' )) . '" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'      => 'tour-option-itinerary-notice',
									'type'    => 'notice',
									'class'	  => 'tour-option-itinerary-notice',
									'content' => __('By default, you can create your entire Tour Itinerary using our Default Itinerary editor found in the Single Tour settings. For access to an Itinerary builder with enhanced advanced features, please consider upgrading to our <a href="'.  Helper::tf_utm_generator("https://tourfic.com/", array( 'utm_medium' => 'settings_pro-itinerary' ))  .'" target="_blank"><b>Pro version.</b></a>', 'tourfic'),
								),
							),
						),
						array(
							'id'     => 'itinerary-downloader-setting',
							'title'  => 'Itinerary Downloader Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'tour-option-notice-three',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="' . Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#itinerary", array( 'utm_medium' => 'settings_doc_tour-itinerary' )) . '" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'      => 'tour-option-itinerary-notice',
									'type'    => 'notice',
									'class'	  => 'tour-option-itinerary-notice',
									'content' => __('By default, you can create your entire Tour Itinerary using our Default Itinerary editor found in the Single Tour settings. For access to an Itinerary builder with enhanced advanced features, please consider upgrading to our <b>Pro version.</b>', 'tourfic'),
								),
							),
						),
					),
				),
			),
		),
		'hotel_option'          => array(
			'title'  => __( 'Hotel Options', 'tourfic' ),
			'icon'   => 'fas fa-hotel',
			'post_dependency' => 'hotel',
			'fields' => array(),
		),
		'single_page'           => array(
			'title'  => __( 'Single Page', 'tourfic' ),
			'parent' => 'hotel_option',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'        => 'label_off_heading',
					'type'      => 'heading',
					'label'     => __( 'Global Settings for Single Hotel Page', 'tourfic' ),
					'sub_title' => __( 'These options can be overridden from Single Hotel Settings.', 'tourfic' ),
				),

				array(
					'id'      => 'hotel-option-notice-one',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-hotel-options/", array( 'utm_medium' => 'settings_doc_hotel-options' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'        => 'h-review',
					'type'      => 'switch',
					'label'     => __( 'Disable Review Section', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false,
				),

				array(
					'id'        => 'h-share',
					'type'      => 'switch',
					'label'     => __( 'Disable Share Option', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false,
				),
				//Feature filter setting
				array(
					'id'        => 'feature-filter',
					'type'      => 'switch',
					'label'     => __( 'Filter By Feature', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true,
				),
				array(
					'id'       => 'h-enquiry-email',
					'type'     => 'text',
					'label'    => __( 'Email for Enquiry Form', 'tourfic' ),
					'subtitle' => __( 'Enter the email address that will receive all submissions from the enquiry form.', 'tourfic' ),
				),
				array(
					'id'       => 'hotel_archive_price_minimum_settings',
					'type'     => 'select',
					'label'    => __( 'Show Minimum Price', 'tourfic' ),
					'options'  => array(
						'all'   => __( 'All', 'tourfic' ),
						'adult'   => __( 'Adult', 'tourfic' ),
						'child'   => __( 'Child', 'tourfic' ),
					),
					'default'    => 'All',
				),
				array(
					'id'           => 'hotel_facilities_cats',
					'type'         => 'repeater',
					'label'        => __( 'Facilities Categories', 'tourfic' ),
					'button_title' => __( 'Add New', 'tourfic' ),
					'field_title'  => 'hotel_facilities_cat_name',
					'fields'       => array(
						array(
							'id'    => 'hotel_facilities_cat_name',
							'type'  => 'text',
							'label' => __( 'Category Name', 'tourfic' ),
						),
						array(
							'id'    => 'hotel_facilities_cat_icon',
							'type'  => 'icon',
							'label' => __( 'Category Icon', 'tourfic' ),
						),
					),
				),
				array(
					'id'       => 'hotel_booking_form_button_text',
					'type'     => 'text',
					'label'    => __( 'Change Booking Form Button Text', 'tourfic' ),
					'subtitle'  => __( 'With this option, you can change the text of the booking form button on the single hotel pages.', 'tourfic' ),
					'default'    => __('Reserve Now', 'tourfic'),
				),
				array(
					'id'       => 'hotel_booking_check_button_text',
					'type'     => 'text',
					'label'    => __( 'Change Book Availability Button Text', 'tourfic' ),
					'subtitle'  => __( 'With this option, you can change the text of the check availability button on the single hotel pages.', 'tourfic' ),
					'default'    => __('Check Availability', 'tourfic'),
				),
			),
		),
		'room_config'=> array(
			'title'  => __( 'Room Config', 'tourfic' ),
			'parent' => 'hotel_option',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'hotel_room_heading',
					'type'  => 'heading',
					'label' => __( 'Global Configuration for Hotel Rooms', 'tourfic' ),
				),
				array(
					'id'      => 'hotel-option-notice-two',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-hotel-options/#room", array( 'utm_medium' => 'settings_doc_hotel-options_room' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'       => 'enable_child_age_limit',
					'type'     => 'switch',
					'label'    => __( 'Children Age Limit', 'tourfic' ),
					'subtitle' => __( 'Turn on this option to set the Maximum age limit for Children. This can be overridden from Single Hotel Settings.', 'tourfic' ),
				),
				array(
					'id'         => 'children_age_limit',
					'type'       => 'number',
					'label'      => __( 'Specify Maximum Age Limit', 'tourfic' ),
					'subtitle'   => __( 'Set the maximum age limit for children', 'tourfic' ),
					'attributes' => array(
						'min' => '0',
					),
					'dependency' => array( 'enable_child_age_limit', '==', '1' ),
				),
			),
		),

		//Apartment Options
		'apartment_option'      => array(
			'title'  => __( 'Apartment Options', 'tourfic' ),
			'icon'   => 'fa-solid fa-house-chimney',
			'post_dependency' => 'apartment',
			'fields' => array(),
		),
		'apartment_single_page' => array(
			'title'  => __( 'Single Page', 'tourfic' ),
			'parent' => 'apartment_option',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'label_off_heading',
					'type'  => 'heading',
					'label' => __( 'Single Apartment Settings', 'tourfic' ),
					'subtitle'   => __( 'These options can be overridden from Single Apartment Settings.', 'tourfic' ),
				),

				array(
					'id'      => 'apartment-option-notice',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/apartment-options/", array( 'utm_medium' => 'settings_doc_apartment-options' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'           => 'amenities_cats',
					'type'         => 'repeater',
					'label'        => __( 'Amenities Categories', 'tourfic' ),
					'button_title' => __( 'Add New', 'tourfic' ),
					'field_title'  => 'amenities_cat_name',
					'fields'       => array(
						array(
							'id'    => 'amenities_cat_name',
							'type'  => 'text',
							'label' => __( 'Category Name', 'tourfic' ),
						),
						array(
							'id'    => 'amenities_cat_icon',
							'type'  => 'icon',
							'label' => __( 'Category Icon', 'tourfic' ),
						),
					),
				),

				array(
					'id'        => 'disable-apartment-review',
					'type'      => 'switch',
					'label'     => __( 'Disable Review Section', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),

				array(
					'id'        => 'disable-apartment-share',
					'type'      => 'switch',
					'label'     => __( 'Disable Share Option', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),

				array(
					'id'        => 'disable-related-apartment',
					'type'      => 'switch',
					'label'     => __( 'Disable Related Section', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),
				array(
					'id'       => 'apartment_booking_form_button_text',
					'type'     => 'text',
					'label'    => __( 'Change Booking Form Button Text', 'tourfic' ),
					'subtitle'  => __( 'With this option, you can change the text of the booking form button on the single apartment pages.', 'tourfic' ),
					'default'    => __('Reserve', 'tourfic'),
				),
			),
		),

		//Car Options
		'car_option'      => array(
			'title'  => __( 'Car Options', 'tourfic' ),
			'icon'   => 'fa-solid fa-car',
			'post_dependency' => 'carrentals',
			'fields' => array(),
		),
		'car_single_page' => array(
			'title'  => __( 'Single Page', 'tourfic' ),
			'parent' => 'car_option',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'label_off_heading',
					'type'  => 'heading',
					'label' => __( 'Single Car Settings', 'tourfic' ),
					'subtitle'   => __( 'These options can be overridden from Single Car Settings.', 'tourfic' ),
				),

				array(
					'id'      => 'apartment-option-notice',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/car-options/#Single_Page_Settings", array( 'utm_medium' => 'settings_doc_car-options_single' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),

				array(
					'id'        => 'disable-car-share',
					'type'      => 'switch',
					'label'     => __( 'Disable Share Option', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),
				array(
					'id'       => 'car_booking_form_button_text',
					'type'     => 'text',
					'label'    => __( 'Change Booking Form Button Text', 'tourfic' ),
					'subtitle'  => __( 'With this option, you can change the text of the booking form button on the single car pages.', 'tourfic' ),
					'default'    => __('Reserve', 'tourfic'),
				),
			),
		),
		'car_operating_hours' => array(
			'title'  => __( 'Operating Hours', 'tourfic' ),
			'parent' => 'car_option',
			'icon'   => 'fa fa-hourglass-half',
			'fields' => array(
				array(
					'id'    => 'label_off_heading',
					'type'  => 'heading',
					'label' => __( 'Operating Hours Settings', 'tourfic' ),
					'subtitle'   => __( 'These options can be overridden from Operating Hours Settings.', 'tourfic' ),
				),

				array(
					'id'      => 'apartment-option-notice',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/car-options/#Single_Page_Settings", array( 'utm_medium' => 'settings_doc_car-options_single' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),

				array(
					'id'        => 'disable-car-time-slots',
					'type'      => 'switch',
					'label'     => __( 'Modify Time Slots', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false
				),
				array(
					'id'       => 'car_time_interval',
					'type'     => 'number',
					'label'    => __( 'Time Interval', 'tourfic' ),
					'subtitle' => __( 'Set the time interval for search form time slots.', 'tourfic' ),
					'default'  => '30',
					'attributes' => array(
						'min' => '10',
						'max' => '60',
					),
					'dependency' => array( 'disable-car-time-slots', '==', '1' ),
				),
				
			),
		),

		//Frontend Dashboard
		'frontend_dashboard'    => array(
			'title'  => __( 'Frontend Dashboard', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa-solid fa-gauge-high',
			'fields' => array(
				//logo
				array(
					'id'           => '',
					'type'         => 'image',
					'label'        => __( 'Dashboard Logo', 'tourfic' ),
					'library'      => 'image',
					'placeholder'  => 'http://',
					'button_title' => __( 'Add Image', 'tourfic' ),
					'remove_title' => __( 'Remove Image', 'tourfic' ),
					'is_pro'       => true,
				),
				//minified logo
				array(
					'id'           => '',
					'type'         => 'image',
					'label'        => __( 'Minified Logo', 'tourfic' ),
					'library'      => 'image',
					'placeholder'  => 'http://',
					'button_title' => __( 'Add Image', 'tourfic' ),
					'remove_title' => __( 'Remove Image', 'tourfic' ),
					'is_pro'       => true,
				),
				//mobile logo
				array(
					'id'           => '',
					'type'         => 'image',
					'label'        => __( 'Mobile Logo', 'tourfic' ),
					'library'      => 'image',
					'placeholder'  => 'http://',
					'button_title' => __( 'Add Image', 'tourfic' ),
					'remove_title' => __( 'Remove Image', 'tourfic' ),
					'is_pro'       => true,
				),
			),
		),
		//user options
		'user_options'          => array(
			'title'  => __( 'User Options', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fas fa-user',
			'fields' => array(
				array(
					'id'   => 'tf_user_permission',
					'type' => 'tab',
					'tabs' => array(
						array(
							'id'     => 'vendor_permission',
							'title'  => 'Vendor Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'user-option-notice',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/user-option/", array( 'utm_medium' => 'settings_doc_user-option' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Vendor Can Add Post', 'tourfic' ),
									'subtitle' => __( 'Choose the post type you wish to enable for vendor contributions.', 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'hotel'     => __( 'Hotel', 'tourfic' ),
										'tour'      => __( 'Tour', 'tourfic' ),
										'apartment' => __( 'Apartment', 'tourfic' ),
									),
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Vendor Can Add Taxonomy', 'tourfic' ),
									'subtitle' => __( 'Choose the Taxonomy you wish to enable for vendor contributions.', 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'hotel_location'     => __( 'Hotel Location', 'tourfic' ),
										'hotel_feature'      => __( 'Hotel Feature', 'tourfic' ),
										'hotel_type'         => __( 'Hotel Type', 'tourfic' ),
										'tour_destination'   => __( 'Tour Destination', 'tourfic' ),
										'tour_attraction'    => __( 'Tour Attraction', 'tourfic' ),
										'tour_activities'    => __( 'Tour Activities', 'tourfic' ),
										'tour_features'      => __( 'Tour Features', 'tourfic' ),
										'tour_type'          => __( 'Tour Types', 'tourfic' ),
										'apartment_location' => __( 'Apartment Location', 'tourfic' ),
										'apartment_feature'  => __( 'Apartment Feature', 'tourfic' ),
										'apartment_type'     => __( 'Apartment Types', 'tourfic' ),
									),
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Vendor Can Manage Options', 'tourfic' ),
									'subtitle' => __( 'Choose the capabilities you wish to grant vendors for management.', 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'view_hotel_enquiry'     => __( 'View Hotel Enquiry', 'tourfic' ),
										'view_hotel_booking'     => __( 'View Hotel Booking', 'tourfic' ),
										'add_hotel_booking'      => __( 'Add Hotel Booking', 'tourfic' ),
										'view_tour_enquiry'      => __( 'View Tour Enquiry', 'tourfic' ),
										'view_tour_booking'      => __( 'View Tour Booking', 'tourfic' ),
										'add_tour_booking'       => __( 'Add Tour Booking', 'tourfic' ),
										'view_apartment_enquiry' => __( 'View Apartment Enquiry', 'tourfic' ),
										'view_apartment_booking' => __( 'View Apartment Booking', 'tourfic' ),
										'view_commission'        => __( 'View Commission', 'tourfic' ),
										'view_payout'            => __( 'View Payout', 'tourfic' ),
										'qr_code'                => esc_html__( 'QR Code Verification', 'tourfic' ),
										'enquiry_email'          => esc_html__( 'Access Enquiry Email', 'tourfic' ),
										'external_booking'       => esc_html__( 'External Booking', 'tourfic' ),
									),
								),
							)
						),
						array(
							'id'     => 'manager_permission',
							'title'  => 'Manager Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'user-option-notice',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/user-option/", array( 'utm_medium' => 'settings_doc_user-option' )) . '" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Manager Can Add Post', 'tourfic' ),
									'subtitle' => __( "Choose the post type you wish to enable for your Manager's contributions.", 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'hotel'     => __( 'Hotel', 'tourfic' ),
										'tour'      => __( 'Tour', 'tourfic' ),
										'apartment' => __( 'Apartment', 'tourfic' ),
									),
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Manager Can Add Taxonomy', 'tourfic' ),
									'subtitle' => __( "Choose the Taxonomy you wish to enable for your Manager's contributions.", 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'hotel_location'     => __( 'Hotel Location', 'tourfic' ),
										'hotel_feature'      => __( 'Hotel Feature', 'tourfic' ),
										'hotel_type'         => __( 'Hotel Type', 'tourfic' ),
										'tour_destination'   => __( 'Tour Destination', 'tourfic' ),
										'tour_attraction'    => __( 'Tour Attraction', 'tourfic' ),
										'tour_activities'    => __( 'Tour Activities', 'tourfic' ),
										'tour_features'      => __( 'Tour Features', 'tourfic' ),
										'tour_type'          => __( 'Tour Types', 'tourfic' ),
										'apartment_location' => __( 'Apartment Location', 'tourfic' ),
										'apartment_feature'  => __( 'Apartment Feature', 'tourfic' ),
										'apartment_type'     => __( 'Apartment Types', 'tourfic' ),
									),
								),
								array(
									'id'       => '',
									'type'     => 'checkbox',
									'label'    => __( 'Manager Can Manage Options', 'tourfic' ),
									'subtitle' => __( "Choose the Options you wish to enable for your Manager's contributions.", 'tourfic' ),
									'is_pro'      => true,
									'options'  => array(
										'view_hotels'            => __( 'View Hotels', 'tourfic' ),
										'approve_hotel'          => __( 'Approve Hotel', 'tourfic' ),
										'add_hotel'              => __( 'Add Hotel', 'tourfic' ),
										'edit_hotel'             => __( 'Edit Hotel', 'tourfic' ),
										'delete_hotel'           => __( 'Delete Hotel', 'tourfic' ),
										'view_tours'             => __( 'View Tours', 'tourfic' ),
										'approve_tour'           => __( 'Approve Tour', 'tourfic' ),
										'add_tour'               => __( 'Add Tour', 'tourfic' ),
										'edit_tour'              => __( 'Edit Tour', 'tourfic' ),
										'delete_tour'            => __( 'Delete Tour', 'tourfic' ),
										'approve_apartment'      => __( 'Approve Apartment', 'tourfic' ),
										'add_apartment'          => __( 'Add Apartment', 'tourfic' ),
										'edit_apartment'         => __( 'Edit Apartment', 'tourfic' ),
										'delete_apartment'       => __( 'Delete Apartment', 'tourfic' ),
										'view_vendors'           => __( 'View Vendors', 'tourfic' ),
										'approve_vendor'         => __( 'Approve Vendor', 'tourfic' ),
										'add_vendor'             => __( 'Add Vendor', 'tourfic' ),
										'edit_vendor'            => __( 'Edit Vendor', 'tourfic' ),
										'delete_vendor'          => __( 'Delete Vendor', 'tourfic' ),
										'approve_payout'         => __( 'Approve Payout', 'tourfic' ),
										'add_payout'             => __( 'Add Payout', 'tourfic' ),
										'edit_payout'            => __( 'Edit Payout', 'tourfic' ),
										'view_hotel_enquiry'     => __( 'View Hotel Enquiry', 'tourfic' ),
										'view_hotel_booking'     => __( 'View Hotel Booking', 'tourfic' ),
										'add_hotel_booking'      => __( 'Add Hotel Booking', 'tourfic' ),
										'view_tour_enquiry'      => __( 'View Tour Enquiry', 'tourfic' ),
										'view_tour_booking'      => __( 'View Tour Booking', 'tourfic' ),
										'add_tour_booking'       => __( 'Add Tour Booking', 'tourfic' ),
										'view_apartment_enquiry' => __( 'View Apartment Enquiry', 'tourfic' ),
										'view_apartment_booking' => __( 'View Apartment Booking', 'tourfic' ),
										'view_commission'        => __( 'View Commission', 'tourfic' ),
										'view_payout'            => __( 'View Payout', 'tourfic' ),
									),
								),
							)
						),
					)
				),
			)
		),
		// Multi Vendor
		'vendor'                => array(
			'title'  => __( 'Multi Vendor', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-handshake',
			'fields' => array(
				array(
					'id'   => 'multi-vendor-setings',
					'type' => 'tab',
					'tabs' => array(
						array(
							'id'     => 'general-setting',
							'title'  => 'General Options',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'       => 'vendor-reg',
									'type'     => 'switch',
									'label'    => __( 'Enable Vendor Registration', 'tourfic' ),
									'subtitle' => __( 'Visitor can register as vendor using the registration form', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'       => 'user_approval',
									'type'     => 'switch',
									'label'    => __( 'Automatic Approval', 'tourfic' ),
									'subtitle' => __( 'Partner be automatic approval (register account).', 'tourfic' ),
									'is_pro'   => true,
								),
								/*array(
									'id'        => 'reg-pop',
									'type'      => 'switch',
									'label'     => __( 'Registration Form Popup', 'tourfic' ),
									'subtitle'  => __( 'Add class <code>tf-reg-popup</code> to trigger the popup', 'tourfic' ),
									'is_pro'   => true,
								),*/

								array(
									'id'      => 'notice',
									'type'    => 'notice',
									'content' => wp_kses(__( 'Use shortcode <code>[tf_registration_form]</code> to show registration form in post/page/widget.', 'tourfic' ), Helper::tf_custom_wp_kses_allow_tags() ),
								),
								array(
									'id'       => 'email-verify',
									'type'     => 'switch',
									'label'    => __( 'Email Verification', 'tourfic' ),
									'subtitle' => __( 'ON: Vendor must verify by email', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'       => 'partner_post',
									'type'     => 'switch',
									'label'    => __( "Partner's Post Must be Approved by Admin", 'tourfic' ),
									'subtitle' => __( 'ON: When partner posts a service, it needs to be approved by administrator ', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'      => 'notice_shortcode',
									'type'    => 'notice',
									'content' => wp_kses(__( 'Use shortcode <code>[tf_login_form]</code> to show login form in post/page/widget.', 'tourfic' ), Helper::tf_custom_wp_kses_allow_tags() ),
								),
								array(
									'id'         => 'partner_commission',
									'type'       => 'number',
									'label'      => __( 'Commission(%)', 'tourfic' ),
									'subtitle'   => __( 'Enter commission of partner for admin after each item is booked ', 'tourfic' ),
									'attributes' => array(
										'min' => '0',
									),
									'is_pro'     => true,
								),
								array(
									'id'      => 'pabbly-title',
									'type'    => 'heading',
									'content' => __( 'Pabbly', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'vendor-integrate-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for New Vendor Registration?', 'tourfic' ),
									'subtitle'  => __( 'You can able to Integrate Pabbly with New Vendor Registration.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'vendor-integrate-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Vendor Registration Web Hook', 'tourfic' ),
									'subtitle'   => __( 'Enter Here Your Vendor Registration Pabbly Web Hook.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'vendor-integrate-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'      => 'zapier-title',
									'type'    => 'heading',
									'content' => __( 'Zapier', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'vendor-integrate-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for New Vendor Registration?', 'tourfic' ),
									'subtitle'  => __( 'You can able to Integrate Zapier with New Vendor Registration.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'vendor-integrate-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Vendor Registration Web Hook', 'tourfic' ),
									'subtitle'   => __( 'Enter Here Your Vendor Registration Zapier Web Hook.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'vendor-integrate-zapier', '==', 'true' ),
									),
								),
							),
						),
						array(
							'id'     => 'layout-setting',
							'title'  => 'Vendor Dashboard',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'       => 'vendor-config',
									'type'     => 'switch',
									'label'    => __( 'Configuration Partner Profile info', 'tourfic' ),
									'subtitle' => __( 'Show/hide sections for partner dashboard', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'       => 'vendor-earning',
									'type'     => 'switch',
									'label'    => __( 'Show total Earning', 'tourfic' ),
									'subtitle' => __( 'ON: Display earnings information in accordance with time periods', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'       => 'vendor-each-earning',
									'type'     => 'switch',
									'label'    => __( 'Show each service Earning', 'tourfic' ),
									'subtitle' => __( 'ON: Display earnings according to each service', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'       => 'vendor-earning-chart',
									'type'     => 'switch',
									'label'    => __( 'Show Chart info', 'tourfic' ),
									'subtitle' => __( 'ON: Display visual graphs to follow your earnings through each time', 'tourfic' ),
									'is_pro'   => true,
								),
							),
						),
						array(
							'id'     => 'withdraw-setting',
							'title'  => 'Withdrawal Options',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'       => 'vendor-withdraw',
									'type'     => 'switch',
									'label'    => __( 'Allow Request Withdrawal', 'tourfic' ),
									'subtitle' => __( 'ON: Partner is allowed to withdraw money', 'tourfic' ),
									'is_pro'   => true,
								),
								array(
									'id'         => 'vendor_min_withdraw',
									'type'       => 'number',
									'label'      => __( 'Minimum value request when withdrawal', 'tourfic' ),
									'subtitle'   => __( 'Enter minimum value when a withdrawal is conducted', 'tourfic' ),
									'attributes' => array(
										'min' => '0',
									),
									'is_pro'     => true,
								),
								array(
									'id'         => 'vendor_withdraw_date',
									'type'       => 'number',
									'label'      => __( 'Date of sucessful payment in current month', 'tourfic' ),
									'subtitle'   => __( 'Enter the date monthly payment. Ex: 25', 'tourfic' ),
									'attributes' => array(
										'min' => '1',
										'max' => '28',
									),
									'is_pro'     => true,
								),
							),
						),
					),
				),
			),
		),
		// Search Options
		'search'                => array(
			'title'  => __( 'Search', 'tourfic' ),
			'icon'   => 'fas fa-search',
			'fields' => array(
				array(
					'id'      => 'search-option-heading',
					'type'    => 'heading',
					'label' => __( 'Search Page Settings', 'tourfic' ),
					'subtitle'   => __( 'These settings apply to the search result page of Hotels/Tours/Apartments.', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'      => 'search-option-notice',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/search-page/", array( 'utm_medium' => 'settings_doc_search-page' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				// Registration
				array(
					'id'          => 'search-result-page',
					'type'        => 'select2',
					'placeholder' => __( 'Select a page', 'tourfic' ),
					'label'       => __( 'Select Search Result Page', 'tourfic' ),
					'description' => __( 'This page will be used to show the Search form Results. Please make sure Page template: <code>Tourfic - Search Result</code> is selected while creating this page.', 'tourfic' ),
					'options'     => 'posts',
					'query_args'  => array(
						'post_type'      => 'page',
						'posts_per_page' => - 1,
					),
					'default'     => !empty( get_option( 'tf_search_page_id	' ) ) ? get_option( 'tf_search_page_id	' ) : tf_search_page_default(),
				),

				array(
					'id'       => 'posts_per_page',
					'type'     => 'number',
					'label'    => __( 'Search Items to show per page', 'tourfic' ),
					'subtitle' => __( 'Add the total number of hotels/tours/apartments you want to show per page on the Search result.', 'tourfic' ),
					'default'  => 8,
				),

				array(
					'id'       => 'hotel_search_heading',
					'type'     => 'heading',
					'label'    => __( 'Hotel Search', 'tourfic' ),
				),
				array(
					'id'        => 'date_hotel_search',
					'type'      => 'switch',
					'label'     => __( 'Date Required in Hotel Search', 'tourfic' ),
					'subtitle'  => __( 'Activate this feature to enable users to pick their check-in and check-out dates for searching.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true,
				),
				array(
					'id'        => 'disable_hotel_child_search',
					'type'      => 'switch',
					'label'     => __( 'Disable Child in Hotel Search', 'tourfic' ),
					'subtitle'  => __( 'Turn on this setting to hide the child option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 'required_location_hotel_search',
					'type'      => 'switch',
					'label'     => __( ' Location Required in Hotel Search', 'tourfic' ),
					'subtitle'  => __( 'Enable this setting to make the location field required for the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true,
				),
				array(
					'id'        => 'hide_hotel_location_search',
					'type'      => 'switch',
					'label'     => __( 'Hide Location in Hotel Search', 'tourfic' ),
					'subtitle'  => __( 'Enable this setting to hide the location option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false,
					'dependency' => array( "required_location_hotel_search", "==", "false")
				),
				array(
					'id'       => 'tour_search_heading',
					'type'     => 'heading',
					'label'    => __( 'Tour Search', 'tourfic' ),
				),
				array(
					'id'        => 'date_tour_search',
					'type'      => 'switch',
					'label'     => __( 'Date Required in Tour Search', 'tourfic' ),
					'subtitle'  => __( 'Activate this feature to enable users to pick their check-in and check-out dates for searching.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true,
				),
				array(
					'id'        => 'disable_child_search',
					'type'      => 'switch',
					'label'     => __( 'Disable Child in Tour Search', 'tourfic' ),
					'subtitle'  => __( 'Turn on this setting to hide the child option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 'disable_infant_search',
					'type'      => 'switch',
					'label'     => __( 'Disable Infant in Tour Search', 'tourfic' ),
					'subtitle'  => __( 'Turn on this setting to hide the infant option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 'required_location_tour_search',
					'type'      => 'switch',
					'label'     => __( ' Location Required in Tour Search', 'tourfic' ),
					'subtitle'  => __( 'Enable this setting to make the location field required for the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true,
				),
				array(
					'id'        => 'hide_tour_location_search',
					'type'      => 'switch',
					'label'     => __( 'Hide Location in Tour Search', 'tourfic' ),
					'subtitle'  => __( 'Enable this setting to hide the location option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => false,
					'dependency' => array( "required_location_tour_search", "==", "false")
				),
				array(
					'id'       => 'apartment_search_heading',
					'type'     => 'heading',
					'label'    => __( 'Apartment Search', 'tourfic' ),
				),
				array(
					'id'        => 'date_apartment_search',
					'type'      => 'switch',
					'label'     => __( 'Date Required in Apartment Search', 'tourfic' ),
					'subtitle'  => __( 'Activate this feature to enable users to pick their check-in and check-out dates for searching.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 'disable_apartment_child_search',
					'type'      => 'switch',
					'label'     => __( 'Disable Child in Apartment Search', 'tourfic' ),
					'subtitle'  => __( 'Turn on this setting to hide the child option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'        => 'disable_apartment_infant_search',
					'type'      => 'switch',
					'label'     => __( 'Disable Infant in Apartment Search', 'tourfic' ),
					'subtitle'  => __( 'Turn on this setting to hide the infant option from the search form.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),
				array(
					'id'       => 'car_search_heading',
					'type'     => 'heading',
					'label'    => __( 'Car Search', 'tourfic' ),
				),
				array(
					'id'        => 'pick_drop_car_search',
					'type'      => 'switch',
					'label'     => __( 'Pickup & Dropoff Location Required in Car Search', 'tourfic' ),
					'subtitle'  => __( 'Activate this feature to enable users to pick their pickup and dropoff Location for searching.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true
				),
				array(
					'id'        => 'pick_drop_date_car_search',
					'type'      => 'switch',
					'label'     => __( 'Pickup & Dropoff Date Required in Car Search', 'tourfic' ),
					'subtitle'  => __( 'Activate this feature to enable users to pick their pickup and dropoff Date for searching.', 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
					'default'   => true
				),
			),
		),

		// Miscellaneous Options
		'miscellaneous'         => array(
			'title'  => __( 'Miscellaneous', 'tourfic' ),
			'icon'   => 'fas fa-globe',
			'fields' => array(),
		),
		/**
		 * Login Register Settings
		 *
		 * Sub Menu
		 */
		'login_register'        => array(
			'title'  => __( 'Login & Register', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fas fa-user',
			'fields' => array(
				array(
					'id'   => 'log_reg_settings',
					'type' => 'tab',
					'tabs' => array(
						array(
							'id'     => 'login-setting',
							'title'  => 'Login Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'loginsettings-official-docs',
									'type'    => 'notice',
									'style'   => 'success',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.  Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/", array( 'utm_medium' => 'settings_doc_miscellaneous' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'         => '',
									'type'       => 'select',
									'options'    => 'posts',
									'query_args' => array(
										'post_type'      => 'page',
										'posts_per_page' => - 1,
									),
									'label'      => __( 'Login Page', 'tourfic' ),
									'subtitle'   => __( 'Choose a page to serve as the Login Page.', 'tourfic' ),
									'default'    => get_option( 'tf_login_page_id' ),
									'is_pro'     => true,
								),
								array(
									'id'          => '',
									'type'        => 'select',
									'label'       => __( 'Login Redirect Option', 'tourfic' ),
									'subtitle'    => __( 'Select the destination for users after they log in.', 'tourfic' ),
									'options'     => array(
										'page' => __( 'Page', 'tourfic' ),
										'url'  => __( 'Custom URL', 'tourfic' ),
									),
									'field_width' => '50',
									'is_pro'      => true,
								),
								array(
									'id'          => '',
									'type'        => 'select',
									'options'     => 'posts',
									'query_args'  => array(
										'post_type'      => 'page',
										'posts_per_page' => - 1,
									),
									'label'       => __( 'Choose your Page', 'tourfic' ),
									'subtitle'    => __( 'Select the destination page for users after they log in.', 'tourfic' ),
									'default'     => get_option( 'tf_dashboard_page_id' ),
									'field_width' => '50',
									'dependency'  => array( 'login_redirect_type', '==', 'page' ),
									'is_pro'      => true,
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'label'       => __( 'Insert Custom URL', 'tourfic' ),
									'subtitle'    => __( 'Enter the destination URL for users after they log in.', 'tourfic' ),
									'default'     => site_url() . '/tf-dashboard',
									'field_width' => '50',
									'dependency'  => array( 'login_redirect_type', '==', 'url' ),
									'is_pro'      => true,
								),
							),
						),
						array(
							'id'     => 'register-setting',
							'title'  => 'Register Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'registersettings-official-docs',
									'type'    => 'notice',
									'style'   => 'success',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.  Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/", array( 'utm_medium' => 'settings_doc_miscellaneous' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'         => '',
									'type'       => 'select',
									'options'    => 'posts',
									'query_args' => array(
										'post_type'      => 'page',
										'posts_per_page' => - 1,
									),
									'label'      => __( 'Registration Page', 'tourfic' ),
									'subtitle'   => __( 'Choose a page that will be used as the Registration Page.', 'tourfic' ),
									'default'    => get_option( 'tf_register_page_id' ),
									'is_pro'     => true,
								),
								array(
									'id'          => '',
									'type'        => 'select',
									'label'       => __( 'Registration Redirect Option', 'tourfic' ),
									'subtitle'    => __( 'Select the destination for users after they register.', 'tourfic' ),
									'options'     => array(
										'page' => __( 'Page', 'tourfic' ),
										'url'  => __( 'Custom URL', 'tourfic' ),
									),
									'field_width' => '50',
									'is_pro'      => true,
								),
								array(
									'id'          => '',
									'type'        => 'select',
									'options'     => 'posts',
									'query_args'  => array(
										'post_type'      => 'page',
										'posts_per_page' => - 1,
									),
									'label'       => __( 'Choose your Page', 'tourfic' ),
									'subtitle'    => __( 'Select the destination page for users after they log in.', 'tourfic' ),
									'default'     => get_option( 'tf_login_page_id' ),
									'field_width' => '50',
									'dependency'  => array( 'register_redirect_type', '==', 'page' ),
									'is_pro'      => true,
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'label'       => __( 'Insert Custom URL', 'tourfic' ),
									'subtitle'    => __( 'Enter the destination URL for users after they log in.', 'tourfic' ),
									'default'     => site_url() . '/tf-login',
									'field_width' => '50',
									'dependency'  => array( 'register_redirect_type', '==', 'url' ),
									'is_pro'      => true,
								),
							),
						),
						array(
							'id'     => 'social-login-setting',
							'title'  => 'Social Login Options',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'       => '',
									'type'     => 'switch',
									'label'    => __( 'Setup Google Login', 'tourfic' ),
									'subtitle' => __( 'If enabled, vendors will have the option to log in using Google.', 'tourfic' ),
									'badge_up' => true,
									'is_pro'   => true,
								),
								array(
									'id'         => '',
									'type'       => 'text',
									'label'      => __( 'Google App Client ID', 'tourfic' ),
									'subtitle'   => __( 'Enter the App ID', 'tourfic' ),
									'dependency' => array(
										array( 'vendor-google-login', '==', true ),
									),
									'badge_up'   => true,
									'is_pro'     => true,
								),
								array(
									'id'         => '',
									'type'       => 'text',
									'label'      => __( 'Google App Client Secret', 'tourfic' ),
									'subtitle'   => __( 'Enter the App Secret', 'tourfic' ),
									'dependency' => array(
										array( 'vendor-google-login', '==', true ),
									),
									'badge_up'   => true,
									'is_pro'     => true,
								),
								array(
									'id'         => '',
									'type'       => 'text',
									'label'      => __( 'Google Redirect URI', 'tourfic' ),
									'subtitle'   => __( 'Enter the Redirect URI', 'tourfic' ),
									'dependency' => array(
										array( 'vendor-google-login', '==', true ),
									),
									'badge_up'   => true,
									'is_pro'     => true,
								),
							),
						),
						array(
							'id'     => 'registration-fields',
							'title'  => 'Custom Registration Fields',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'customfield-official-docs',
									'type'    => 'notice',
									'style'   => 'success',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="' . Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/", array( 'utm_medium' => 'settings_doc_miscellaneous' )) . '" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'           => '',
									'class'        => 'disable-sortable',
									'type'         => 'repeater',
									'button_title' => __( 'Add New', 'tourfic' ),
									'label'        => __( 'Registration Fields for Vendor', 'tourfic' ),
									'subtitle'     => __( 'Design custom registration fields for vendor sign-up. Custom fields are permitted.', 'tourfic' ),
									'is_pro'       => true,
									'fields'       => array(
										array(
											'id'    => 'reg-field-label',
											'type'  => 'text',
											'label' => __( 'Label', 'tourfic' ),
										),
										array(
											'id'       => 'reg-field-name',
											'type'     => 'text',
											'label'    => __( 'Name', 'tourfic' ),
											'subtitle' => __( 'Space Not allowed (Ex: tf_name)', 'tourfic' ),
											'validate' => 'no_space_no_special',
										),
										array(
											'id'      => 'reg-fields-type',
											'type'    => 'select',
											'label'   => __( 'Field Type', 'tourfic' ),
											'options' => array(
												'text'     => __( 'Text', 'tourfic' ),
												'email'    => __( 'Email', 'tourfic' ),
												'password' => __( 'Password', 'tourfic' ),
												'textarea' => __( 'Textarea', 'tourfic' ),
												'radio'    => __( 'Radio', 'tourfic' ),
												'checkbox' => __( 'Checkbox', 'tourfic' ),
												'select'   => __( 'Select', 'tourfic' ),
											),
										),
										array(
											'id'           => 'radio-reg-options',
											'type'         => 'repeater',
											'button_title' => __( 'Add New Option', 'tourfic' ),
											'label'        => __( 'Option Label', 'tourfic' ),
											'dependency'   => array(
												array( 'reg-fields-type', '==', 'radio' ),
											),
											'field_title'  => 'option-label',
											'fields'       => array(
												array(
													'label' => __( 'Field Label', 'tourfic' ),
													'id'    => 'option-label',
													'type'  => 'text',
												),
												array(
													'label' => __( 'Field Value', 'tourfic' ),
													'id'    => 'option-value',
													'type'  => 'text',
												),
											),
										),
										array(
											'id'           => 'select-reg-options',
											'type'         => 'repeater',
											'button_title' => __( 'Add New Option', 'tourfic' ),
											'label'        => __( 'Option Label', 'tourfic' ),
											'dependency'   => array(
												array( 'reg-fields-type', '==', 'select' ),
											),
											'field_title'  => 'option-label',
											'fields'       => array(
												array(
													'label' => __( 'Field Label', 'tourfic' ),
													'id'    => 'option-label',
													'type'  => 'text',
												),
												array(
													'label' => __( 'Field Value', 'tourfic' ),
													'id'    => 'option-value',
													'type'  => 'text',
												),
											),
										),
										array(
											'id'           => 'checkbox-reg-options',
											'type'         => 'repeater',
											'button_title' => __( 'Add New Option', 'tourfic' ),
											'label'        => __( 'Option Label', 'tourfic' ),
											'dependency'   => array(
												array( 'reg-fields-type', '==', 'checkbox' ),
											),
											'field_title'  => 'option-label',
											'fields'       => array(
												array(
													'label' => __( 'Field Label', 'tourfic' ),
													'id'    => 'option-label',
													'type'  => 'text',
												),
												array(
													'label' => __( 'Field Value', 'tourfic' ),
													'id'    => 'option-value',
													'type'  => 'text',
												),
											),
										),
										array(
											'id'    => 'reg-field-placeholder',
											'type'  => 'text',
											'label' => __( 'Placeholder', 'tourfic' ),
										),
										array(
											'id'    => 'reg-field-required',
											'type'  => 'switch',
											'label' => __( 'Required Field ?', 'tourfic' ),
										),

									),
								),
							),
						),
					),
				),
			)
		),
		/**
		 * Google Map
		 *
		 * Sub Menu
		 */
		'map_settings'          => array(
			'title'  => __( 'Map Settings', 'tourfic' ),
			'parent' => 'miscellaneous',
			'icon'   => 'fas fa-umbrella-beach',
			'fields' => array(
				array(
					'id'      => 'map_settings_heading',
					'type'    => 'heading',
					'content' => __( 'Map Settings', 'tourfic' )
				),
				array(
					'id'       => 'google-page-option',
					'type'     => 'select',
					'label'    => __( 'Select Map', 'tourfic' ),
					'subtitle' => __( 'This map is used to dynamically search your hotel/tour location on the option panel. The frontend map information is based on this data. We use "OpenStreetMap” by default. You can also use Google Map. To use Google map, you need to insert your Google Map API Key.', 'tourfic' ),
					'options'  => array(
						'default' => __( 'Default Map', 'tourfic' ),
						''        => __( 'Google Map (Pro)', 'tourfic' ),
					),
					'default'  => 'default'
				),
				array(
					'id'          => '',
					'type'        => 'text',
					'label'       => __( 'Google Map API Key', 'tourfic' ),
					'placeholder' => __( 'Enter Google Map API Key', 'tourfic' ),
					'dependency'  => array(
						array( 'google-page-option', '==', 'googlemap' ),
					),
					'is_pro'     => true,
				)
			),
		),
		/**
		 * Wishlist
		 *
		 * Sub Menu
		 */
		'wishlist'              => array(
			'title'  => __( 'Wishlist', 'tourfic' ),
			'parent' => 'miscellaneous',
			'icon'   => 'fas fa-heart',
			'fields' => array(
				array(
					'id'      => 'wishlist_heading',
					'type'    => 'heading',
					'label' => __( 'Wishlist Settings', 'tourfic' ),
					'subtitle' => __( 'The wishlist feature enables customers to curate a collection of hotels, tours, and apartments they are interested in or plan to book in the future.', 'tourfic' ),
				),
				array(
					'id'      => 'wishlistsettings-official-docs',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/#wishlist-settings", array( 'utm_medium' => 'settings_doc_miscellaneous_wishlist' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),

				array(
					'id'      => 'wl-for',
					'type'    => 'checkbox',
					'label'   => __( 'Enable Wishlist for', 'tourfic' ),
					'options' => array(
						'li' => __( 'Logged in User', 'tourfic' ),
						'lo' => __( 'Logged out User', 'tourfic' ),
					),
					'default' => array( 'li', 'lo' )
				),

				array(
					'id'      => 'wl-bt-for',
					'type'    => 'checkbox',
					'label'   => __( 'Show Wishlist Button on', 'tourfic' ),
					'options' => array(
						'1' => __( 'Single Hotel Page', 'tourfic' ),
						'2' => __( 'Single Tour Page', 'tourfic' ),
						'3' => __( 'Single Apartment Page', 'tourfic' ),
					),
					'default' => array( '1', '2', '3' ),
				),

				array(
					'id'          => 'wl-page',
					'type'        => 'select2',
					'label'       => __( 'Select Wishlist Page', 'tourfic' ),
					'subtitle' => __( 'Choose a page to serve as the wishlist Page.', 'tourfic' ),
					'placeholder' => __( 'Select Wishlist Page', 'tourfic' ),
					'options'     => 'posts',
					'query_args'  => array(
						'post_type'      => 'page',
						'posts_per_page' => - 1,
						'orderby'        => 'post_title',
						'order'          => 'ASC'
					),
					'default' => !empty( get_option('tf_wishlist_page_id') ) ? get_option('tf_wishlist_page_id') : tf_wishlist_page_default(),
				),
			),
		),

		/**
		 * Permalink Settings
		 *
		 * Sub Menu
		 */

		'permalink' => array(
			'title'  => __( 'Permalink Settings', 'tourfic' ),
			'icon'   => 'fas fa-link',
			'fields' => array(
				array(
					'id'      => 'permalink_heading',
					'type'    => 'heading',
					'label' => __( 'Permalink Settings', 'tourfic' ),
					'subtitle' => __( 'Select the URL structure for your Hotels, Tours, and Apartments listings.', 'tourfic' ),
				),
				array(
					'id'      => 'permalink_notice',
					'type'    => 'notice',
					'content' => __( 'Anything confusing? <a href="' .  Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/#permalink-settings", array( 'utm_medium' => 'settings_doc_miscellaneous_permalink' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>Read Documentation</strong></a>', 'tourfic' ),
				),

				array(
					'id'       => 'tour-permalink-setting',
					'type'     => 'text',
					'label'    => __( 'Tour Permalink', 'tourfic' ),
					'subtitle' => __( 'Enter a permalink for your tour archive page.', 'tourfic' ),
					'default' => "tours",
					'placeholder' => !empty(get_option("tour_slug")) ? get_option("tour_slug") : "tours",
					
				),
				array(
					'id'       => 'hotel-permalink-setting',
					'type'     => 'text',
					'label'    => __( 'Hotel Permalink', 'tourfic' ),
					'subtitle' => __( 'Enter a permalink for your hotel archive page.', 'tourfic' ),
					'default' => "hotels",
					'placeholder' => ! empty(get_option("hotel_slug")) ? get_option("hotel_slug") : "hotels",
				),
				array(
					'id'       => 'apartment-permalink-setting',
					'type'     => 'text',
					'label'    => __( 'Apartment Permalink', 'tourfic' ),
					'subtitle' => __( 'Enter a permalink for your apartment archive page.', 'tourfic' ),
					'default' => "apartments",
					'placeholder' => ! empty(get_option("apartment_slug")) ? get_option("apartment_slug") : "apartments",
				),
				array(
					'id'       => 'car-permalink-setting',
					'type'     => 'text',
					'label'    => __( 'Car Permalink', 'tourfic' ),
					'subtitle' => __( 'Enter a permalink for your car archive page.', 'tourfic' ),
					'default' => "cars",
					'placeholder' => ! empty(get_option("car_slug")) ? get_option("car_slug") : "cars",
				),
			),
		),
		/**
		 * Review
		 *
		 * Sub Menu
		 */

		'review'       => array(
			'title'  => __( 'Review', 'tourfic' ),
			'parent' => 'miscellaneous',
			'icon'   => 'fas fa-star',
			'fields' => array(
				array(
					'id'      => 'review_heading',
					'type'    => 'heading',
					'label' => __( 'Review Settings', 'tourfic' ),
					'subtitle' => __( 'Configure your Hotel/Tour/Apartment Customer Review Section through this settings panel.', 'tourfic' ),
				),
				array(
					'id'      => 'review-settings-official-docs',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-miscellaneous/#review-settings", array( 'utm_medium' => 'settings_doc_miscellaneous_review' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'      => 'r-for',
					'type'    => 'checkbox',
					'label'   => __( 'Enable Review for', 'tourfic' ),
					'options' => array(
						'li' => __( 'Logged in User', 'tourfic' ),
						''   => __( 'Logged out User (Pro)', 'tourfic' ),
					),
					'default' => array( 'li' ),
				),

				array(
					'id'        => 'r-auto-publish',
					'type'      => 'switch',
					'label'     => __( 'Auto Publish Review', 'tourfic' ),
					'subtitle'  => __( "Reviews will be set to pending by default, awaiting administrative approval. However, if enabled, reviews will be automatically published without requiring the admin's approval.", 'tourfic' ),
					'label_on'  => __( 'Yes', 'tourfic' ),
					'label_off' => __( 'No', 'tourfic' ),
				),

				array(
					'id'      => 'r-base',
					'type'    => 'radio',
					'label'   => __( 'Review Parameter', 'tourfic' ),
					'subtitle' => __( 'Select the option to calculate reviews on a scale of either 5 or 10.', 'tourfic' ),
					'options' => array(
						'5'  => __( '5', 'tourfic' ),
						'10' => __( '10', 'tourfic' ),
					),
					'default' => '5',
				),

				array(
					'id'       => 'r-hotel',
					'class'    => 'disable-sortable',
					'type'     => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'        => __( 'Review Fields for Hotels', 'tourfic' ),
					'subtitle'     => __( 'Design customer review fields for hotels. Custom fields are permitted.', 'tourfic' ),
					'max'      => '6',
					'drag_only'   => true,
					'field_title'  => 'r-field-type',
					'fields'   => array(
						array(
							'id'    => 'r-field-type',
							'type'  => 'text',
							'label' => __( 'Review for', 'tourfic' ),
						),

					),
					'default'  => array(
						array(
							'r-field-type' => __( 'Staff', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Facilities', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Cleanliness', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Comfort', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Value for money', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Location', 'tourfic' ),
						),
					)
				),
				array(
					'id'       => 'r-tour',
					'type'     => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'        => __( 'Review Fields for Tours', 'tourfic' ),
					'subtitle'     => __( 'Design customer review fields for tours. Custom fields are permitted.', 'tourfic' ),
					'max'      => '6',
					'drag_only'   => true,
					'field_title'  => 'r-field-type',
					'fields'   => array(

						array(
							'id'    => 'r-field-type',
							'type'  => 'text',
							'label' => __( 'Review for', 'tourfic' ),
						),

					),
					'default'  => array(
						array(
							'r-field-type' => __( 'Guide', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Transportation', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Value for money', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Safety', 'tourfic' ),
						),
					)
				),
				array(
					'id'       => 'r-apartment',
					'class'    => 'disable-sortable',
					'type'     => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'    => __( 'Review Fields for Apartments', 'tourfic' ),
					'subtitle' => __( 'Design customer review fields for apartments. Custom fields are permitted.', 'tourfic' ),
					'max'      => '6',
					'drag_only'   => true,
					'field_title'  => 'r-field-type',
					'fields'   => array(
						array(
							'id'    => 'r-field-type',
							'type'  => 'text',
							'label' => __( 'Review for', 'tourfic' ),
						),

					),
					'default'  => array(
						array(
							'r-field-type' => __( 'Staff', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Facilities', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Cleanliness', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Comfort', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Value for money', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Location', 'tourfic' ),
						),
					)
				),

				array(
					'id'       => 'r-car',
					'class'    => 'disable-sortable',
					'type'     => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'        => __( 'Review Fields for Cars', 'tourfic' ),
					'subtitle'     => __( 'Design customer review fields for cars. Custom fields are permitted.', 'tourfic' ),
					'max'      => '6',
					'drag_only'   => true,
					'field_title'  => 'r-field-type',
					'fields'   => array(
						array(
							'id'    => 'r-field-type',
							'type'  => 'text',
							'label' => __( 'Review for', 'tourfic' ),
						),

					),
					'default'  => array(
						array(
							'r-field-type' => __( 'Staff', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Facilities', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Cleanliness', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Comfort', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Value for money', 'tourfic' ),
						),
						array(
							'r-field-type' => __( 'Location', 'tourfic' ),
						),
					)
				),


				array(
					'id'       => 'tf_delete_old_review_fields_button',
					'type'     => 'callback',
					'function' => array( '\Tourfic\App\TF_Review', 'tf_delete_old_review_fields_button'),
				),
				array(
					'id'       => 'tf_delete_old_complete_review_button',
					'type'     => 'callback',
					'function' => array( '\Tourfic\App\TF_Review', 'tf_delete_old_complete_review_button' ),
				),

			),
		),
		/**
		 * optimization Settings
		 *
		 * Sub Menu
		 */
		'optimization' => array(
			'title'  => __( 'Optimization', 'tourfic' ),
			'parent' => 'miscellaneous',
			'icon'   => 'fas fa-star',
			'fields' => array(
				array(
					'id'      => 'optimization_heading',
					'type'    => 'heading',
					'label' => __( 'Minification Settings', 'tourfic' ),
					'subtitle'  => __( "Enhance your website's performance by activating the minification for the files listed below. After enabling each setting, please conduct a thorough test of your site to ensure that these changes do not negatively impact your website's functionality.", 'tourfic' ),
				),
				array(
					'id'      => 'optimize-settings-official-docs',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/optimization-settings/", array( 'utm_medium' => 'settings_doc_optimization' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'        => 'css_min',
					'type'      => 'switch',
					'label'     => __( 'Minify CSS', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Minification of CSS files included with Tourfic.', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
					'default'   => true,
				),

				array(
					'id'        => 'js_min',
					'type'      => 'switch',
					'label'     => __( 'Minify JS', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Minification of JS files included with Tourfic.', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
					'default'   => true,
				),

				array(
					'id'      => 'cdn_heading',
					'type'    => 'heading',
					'content' => __( 'CDN Settings', 'tourfic' ),
				),

				array(
					'id'        => 'ftpr_cdn',
					'type'      => 'switch',
					'label'     => __( 'Flatpickr CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Flatpickr CSS & JS', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),

				array(
					'id'        => 'fnybx_cdn',
					'type'      => 'switch',
					'label'     => __( 'Fancybox CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Fancybox CSS & JS', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),

				array(
					'id'        => 'slick_cdn',
					'type'      => 'switch',
					'label'     => __( 'Slick CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Slick CSS & JS', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),

				array(
					'id'        => 'fa_cdn',
					'type'      => 'switch',
					'label'     => __( 'Font Awesome CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Font Awesome CSS', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
				array(
					'id'        => 'select2_cdn',
					'type'      => 'switch',
					'label'     => __( 'Select2 CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Select2', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
				
				array(
					'id'        => 'remix_cdn',
					'type'      => 'switch',
					'label'     => __( 'Remix Icon CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Remix Icon', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
				
				array(
					'id'        => 'leaflet_cdn',
					'type'      => 'switch',
					'label'     => __( 'Leaflet CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Leaflet', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
				
				array(
					'id'        => 'swal_cdn',
					'type'      => 'switch',
					'label'     => __( 'jQuery Confirm CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for jQuery Confirm', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
				
				array(
					'id'        => 'chart_cdn',
					'type'      => 'switch',
					'label'     => __( 'Chart JS CDN', 'tourfic' ),
					'subtitle'  => __( 'Enable/disable Cloudflare CDN for Chart Js', 'tourfic' ),
					'label_on'  => __( 'Enabled', 'tourfic' ),
					'label_off' => __( 'Disabled', 'tourfic' ),
					'width'     => 100,
				),
			),
		),

		/**
		 * Affiliate Options
		 */
		'affiliate' => array(
			'title'  => __( 'Affiliate', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-handshake-o',
			'fields' => array(
				array(
					'id'       => 'affiliate_heading',
					'type'     => 'heading',
					'label'    => __( 'Affiliate Settings', 'tourfic' ),
					'subtitle' => __( 'Use these options if you want to show 3rd party data and earn commission from them. Currently, we only allow Booking.com and TravelPayout. Gradually more options would be added.', 'tourfic' ),
				),
				array(
					'id'       => 'tf-affiliate',
					'type'     => 'callback',
					'function' => array( '\Tourfic\Classes\Helper', 'tf_affiliate_callback' ),
				)
			),
		),

		// Email Settings
		'email-settings'          => array(
			'title'  => __( 'Email Settings', 'tourfic' ),
			'icon'   => 'fa fa-envelope',
			'fields' => array(),
		),

		//email template settings
		'email_templates' => array(
			'title'  => __( 'Email Templates', 'tourfic' ),
			'parent' => 'email-settings',
			'icon'   => 'fas fa-cogs',
			'fields' => array(
				array(
					'id'   => 'email-settings',
					'type' => 'tab',
					'label' => 'Email Templates',
					'subtitle'   => __( 'Tourfic provides a robust and sophisticated Email Template feature, enabling you to easily design and personalize impressive email templates for your business communications.', 'tourfic' ),
					'tabs' => array(
						array(
							'id'     => 'admin_emails',
							'title'  => __( 'Admin Email', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'fields' => array(
								//file upload
								array(
									'id'    => 'brand_logo',
									'type'  => 'image',
									'label' => __( 'Admin Email Logo', 'tourfic' ),
								),
								array(
									'id'      => 'send_notification',
									'type'    => 'select',
									'label'   => __( 'Send Notification', 'tourfic' ),
									'options' => array(
										'admin'        => __( 'Admin', 'tourfic' ),
										'admin_vendor' => __( 'Admin + Vendor', 'tourfic' ),
										'turn_off'     => __( 'Turn Off', 'tourfic' ),
									),
									'default' => 'admin',
								),
								array(
									'id'      => 'sale_notification_email',
									'type'    => 'text',
									'label'   => __( 'Sale Notification Email', 'tourfic' ),
									'default' => get_bloginfo( 'admin_email' ),
								),
								//enable disable admin email
								array(
									'id'      => 'admin_email_disable',
									'type'    => 'switch',
									'label'   => __( 'Disable Admin Email', 'tourfic' ),
									'default' => 'false',
								),
								//heading
								array(
									'id'    => 'admin_email_heading',
									'type'  => 'heading',
									'label' => __( 'Admin Email Setting', 'tourfic' ),
								),
								array(
									'id'      => 'admin_email_subject',
									'type'    => 'text',
									'label'   => __( 'Booking Email Subject', 'tourfic' ),
									'default' => __( 'New Tour Booking', 'tourfic' ),
								),
								array(
									'id'      => 'email_from_name',
									'type'    => 'text',
									'label'   => __( 'Email From Name', 'tourfic' ),
									'default' => get_bloginfo( 'name' ),
								),
								array(
									'id'      => 'email_from_email',
									'type'    => 'text',
									'label'   => __( 'Email From Email', 'tourfic' ),
									'default' => get_bloginfo( 'admin_email' ),
								),
								array(
									'id'      => 'order_email_heading',
									'type'    => 'text',
									'label'   => __( 'Order Email Heading', 'tourfic' ),
									'default' => __( 'You booking has been received', 'tourfic' ),
								),
								//type color
								array(
									'id'       => 'email_heading_bg',
									'type'     => 'color',
									'label'    => __( 'Email header background color', 'tourfic' ),
									'default'  => array(
										'bg_color' => '#0209AF'
									),
									'multiple' => true,
									'inline'   => true,
									'colors'   => array(
										'bg_color' => __( 'Background Color', 'tourfic' ),
									)
								),
								//email body
								array(
									'id'          => 'admin_booking_email_template',
									'type'        => 'editor',
									'label'       => __( 'Booking Confrimation Template', 'tourfic' ),
									'default'     => Tourfic\Admin\Emails\TF_Handle_Emails::get_email_template( 'order_confirmation', '', 'admin' ),
									'description' => __( 'This template will be sent to admin', 'tourfic' )
								),
							),
						),

						//customer email tab
						array(
							'id'     => 'customer-email',
							'title'  => __( 'Customer Email', 'tourfic' ),
							'icon'   => 'fa fa-envelope',
							'fields' => array(
								//disable customer email
								array(
									'id'      => 'customer_email_disable',
									'type'    => 'switch',
									'label'   => __( 'Disable Customer Email', 'tourfic' ),
									'default' => 'false',
								),
								array(
									'id'      => 'customer_confirm_email_subject',
									'type'    => 'text',
									'label'   => __( 'Booking Confirmation Email Subject', 'tourfic' ),
									'default' => __( 'Your booking has been confirmed', 'tourfic' ),
								),
								//from name
								array(
									'id'      => 'customer_from_name',
									'type'    => 'text',
									'label'   => __( 'Email From Name', 'tourfic' ),
									'default' => get_bloginfo( 'name' ),
								),
								//from email
								array(
									'id'      => 'customer_from_email',
									'type'    => 'text',
									'label'   => __( 'Email From Email', 'tourfic' ),
									'default' => get_bloginfo( 'admin_email' ),
								),
								array(
									'id'          => 'customer_confirm_email_template',
									'type'        => 'editor',
									'label'       => __( 'Booking Confirmation Email', 'tourfic' ),
									'default'     => \Tourfic\Admin\Emails\TF_Handle_Emails::get_email_template( 'order_confirmation', '', 'customer' ),
									'description' => __( 'This template will be sent to customer after booking is confirmed.', 'tourfic' ),
								),
							),
						),
					),
				),
				//notice field
				array(
					'id'      => 'notice',
					'type'    => 'notice',
					'class'   => 'info',
					'title'   => __( 'Email Shortcodes', 'tourfic' ),
					'content' => __( 'You can use the following placeholders in the email body:', 'tourfic' ) . '<br><br><strong>{order_id} </strong> : To display the booking ID.<br>
					<strong>{booking_id} </strong> : To display the booking ID.<br>
					<strong>{booking_date} </strong> : To display the booking date.<br>
					<strong>{fullname} </strong> : To display the customer name.<br>
					<strong>{user_email} </strong> : To display the customer email.<br>
					<strong>{phone} </strong> : To display the customer phone.<br>
					<strong>{address} </strong> : To display the customer address.<br>
					<strong>{city} </strong> : To display the customer city.<br>
					<strong>{country} </strong> : To display the customer country.<br>
					<strong>{zip} </strong> : To display the customer zip.<br>
					<strong>{booking_details} </strong> : To display the booking details.<br>
					<strong>{shipping_address} </strong> : To display the shipping address.<br>
					<strong>{shipping_method} </strong> : To display the shipping method.<br>
					<strong>{shipping_city} </strong> : To display the shipping city.<br>
					<strong>{shipping_country} </strong> : To display the shipping country.<br>
					<strong>{shipping_zip} </strong> : To display the shipping zip.<br>
					<strong>{order_total} </strong> : To display the total price.<br>
					<strong>{order_subtotal} </strong> : To display the subtotal price.<br>
					<strong>{order_date} </strong> : To display the order date.<br>
					<strong>{order_status} </strong> : To display the order status.<br>
					<strong>{payment_method} </strong> : To display the payment method.<br>
					<strong>{booking_url} </strong> : To display the booking url.<br>
					<strong>{site_name} </strong> : To display the site name.<br>
					<strong>{site_url} </strong> : To display the site url.<br>

					'

				,
				),
			),
		),

		//QR Code settings
		'qr_code' => array(
			'title'  => __( 'QR Code', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-qrcode',
			'fields' => array(
				array(
					'id'      => 'qr-code-title',
					'type'    => 'heading',
					'label'    => __( 'Tour QR Code', 'tourfic' ),
					'subtitle' => __( 'Configure the QR code generation for your tours here. This will allow for the creation of unique QR codes that can be scanned for tour information or check-ins.', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'      => 'qrcode-official-docs',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/qr-code/", array( 'utm_medium' => 'settings_doc_qr-code' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'    => 'qr_logo',
					'type'  => 'image',
					'label' => __( 'Company Logo', 'tourfic' ),
					'is_pro' => true,
				),
				array(
					'id'    => 'qr_background',
					'type'  => 'image',
					'label' => __( 'QR Code Watermark', 'tourfic' ),
					'is_pro' => true,
				),
				array(
					'id'      => 'qr-ticket-title',
					'type'    => 'text',
					'label'   => __( 'Voucher Title', 'tourfic' ),
					'default' => "Voucher ID",
					'is_pro'  => true,
				),
				array(
					'id'     => 'qr-ticket-prefix',
					'type'   => 'text',
					'label'  => __( 'Voucher ID Prefix', 'tourfic' ),
					'is_pro' => true,
				),
				array(
					'id'      => 'qr-ticket-content',
					'type'    => 'text',
					'label'   => __( 'Voucher Policy', 'tourfic' ),
					'default' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s.",
					'is_pro'  => true,
				),
				array(
					'id'      => 'qr-ticket-verify',
					'type'    => 'select',
					'label'   => __( 'QR Code Verification', 'tourfic' ),
					'options' => array(
						'1' => __( '1 Step', 'tourfic' ),
						'2' => __( '2 Steps', 'tourfic' ),
					),
					'default' => '2',
					'is_pro'  => true,
				),
			),
		),

		/**
		 * Integration
		 *
		 * Main menu
		 */

		'integration' => array(
			'title'  => __( 'Integration', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-plus',
			'fields' => array(
				array(
					'id'       => 'integration_heading',
					'type'     => 'heading',
					'label'    => __( 'Tourfic Integration Settings', 'tourfic' ),
					'subtitle' => __( 'For integration with other systems, we currently support connections via Pabbly, Zapier and Google Calendar only.', 'tourfic' ),
				),
				array(
					'id'     => 'tf-integration',
					'type'   => 'tab',
					'label'  => 'Pabbly, Zapier & Google Calendar Settings',
					'is_pro' => true,
					'tabs'   => array(
						array(
							'id'     => 'pabbly_integration',
							'title'  => __( 'Pabbly Setup', 'tourfic' ),
							'fields' => array(
								array(
									'id'      => 'hotel-title',
									'type'    => 'heading',
									'content' => __( 'Hotel Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'hotel-integrate-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Hotel?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Pabbly with the creation and updating of hotels in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'hotel-integrate-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Hotel Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Hotels.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'hotel-integrate-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'        => 'h-enquiry-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Hotel Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Pabbly with Hotel Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 'h-enquiry-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Hotel Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Hotel Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'h-enquiry-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'      => 'tour-title',
									'type'    => 'heading',
									'content' => __( 'Tour Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'tour-integrate-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Tour?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Pabbly with the creation and updating of tours in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tour-integrate-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Tour Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Tour.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'tour-integrate-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'        => 't-enquiry-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Tour Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Pabbly with Tour Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 't-enquiry-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Tour Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Tour Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 't-enquiry-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'      => 'apartment-title',
									'type'    => 'heading',
									'content' => __( 'Apartment Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'apartment-integrate-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Apartment?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Pabbly with the creation and updating of apartments in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'apartment-integrate-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Apartment Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Apartment.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'apartment-integrate-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'        => 'a-enquiry-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Apartment Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Pabbly with Apartment Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 'a-enquiry-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Apartment Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Apartment Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'a-enquiry-pabbly', '==', 'true' ),
									),
								),
								array(
									'id'      => 'woocommerce-title',
									'type'    => 'heading',
									'content' => __( 'WooCommerce Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'tf-new-order-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for Booking?', 'tourfic' ),
									'subtitle'  => __( 'Connect Pabbly with WooCommerce Booking.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tf-new-order-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'Booking Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for Booking.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-order-pabbly', '==', 'true' ),
									),
									'is_pro'     => true,
								),
								array(
									'id'        => 'tf-new-customer-pabbly',
									'type'      => 'switch',
									'label'     => __( 'Enable Pabbly for New Customer?', 'tourfic' ),
									'subtitle'  => __( 'Connect Pabbly with WooCommerce New Customer.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tf-new-customer-pabbly-webhook',
									'type'       => 'text',
									'label'      => __( 'New Customer Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Pabbly Webhook for New Customer.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-customer-pabbly', '==', 'true' ),
									),
									'is_pro'     => true,
								),
							),
						),
						array(
							'id'     => 'zapier_integration',
							'title'  => __( 'Zapier Setup', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'zapier-official-docs',
									'type'    => 'zapier-official-docs',
									'type'    => 'notice',
									'style'   => 'success',
									'content' => __( 'Anything confusing? ', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/pabbly-vs-zapier-integrations/zapier-integration/", array( 'utm_medium' => 'settings_doc_integrations_zapier' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'      => 'hotel-title',
									'type'    => 'heading',
									'content' => __( 'Hotel', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'hotel-integrate-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Hotel?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Zapier with the creation and updating of hotels in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'hotel-integrate-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Hotel Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Hotels.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'hotel-integrate-zapier', '==', 'true' ),
									),
								),
								array(
									'id'        => 'h-enquiry-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Hotel Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Zapier with Hotel Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 'h-enquiry-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Hotel Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Hotel Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'h-enquiry-zapier', '==', 'true' ),
									),
								),
								array(
									'id'      => 'tour-title',
									'type'    => 'heading',
									'content' => __( 'Tour Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'tour-integrate-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Tour?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Zapier with the creation and updating of tours in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tour-integrate-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Tour Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Tours.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'tour-integrate-zapier', '==', 'true' ),
									),
								),
								array(
									'id'        => 't-enquiry-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Tour Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Zapier with Tour Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 't-enquiry-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Tour Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Tour Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 't-enquiry-zapier', '==', 'true' ),
									),
								),
								array(
									'id'      => 'apartment-title',
									'type'    => 'heading',
									'content' => __( 'Apartment Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'apartment-integrate-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Apartment?', 'tourfic' ),
									'subtitle'  => __( 'You have the ability to integrate Zapier with the creation and updating of apartments in our system.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'apartment-integrate-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Apartment Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Apartment.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'apartment-integrate-zapier', '==', 'true' ),
									),
								),
								array(
									'id'        => 'a-enquiry-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Apartment Enquiry Form?', 'tourfic' ),
									'subtitle'  => __( 'Connect Zapier with Apartment Enquiry Form.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true
								),
								array(
									'id'         => 'a-enquiry-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Apartment Enquiry Form Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Apartment Enquiry Form.', 'tourfic' ),
									'is_pro'     => true,
									'dependency' => array(
										array( 'a-enquiry-zapier', '==', 'true' ),
									),
								),
								array(
									'id'      => 'woocommerce-title',
									'type'    => 'heading',
									'content' => __( 'WooCommerce Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'tf-new-order-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for Booking?', 'tourfic' ),
									'subtitle'  => __( 'Connect Zapier with WooCommerce Booking.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tf-new-order-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'Booking Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for Booking.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-order-zapier', '==', 'true' ),
									),
									'is_pro'     => true,
								),
								array(
									'id'        => 'tf-new-customer-zapier',
									'type'      => 'switch',
									'label'     => __( 'Enable Zapier for New Customer?', 'tourfic' ),
									'subtitle'  => __( 'Connect Zapier with WooCommerce New Customer.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tf-new-customer-zapier-webhook',
									'type'       => 'text',
									'label'      => __( 'New Customer Webhook', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Zapier Webhook for New Customer.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-customer-zapier', '==', 'true' ),
									),
									'is_pro'     => true,
								),
							),
						),
						array(
							'id'     => 'google_calendar_integration',
							'title'  => __( 'Google Calendar Setup', 'tourfic' ),
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'google-calendar-official-docs',
									'type'    => 'google-calendar-official-docs',
									'type'    => 'notice',
									'style'   => 'success',
									'content' => __( 'Anything confusing? ', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/integration/#Google_Calendar_Setup", array( 'utm_medium' => 'settings_doc_integration_google-cal' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'      => 'woocommerce-title',
									'type'    => 'heading',
									'content' => __( 'Google Calendar Integration', 'tourfic' ),
									'class'   => 'tf-field-class',
								),
								array(
									'id'        => 'tf-new-order-google-calendar',
									'type'      => 'switch',
									'label'     => __( 'Enable Google Calendar for Booking?', 'tourfic' ),
									'subtitle'  => __( 'Connect Google Calendar with WooCommerce Booking.', 'tourfic' ),
									'label_on'  => __( 'Yes', 'tourfic' ),
									'label_off' => __( 'No', 'tourfic' ),
									'default'   => false,
									'is_pro'    => true,
								),
								array(
									'id'         => 'tf-google-calendar-client_id',
									'type'       => 'text',
									'label'      => __( 'Client Id', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Google Calendar Client Id for Booking.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-order-google-calendar', '==', 'true' ),
									),
									'is_pro'     => true,
								),
								array(
									'id'         => 'tf-google-calendar-secret_key',
									'type'       => 'text',
									'label'      => __( 'Secret Key', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Google Calendar Secret Key for Booking.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-order-google-calendar', '==', 'true' ),
									),
									'is_pro'     => true,
								),
								array(
									'id'         => 'tf-google-calendar-redirect_url',
									'type'       => 'text',
									'label'      => __( 'Redirect Url', 'tourfic' ),
									'subtitle'   => __( 'Enter Your Google Calendar Redirect Url for Booking.', 'tourfic' ),
									'dependency' => array(
										array( 'tf-new-order-google-calendar', '==', 'true' ),
									),
									'is_pro'     => true,
								),
							),
						),
					),
				)
			),
		),

		/**
		 * Cancellation
		 *
		 * Main menu
		 */

		 'cancellation' => array(
			'title'  => esc_html__( 'Cancellation', 'tourfic' ),
			'icon'   => 'fa-solid fa-arrow-rotate-left',
			'parent' => 'pro_options',
			'fields' => array(
				array(
					'id'       => 'integration_heading',
					'type'     => 'heading',
					'label'    => esc_html__( 'Cancellation Settings', 'tourfic' ),
				),
				array(
					'id'      => 'cancellation-official-docs',
					'type'    => 'cancellation-official-docs',
					'type'    => 'notice',
					'style'   => 'success',
					'content' => esc_html__( 'Anything confusing?', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/cancellation-settings/", array( 'utm_medium' => 'settings_doc_cancellation' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . esc_html__( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'      => 'timezone-title',
					'type'    => 'heading',
					'content' => esc_html__( 'Time Zone', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'       => 'cancellation_time_zone',
					'type'     => 'select2',
					'label'    => esc_html__( 'Select Time Zone', 'tourfic' ),
					'subtitle' => esc_html__( 'Choose your time-zone', 'tourfic' ),
					'options' => [
						'America/New_York' => __( '(UTC-05:00) New York', 'tourfic' ),
						'Asia/Dhaka'  => __( '(UTC+06:00) Dhaka', 'tourfic' ),
					],
					'default' => 'America/New_York',
					'is_pro'  => true,
				),
				array(
					'id'      => 'hotel-title',
					'type'    => 'heading',
					'content' => esc_html__( 'Hotel', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'       => 'cancellation_hotel_checkin_time',
					'type'     => 'time',
					'label'    => esc_html__( 'Hotel Check-in Time', 'tourfic' ),
					'subtitle' => esc_html__( 'Choose the hotel check-in time.', 'tourfic' ),
					'format'   => 'H:i',
					'default'  => '11:00',
					'is_pro'  => true,
				),
				array(
					'id'      => 'tour-title',
					'type'    => 'heading',
					'content' => esc_html__( 'Tour', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'       => 'cancellation_tour_checkin_time',
					'type'     => 'time',
					'label'    => esc_html__( 'Tour Check-in Time', 'tourfic' ),
					'subtitle' => esc_html__( 'Choose the tour check-in time.', 'tourfic' ),
					'format'   => 'H:i',
					'default'  => '10:00',
					'is_pro'  => true,
				),
				array(
					'id'      => 'apartment-title',
					'type'    => 'heading',
					'content' => esc_html__( 'Apartment', 'tourfic' ),
					'class'   => 'tf-field-class',
				),
				array(
					'id'       => 'cancellation_apartment_checkin_time',
					'type'     => 'time',
					'label'    => esc_html__( 'Apartment Check-in Time', 'tourfic' ),
					'subtitle' => esc_html__( 'Choose the apartment check-in time.', 'tourfic' ),
					'format'   => 'H:i',
					'default'  => '11:00',
					'is_pro'  => true,
				),
			),
		),

		/**
		 * Import/Export
		 *
		 * Main menu
		 */
		'import_export' => array(
			'title' => __( 'Import/Export', 'tourfic' ),
			'icon' => 'fas fa-hdd',
			'fields' => array(
				array(
					'id'      => 'export-import-notice-one',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/import-export/", array( 'utm_medium' => 'settings_doc_import-export' )).'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id' => 'backup',
					'type' => 'backup',
				),  

			),
		),
		// Pro Options
		'pro_options' => array(
			'title'  => __( 'Pro Options', 'tourfic' ),
			'icon'   => 'fa-solid fa-atom',
			'fields' => array(),
		),
		// Itinerary Settings
		'tour_itinerary-pro'        => array(
			'title'  => __( 'Tour Itinerary Settings', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'   => 'itinerary-builder-setings',
					'type' => 'tab',
					'tabs' => array(
						array(
							'id'     => 'itinerary-builder-setting',
							'title'  => 'Itinerary Builder Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'tour-option-notice-three',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#itinerary", array( 'utm_medium' => 'settings_doc_tours_itinerary' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'       => 'itinerary-builder-heading',
									'type'     => 'heading',
									'subtitle' => __( 'You can create your own Itinerary using Tourfic\'s Itinerary builder. The builder can be found on Single Tour Settings', 'tourfic' ),
								),
								array(
									'id'           => '',
									'type'         => 'repeater',
									'label'        => __( 'Create Custom Itinerary options', 'tourfic' ),
									'button_title' => __( 'Add New Options', 'tourfic' ),
									'is_pro'       => true,
									'fields'       => array(
										array(
											'id'    => 'sleep-mode-title',
											'type'  => 'text',
											'label' => __( 'Field Title', 'tourfic' ),
										),
										array(
											'id'    => 'sleep-mode-icon',
											'type'  => 'icon',
											'label' => __( 'Field Icon', 'tourfic' ),
										),
									),
								),
								array(
									'id'           => '',
									'type'         => 'repeater',
									'button_title' => __( 'Add New Meal', 'tourfic' ),
									'label'        => __( 'Include Meal', 'tourfic' ),
									'is_pro'       => true,
									'fields'       => array(
										array(
											'id'    => 'meal',
											'type'  => 'text',
											'label' => __( 'Meal name', 'tourfic' ),
										),
									),
								),
								array(
									'id'      => '',
									'label'   => __( 'Elevation Input', 'tourfic' ),
									'type'    => 'select',
									'options' => [
										'Meter' => __( 'Meter', 'tourfic' ),
										'Feet'  => __( 'Feet', 'tourfic' ),
									],
									'is_pro'  => true,
									'default' => 'Meter',
								),
								array(
									'id'          => '',
									'type'        => 'switch',
									'is_pro'      => true,
									'label'       => __( 'Show Chart on Trip Page', 'tourfic' ),
									'field_width' => 50,
								),
								array(
									'id'          => '',
									'type'        => 'switch',
									'is_pro'      => true,
									'label'       => __( 'Always Show All Itinerary', 'tourfic' ),
									'field_width' => 50,
								),
								array(
									'id'          => '',
									'type'        => 'switch',
									'is_pro'      => true,
									'label'       => __( 'Show X-Axis', 'tourfic' ),
									'field_width' => 50,
								),
								array(
									'id'          => '',
									'type'        => 'switch',
									'is_pro'      => true,
									'label'       => __( 'Show Y-Axis', 'tourfic' ),
									'field_width' => 50,
								),
								array(
									'id'          => '',
									'type'        => 'switch',
									'is_pro'      => true,
									'label'       => __( 'Show line Graph', 'tourfic' ),
									'field_width' => 50,
								),
							),
						),
						array(
							'id'     => 'itinerary-downloader-setting',
							'title'  => 'Itinerary Downloader Settings',
							'icon'   => 'fa fa-gear',
							'fields' => array(
								array(
									'id'      => 'tour-option-notice-three',
									'type'    => 'notice',
									'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#itinerary", array( 'utm_medium' => 'settings_doc_tours_itinerary' ))  .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
								),
								array(
									'id'       => '',
									'type'     => 'switch',
									'is_pro'   => true,
									'label'    => __( 'Enable Itinerary Downloader', 'tourfic' ),
									'subtitle' => __( 'Turn this on to give customers the option to download the itinerary plan as a PDF.', 'tourfic' ),
									"default" => true,
								),
								array(
									'id'      => 'tour_pdf_downloader_section',
									'type'    => 'heading',
									'content' => __( 'Tour Itinerary Downloader Section', 'tourfic' ),
								),
								array(
									'id'    => '',
									'type'  => 'text',
									'label' => __( 'Itinerary Downloader Title', 'tourfic' ),
									'default' => "Want to read it later?",
									'placeholder' => "Want to read it later?",
									'is_pro'   => true,
								),
								array(
									'id'    => '',
									'type'  => 'text',
									'label' => __( 'Itinerary Downloader Description', 'tourfic' ),
									'default' => "Download this tour's PDF brochure and start your planning offline.",
									'placeholder' => "Download this tour's PDF brochure and start your planning offline.",
									'is_pro'   => true,
								),
								array(
									'id'    => '',
									'type'  => 'text',
									'label' => __( 'Itinerary Downloader Button Text', 'tourfic' ),
									'default' => "Download Now",
									'placeholder' => "Download Now",
									'is_pro'   => true,
								),
								array(
									'id'      => 'tour_settings',
									'type'    => 'heading',
									'label' => __( 'Thumbnail Settings in PDF', 'tourfic' ),
									'subtitle' => esc_html__( 'These settings will adjust the height and width of the main tour image in the itinerary.', 'tourfic' ),
								),
								array(
									'id'          => '',
									'type'        => 'number',
									'label'       => __( 'Image Thumbnail Height', 'tourfic' ),
									'subtitle' => esc_html__( 'Adjust the height of the tour image in the itinerary. Leave blank to use the image in its full size.', 'tourfic' ),
									'field_width' => 50,
									'is_pro'      => true,
								),
								array(
									'id'          => '',
									'type'        => 'number',
									'label'       => __( 'Image Thumbnail Width', 'tourfic' ),
									'subtitle' => esc_html__( 'Adjust the width of the tour image in the itinerary. Leave blank to use the image in its full size.', 'tourfic' ),
									'field_width' => 50,
									'is_pro'      => true,
								),
								array(
									'id'      => 'companey_info_heading',
									'type'    => 'heading',
									'content' => __( 'Default Company Info in PDF', 'tourfic' ),
								),
								array(
									'id'      => 'tour-option-notice-one',
									'type'    => 'notice',
									'content' => __( 'If no company information is specified in the Single Tour Settings, this information will be used by default.', 'tourfic' ),
								),

								array(
									'id'     => '',
									'type'   => 'image',
									'is_pro' => true,
									'label'  => __( 'Company Logo', 'tourfic' ),
								),
								array(
									'id'     => '',
									'type'   => 'textarea',
									'is_pro' => true,
									'label'  => __( 'Company Description', 'tourfic' ),
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'is_pro'      => true,
									'label'       => __( 'Company Email Address', 'tourfic' ),
									'field_width' => 33.33,
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'is_pro'      => true,
									'label'       => __( 'Company Address', 'tourfic' ),
									'field_width' => 33.33,
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'is_pro'      => true,
									'label'       => __( 'Company Phone', 'tourfic' ),
									'field_width' => 33.33,
								),
								array(
									'id'    => 'export_heading',
									'type'  => 'heading',
									'label' => __( 'Talk to Expert Section', 'tourfic' ),
								),
								array(
									'id'      => '',
									'type'    => 'switch',
									'is_pro'  => true,
									'label'   => __( 'Enable Talk To Expert Section in PDF', 'tourfic' ),
									'default' => false,
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'is_pro'      => true,
									'label'       => __( 'Talk to Expert - Label', 'tourfic' ),
									'field_width' => 25,
									'dependency'  => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'label'       => __( 'Expert Name', 'tourfic' ),
									'field_width' => 25,
									'is_pro'      => true,
									'dependency'  => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'label'       => __( 'Expert Email Address', 'tourfic' ),
									'field_width' => 25,
									'is_pro'      => true,
									'dependency'  => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'          => '',
									'type'        => 'text',
									'label'       => __( 'Expert Phone Address', 'tourfic' ),
									'field_width' => 25,
									'is_pro'      => true,
									'dependency'  => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'         => '',
									'type'       => 'image',
									'is_pro'     => true,
									'label'      => __( 'Expert Avatar Image', 'tourfic' ),
									'dependency' => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'         => '',
									'type'       => 'switch',
									'label'      => __( 'Enable Viber Contact', 'tourfic' ),
									'dependency' => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
									'is_pro'  => true,
								),
								array(
									'id'         => '',
									'type'       => 'switch',
									'is_pro'  => true,
									'label'      => __( 'Enable WhatsApp Contact', 'tourfic' ),
									'dependency' => array(
										array( 'itinerary-expert', '==', 'true' ),
									),
								),
								array(
									'id'       => 'signle_tour_fonts',
									'type'     => 'heading',
									'label'    => __( 'PDF Downloader Font Support', 'tourfic' ),
									'subtitle' => __( 'If your site\'s language is not English, then upload your language font. Otherwise, your Downloader PDF may not work properly.', 'tourfic' ),
								),
								array(
									'id'     => '',
									'type'   => 'file',
									'label'  => __( 'Upload Fonts', 'tourfic' ),
									'is_pro' => true,
								),
							),
						),
					),
				),
				array(
					'id'          => '',
					'type'        => 'switch',
					'label'       => __( 'Enable Itinerary Map', 'tourfic' ),
					'label_on'    => __( 'Yes', 'tourfic' ),
					'label_off'   => __( 'No', 'tourfic' ),
					'subtitle'  => __( 'To show the itinerary on a map, it is necessary to add your Google Maps API key in the settings under Miscellaneous -> Map.', 'tourfic' ),
					'is_pro'      => true,
					'field_width' => 50,
				),
				array(
					'id'          => '',
					'type'        => 'select',
					'label'       => __( 'Map Mode', 'tourfic' ),
					'options'     => array(
						'DRIVING'   => __( 'Driving', 'tourfic' ),
						'WALKING'   => __( 'Walking', 'tourfic' ),
						'BICYCLING' => __( 'Bycycling', 'tourfic' ),
					),
					'default'     => 'driving',
					'is_pro'      => true,
					'field_width' => 50,
				),

			),
		),
		// Partial Payment Popup
		'tour_payment_popup'    => array(
			'title'  => __( 'Tour Partial Payment', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'signle_tour_heading',
					'type'  => 'heading',
					'label' => __( 'Settings for Partial Payment', 'tourfic' ),
					'subtitle'  => __( 'This option will appear as Popup during Booking.', 'tourfic' ),
				),
				array(
					'id'      => 'tour-option-notice-two',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#partial_payment", array( 'utm_medium' => 'settings_doc_tours_partial-payment' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),

				array(
					'id'      => 'deposit-title',
					'type'    => 'text',
					'label'   => __( 'Label', 'tourfic' ),
					'default' => __( 'Partial payment of {amount} on total', 'tourfic' ),
					'placeholder' => __( 'Partial payment of {amount} on total', 'tourfic' ),
					'is_pro' => true,
				),
				array(
					'id'      => '',
					'type'    => 'textarea',
					'label'   => __( 'Description', 'tourfic' ),
					'is_pro' => true,
					'default' => __( 'You have the option to make a partial payment to secure your tour booking. The remaining balance can then be settled after the tour is completed.', 'tourfic' ),
				),
				array(
					'id'      => 'notice_shortcode',
					'type'    => 'notice',
					'content' => __( 'Use shortcode <code>{amount}</code> to show percentage amount in Label', 'tourfic' ),
					'is_pro' => true
				),
			),
		),
		// Without Payment Popup
		'without_payment_book'  => array(
			'title'  => __( 'Tour Without Payment', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'       => 'confirmation_fields_heading',
					'type'     => 'heading',
					'label'    => __( 'Settings for Without Payment Option', 'tourfic' ),
					'subtitle' => __( 'Activating the "Without Payment" booking option will enable the use of this section.', 'tourfic' ),
				),
				array(
					'id'      => 'tour-option-notice-four',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'.  Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-tours-options/#Without_payment_Book", array( 'utm_medium' => 'settings_doc_tours_without-payment' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'           => '',
					'class'        => 'disable-sortable',
					'type'         => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'        => __( 'Fields for Booking Confirmation', 'tourfic' ),
					'subtitle'     => __( 'Custom fields allowed', 'tourfic' ),
					'is_pro'       => true,
					'field_title'  => 'reg-field-label',
					'fields'       => array(
						array(
							'id'    => 'reg-field-label',
							'type'  => 'text',
							'label' => __( 'Label', 'tourfic' ),
						),
						array(
							'id'       => 'reg-field-name',
							'type'     => 'text',
							'label'    => __( 'Name', 'tourfic' ),
							'subtitle' => __( 'Space Not allowed (Ex: tf_name)', 'tourfic' ),
							'validate' => 'no_space_no_special',
							'class'    => 'tf_hidden_fields'
						),
						array(
							'id'      => 'reg-fields-type',
							'type'    => 'select',
							'label'   => __( 'Field Type', 'tourfic' ),
							'options' => array(
								'text'     => __( 'Text', 'tourfic' ),
								'email'    => __( 'Email', 'tourfic' ),
								'date'     => __( 'Date', 'tourfic' ),
								'radio'    => __( 'Radio', 'tourfic' ),
								'checkbox' => __( 'Checkbox', 'tourfic' ),
								'select'   => __( 'Select', 'tourfic' ),
							),
							'class'   => 'tf_hidden_fields'
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'radio' ),
							),
							'field_title'  => 'option-label',
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'select' ),
							),
							'field_title'  => 'option-label',
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'checkbox' ),
							),
							'field_title'  => 'option-label',
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'    => 'reg-field-required',
							'type'  => 'switch',
							'label' => __( 'Required Field ?', 'tourfic' ),
							'class' => 'tf_hidden_fields'
						),

					),
					'default'      => array(
						array(
							'reg-field-label'    => __( 'First Name', 'tourfic' ),
							'reg-field-name'     => __( 'tf_first_name', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Last Name', 'tourfic' ),
							'reg-field-name'     => __( 'tf_last_name', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Email', 'tourfic' ),
							'reg-field-name'     => __( 'tf_email', 'tourfic' ),
							'reg-fields-type'    => 'email',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Phone', 'tourfic' ),
							'reg-field-name'     => __( 'tf_phone', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Country', 'tourfic' ),
							'reg-field-name'     => __( 'tf_country', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Street Address', 'tourfic' ),
							'reg-field-name'     => __( 'tf_street_address', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Town/City', 'tourfic' ),
							'reg-field-name'     => __( 'tf_town_city', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'State/Country', 'tourfic' ),
							'reg-field-name'     => __( 'tf_state_country', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Postcode/ZIP', 'tourfic' ),
							'reg-field-name'     => __( 'tf_postcode', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
					),
				),
				array(
					'id'          => '',
					'type'        => 'editor',
					'label'       => __( 'Booking Confirmation Message', 'tourfic' ),
					'default' 	  => 'Booked Successfully',
					'is_pro'       => true,
				),
			),
		),
		// Hotel service Popup
		'payment_popup'         => array(
			'title'  => __( 'Hotel Popup Settings', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-cog',
			'fields' => array(
				array(
					'id'    => 'hotel_popup_heading',
					'type'  => 'heading',
					'label' => __( 'Settings for Popup', 'tourfic' ),
					'subtitle'   => __( 'The popup will appear when you enable the airport pickup service.', 'tourfic' ),
				),
				array(
					'id'      => 'hotel-option-notice-three',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/tourfic-settings/tourfic-hotel-options/#popup", array( 'utm_medium' => 'settings_doc_hotels_popup' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'    => '',
					'type'  => 'text',
					'label' => __( 'Popup Title', 'tourfic' ),
					'is_pro' => true,
				),

				array(
					'id'     => '',
					'type'   => 'textarea',
					'label'  => __( 'Popup Description', 'tourfic' ),
					'is_pro' => true,
				),

				array(
					'id'      => '',
					'type'    => 'text',
					'label'   => __( 'Popup Button Text', 'tourfic' ),
					'default' => __( 'Continue to booking', 'tourfic' ),
					'is_pro'  => true,
				)
			),
		),
		// Without Payment Popup
		'car_without_payment_book'  => array(
			'title'  => esc_html__( 'Car Without Payment', 'tourfic' ),
			'parent' => 'pro_options',
			'icon'   => 'fa fa-cog',
			'fields' => array(

				array(
					'id'       => 'confirmation_fields_heading',
					'type'     => 'heading',
					'label'    => __( 'Settings for Without Payment Option', 'tourfic' ),
					'subtitle' => __( 'Activating the "Without Payment" booking option will enable the use of this section.', 'tourfic' ),
				),
				array(
					'id'      => 'tour-option-notice-four',
					'type'    => 'notice',
					'content' => __( 'Anything confusing?', 'tourfic' ) . ' <a href="'. Helper::tf_utm_generator("https://themefic.com/docs/tourfic/settings/car-options/#Without_Payment_Settings", array( 'utm_medium' => 'settings_doc_cars_without-payment' )) .'" target="_blank" class="tf-admin-btn tf-btn-secondary tf-small-btn"><strong>' . __( 'Read Documentation', 'tourfic' ) . '</strong></a>',
				),
				array(
					'id'           => 'book-confirm-field',
					'class'        => 'disable-sortable',
					'type'         => 'repeater',
					'button_title' => __( 'Add New', 'tourfic' ),
					'label'        => __( 'Fields for Booking Confirmation', 'tourfic' ),
					'subtitle'     => __( 'Custom fields allowed', 'tourfic' ),
					'field_title'  => 'reg-field-label',
					'is_pro' => true,
					'fields'       => array(
						array(
							'id'    => 'reg-field-label',
							'type'  => 'text',
							'label' => __( 'Label', 'tourfic' ),
						),
						array(
							'id'       => 'reg-field-name',
							'type'     => 'text',
							'label'    => __( 'Name', 'tourfic' ),
							'subtitle' => __( 'Space Not allowed (Ex: tf_name)', 'tourfic' ),
							'validate' => 'no_space_no_special',
							'class'    => 'tf_hidden_fields',
						),
						array(
							'id'      => 'reg-fields-type',
							'type'    => 'select',
							'label'   => __( 'Field Type', 'tourfic' ),
							'options' => array(
								'text'     => __( 'Text', 'tourfic' ),
								'email'    => __( 'Email', 'tourfic' ),
								'date'     => __( 'Date', 'tourfic' ),
								'radio'    => __( 'Radio', 'tourfic' ),
								'checkbox' => __( 'Checkbox', 'tourfic' ),
								'select'   => __( 'Select', 'tourfic' ),
							),
							'class'   => 'tf_hidden_fields'
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'radio' ),
							),
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'select' ),
							),
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'           => 'reg-options',
							'type'         => 'repeater',
							'button_title' => __( 'Add New Option', 'tourfic' ),
							'label'        => __( 'Option Label', 'tourfic' ),
							'dependency'   => array(
								array( 'reg-fields-type', '==', 'checkbox' ),
							),
							'fields'       => array(
								array(
									'label' => __( 'Field Label', 'tourfic' ),
									'id'    => 'option-label',
									'type'  => 'text',
								),
								array(
									'label' => __( 'Field Value', 'tourfic' ),
									'id'    => 'option-value',
									'type'  => 'text',
								),
							),
						),
						array(
							'id'    => 'reg-field-required',
							'type'  => 'switch',
							'label' => __( 'Required Field ?', 'tourfic' ),
							'class' => 'tf_hidden_fields'
						),

					),
					'default'      => array(
						array(
							'reg-field-label'    => __( 'First Name', 'tourfic' ),
							'reg-field-name'     => __( 'tf_first_name', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Last Name', 'tourfic' ),
							'reg-field-name'     => __( 'tf_last_name', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Email', 'tourfic' ),
							'reg-field-name'     => __( 'tf_email', 'tourfic' ),
							'reg-fields-type'    => 'email',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Phone', 'tourfic' ),
							'reg-field-name'     => __( 'tf_phone', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Country', 'tourfic' ),
							'reg-field-name'     => __( 'tf_country', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Street Address', 'tourfic' ),
							'reg-field-name'     => __( 'tf_street_address', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Town/City', 'tourfic' ),
							'reg-field-name'     => __( 'tf_town_city', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'State/Country', 'tourfic' ),
							'reg-field-name'     => __( 'tf_state_country', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
						array(
							'reg-field-label'    => __( 'Postcode/ZIP', 'tourfic' ),
							'reg-field-name'     => __( 'tf_postcode', 'tourfic' ),
							'reg-fields-type'    => 'text',
							'reg-field-required' => true,
						),
					),
				),
				array(
					'id'          => 'car-booking-confirmation-msg',
					'type'        => 'editor',
					'label'       => __( 'Booking Confirmation Message', 'tourfic' ),
					'default' 	  => 'Booked Successfully',
					'is_pro' => true
				),
			),
		),
	),
) );
