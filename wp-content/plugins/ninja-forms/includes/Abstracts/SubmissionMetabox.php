<?php if ( ! defined( 'ABSPATH' ) ) exit;

abstract class NF_Abstracts_SubmissionMetabox extends NF_Abstracts_Metabox
{
    /**
     * @var array
     */
    protected $_post_types = array( 'nf_sub' );

    /**
     * @var NF_Database_Models_Submission
     */
    protected $sub;

    public function __construct()
    {
        parent::__construct();

        if( ! isset( $_GET[ 'post' ] ) ) return;

        add_action('init', [$this, 'abstractSubmissionInit'], 8);

        $post_id = absint( $_GET[ 'post' ] );

        $this->sub = Ninja_Forms()->form()->get_sub( $post_id );
        
        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, '_save_post' ) );
    }

    /**
     * Initialize properties at WP `init-8` action hook
     *
     * Set translatable properties - _title
     * 
     * @return void
     */
    public function abstractSubmissionInit(): void
    {
        $this->_title = esc_html__('Submission Metabox', 'ninja-forms');
    }
}