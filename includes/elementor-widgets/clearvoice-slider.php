<?php
/**
 * Elementor Widgets.
 *
 * @since 1.0.0
 */
class Clearvoice_Slider extends \Elementor\Widget_Base {

	/**
	 * Constructor of the class.
	 *
	 * @param array $data The widget data.
	 * @param array $args The widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}


	/**
	 * Get widget name.
	 *
	 * Retrieve widget name
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name
	 */
	public function get_name() {
		return 'clearvoice_slider';
	}

	/**
	 * Enqueue Scripts with this function
	 *
	 * @return array Widget scripts
	 */
	public function get_script_depends() {
		return array( 'elementor-hello-world');
	}


	/**
	 * Get widget title.
	 *
	 * Retrieve  widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'ClearVoice Slider', 'widgets' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-3d';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Register widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */

	 protected function register_controls() {

		/**
		 * Start a new section and end the old one
		 */
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Content', 'widgets' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'category_name',
			array(
				'label' => esc_html__( 'Category', 'widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'widgets' ),
			)
		);

		$repeater->add_control(
			'tab_title',
			array(
				'label' => esc_html__( 'Pdf Title', 'widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'widgets' ),
			)
		);

		$repeater->add_control(
			'pdf_image',
			array(
				'label' => esc_html__( 'Pdf Image', 'widgets' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => array(
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_control(
			'link',
			[
				'label' => esc_html__( 'Link', 'widgets' ),
				'type' => \Elementor\Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'widgets' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pdf_slider',
			array(
				'label'       => esc_html__( 'Pdf Cards', 'widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default' => [
                    [
                        'cat_name' => __( 'Item 1', 'widgets' ),
                    ]
                    
                ],
				'title_field' => '{{{ category_name }}}',
			)
		);
		$this->end_controls_section();

	}

	/**
	 * Render function is used to render the content, it works in Elementor and on frontend as well
	 *
	 * @return void
	 */
	protected function render() {
		
		$settings  = $this->get_settings_for_display();
		$pdf_posts = isset( $settings['pdf_slider'] ) && ! empty( $settings['pdf_slider'] ) ? $settings['pdf_slider'] : '';

		if ( is_array( $pdf_posts ) ) : ?>
		 
			<div class="timeline-main-wrapper swiper-container">
				<div class="swiper-wrapper">
					<?php
					foreach ( $pdf_posts as $pdf_post ) {
						$title = isset( $pdf_post['tab_title'] ) && ! empty( $pdf_post['tab_title'] ) ? $pdf_post['tab_title'] : '';
						$cat_title       = isset( $pdf_post['category_name'] ) && ! empty( $pdf_post['category_name'] ) ? $pdf_post['category_name'] : '';
						$image       = isset( $pdf_post['pdf_image'] ) && ! empty( $pdf_post['pdf_image'] ) ? $pdf_post['pdf_image'] : '';
						$link      = isset( $pdf_post['link'] ) && ! empty( $pdf_post['link'] ) ? $pdf_post['link'] : '';
						?>
						<div class="swiper-slide">
							<div class="marketing-box">
								<?php if ($link['url']) : ?>
                                    <a href="<?php echo esc_url($link['url']); ?>" target="<?php echo ($link['is_external']) ? "_blank" : '' ?>">
                                    
									<div class="marketing-thumbnail">
										<?php if(! empty($image)) : ?>
										<?php echo wp_get_attachment_image($image['id']) ?>
										<?php endif ; ?>
									</div>
									<div class="marketing-content">
										<div class="marketing-label">
											<span class="article-label"><?php esc_html_e( $cat_title, 'widgets' ); ?></span>
											<h6 class="article-title"><?php esc_html_e( $title, 'widgets' ); ?></h6>
										</div>
									</div>
								</a>
								<?php else :  ?>
								<div>
									<div class="marketing-thumbnail">
										<?php if(! empty($image)) : ?>
										<?php echo wp_get_attachment_image($image['id']) ?>
										<?php endif ; ?>
									</div>
									<div class="marketing-content">
										<div class="marketing-label">
											<span class="article-label"><?php esc_html_e( $cat_title, 'widgets' ); ?></span>
											<h6 class="article-title"><?php esc_html_e( $title, 'widgets' ); ?></h6>
										</div>
									</div>
								</div>
								<?php endif ;?>
							</div>
						</div>
						<?php
					}
					?>
				</div>
				<div class="swiper-controller">
                    <div class="swiper-next-btn"></div>
                    <div class="swiper-prev-btn"></div>
                    <div class="swiper-pagination"></div>
                </div>
			</div>
		<?php
		endif;
	}
	


}