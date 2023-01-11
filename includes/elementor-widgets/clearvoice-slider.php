<?php
/**
 * Plus Alliance Elementor Widgets.
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
		wp_register_style( 'clearvoice', plugins_url( '/assets/css/clearvoice-slider.css' ), array(), '1.0.0' );
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Plus Alliance widget name
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name
	 */
	public function get_name() {
		return 'clearvoice';
	}

	/**
	 * Enqueue Scripts with this function
	 *
	 * @return array Widget scripts
	 */
	public function get_script_depends() {
		return array( 'clearvoice' );
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
		return __( 'Clear Voice Slider', 'widgets' );
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
		return 'eicon-menu-card';
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
		return array( 'maricopa_widgets' );
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
				'label' => esc_html__( 'Content', 'maricopa' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'category_name',
			array(
				'label' => esc_html__( 'Category', 'widgets' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '', 'maricopa' ),
			)
		);

		$repeater->add_control(
			'tab_title',
			array(
				'label' => esc_html__( 'Pdf Title', 'maricopa' ),
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
				'separator' => 'before',
			]
		);

		$this->add_control(
			'pdf_slider',
			array(
				'label'       => esc_html__( 'Security Cards', 'widgets' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'main_heading' => esc_html__( '{{ mccf_timeline_year }}}', 'maricopa' ),
						'card_content' => esc_html__( 'Item content. Click the edit button to change this text.', 'maricopa' ),
					),
				),
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
			<div class="timeline-main-wrapper">
				<div class="container-timeline">
					<?php
					foreach ( $pdf_posts as $pdf_post ) {

						$description = isset( $timeline['mccf_timeline_description'] ) && ! empty( $timeline['mccf_timeline_description'] ) ? $timeline['mccf_timeline_description'] : '';
						$year        = isset( $timeline['mccf_timeline_year'] ) && ! empty( $timeline['mccf_timeline_year'] ) ? $timeline['mccf_timeline_year'] : '';
						$image       = isset( $timeline['mccf_timeline_image'] ) && ! empty( $timeline['mccf_timeline_image'] ) ? $timeline['mccf_timeline_image'] : '';

						?>
						<div class="timeline-wrapper">
							<div class="timeline-description">
								<?php _e( $description, 'maricopa' ); ?>
							</div>
							<div class="date-timeline"><?php esc_html_e( $year, 'maricopa' ); ?></div>
							<?php $extra_class = ! empty( $image['url'] ) ? '' : ' timeline-empty-img'; ?>
							<div class="timeline-image<?php echo $extra_class; ?>">
								<?php if ( ! empty( $image['url'] ) ) : ?>
									<?php $image_alt = isset( $image['alt'] ) && ! empty( $image['alt'] ) ? $image['alt'] : ''; ?>
									<img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
								<?php endif; ?>
							</div>
						</div>  
						<?php
					}
					?>
				</div>
			</div>
		<?php
		endif;
	}
	


}