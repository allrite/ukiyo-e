<?php
    /**
     * Ukiyo-e theme functions and definitions
     * @package botchan
     * @since 0.0.1 
     */

    namespace UkiyoE;

        $settings = array(
            'theme_support' => array(
                'post-thumbnails' => array( 'post', 'page' ),
                'editor-color-palette' => 
                    array(
                        array(
                            'name' => __( 'prussian blue', 'ukiyo-e' ),
                            'slug' => 'prussian-blue',
                            'color' => '#123854',
                        ),
                        array(
                            'name' => __( 'teal blue', 'ukiyo-e' ),
                            'slug' => 'teal-blue',
                            'color' => '#537D8D',
                        ),
                        array(
                            'name' => __( 'bone', 'ukiyo-e' ),
                            'slug' => 'bone',
                            'color' => '#DCCFB9',
                        ),
                        array(
                            'name' => __( 'alabaster', 'ukiyo-e' ),
                            'slug' => 'alabaster',
                            'color' => '#F1ECE4',
                        ),
                        array(
                            'name' => __( 'pale silver', 'ukiyo-e' ),
                            'slug' => 'pale-silver',
                            'color' => '#B4ADA2',
                        ),
                        array(
                            'name' => __( 'redwood', 'ukiyo-e' ),
                            'slug' => 'redwood',
                            'color' => '#A96556',
                        ),
                        array(
                            'name' => __( 'raisin black', 'ukiyo-e' ),
                            'slug' => 'raisin-black',
                            'color' => '#27262C',
                        ),
                    )
                ,
                'wp-block-styles' => false,
                'align-wide' => false,
            ),
            'styles'    =>  array(
                    'quicksand' => array( 'https://fonts.googleapis.com/css2?family=Laila:wght@300&family=Quicksand:wght@500;700&display=swap', false, false ),
                    'laila' => array( 'https://fonts.googleapis.com/css2?family=Laila:wght@300&&display=swap', false, false ),
                    'ukiyo-e' => array( get_template_directory_uri().'/build/ukiyo-e.css', false, false )
            ),
            'editorstyles'  =>  array(
                'build/ukiyo-e.css',
                'https://fonts.googleapis.com/css2?family=Laila:wght@300&family=Quicksand:wght@500;700&display=swap',
                'https://fonts.googleapis.com/css2?family=Laila:wght@300&family=Quicksand:wght@500;700&display=swap'
            ),
            'scripts'   =>  array(),
        );

        class Config {
        
            private $settings;

            public function __construct( $args = array() ) {
                $this->settings = $args;
                $this->actions();
            }

            private function actions() {
                add_action( 'after_setup_theme', array( $this, 'theme_support' ) );
                add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
                add_editor_style( $this->settings['editorstyles'] );
            }

            public function theme_support() {
                foreach( $this->settings['theme_support'] as $key => $val ) {
                    add_theme_support( $key, $val);
                }
            }

            public function scripts() {
                wp_enqueue_style( 'ukiyo-e-style', get_stylesheet_uri() );
                if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                    wp_enqueue_script( 'comment-reply' );
                }
            }

            public function enqueue() {
                $this->scripts();
                foreach( $this->settings['styles'] as $key => $val ) {
                    wp_enqueue_style( $key, $val[0], $val[1], $val[2]);
                }
                foreach( $this->settings['scripts'] as $key => $val ) {
                    wp_enqueue_script( $key, $val[0], $val[1]);
                }
            }
        }
        
        $config = new Config( $settings );

?>