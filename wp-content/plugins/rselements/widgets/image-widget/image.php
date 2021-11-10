<?php
/**
 * Image widget class
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

defined( 'ABSPATH' ) || die();

class Rsaddon_pro_Image_Showcase_Widget extends \Elementor\Widget_Base {
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
        return 'rs-image';
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
        return esc_html__( 'RS Image Showcase', 'rsaddon' );
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
            '_section_logo',
            [
                'label' => esc_html__( 'Image Settings', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        ); 

        $this->add_control(
            'first_image',
            [
                'label' => esc_html__( 'Choose Image', 'rsaddon' ),
                'type' => \Elementor\Controls_Manager::MEDIA,     
                'separator' => 'before',
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
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .rs-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'image_animation',
            [
                'label' => esc_html__( 'Animation', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'images_translate',
            [
                'label'   => esc_html__( 'Translate Position', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'veritcal',
                'options' => [                  
                    'veritcal' => esc_html__( 'Veritcal', 'rsaddon'),
                    'horizontal' => esc_html__( 'Horizontal', 'rsaddon'),
                    'rotated_style' => esc_html__( 'Rotated', 'rsaddon'),
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'rs_image_duration',
            [

                'label' => esc_html__( 'Animation Duration', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 20,
                   ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .rs-image .rs-multi-image' => 'animation-duration: {{SIZE}}s;',
                ],
                'condition' => [
                    'image_animation' => 'yes',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'rs_image_animate_start_x',
            [

                'label' => esc_html__( 'Translate X Start', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'horizontal',
                ],
            ]
        );  

        $this->add_responsive_control(
            'rs_image_animate_end_x',
            [

                'label' => esc_html__( 'Translate X End', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => -100,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'horizontal',
                ],
            ]
        ); 


        $this->add_responsive_control(
            'rs_image_animate_start_y',
            [

                'label' => esc_html__( 'Translate Y Start', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => 0,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'veritcal',
                ],
            ]
        );  

        $this->add_responsive_control(
            'rs_image_animate_end_y',
            [

                'label' => esc_html__( 'Translate Y End', 'rsaddon' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                   'px' => [
                       'min' => -100,
                       'max' => 100,
                   ],
                ],
                'condition' => [
                    'image_animation' => 'yes',
                    'images_translate' => 'veritcal',
                ],
            ]
        );     
       

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>

        <div class="rs-image <?php echo esc_attr($settings['image_animation']); ?>">
            <?php if(!empty($settings['first_image']['url'])) : ?>
                <img class="rs-multi-image <?php echo esc_attr($settings['images_translate']); ?>" src="<?php echo esc_url($settings['first_image']['url']);?>" alt="image"/>
            <?php endif; ?>
        </div>

        <?php        
            $start   = $settings['rs_image_animate_start_x']['size'].$settings['rs_image_animate_start_x']['unit'];             
            $end     = $settings['rs_image_animate_end_x']['size'].$settings['rs_image_animate_end_x']['unit'];            
            $start_y = $settings['rs_image_animate_start_y']['size'].$settings['rs_image_animate_start_y']['unit'];            
            $end_y   = $settings['rs_image_animate_end_y']['size'].$settings['rs_image_animate_end_y']['unit'];
        ?>      
    <?php
    }
}
