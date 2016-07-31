<?php
/**
 * Custom Customizer controls.
 *
 * @package kihon
 * @since 1.0.0
 */


if ( ! class_exists( 'kihon_Text_Control' ) ) :
/**
 * Class kihon_Text_Control
 *
 * Adds a description property to controls.
 *
 * @since 1.0.0.
 */
class kihon_Text_Control extends WP_Customize_Control
{
  public $type        = 'customtext';
  public $description = ''; // description property added

  public function render_content()
  {
    ?>
      <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
        <span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
      </label>
    <?php
  }
} // class kihon_Text_Control
endif; // kihon_Text_Control
