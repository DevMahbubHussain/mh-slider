<?php 
if(!class_exists('MH_slider_settings'))
{
   class MH_slider_settings
   {
      public static $options;
      public function __construct()
      {
            self::$options = get_option('mh_slider_options');
            add_action('admin_init', array($this,'admin_init_func'));

      }

      public function admin_init_func()
      {
            register_setting('mh_slider_group','mh_slider_options',array($this,'mh_slider_validate'));
            // add_settings_section($id, $title, $callback, $'page');
            add_settings_section(
                'mh_slider_main_section',
                'How does it Work?',
                 null,
                'mh_slider_page1'
            );

            // section 2 
            add_settings_section(
               'mh_slider_second_section',   // id(string)  required
                null,     // title(string)  required
                null,                      // callable(function) required 
               'mh_slider_page2'          //  required(string) The slug-name of the settings page on which to show the section. Built-in pages include 'general', 'reading', 'writing', 'discussion', 'media', etc. Create your own using 
            );

             // add_settings_field($id, $title, $callback, $page, $section, $args);
            add_settings_field(
                'mh_slider_shortcode',
                'Shortcode',
                array($this,'mh_slider_shortcode_callback'),
                'mh_slider_page1',
                'mh_slider_main_section',   
            );
            // second settings field 
           add_settings_field(
                'mh_slider_title',
                'Slider Title',
                array($this,'mh_slider_title_callback'),
                'mh_slider_page2',
                'mh_slider_second_section',
                array(
                  'label_for'=>'mh_slider_title'
               ),
            );

          add_settings_field(
            'mh_slider_bullest',
            'Slider Bullet',
            array($this,'mh_slider_bullet_callback'),
            'mh_slider_page2',
            'mh_slider_second_section',
            array(
             'label_for'=>'mh_slider_bullest'
            ),
         );
         add_settings_field(
         'mh_slider_style',
         'Slider Layout',
         array($this,'mh_slider_layout_callback'),
         'mh_slider_page2',
         'mh_slider_second_section',
         array(
              'items'=>array(
                'style-1',
                'style-2'
              ),
              'label_for'=>'mh_slider_style'
           ),
         );
           
      }

      public function mh_slider_shortcode_callback()
      {
         ?>
          <span>Use this[mh_slider] to display the slider in any page / post / widget</span>
         <?php 
      }

      public function mh_slider_title_callback($args)
      {
        // var_dump(self::$options);
        ?>
           <input 
            type="text"
            placeholder="Enter Your Slider Title"
            name="mh_slider_options['mh_slider_title']" 
            value="<?php echo isset(self::$options["'mh_slider_title'"]) ? esc_attr(self::$options["'mh_slider_title'"]) : '' ?>">
        <?php 
      }

      public function mh_slider_bullet_callback($args)
      {
         ?>
           <input 
            type="checkbox"
            name="mh_slider_options['mh_slider_bullest']"
            id="mh_slider_bullest"
            value="1"
               <?php
                  if(isset(self::$options["'mh_slider_bullest'"]))
                    checked("1", self::$options["'mh_slider_bullest'"], true);
               ?>
            />
            <label for="mh_slider_bullest">Whether to display bullest or not</label>
         <?php 
      }
      public function mh_slider_layoudt_callback($args) // not callable
      {
         ?>
         <select 
            id="mh_slider_style" 
            name="mh_slider_options[mh_slider_style]">
            <option value="style-1" 
               <?php isset( self::$options['mh_slider_style'] ) ? selected( 'style-1', self::$options['mh_slider_style'], true ) : ''; ?>>Style-1</option>
            <option value="style-2" 
               <?php isset( self::$options['mh_slider_style'] ) ? selected( 'style-2', self::$options['mh_slider_style'], true ) : ''; ?>>Style-2</option>
        </select>
         <?php 
      }

    public function mh_slider_layout_callback($args)
      {
         ?>
         <select 
            id="mh_slider_style" 
            name="mh_slider_options[mh_slider_style]">
            <?php 
               foreach($args['items'] as $item)
               {
                 ?>
                   <option value="<?php echo esc_attr($item);?>"
                        <?php 
                          isset(self::$options['mh_slider_style']) ? selected($item, self::$options['mh_slider_style'],true) : '' 
                        ?>
                        > 
                        <?php echo esc_html(ucfirst($item));?>
                     </option>
                 <?php
               }
            ?>
        </select>
         <?php 
      }

      public function mh_slider_validate($input)
      {
         $new_input = array();
         foreach($input as $key => $value)
         {
            switch($key)
            {
               case 'mh_slider_title':
               if(empty($value)){
                     add_settings_error('mh_slider_options', 'mh_slider_message', 'Title field is Required', 'error');
                     $value = "Please, type some text";
                  }
                  $new_input[$key] =  sanitize_text_field( $value );
                  break;
               default:
                  $new_input[$key] = sanitize_text_field( $value );
                  break;

            }

         }
         return $new_input;
      }


   }
}