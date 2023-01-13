<?php
/**
 *  Elementor Widgets.
 *
 * @since 1.0.0
 */
class Clearvoice_Posts extends \Elementor\Widget_Base {

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
	 * Retrieve Plus Alliance widget name
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name
	 */
	public function get_name() {
		return 'clearvoice_posts';
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
		return __( 'Clearvoice Posts', 'widgets');
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
		return 'eicon-post';
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

		$this->add_control(
			'clearvoice_post_per_page_post',
			array(
				'label'   => esc_html__( 'Posts Per Page', 'widgets' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'default' => esc_html__( '1', 'widgets' ),
			)
		);

        $this->add_control(
			'clearvoice_post_order',
			[
				'label' => esc_html__( 'Post Order', 'widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'ASC',
				'options' => [
					
					'ASC' => esc_html__( 'ASC', 'widgets' ),
					'DESC'  => esc_html__( 'DESC', 'widgets' ),
				]
				
			]
		);

		$this->add_control(
			'post_orderby',
			[
				'label' => __( 'Order By', 'widgets' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __( 'Date', 'widgets' ),
					'title' => __( 'Title', 'widgets' ),
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render function is used to render the content, it works in Elementor and on frontend as well
	 *
	 * @return void
	 */
	protected function render() {

		$settings      = $this->get_settings_for_display();
		$post_per_page = isset( $settings['clearvoice_post_per_page_post'] ) && ! empty( $settings['clearvoice_post_per_page_post'] ) ? $settings['clearvoice_post_per_page_post'] : '';
		$post_order = isset( $settings['clearvoice_post_order'] ) && ! empty( $settings['clearvoice_post_order']) ? $settings['clearvoice_post_order'] : '';
		$post_orderby =isset( $settings['post_orderby'] ) && ! empty( $settings['post_orderby']) ? $settings['post_orderby'] : '';
        
		$post_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'orderby' => $post_orderby,
				'order' => $post_order,
				'posts_per_page' => $post_per_page,
			)
		);

		if ( $post_query->have_posts() ) :
			?>
            <div class="case-studies-wrapper">
                    <?php
                    while ( $post_query->have_posts() ) :
                        $post_query->the_post();?>
                        <div class="case-study-block">
                            <div  class="thumbnail-block">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium' ); ?>
                            <?php endif; ?>
                                
                            </div>
                            <div class="content-block">
                                <div class="block-heading">
                                    <h5 class="block-title"> <a href="<?php echo get_permalink(); ?>"><?php echo get_the_title() ?></a> </h5>
                                </div>
                                <div class="block-btn-wrapper">
                                    <a href="<?php echo get_permalink(); ?>" class="text-link">Read More</a>
                                </div>
                            </div>
                        </div>
                            <?php
                        
                    endwhile;
					wp_reset_postdata();
                    ?>				
				</div>
			<?php
			
		endif;
	}
}
