<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "braintech_option";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'braintech/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        'page_priority'        => 8,
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Braintech Options', 'braintech' ),
        'page_title'           => esc_html__( 'Braintech Options', 'braintech' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        'forced_dev_mode_off' => true,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        'compiler' => true,

        // OPTIONAL -> Give you extra features
        'page_priority'        => 20,        
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        'force_output' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_html__( 'braintech Theme', 'braintech' ), $v );
    } else {
        $args['intro_text'] = esc_html__( 'braintech Theme', 'braintech' );
    }

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTSbraintech
      
     */     
   // -> START General Settings
   Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Sections', 'braintech' ),
        'id'               => 'basic-checkbox',
        'customizer_width' => '450px',
        'fields'           => array(
        	array(
        	    'id'       => 'enable_global',
        	    'type'     => 'switch', 
        	    'title'    => esc_html__('Enable Global Settings', 'braintech'),
        	    'subtitle' => esc_html__('If you enable global settings all option will be work only theme option', 'braintech'),
        	    'default'  => false,
        	),
            array(
                'id'       => 'container_size',
                'title'    => esc_html__( 'Container Size', 'braintech' ),
                'subtitle' => esc_html__( 'Container Size example(1200px)', 'braintech' ),
                'type'     => 'text',
                'default'  => '1280px'                
            ),
            array(
                'id'       => 'logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Default Logo', 'braintech' ),
                'subtitle' => esc_html__( 'Upload your logo', 'braintech' ),
                'url'=> true                
            ),

            array(
                'id'       => 'logo_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Light', 'braintech' ),
                'subtitle' => esc_html__( 'Upload your light logo', 'braintech' ),
                'url'=> true                
            ),
            array(
                'id'       => 'logo_icons',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload default icon logo', 'braintech' ),
                'subtitle' => esc_html__( 'Upload default icon logo', 'braintech' ),
                'url'=> true
            ),

            array(
                'id'       => 'logo_icons_light',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Light icon logo', 'braintech' ),
                'subtitle' => esc_html__( 'Upload Light icon logo', 'braintech' ),
                'url'=> true
            ),

            array(
                    'id'       => 'logo-height',                               
                    'title'    => esc_html__( 'Logo Height', 'braintech' ),
                    'subtitle' => esc_html__( 'Logo max height example(50px)', 'braintech' ),
                    'type'     => 'text',
                    'default'  => '25px'                    
            ), 


            array(
                'id'       => 'logo-mobile',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Mobile Logo', 'braintech' ),
                'subtitle' => esc_html__( 'Upload your mobile logo', 'braintech' ),
                'url'=> true                
            ),

            array(
                    'id'       => 'logo-height-mobile',                               
                    'title'    => esc_html__( 'Mobile Logo Height', 'braintech' ),
                    'subtitle' => esc_html__( 'Mobile Logo max height example(50px)', 'braintech' ),
                    'type'     => 'text',
                    'default'  => '25px'                    
            ),

            array(
                'id'       => 'rswplogo_sticky',
                'type'     => 'media',
                'title'    => esc_html__( 'Upload Your Sticky Logo', 'braintech' ),
                'subtitle' => esc_html__( 'Upload your sticky logo', 'braintech' ),
                'url'=> true                
            ),

            array(
                'id'       => 'sticky_logo_height',                               
                'title'    => esc_html__( 'Sticky Logo Height', 'braintech' ),
                'subtitle' => esc_html__( 'Sticky Logo max height example(20px)', 'braintech' ),
                'type'     => 'text',
                'default'  => '25px'
                    
            ),            
            array(
            'id'       => 'rs_favicon',
            'type'     => 'media',
            'title'    => esc_html__( 'Upload Favicon', 'braintech' ),
            'subtitle' => esc_html__( 'Upload your faviocn here', 'braintech' ),
            'url'=> true            
            ),
            
            array(
                'id'       => 'off_sticky',
                'type'     => 'switch', 
                'title'    => esc_html__('Sticky Menu', 'braintech'),
                'subtitle' => esc_html__('You can show or hide sticky menu here', 'braintech'),
                'default'  => false,
            ),
               
             array(
                'id'       => 'off_search',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Search', 'braintech'),
                'subtitle' => esc_html__('You can show or hide search icon at menu area', 'braintech'),
                'default'  => false,
            ),
            
            array(
                'id'       => 'off_canvas',
                'type'     => 'switch', 
                'title'    => esc_html__('Show off Canvas', 'braintech'),
                'subtitle' => esc_html__('You can show or hide off canvas here', 'braintech'),
                'default'  => false,
            ),  
     
            array(
                'id'       => 'show_top_bottom',
                'type'     => 'switch', 
                'title'    => esc_html__('Go to Top', 'braintech'),
                'subtitle' => esc_html__('You can show or hide here', 'braintech'),
                'default'  => false,
            ), 
           
        )
    ) );
    
    
    // -> START Header Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'braintech' ),
        'id'               => 'header',
        'customizer_width' => '450px',
        'icon' => 'el el-certificate',       
         
        'fields'           => array(
        array(
            'id'     => 'notice_critical',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Top Area', 'braintech')            
        ),
        
        array(
                'id'       => 'show-top',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Top Bar', 'braintech'),
                'subtitle' => esc_html__('You can select top bar show or hide', 'braintech'),
                'default'  => false,
        ),   
       
      
        array(
                'id'       => 'show-social',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Social Icons at Header', 'braintech'),
                'subtitle' => esc_html__('You can select Social Icons show or hide', 'braintech'),
                'default'  => true,
            ),  
                    
          array(
            'id'     => 'notice_critical2',
            'type'   => 'info',
            'notice' => true,
            'style'  => 'success',
            'title'  => esc_html__('Header Area', 'braintech')            
        ),

        array(
                'id'               => 'header-grid',
                'type'             => 'select',
                'title'            => esc_html__('Header Area Width', 'braintech'),                  
               
                //Must provide key => value pairs for select options
                'options'          => array(                                     
                
                    'container' => esc_html__('Container', 'braintech'),
                    'full'      => esc_html__('Container Fluid', 'braintech'),
                ),

                'default'          => 'container',            
            ),

        array(
                'id'       => 'phone_line',                               
                'title'    => esc_html__( ' Phone Number Pre Text', 'braintech' ),
                'subtitle' => esc_html__( 'Enter Phone Text', 'braintech' ),
                'type'     => 'text',     
        ),

        array(
                'id'       => 'phone',                               
                'title'    => esc_html__( ' Phone Number', 'braintech' ),
                'subtitle' => esc_html__( 'Enter Phone Number', 'braintech' ),
                'type'     => 'text',     
        ),

       
        array(
                'id'       => 'email__text',                               
                'title'    => esc_html__( ' Email Pre Text', 'braintech' ),
                'subtitle' => esc_html__( 'Enter Email Text', 'braintech' ),
                'type'     => 'text',     
        ),
               
        array(
            'id'       => 'top-email',                               
            'title'    => esc_html__( 'Email Address', 'braintech' ),
            'subtitle' => esc_html__( 'Enter Email Address', 'braintech' ),
            'type'     => 'text',
            'validate' => 'email',
            'msg'      => esc_html__('Email Address Not Valid', 'braintech')  
        ),  

        
        array(
                'id'       => 'address__text',                               
                'title'    => esc_html__( ' Address Pre Text', 'braintech' ),
                'subtitle' => esc_html__( 'Address Email Text', 'braintech' ),
                'type'     => 'text',     
        ),

        array(
            'id'       => 'top_address',                               
            'title'    => esc_html__( 'Address', 'braintech' ),
            'subtitle' => esc_html__( 'Enter Address Text', 'braintech' ),
            'type'     => 'text', 
        ),         

        array(
            'id'       => 'open_hours',                               
            'title'    => esc_html__( 'Opening Hours', 'braintech' ),
            'subtitle' => esc_html__( 'Enter Opening Hours', 'braintech' ),
            'type'     => 'text',
            
        ),  

        array(
            'id'       => 'quote_btns',
            'type'     => 'switch', 
            'title'    => esc_html__('Show Quote Button', 'braintech'),
            'subtitle' => esc_html__('You can show or hide Quote Button', 'braintech'),
            'default'  => false,
        ),
            
        array(
                'id'       => 'quote',                               
                'title'    => esc_html__( 'Quote Button Text', 'braintech' ),                  
                'type'     => 'text',
                
        ),  
        
        array(
                'id'       => 'quote_link',                               
                'title'    => esc_html__( 'Quote Button Link', 'braintech' ),
                'subtitle' => esc_html__( 'Enter Quote Button Link Here', 'braintech' ),
                'type'     => 'text',
                
            ),      
        )
    ) 

);  
   

Redux::setSection( $opt_name, array(
'title'            => esc_html__( 'Header Layout', 'braintech' ),
'id'               => 'header-style',
'customizer_width' => '450px',
'subsection' =>true,      
'fields'    => array( 
                    
                array(
                    'id'       => 'header_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Header Layout', 'braintech'), 
                    'subtitle' => esc_html__('Select header layout. Choose between 1, 2 or 3 layout.', 'braintech'),
                    'options'  => array(
                    'style1'   => array(
                    'alt'      => 'Header Style 1', 
                    'img'      => get_template_directory_uri().'/libs/img/style_1.png'
                    ),                        
                    'style5' => array(
                        'alt'    => 'Header Style 2', 
                        'img'    => get_template_directory_uri().'/libs/img/style_2.png'
                    ),
                    'style8' => array(
                        'alt'    => 'Header Style 3', 
                        'img'    => get_template_directory_uri().'/libs/img/style_3.png'
                    ), 
                    'style4' => array(
                        'alt'    => 'Header Style 4', 
                        'img'    => get_template_directory_uri().'/libs/img/style_l.png'
                    ),                                 
                    ),
                    'default' => 'style8'
            ),                           
                
        )
    ) 
);

                                   
//Topbar settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Toolbar area', 'braintech' ),
        'desc'   => esc_html__( 'Toolbar area Style Here', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array( 
                        
                array(
                    'id'        => 'toolbar_bg_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar background Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#106eea',                        
                    'validate'  => 'color',                        
                ),
                array(
                    'id'        => 'toolbar_bg_skew_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Skew background Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '',                        
                    'validate'  => 'color',                        
                ),    

                array(
                    'id'        => 'toolbar_text_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Text Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ), 

                array(
                    'id'       => 'tool_dark_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Toolbar Dark Color', 'braintech' ),
                    'subtitle' => esc_html__( 'Pick color', 'braintech' ),      
                    'default'  => array(
                        'color'     => '#0a0a0a',                   
                    ),
                    'output' => array(                 
                        'color'            => '#rs-header.header-style8 .rs-address-area .info-title, #rs-header.header-style8 .rs-address-area .info-des, #rs-header.header-style8 .rs-address-area .info-des a'
                    )           
                ),

                array(
                    'id'       => 'tool_dark_hover_color',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Toolbar Dark Hover Color', 'braintech' ),
                    'subtitle' => esc_html__( 'Pick color', 'braintech' ),      
                    'default'  => array(
                        'color'     => '#0B70E1',                   
                    ),
                    'output' => array(                 
                        'color'            => '#rs-header.header-style8 .rs-address-area .info-des a:hover'
                    )           
                ),

                array(
                    'id'        => 'transparent_toolbar_text_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Transparent Toolbar Text Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'       => 'tool_border',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Toolbar Border Color', 'braintech' ),
                    'subtitle' => esc_html__( 'Pick color', 'braintech' ),      
                    'default'  => array(
                        'color'     => '',                   
                    ),
                    'output' => array(                 
                        'border-color'            => '#rs-header .toolbar-area .toolbar-contact ul li a, #rs-header .toolbar-area .opening em, #rs-header.header-style5 .toolbar-area, #rs-header.header-style5 .toolbar-area .toolbar-contact ul li, #rs-header.header-style5 .toolbar-area .opening'
                    )           
                ),

                array(
                    'id'        => 'toolbar_link_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ), 

               

                array(
                    'id'        => 'toolbar_link_hover_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Toolbar Link Hover Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#cccccc',                        
                    'validate'  => 'color',                        
                ),  

                 array(
                    'id'        => 'transparent_toolbar_link_hover_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Transparent Toolbar Link Hover Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#cccccc',                        
                    'validate'  => 'color',                        
                ), 

                array(
                    'id'        => 'toolbar_text_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Toolbar Font Size','braintech'),
                    'subtitle'  => esc_html__('Font Size', 'braintech'),    
                    'default'   => '14px',                                            
                ), 
                
        )
    )
);

  //Preloader settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Preloader Style', 'braintech' ),
        'desc'   => esc_html__( 'Preloader Style Here', 'braintech' ),        
        
        'fields' => array( 
                        array(
                            'id'       => 'show_preloader',
                            'type'     => 'switch', 
                            'title'    => esc_html__('Show Preloader', 'braintech'),
                            'subtitle' => esc_html__('You can show or hide preloader', 'braintech'),
                            'default'  => false,
                        ), 

                        array(
                            'id'        => 'preloader_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Preloader Background Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'preloader_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Preloader Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'    => 'preloader_img', 
                            'url'   => true,     
                            'title' => esc_html__( 'Preloader Image', 'braintech' ),                 
                            'type'  => 'media',                                  
                        ),       
                    )
                )
            );    
//End Preloader settings  
    // -> START Style Section
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Style', 'braintech' ),
        'id'               => 'stle',
        'customizer_width' => '450px',
        'icon' => 'el el-brush',
        ));
    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Global Style', 'braintech' ),
        'desc'   => esc_html__( 'Style your theme', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array( 
                        
                        array(
                            'id'        => 'body_bg_color',
                            'type'      => 'color',                           
                            'title'     => esc_html__('Body Backgroud Color','braintech'),
                            'subtitle'  => esc_html__('Pick body background color', 'braintech'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'body_text_color',
                            'type'      => 'color',            
                            'title'     => esc_html__('Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick text color', 'braintech'),
                            'default'   => '#454545',
                            'validate'  => 'color',                        
                        ),     
        
                        array(
                            'id'        => 'primary_color',
                            'type'      => 'color', 
                            'title'     => esc_html__('Primary Color','braintech'),
                            'subtitle'  => esc_html__('Select Primary Color.', 'braintech'),
                            'default'   => '#061340',
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'secondary_color',
                            'type'      => 'color', 
                            'title'     => esc_html__('Secondary Color','braintech'),
                            'subtitle'  => esc_html__('Select Secondary Color.', 'braintech'),
                            'default'   => '#0B70E1',
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'third_color',
                            'type'      => 'color', 
                            'title'     => esc_html__('Third Color','braintech'),
                            'subtitle'  => esc_html__('Select Third Color.', 'braintech'),
                            'default'   => '#03228F',
                            'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'link_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Link Color','braintech'),
                            'subtitle'  => esc_html__('Pick Link color', 'braintech'),
                            'default'   => '#0B70E1',
                            'validate'  => 'color',                        
                        ),
                        
                        array(
                            'id'        => 'link_hover_text_color',
                            'type'      => 'color',                 
                            'title'     => esc_html__('Link Hover Color','braintech'),
                            'subtitle'  => esc_html__('Pick link hover color', 'braintech'),
                            'default'   => '#0B70E1',
                            'validate'  => 'color',                        
                        ),

                        array(
                            'id'        => 'gradient_first_color',
                            'type'      => 'color',                 
                            'title'     => esc_html__('First Gradient Color','braintech'),
                            'subtitle'  => esc_html__('Pick Gradient color', 'braintech'),
                            'default'   => '',
                            'validate'  => 'color',                        
                        ),  
                        array(
                            'id'        => 'gradient_snd_color',
                            'type'      => 'color',                 
                            'title'     => esc_html__('Second Gradient Color','braintech'),
                            'subtitle'  => esc_html__('Pick Gradient color', 'braintech'),
                            'default'   => '',
                            'validate'  => 'color',                        
                        ),    
                       
                 ) 
            ) 
    ); 

       
    
    //Menu settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Main Menu', 'braintech' ),
        'desc'   => esc_html__( 'Main Menu Style Here', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array( 

                        array(
                            'id'     => 'notice_critical_menu',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'success',
                            'title'  => esc_html__('Main Menu Settings', 'braintech'),                                           
                        ),

                        array(
                            'id'       => 'main_menu_center',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Main Menu Center', 'braintech' ),
                            'on'       => esc_html__( 'Enabled', 'braintech' ),
                            'off'      => esc_html__( 'Disabled', 'braintech' ),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'main_menu_icon',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Main Menu Icon Hide', 'braintech' ),
                            'on'       => esc_html__( 'Enabled', 'braintech' ),
                            'off'      => esc_html__( 'Disabled', 'braintech' ),
                            'default'  => false,
                        ),

                        array(
                            'id'        => 'menu_area_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Background Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#101010',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'transparent_menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Trasparent Menu Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'transparent_menu_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Trasparent Menu Hover Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#0B70E1',                        
                            'validate'  => 'color',                        
                        ),  

                        array(
                            'id'        => 'transparent_menu_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Trasparent Menu Active Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#0B70E1',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Hover Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),           
                            'default'   => '#0B70E1',                 
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Active Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),
                            'default'   => '#0B70E1',
                            'validate'  => 'color',                        
                        ),

                         array(
                            'id'        => 'menu_des_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Item Description Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),
                            'default'   => '',
                            'validate'  => 'color', 
                            'output' => array(                 
                                'color'            => 'span.description'
                            )                          
                        ),

                        array(
                            'id'        => 'menu_des_size',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Description Font Size','braintech'),   
                            'default'   => '22px',                             
                        ), 

                        array(
                            'id'        => 'menu_item_gap',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Item Left Right Gap','braintech'),   
                            'default'   => '10px',                             
                        ), 
                        array(
                            'id'        => 'menu_item_gap2',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Item Top Gap','braintech'),   
                            'default'   => '22px',                             
                        ),                        

                        array(
                            'id'        => 'menu_item_gap3',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Menu Item Bottom Gap','braintech'),   
                            'default'   => '14px',                             
                        ),

                        array(
                            'id'       => 'menu_text_trasform',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Menu Text Uppercase', 'braintech' ),
                            'on'       => esc_html__( 'Enabled', 'braintech' ),
                            'off'      => esc_html__( 'Disabled', 'braintech' ),
                            'default'  => false,
                        ),

                        array(
                            'id'     => 'notice_critical_dropmenu',
                            'type'   => 'info',
                            'notice' => true,
                            'style'  => 'success',
                            'title'  => esc_html__('Dropdown Menu Settings', 'braintech'),                                           
                        ),
                                               
                        array(
                            'id'        => 'drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Background Color','braintech'),
                            'subtitle'  => esc_html__('Pick bg color', 'braintech'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'drop_text_color',
                            'type'      => 'color',                     
                            'title'     => esc_html__('Dropdown Menu Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick text color', 'braintech'),
                            'default'   => '#101010',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick text color', 'braintech'),
                            'default'   => '#0B70E1',
                            'validate'  => 'color',                        
                        ),  

                        array(
                            'id'        => 'drop_menu_des_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Description Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),
                            'default'   => '',
                            'validate'  => 'color', 
                            'output' => array(                 
                                'color'            => '.menu-area .navbar ul li ul.sub-menu span.description'
                            )                          
                        ),                            
                     

                        array(
                            'id'       => 'menu_text_trasform2',
                            'type'     => 'switch',
                            'title'    => esc_html__( 'Dropdown Menu Text Uppercase', 'braintech' ),
                            'on'       => esc_html__( 'Enabled', 'braintech' ),
                            'off'      => esc_html__( 'Disabled', 'braintech' ),
                            'default'  => false,
                        ),

                        array(
                             'id'        => 'dropdown_menu_item_gap',
                             'type'      => 'text',                       
                             'title'     => esc_html__('Dropdown Menu Item Left Right Gap','braintech'),   
                             'default'   => '40px',                             
                         ), 

                        array(
                             'id'        => 'dropdown_menu_item_separate',
                             'type'      => 'text',                       
                             'title'     => esc_html__('Dropdown Menu Item Middle Gap','braintech'),   
                             'default'   => '10px',                             
                         ), 
                         array(
                             'id'        => 'dropdown_menu_item_gap2',
                             'type'      => 'text',                       
                             'title'     => esc_html__('Dropdown Menu Boxes Top Bottom Gap','braintech'),   
                             'default'   => '21px',                             
                         ),
                         array(
                             'id'     => 'notice_critical3',
                             'type'   => 'info',
                             'notice' => true,
                             'style'  => 'success',
                             'title'  => esc_html__('Mega Menu Settings', 'braintech'),                                           
                         ),

                          array(
                            'id'        => 'meaga_menu_item_gap',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Mega Menu Item Left Right Gap','braintech'),   
                            'default'   => '40px',                             
                        ), 

                         array(
                            'id'        => 'mega_menu_item_separate',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Mega Menu Item Middle Gap','braintech'),   
                            'default'   => '10px',                             
                        ),  
                        array(
                            'id'        => 'mega_menu_item_gap2',
                            'type'      => 'text',                       
                            'title'     => esc_html__('Mega Menu Boxes Top Bottom Gap','braintech'),   
                            'default'   => '21px',                             
                        ),                       
                        
                        
                )
            )
        ); 

     //Sticky Menu settings
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Sticky Menu', 'braintech' ),
        'desc'       => esc_html__( 'Sticky Menu Style Here', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array(                       

                        array(
                            'id'        => 'stiky_menu_area_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Sticky Menu Area Background Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#fff',                        
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'stikcy_menu_text_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Menu Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#101010',                        
                            'validate'  => 'color',                        
                        ), 
                       

                        array(
                            'id'        => 'sticky_menu_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Menu Text Hover Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),           
                            'default'   => '#1273eb',                 
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'        => 'stikcy_menu_text_active_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Main Menu Text Active Color','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),
                            'default'   => '#1273eb',
                            'validate'  => 'color',                        
                        ),
                                               
                        array(
                            'id'        => 'sticky_drop_down_bg_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Background Color','braintech'),
                            'subtitle'  => esc_html__('Pick bg color', 'braintech'),
                            'default'   => '#fff',
                            'validate'  => 'color',                        
                        ), 
                            
                        
                        array(
                            'id'        => 'stikcy_drop_text_color',
                            'type'      => 'color',                     
                            'title'     => esc_html__('Dropdown Menu Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick text color', 'braintech'),
                            'default'   => '#101010',
                            'validate'  => 'color',                        
                        ), 
                        
                        array(
                            'id'        => 'sticky_drop_text_hover_color',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Dropdown Menu Hover Text Color','braintech'),
                            'subtitle'  => esc_html__('Pick text color', 'braintech'),
                            'default'   => '#1273eb',
                            'validate'  => 'color',                        
                        ),                        
                )
            )
        ); 

    //Breadcrumb settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Breadcrumb Style', 'braintech' ),      
        'subsection' =>true,  
        'fields' => array( 

                      array(
                        'id'       => 'off_breadcrumb',
                        'type'     => 'switch', 
                        'title'    => esc_html__('Show off Breadcrumb', 'braintech'),
                        'subtitle' => esc_html__('You can show or hide off breadcrumb here', 'braintech'),
                        'default'  => true,
                    ),

                    array(
                        'id'        => 'breadcrumb_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Background Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#101010',                        
                        'validate'  => 'color',                        
                    ),                     

                     array(
                        'id'       => 'page_banner_main',
                        'type'     => 'media',
                        'title'    => esc_html__( 'Background Banner', 'braintech' ),
                        'subtitle' => esc_html__( 'Upload your banner', 'braintech' ),                  
                    ), 
                    
                    array(
                        'id'        => 'breadcrumb_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Text Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ),

                    array(
                        'id'        => 'breadcrumb_seperator_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Breadcrumb Seperator Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#1273eb',                        
                        'validate'  => 'color',                        
                    ),  
                    
                  
                    array(
                        'id'        => 'breadcrumb_top_gap',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Top Gap','braintech'),                          
                        'default'   => '150px',                        
                                            
                    ), 
                     array(
                        'id'        => 'breadcrumb_bottom_gap',
                        'type'      => 'text',                       
                        'title'     => esc_html__('Bottom Gap','braintech'),                          
                        'default'   => '150px',                        
                                            
                    ),     
                        
                )
            )
        );

    //Button settings
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Button Style', 'braintech' ),
        'desc'       => esc_html__( 'Button Style Here', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array( 

                    array(
                        'id'        => 'btn_bg_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Background Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#0B70E1',                        
                        'validate'  => 'color',                        
                    ), 

                    array(
                        'id'        => 'btn_bg_hover',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Hover Background','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#0B70E1',                        
                        'validate'  => 'color',                        
                    ), 

                    array(
                        'id'        => 'btn_bg_hover_border',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Hover Border Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#0B70E1',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_text_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Text Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ), 
                    
                    array(
                        'id'        => 'btn_txt_hover_color',
                        'type'      => 'color',                       
                        'title'     => esc_html__('Hover Text Color','braintech'),
                        'subtitle'  => esc_html__('Pick color', 'braintech'),    
                        'default'   => '#fff',                        
                        'validate'  => 'color',                        
                    ),  
                )
            )
        );
    
    //offcanvas  settings
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Offcanvas Style', 'braintech' ),
        'desc'   => esc_html__( 'Offcanvas Style Here', 'braintech' ),        
        'subsection' =>true,  
        'fields' => array( 

                array(
                    'id'       => 'show_off_contact_information',
                    'type'     => 'switch', 
                    'title'    => esc_html__('Show Contact Information', 'braintech'),
                    'subtitle' => esc_html__('You can Contact Information show or hide', 'braintech'),
                    'default'  => true,
                ),

                array(
                    'id'       => 'offcanvas_logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Offcanvas Logo', 'braintech' ),
                    'subtitle' => esc_html__( 'Upload your  logo', 'braintech' ),                  
                ), 

                
                array(
                    'id'       => 'offcanvas_logo_height',                               
                    'title'    => esc_html__( 'Logo Height', 'braintech' ),
                    'subtitle' => esc_html__( 'Logo max height example(50px)', 'braintech' ),
                    'type'     => 'text',
                    'default'  => '36px'                    
                ),

                array(
                    'id'        => 'offcan_bgs_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Background Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ), 
   

                array(
                    'id'        => 'offcan_link_social_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Social Icon Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#fff',                        
                    'validate'  => 'color',                        
                ), 

                array(
                    'id'        => 'offcan_txt_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Text Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#333',                        
                    'validate'  => 'color',                        
                ),
                 
                array(
                    'id'        => 'offcan_link_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Link Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#333',                        
                    'validate'  => 'color',                        
                ),  
                array(
                    'id'        => 'offcan_link_hovers_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Link hover Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#555',                        
                    'validate'  => 'color',                        
                ),  

          
                array(
                    'id'        => 'offcanvas_text_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Dots Primary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#333',                        
                    'validate'  => 'color',                        
                ), 
          
                array(
                    'id'        => 'offcanvas_dots_secondary_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Dots Secondary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '',                        
                    'validate'  => 'color',                        
                ),


                array(
                    'id'        => 'offcanvas_text_sticky_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Sticky Dots Primary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '#333',                        
                    'validate'  => 'color',                        
                ), 
          
                array(
                    'id'        => 'offcanvas_dots_sticky_secondary_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Sticky Dots Secondary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '',                        
                    'validate'  => 'color',                        
                ),

                array(
                    'id'        => 'offcanvas_close_dots_primary_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Close Dots Primary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '',                        
                    'validate'  => 'color',                        
                ),

                array(
                    'id'        => 'offcanvas_dots_close_secondary_color',
                    'type'      => 'color',                       
                    'title'     => esc_html__('Hamburger Close Dots Secondary Color','braintech'),
                    'subtitle'  => esc_html__('Pick color', 'braintech'),    
                    'default'   => '',                        
                    'validate'  => 'color',                        
                ),
            )
        )
    );
    

    //-> START Typography
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Typography', 'braintech' ),
        'id'     => 'typography',
        'desc'   => esc_html__( 'You can specify your body and heading font here','braintech'),
        'icon'   => 'el el-font',
        'fields' => array(
            array(
                'id'       => 'opt-typography-body',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font', 'braintech' ),
                'subtitle' => esc_html__( 'Specify the body font properties.', 'braintech' ),
                'google'   => true, 
                'font-style' =>false,           
                'default'  => array(                    
                    'font-size'   => '16px',
                    'font-family' => 'Livvic',
                    'font-weight' => '400',
                ),
            ),
             array(
                'id'       => 'opt-typography-menu',
                'type'     => 'typography',
                'title'    => esc_html__( 'Navigation Font', 'braintech' ),
                'subtitle' => esc_html__( 'Specify the menu font properties.', 'braintech' ),
                'google'   => true,
                'font-backup' => true,                
                'all_styles'  => true,              
                'default'  => array(
                    'color'       => '#202427',                    
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '15px',                    
                    'font-weight' => '500',                    
                ),
            ),
            array(
                'id'          => 'opt-typography-h1',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H1', 'braintech' ),
                'font-backup' => true,                
                'all_styles'  => true,
                'units'       => 'px',
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '46px',
                    'line-height' => '56px'
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h2',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H2', 'braintech' ),
                'font-backup' => true,                
                'all_styles'  => true,                 
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '36px',
                    'line-height' => '40px'
                    
                ),
                ),
            array(
                'id'          => 'opt-typography-h3',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H3', 'braintech' ),             
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '28px',
                    'line-height' => '32px'
                    
                    ),
                ),
            array(
                'id'          => 'opt-typography-h4',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H4', 'braintech' ),                
                'font-backup' => false,                
                'all_styles'  => true,               
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '20px',
                    'line-height' => '28px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-h5',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H5', 'braintech' ),                
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '18px',
                    'line-height' => '28px'
                    ),
                ),
            array(
                'id'          => 'opt-typography-6',
                'type'        => 'typography',
                'title'       => esc_html__( 'Heading H6', 'braintech' ),
             
                'font-backup' => false,                
                'all_styles'  => true,                
                'units'       => 'px',
                // Defaults to px
                'subtitle'    => esc_html__( 'Typography option with each property can be called individually.', 'braintech' ),
                'default'     => array(
                    'color'       => '#0a0a0a',
                    'font-style'  => '700',
                    'font-family' => 'Livvic',
                    'google'      => true,
                    'font-size'   => '16px',
                    'line-height' => '20px'
                ),
            ),
                
        )
    )                    
   
);

    /*Blog Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog', 'braintech' ),
        'id'               => 'blog',
        'customizer_width' => '450px',
        'icon' => 'el el-comment',
        )
        );
        
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog Settings', 'braintech' ),
        'id'               => 'blog-settings',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(
        
                                array(
                                    'id'    => 'blog_banner_main', 
                                    'url'   => true,     
                                    'title' => esc_html__( 'Blog Page Banner', 'braintech' ),                 
                                    'type'  => 'media',                                  
                                ),  

                                array(
                                    'id'        => 'blog_bg_color',
                                    'type'      => 'color',                           
                                    'title'     => esc_html__('Body Backgroud Color','braintech'),
                                    'subtitle'  => esc_html__('Pick body background color', 'braintech'),
                                    'default'   => '#ffffff',
                                    'validate'  => 'color',                        
                                ),
                                
                                array(
                                    'id'       => 'blog_title',                               
                                    'title'    => esc_html__( 'Blog  Title', 'braintech' ),
                                    'subtitle' => esc_html__( 'Enter Blog  Title Here', 'braintech' ),
                                    'type'     => 'text',                                   
                                ),
                                
                                array(
                                    'id'               => 'blog-layout',
                                    'type'             => 'image_select',
                                    'title'            => esc_html__('Select Blog Layout', 'braintech'), 
                                    'subtitle'         => esc_html__('Select your blog layout', 'braintech'),
                                    'options'          => array(
                                    'full'             => array(
                                    'alt'              => 'Blog Style 1', 
                                    'img'              => get_template_directory_uri().'/libs/img/1c.png'                                      
                                ),
                                    '2right'           => array(
                                    'alt'              => 'Blog Style 2', 
                                    'img'              => get_template_directory_uri().'/libs/img/2cr.png'
                                ),
                                '2left'            => array(
                                'alt'              => 'Blog Style 3', 
                                'img'              => get_template_directory_uri().'/libs/img/2cl.png'
                                ),                                  
                                ),
                                'default'          => '2right'
                                ),                      
                                
                                array(
                                    'id'               => 'blog-grid',
                                    'type'             => 'select',
                                    'title'            => esc_html__('Select Blog Gird', 'braintech'),                   
                                    'desc'             => esc_html__('Select your blog gird layout', 'braintech'),
                                //Must provide key => value pairs for select options
                                'options'          => array(
                                    '12'               => esc_html__('1 Column','braintech'),                                   
                                    '6'                => esc_html__('2 Column', 'braintech'),                                         
                                    '4'                => esc_html__('3 Column', 'braintech'),
                                    '3'                => esc_html__('4 Column', 'braintech'),
                                    ),
                                    'default'          => '12',                                  
                                ),  
                                
                                array(
                                'id'               => 'blog-author-post',
                                'type'             => 'select',
                                'title'            => esc_html__('Show Author Info ', 'braintech'),                   
                                'desc'             => esc_html__('Select author info show or hide', 'braintech'),
                                //Must provide key => value pairs for select options
                                'options'          => array(                                            
                                'show'             => esc_html__('Show','braintech'), 
                                'hide'             => esc_html__('Hide', 'braintech'),
                                ),
                                'default'          => 'show',
                                
                                ), 

                                

                                array(
                                'id'               => 'blog-category',
                                'type'             => 'select',
                                'title'            => esc_html__('Show Category', 'braintech'),                   
                               
                                //Must provide key => value pairs for select options
                                'options'          => array(                                            
                                'show'             => esc_html__('Show','braintech'), 
                                'hide'             => esc_html__('Hide', 'braintech'),
                                ),
                                'default'          => 'show',
                                
                                ),  
                                
                                array(
                                    'id'               => 'blog-date',
                                    'type'             => 'switch',
                                    'title'            => esc_html__('Show Date', 'braintech'),                   
                                    'desc'             => esc_html__('You can show/hide date at blog page', 'braintech'),
                                    
                                    'default'          => true,
                                ), 
                                array(
                                    'id'               => 'blog_readmore',                               
                                    'title'            => esc_html__( 'Blog  ReadMore Text', 'braintech' ),
                                    'subtitle'         => esc_html__( 'Enter Blog  ReadMore Here', 'braintech' ),
                                    'type'             => 'text',                                   
                                ),
                                
                            )
                        ) 
                                
                    );
    
    
    /*Single Post Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single Post', 'braintech' ),
        'id'               => 'spost',
        'subsection'       => true,
        'customizer_width' => '450px',      
        'fields'           => array(                            
        
                            array(
                                    'id'       => 'blog_banner', 
                                    'url'      => true,     
                                    'title'    => esc_html__( 'Blog Single page banner', 'braintech' ),                  
                                    'type'     => 'media',
                                    
                            ),  
                           
                           array(
                               'id'       => 'blog-author',
                               'type'     => 'switch', 
                               'title'    => esc_html__('Show Meta', 'braintech'),
                               'subtitle' => esc_html__('You can show or hide Meta', 'braintech'),
                               'default'  => false,
                           ),     
                        )
                )    
    
    );

  
    /*Team Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Team Section', 'braintech' ),
        'id'               => 'team',
        'customizer_width' => '450px',
        'icon' => 'el el-user',
        'fields'           => array(

             array(
                'id'       => 'show-team-banner',
                'type'     => 'switch', 
                'title'    => esc_html__('Show Team Page Banner', 'braintech'),
                'subtitle' => esc_html__('You can select banner show or hide', 'braintech'),
                'default'  => true,
            ), 
        
            array(
                    'id'       => 'team_single_image', 
                    'url'      => true,     
                    'title'    => esc_html__( 'Team Single page banner image', 'braintech' ),                    
                    'type'     => 'media',
                    
            ),  

             array(
                    'id'        => 'team_single_bg_color',
                    'type'      => 'color',                           
                    'title'     => esc_html__('Sinlge Team Body Backgroud Color','braintech'),
                    'subtitle'  => esc_html__('Pick body background color', 'braintech'),
                    'default'   => '#fff',
                    'validate'  => 'color',                        
                ),
            
            array(
                    'id'       => 'team_slug',                               
                    'title'    => esc_html__( 'Team Slug', 'braintech' ),
                    'subtitle' => esc_html__( 'Enter Team Slug Here', 'braintech' ),
                    'type'     => 'text',
                    'default'  => esc_html__('teams', 'braintech'),
                    
                ),               
                          
             )
         ) 
    );
    

    /*Department Sections*/
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Portfolio Section', 'braintech' ),
        'id'               => 'Portfolio',
        'customizer_width' => '450px',
        'icon' => 'el el-align-right',
        'fields'           => array(
        
            array(
                    'id'       => 'department_single_image', 
                    'url'      => true,     
                    'title'    => esc_html__( 'Portfolio Single page banner image', 'braintech' ),                    
                    'type'     => 'media',
                    
            ),  

             array(
                    'id'       => 'portfolio_slug',                               
                    'title'    => esc_html__( 'Portfolio Slug', 'braintech' ),
                    'subtitle' => esc_html__( 'Enter Portfolio Slug Here', 'braintech' ),
                    'type'     => 'text',
                    'default'  => 'portfolio',
                    
                ), 
            )
         ) 
    );




    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Social Icons', 'braintech' ),
        'desc'   => esc_html__( 'Add your social icon here', 'braintech' ),
        'icon'   => 'el el-share',
         'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields' => array(
                    array(
                        'id'       => 'facebook',                               
                        'title'    => esc_html__( 'Facebook Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Facebook Link', 'braintech' ),
                        'type'     => 'text',                     
                    ),
                        
                     array(
                        'id'       => 'twitter',                               
                        'title'    => esc_html__( 'Twitter Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Twitter Link', 'braintech' ),
                        'type'     => 'text'
                    ),
                    
                        array(
                        'id'       => 'rss',                               
                        'title'    => esc_html__( 'Rss Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Rss Link', 'braintech' ),
                        'type'     => 'text'
                    ),
                    
                     array(
                        'id'       => 'pinterest',                               
                        'title'    => esc_html__( 'Pinterest Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Pinterest Link', 'braintech' ),
                        'type'     => 'text'
                    ),
                     array(
                        'id'       => 'linkedin',                               
                        'title'    => esc_html__( 'Linkedin Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Linkedin Link', 'braintech' ),
                        'type'     => 'text', 
                    ),

                    array(
                        'id'       => 'instagram',                               
                        'title'    => esc_html__( 'Instagram Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Instagram Link', 'braintech' ),
                        'type'     => 'text',                       
                    ),

                     array(
                        'id'       => 'youtube',                               
                        'title'    => esc_html__( 'Youtube Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Youtube Link', 'braintech' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'tumblr',                               
                        'title'    => esc_html__( 'Tumblr Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Tumblr Link', 'braintech' ),
                        'type'     => 'text',                       
                    ),

                    array(
                        'id'       => 'vimeo',                               
                        'title'    => esc_html__( 'Vimeo Link', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter Vimeo Link', 'braintech' ),
                        'type'     => 'text',                       
                    ),         
            ) 
        ) 
    );
    
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Mouse Pointer', 'braintech' ),
        'desc'   => esc_html__( 'Add your Mouse Pointer here', 'braintech' ),
        'icon'   => 'el el-hand-up',
         'submenu' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
        'fields' => array(
                        array(
                            'id'       => 'show_pointer',
                            'type'     => 'switch', 
                            'title'    => esc_html__('Show Pointer', 'braintech'),
                            'subtitle' => esc_html__('You can show or hide Mouse Pointer', 'braintech'),
                            'default'  => false,
                        ), 

                        array(
                            'id'        => 'pointer_border',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Pointer Border','braintech'),
                            'subtitle'  => esc_html__('Pick color', 'braintech'),    
                            'default'   => '#1273eb',                        
                            'validate'  => 'color',                        
                        ), 

                        array(
                            'id'       => 'border_width',                               
                            'title'    => esc_html__( 'Border Width', 'braintech' ),
                            'subtitle' => esc_html__( 'Enter Pointer Border Width', 'braintech' ),
                            'type'     => 'text',
                            'default'   => '2',                         
                        ), 

                        array(
                            'id'        => 'pointer_bg',
                            'type'      => 'color',                       
                            'title'     => esc_html__('Pointer Background','braintech'),
                            'subtitle'  => esc_html__('Enter Pointer Background color', 'braintech'),    
                            'default'   => 'transparent',                        
                            'validate'  => 'color',                        
                        ),  


                        array(
                            'id'       => 'diameter',                               
                            'title'    => esc_html__( 'Diameter', 'braintech' ),
                            'subtitle' => esc_html__( 'Enter Pointer diameter Size', 'braintech' ),
                            'type'     => 'text',  
                            'default'   => '40',                    
                        ),   

                        array(
                            'id'       => 'speed',                               
                            'title'    => esc_html__( 'Pointer Speed', 'braintech' ),
                            'subtitle' => esc_html__( 'Enter Pointer Scale Size', 'braintech' ),
                            'type'     => 'text',
                            'default'   => '4',                         
                        ),                     

                        array(
                            'id'       => 'scale',                               
                            'title'    => esc_html__( 'Hover Scale', 'braintech' ),
                            'subtitle' => esc_html__( 'Enter Pointer Scale Size', 'braintech' ),
                            'type'     => 'text',
                            'default'   => '1.3',                         
                        ),
            ) 
        ) 
    );
    if ( class_exists( 'WooCommerce' ) ) {
    Redux::setSection( $opt_name, array(
        'title'  => esc_html__( 'Woocommerce', 'braintech' ),    
        'icon'   => 'el el-shopping-cart',    
        ) 
    ); 

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Shop', 'braintech' ),
        'id'               => 'shop_layout',
        'customizer_width' => '450px',
        'subsection' =>true,      
        'fields'           => array(                      
            array(
                'id'       => 'shop_banner', 
                'url'      => true,     
                'title'    => esc_html__( 'Shop page banner', 'braintech' ),                    
                'type'     => 'media',
            ), 
            array(
                    'id'       => 'shop-layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__('Select Shop Layout', 'braintech'), 
                    'subtitle' => esc_html__('Select your shop layout', 'braintech'),
                    'options'  => array(
                        'full'      => array(
                            'alt'   => 'Shop Style 1', 
                            'img'   => get_template_directory_uri().'/libs/img/1c.png'                                      
                        ),
                        'right-col' => array(
                            'alt'   => 'Shop Style 2', 
                            'img'   => get_template_directory_uri().'/libs/img/2cr.png'
                        ),
                        'left-col'  => array(
                            'alt'   => 'Shop Style 3', 
                            'img'   => get_template_directory_uri().'/libs/img/2cl.png'
                        ),                                  
                    ),
                    'default' => 'full'
                ),

                array(
                    'id'       => 'wc_num_product',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Page', 'braintech' ),
                    'default'  => '9',
                ),

                array(
                    'id'       => 'wc_num_product_per_row',
                    'type'     => 'text',
                    'title'    => esc_html__( 'Number of Products Per Row', 'braintech' ),
                    'default'  => '3',
                ),

                array(
                    'id'       => 'wc_cart_icon',
                    'type'     => 'switch',
                    'title'    => esc_html__( 'Cart Icon Show At Menu Area', 'braintech' ),
                    'on'       => esc_html__( 'Enabled', 'braintech' ),
                    'off'      => esc_html__( 'Disabled', 'braintech' ),
                    'default'  => false,
                ), 

                 array(
                'id'       => 'disable-sidebar',
                'type'     => 'switch', 
                'title'    => esc_html__('Sidebar Disable For Single Product Page', 'braintech'),                
                'default'  => true,
            ), 
               
            )
        ) 
    );
}
   
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( 'Footer Option', 'braintech' ),
    'desc'   => esc_html__( 'Footer style here', 'braintech' ),
    'icon'   => 'el el-th-large',   
    'fields' => array(
                array(
                        'id'       => 'footer_bg_image', 
                        'url'      => true,     
                        'title'    => esc_html__( 'Footer Background Image', 'braintech' ),                 
                        'type'     => 'media',                                  
                ),

                array(
                        'id'        => 'footer_bg_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Bg Color','braintech'),
                        'subtitle'  => esc_html__('Pick color.', 'braintech'),
                        'default'   => '#F5F6F9',
                        'validate'  => 'color',                        
                    ),  

                 array(
                    'id'               => 'header_grid2',
                    'type'             => 'select',
                    'title'            => esc_html__('Footer Area Width', 'braintech'),             
                   
                    'options'          => array(                                     
                    
                        'container' => esc_html__('Container', 'braintech'),
                        'full'      => esc_html__('Container Fluid', 'braintech')
                    ),

                    'default'          => 'container',            
                ),

                array(
                    'id'       => 'footer_logo',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Footer Logo', 'braintech' ),
                    'subtitle' => esc_html__( 'Upload your footer logo', 'braintech' ),                  
                ), 

             
                array(
                    'id'       => 'footer-logo-height',                               
                    'title'    => esc_html__( 'Logo Height', 'braintech' ),
                    'subtitle' => esc_html__( 'Logo max height example(50px)', 'braintech' ),
                    'type'     => 'text',
                    'default'  => '40px'                    
                ), 
                array(
                    'id'        => 'foot_social_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Social Icon Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#111111',
                    'validate'  => 'color',                        
                ),                   

                array(
                    'id'        => 'foot_social_hover',
                    'type'      => 'color',
                    'title'     => esc_html__('Social Icon Hover','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#666666',
                    'validate'  => 'color',                        
                ),   

                array(
                    'id'        => 'footer_text_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Footer Font Size','braintech'),
                    'subtitle'  => esc_html__('Font Size', 'braintech'),    
                    'default'   => '16px',                                            
                ),  

                array(
                    'id'        => 'footer_h3_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Footer Title Font Size','braintech'),
                    'subtitle'  => esc_html__('Font Size', 'braintech'),    
                    'default'   => '22px',                                            
                ),  

                array(
                    'id'        => 'footer_link_size',
                    'type'      => 'text',                       
                    'title'     => esc_html__('Footer Link Font Size','braintech'),
                    'subtitle'  => esc_html__('Font Size', 'braintech'),    
                    'default'   => '',                                            
                ), 
                array(
                    'id'        => 'footer_title_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Title Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#111111',
                    'validate'  => 'color',                        
                ),   

                array(
                    'id'        => 'footer_text_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Text Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#454545',
                    'validate'  => 'color',                        
                ),  

                array(
                    'id'        => 'footer_link_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Link Hover Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#1273EB',
                    'validate'  => 'color',                        
                ),   

                array(
                    'id'        => 'footer_input_bg_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Button Background Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '',
                    'validate'  => 'color',                        
                ), 

                array(
                        'id'        => 'footer_input_hover_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Button Hover Background Color','braintech'),
                        'subtitle'  => esc_html__('Pick color.', 'braintech'),
                        'default'   => '',
                        'validate'  => 'color',                        
                    ),

                array(
                        'id'        => 'footer_input_border_color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer input Border Color','braintech'),
                        'subtitle'  => esc_html__('Pick color.', 'braintech'),
                        'default'   => '#333333',
                        'validate'  => 'color',                        
                    ),  

                array(
                    'id'        => 'footer_input_text_color',
                    'type'      => 'color',
                    'title'     => esc_html__('Footer Button Text Color','braintech'),
                    'subtitle'  => esc_html__('Pick color.', 'braintech'),
                    'default'   => '#fff',
                    'validate'  => 'color',                        
                ),                  
                       
                
                array(
                    'id'       => 'copyright',
                    'type'     => 'textarea',
                    'title'    => esc_html__( 'Footer CopyRight', 'braintech' ),
                    'subtitle' => esc_html__( 'Change your footer copyright text ?', 'braintech' ),
                    'default'  => esc_html__( '2020 All Rights Reserved', 'braintech' ),
                ),  

                array(
                    'id'       => 'copyright_bg',
                    'type'     => 'color_rgba',
                    'title'    => esc_html__( 'Copyright Background', 'braintech' ),
                    'subtitle' => esc_html__( 'Copyright Background Color', 'braintech' ),      
                    'default'  => array(
                        'color'     => '',                   
                    ),
                    'output' => array(                 
                        'background'            => 'body .footer-bottom'
                    )           
                ),
         
                array(
                    'id'       => 'copyright_text_color',
                    'type'     => 'color',
                    'title'    => esc_html__( 'Copyright Text Color', 'braintech' ),
                    'subtitle' => esc_html__( 'Copyright Text Color', 'braintech' ),      
                    'default'  => '#454545',            
                ), 
            ) 
        ) 
    );        
    
    Redux::setSection( $opt_name, array(
    'title'  => esc_html__( '404 Error Page', 'braintech' ),
    'desc'   => esc_html__( '404 details  here', 'braintech' ),
    'icon'   => 'el el-error-alt',    
    'fields' => array(

                array(
                        'id'       => 'title_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Title', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter title for 404 page', 'braintech' ), 
                        'default'  => esc_html__('404', 'braintech')                
                    ),  
                
                array(
                        'id'       => 'text_404',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Text', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter text for 404 page', 'braintech' ),  
                        'default'  => esc_html__('Page Not Found', 'braintech')             
                    ),                      
                       
                
                array(
                        'id'       => 'back_home',
                        'type'     => 'text',
                        'title'    => esc_html__( 'Back to Home Button Label', 'braintech' ),
                        'subtitle' => esc_html__( 'Enter label for "Back to Home" button', 'braintech' ),
                        'default'  => esc_html__('Back to Homepage', 'braintech')  
                                    
                    ), 

                array(
                    'id'       => 'error_bg',
                    'type'     => 'media',
                    'title'    => esc_html__( 'Upload 404 Page Bg', 'braintech' ),
                    'subtitle' => esc_html__( 'Upload your image', 'braintech' ),
                    'url'=> true                
                ),                
            
                                  
            ) 
        ) 
    );   


    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";           
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.     
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'braintech' ),
                'desc'   => esc_html__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'braintech' ),
                'icon'   => 'el el-paper-clip',              
                'fields' => array()
            );
            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';
            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_action( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );              
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }