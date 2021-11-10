<?php
/**
 * Image hover widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Image_Animation_Effect_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'rs-image-shabe-animation-effect';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RS Image Animation Shape', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function _register_controls() {


        $this->start_controls_section(
            '_section_image_content',
            [
                'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 
        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Alignment', 'rsaddon' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'rsaddon' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'rsaddon' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'rsaddon' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'rsaddon' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .middle-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'left_shape_image',
            [
                'label' => esc_html__( 'Shape Image One', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],    
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'middle_image',
            [
                'label' => esc_html__( 'Middle Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],    
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'right_shape_image',
            [
                'label' => esc_html__( 'Shape Image Two', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA, 
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],    
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        

        $this->start_controls_section(
            'shape_one_title',
            [
                'label' => esc_html__( 'Shape Image One', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'shape_one_position',
            [
                'label'      => esc_html__( 'Image Left/Right Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .pattern' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        ); 

        $this->add_responsive_control(
            'shape_one_position_top',
            [
                'label'      => esc_html__( 'Image Top/Bottom Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .pattern' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        ); 
        $this->add_control(
            'background_hover_transition',
            [
                'label' => __( 'Transition Duration', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .scale2' => 'animation: scale2 {{SIZE}}s alternate infinite',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'shape_two_title',
            [
                'label' => esc_html__( 'Shape Image Two', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'shape_two_position',
            [
                'label'      => esc_html__( 'Image Left/Right Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .shape' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        ); 

        $this->add_responsive_control(
            'shape_two_position_top',
            [
                'label'      => esc_html__( 'Image Top/Bottom Position', 'rsaddon' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .shape' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        ); 
        $this->add_control(
            'background_hover_transition2',
            [
                'label' => __( 'Transition Duration', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-animation-shape-image .dance' => 'animation: scale2 {{SIZE}}s alternate infinite',
                ],
            ]
        );

        $this->end_controls_section();

        
        
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); 



        ?>

        <div class="rs-animation-shape-image">

            <?php if(!empty($settings['left_shape_image']['url'])) :?>
                <div class="pattern">
                    <img class="scale2" src="<?php echo esc_url( $settings['left_shape_image']['url'] );?>" alt="image"/>
                </div>
            <?php endif;?>


            <?php if(!empty($settings['middle_image']['url'])) :?>
                <div class="middle-image">
                    <img src="<?php echo esc_url( $settings['middle_image']['url'] );?>" alt="image"/>
                </div>
            <?php endif;?>


            <?php if(!empty($settings['right_shape_image']['url'])) :?>
                <div class="shape">
                    <img class="dance" src="<?php echo esc_url( $settings['right_shape_image']['url'] );?>" alt="image"/>
                </div>
            <?php endif;?>


            


        </div>      
    <?php
    }
}