<?php
use \Elementor\Controls_Manager;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Typography;
use \Elementor\Scheme_Typography;


/**
 * Elementor Table Widget.
 *
 * @since 1.0.0
 */
class Rsaddon_Pro_Table_Elementor_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'RS-Table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'RS Table', 'rsaddon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'flaticon-table-for-data';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'rsaddon_category' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_table_header',
			[
				'label' => esc_html__( 'Table Header', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'table_header',
			[
				'label' => esc_html__( 'Table Header Cell', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'text' => esc_html__( 'Table Header', 'rsaddon' ),
					],
					[
						'text' => esc_html__( 'Table Header', 'rsaddon' ),
					]
				],
				'fields' => [
					[
						'name' => 'text',
						'label' => esc_html__( 'Text', 'rsaddon' ),
						'type' => Controls_Manager::TEXT,
						'label_block' => true,
						'placeholder' => esc_html__( 'Table Header', 'rsaddon' ),
						'default' => esc_html__( 'Table Header', 'rsaddon' ),
						'dynamic' => [
		                    'active' => true,
		                ]
					],
					[
						'name'	=> 'advance',
						'label' => esc_html__( 'Advance Settings', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspan',
						'label' => esc_html__( 'colSpan', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'colspannumber',
						'label' => esc_html__( 'colSpan Number', 'elementor' ),
						'type' => Controls_Manager::TEXT,
						'condition' => [
							'advance' => 'yes',
							'colspan' => 'yes',
						],
						'placeholder' => esc_html__( '1', 'rsaddon' ),
						'default' => esc_html__( '1', 'rsaddon' ),
					],
					[
						'name'	=> 'customwidth',
						'label' => esc_html__( 'Custom Width', 'rsaddon' ),
						'type' => Controls_Manager::SWITCHER,
						'condition' => [
							'advance' => 'yes',
						],
						'label_off' => esc_html__( 'No', 'rsaddon' ),
						'label_on' => esc_html__( 'Yes', 'rsaddon' ),
					],
					[
						'name'	=> 'width',
						'label' => esc_html__( 'Width', 'elementor' ),
						'type' => Controls_Manager::SLIDER,
						'condition' => [
							'advance' => 'yes',
							'customwidth' => 'yes',
						],
						'range' => [
							'%' => [
								'min' => 0,
								'max' => 100,
							],
							'px' => [
								'min' => 1,
								'max' => 1000,
							],
						],
						'default' => [
							'size' => 30,
							'unit' => '%',
						],
						'size_units' => [ '%', 'px' ],
						'selectors' => [ '{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'width: {{SIZE}}{{UNIT}};',
						]
					],
					[
						'name' => 'align', 
						'label' => esc_html__( 'Alignment', 'rsaddon' ),
						'type' => Controls_Manager::CHOOSE,
						'condition' => [
							'advance' => 'yes',
						],
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
								'title' => esc_html__( 'Justified', 'rsaddon' ),
								'icon' => 'fa fa-align-justify',
							],
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
						]
					],
					[
						'name'	=> 'decoration',
						'label' => esc_html__( 'Decoration', 'rsaddon' ),
						'type' => Controls_Manager::SELECT,
						'condition' => [
							'advance' => 'yes',
						],
						'options' => [
							''  => esc_html__( 'Default', 'rsaddon' ),
							'underline' => esc_html__( 'Underline', 'rsaddon' ),
							'overline' => esc_html__( 'Overline', 'rsaddon' ),
							'line-through' => esc_html__( 'Line Through', 'rsaddon' ),
							'none' => esc_html__( 'None', 'rsaddon' ),
						],
						'default' => '',
						'selectors' => [
							'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
						],
					]
				],
				'title_field' => '{{{ text }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_table_body',
			[
				'label' => esc_html__( 'Table Body', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		
		$repeater->add_control(
			'row', [
				'label' => esc_html__( 'New Row', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'text', [
				'label' => esc_html__( 'Text', 'rsaddon' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'Table Data', 'rsaddon' ),
				'default' => esc_html__( 'Table Data', 'rsaddon' ),
				'dynamic' => [
		            'active' => true,
		        ]
			]
		);

		
		$repeater->add_control(
			'advance', [
				'label' => esc_html__( 'Advance Settings', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'colspan', [
				'label' => esc_html__( 'colSpan', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'colspannumber', [
				'label' => esc_html__( 'colSpan Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'colspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'rsaddon' ),
				'default' => esc_html__( '1', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'rowspan', [
				'label' => esc_html__( 'rowSpan', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'advance' => 'yes',
				],
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'rowspannumber', [
				'label' => esc_html__( 'rowSpan Number', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'condition' => [
					'advance' => 'yes',
					'rowspan' => 'yes',
				],
				'placeholder' => esc_html__( '1', 'rsaddon' ),
				'default' => esc_html__( '1', 'rsaddon' ),
			]
		);

		$repeater->add_control(
			'align', [
				'label' => esc_html__( 'Alignment', 'rsaddon' ),
				'type' => Controls_Manager::CHOOSE,
				'condition' => [
					'advance' => 'yes',
				],
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
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'decoration',
			[
				'label' => esc_html__( 'Decoration', 'rsaddon' ),
				'type' => Controls_Manager::SELECT,
				'condition' => [
					'advance' => 'yes',
				],
				'options' => [
					''  => esc_html__( 'Default', 'rsaddon' ),
					'underline' => esc_html__( 'Underline', 'rsaddon' ),
					'overline' => esc_html__( 'Overline', 'rsaddon' ),
					'line-through' => esc_html__( 'Line Through', 'rsaddon' ),
					'none' => esc_html__( 'None', 'rsaddon' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} table.rselements-table {{CURRENT_ITEM}}' => 'text-decoration: {{VALUE}};',
				],
			]
		);	


		$this->add_control(
			'table_body',
			[
				'label' => esc_html__( 'Table Body Cell', 'rsaddon' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'text' => esc_html__( 'Table Data', 'rsaddon' ),
					],
					[
						'text' => esc_html__( 'Table Data', 'rsaddon' ),
					],
				],
				'title_field' => '{{{ text }}}',
			]
		);



		$this->end_controls_section();

		 $this->start_controls_section(
            '_section_datatables',
            [
                'label' => esc_html__( 'DataTable', 'rsaddon' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );      

      
        $this->add_control(
            'show_search',
            [
                'label' => esc_html__( 'Enable Search', 'rsaddon' ),
                'type' => Controls_Manager::SWITCHER,               
                'label_on' => esc_html__( 'Show', 'rsaddon' ),
                'label_off' => esc_html__( 'Hide', 'rsaddon' ),
                'return_value' => 'yes',
                'default' => 'no',               
            ]
        );

        $this->add_control(
            'show_pagination',
            [
				'label'        => esc_html__( 'Enable Pagination', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'no',               
            ]
        );

        $this->add_control(
            'enable_ordering',
            [
				'label'        => esc_html__( 'Enable Ordering', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'no',                
            ]
        );

        $this->add_control(
            'show_tableinfo',
            [
				'label'        => esc_html__( 'Show Table Info', 'rsaddon' ),
				'type'         => Controls_Manager::SWITCHER,               
				'label_on'     => esc_html__( 'Show', 'rsaddon' ),
				'label_off'    => esc_html__( 'Hide', 'rsaddon' ),
				'return_value' => 'yes',
				'default'      => 'no',              
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'General Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'table_padding',
			[
				'label' => esc_html__( 'Inner Cell Padding', 'plugin-domain' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table td,{{WRAPPER}} table.rselements-table th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'table_border',
				'label' => esc_html__( 'Border', 'rsaddon' ),
				'selector' => '{{WRAPPER}} table.rselements-table td,{{WRAPPER}} table.rselements-table th',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_header_style',
			[
				'label' => esc_html__( 'Table Header Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'header_align',
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
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'header_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-header',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'header_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-header' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_body_style',
			[
				'label' => esc_html__( 'Table Body Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'body_align',
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
						'title' => esc_html__( 'Justified', 'rsaddon' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'body_text_color',
			[
				'label' => esc_html__( 'Text Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'body_typography',
				'selector' => '{{WRAPPER}} table.rselements-table .rselements-table-body',
				'scheme' => Scheme_Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'body_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'striped_bg', 
			[
				'label' => esc_html__( 'Striped Background', 'rsaddon' ),
				'type' => Controls_Manager::SWITCHER,
				'label_off' => esc_html__( 'No', 'rsaddon' ),
				'label_on' => esc_html__( 'Yes', 'rsaddon' ),
			]
		);
		$this->add_control(
			'striped_bg_color', 
			[
				'label' => esc_html__( 'Secondary Background Color', 'rsaddon' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'striped_bg' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} table.rselements-table .rselements-table-body tr:nth-of-type(2n)' => 'background-color: {{VALUE}};',
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$unique = rand(10,6554120);

		$search     = ($settings['show_search'] == 'yes') ? "true" : "false";
		$order      = ($settings['enable_ordering'] == 'yes') ? "true" : "false";
		$tableinfo  = ($settings['show_tableinfo'] == 'yes') ? "true" : "false";
		$pagination = ($settings['show_pagination'] == 'yes') ? "true" : "false";		
		?>
		<table class="rselements-table" id="datatable-<?php echo esc_attr($unique);?>">
			<thead  class="rselements-table-header">
				<tr>
					<?php
					foreach ($settings['table_header'] as $index => $headeritem) {
						$repeater_setting_key = $this->get_repeater_setting_key( 'text', 'table_header', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$colspan = ($headeritem['colspan'] == 'yes' && $headeritem['advance'] == 'yes') ? 'colSpan="'.$headeritem['colspannumber'].'"' : '';

						echo '<th class="elementor-inline-editing elementor-repeater-headeritem-'.$headeritem['_id'].'"  '.$colspan.' '.$this->get_render_attribute_string( $repeater_setting_key ).'>'.$headeritem['text'].'</th>';
					}
					?>
				</tr>
			</thead>
			<tbody class="rselements-table-body">
				<tr>
					<?php
					foreach ($settings['table_body'] as $index => $item) {
						$table_body_key = $this->get_repeater_setting_key( 'text', 'table_body', $index );

						$this->add_render_attribute( $table_body_key, 'class', 'elementor-repeater-item-'.$item['_id'] );
						$this->add_inline_editing_attributes( $table_body_key );

						if($item['row'] == 'yes'){
							echo '</tr><tr>';
						}

						$colspan = ($item['colspan'] == 'yes' && $item['advance'] == 'yes') ? 'colSpan="'.$item['colspannumber'].'"' : '';

						$rowspan = ($item['rowspan'] == 'yes' & $item['advance'] == 'yes') ? 'rowSpan="'.$item['rowspannumber'].'"' : '';

						echo '<td '.$colspan.' '.$rowspan.' '.$this->get_render_attribute_string( $table_body_key ).' >'.$item['text'].'</td>';
					}
					?>
				</tr>
			</tbody>
		</table>

		<script type="text/javascript">
			jQuery(document).ready(function () {
				jQuery('#datatable-<?php echo esc_attr($unique);?>').DataTable({
					"searching": <?php echo esc_html($search);?>,
					"paging":   <?php echo esc_html($pagination);?>,
			        "ordering": <?php echo esc_html($order);?>,
			        "info":     <?php echo esc_html($tableinfo);?>,			      
				});
				jQuery('.dataTables_length').addClass('rsdatatable-select');

			});


		</script>
		
		<?php

	}
	protected function _content_template() {
		?>
		<table class="rselements-table">
			<thead class="rselements-table-header">
				<tr>
					<#
					if ( settings.table_header ) {
						_.each( settings.table_header, function( item, index ) {
							var iconTextKey = view.getRepeaterSettingKey( 'text', 'table_header', index );

							if( 'yes' === item.colspan && 'yes' === item.advance){
								colSpan = 'colSpan="'+item.colspannumber+'"';
							}else{
								colSpan = '';
							}
							
							view.addRenderAttribute( iconTextKey, 'class', 'elementor-repeater-item-'+item._id );
							view.addInlineEditingAttributes( iconTextKey );
							#>
							<th {{{colSpan}}} {{{ view.getRenderAttributeString( iconTextKey ) }}}>{{{ item.text }}}</th>
						<#
						} );
					} #>
				</tr>
			</thead>
			<tbody class="rselements-table-body">
				<tr>
					<#
					if ( settings.table_body ) {
						_.each( settings.table_body, function( item, index ) {
							if( 'yes' === item.row){
								newRow = '</tr><tr>';
							}else{
								newRow = '';
							}

							if( 'yes' === item.colspan && 'yes' === item.advance){
								colSpan = 'colSpan="'+item.colspannumber+'"';
							}else{
								colSpan = '';
							}

							if( 'yes' === item.rowspan && 'yes' === item.advance){
								rowSpan = 'rowSpan="'+item.rowspannumber+'"';
							}else{
								rowSpan = '';
							}

							var tdTextKey = view.getRepeaterSettingKey( 'text', 'table_body', index );
							
							view.addRenderAttribute( tdTextKey, 'class', 'elementor-repeater-item-'+item._id );
							view.addInlineEditingAttributes( tdTextKey );

							#>
							{{{newRow}}}
							<td {{{rowSpan}}} {{{colSpan}}} {{{ view.getRenderAttributeString( tdTextKey ) }}}>{{{ item.text }}}</td>
						<#
						} );
					} #>
				</tr>
			</tbody>
		</table>


		<?php
	}
}
