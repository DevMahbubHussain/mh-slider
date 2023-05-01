<?php 

if(!class_exists('mh_slider_cpt')){
   
    /**
     * Summary of mh_slider_cpt
     */
    class mh_slider_cpt{

        /**
         * Summary of __construct
         */
        function __construct()
        {
            add_action('init', array($this, 'create_post_type'));
            // column works 
            add_filter('manage_mh-slider_posts_columns',array($this,'mh_slider_cpt_columns'));
            add_action('manage_mh-slider_posts_custom_column', array($this, 'mh_slider_custom_columns'),10,2);
            add_filter('manage_edit-mh-slider_sortable_columns',array($this,'mh_slider_sortable_columns'));
            //add_filter( 'post_row_actions', array($this,'modify_list_row_actions'), 10, 2 );

        }
               // The first hook for managing columns (manage_posts_columns) is a filter that handles the array of columns. 
                // [
                // [cb]          => <input type="checkbox" />
                // [title]       => Title
                // [author]      => Author
                // [categories]  => Categories
                // [tags]        => Tags
                // [comments]    => [..] Comments [..]
                // [date]        => Date
                // ]


                // public function modify_list_row_actions($actions, $post )
                // {
                //     if ( $post->post_type == "mh-slider" ) 
                //     {
                //         // Build your links URL.
		        //         $url = admin_url( 'admin.php?page=mycpt_page&post=' . $post->ID );
                //         		// Maybe put in some extra arguments based on the post status.
		        //         $edit_link = add_query_arg( array( 'action' => 'edit' ), $url );

		        //        // The default $actions passed has the Edit, Quick-edit and Trash links.
		        //        $trash = $actions['trash'];

                //        /*
                //         * You can reset the default $actions with your own array, or simply merge them
                //         * here I want to rewrite my Edit link, remove the Quick-link, and introduce a
                //         * new link 'Copy'
                //         */
                //         $actions = array(
                //             'edit' => sprintf( '<a href="%1$s">%2$s</a>',
                //             esc_url( $edit_link ),
                //             esc_html( __( 'Edit', 'contact-form-7' ) ) )
                //         );

                //         // Include a nonce in this link
                //         if ( current_user_can( 'edit_my_cpt', $post->ID ) ) 
                //         {
                //             $copy_link = wp_nonce_url( add_query_arg( array( 'action' => 'copy' ), $url ), 'edit_my_cpt_nonce' );
                //         }
                //         // Add the new Copy quick link.
                //         $actions = array_merge( $actions, array(
                //             'copy' => sprintf( '<a href="%1$s">%2$s</a>',
                //                 esc_url( $copy_link ), 
                //                 'Duplicate'
                //             ) 
                //         ) );
                //         // Re-insert thrash link preserved from the default $actions.
			    //      $actions['trash']=$trash;

                //     }

                //     return $actions;


                    
                // }

         /**
          * Summary of mh_slider_cpt_columns
          * @param mixed $columns
          * @return array
          */
         public function mh_slider_cpt_columns($columns) :array
            {
                // $columns['featured_image'] = esc_html__('Feature Image', 'mh-slider');
                // $columns['title'] = esc_html__('Titles', 'mh-slider');
                // $columns['mv_slider_link_text'] = esc_html__('Link Text', 'mh-slider');
                // $columns['mv_slider_link_url'] = esc_html__('Link Url', 'mh-slider');
               
               // $columns['cb'] = '<input type="checkbox" />';
              // $columns['comments'] = '<span class="vers"><div title="Comments" class="comment-grey-bubble"></div></span>';
                // return $columns;

                 $columns = array(
                    'cb' => $columns['cb'],
                    'image' => __( 'Feature Image' ),
                    'title' => __( 'Slider Title' ),
                    'excerpt' => __( 'Slider Description' ),
                    'mv_slider_link_text' => __( 'Slider Link Text ', 'mh-slider' ),
                    'mv_slider_link_url' => __( 'Slider URL', 'mh-slider' ),
                    'date'=> __( 'Publish Date', 'mh-slider' ),
                    'author' => __( 'Post author', 'mh-slider' ),
                    //'category' => __( 'Categories', 'mh-slider' )
                    //'tags'    => __( 'Tags', 'mh-slider' )
                    //'comments' => '[..] Comments [..]'
                    );

                return $columns; 
            }

         /**
          * Summary of mh_slider_custom_columns
          * @param mixed $columns
          * @param mixed $post_id
          * @return void
          */
         public function mh_slider_custom_columns($columns,$post_id):void
        {
            switch($columns)
            {
                case 'mv_slider_link_text':
                    echo esc_html(get_post_meta($post_id, 'mv_slider_link_text', true));
                    break;
                case 'mv_slider_link_url':
                    echo esc_html(get_post_meta($post_id, 'mv_slider_link_url', true));
                    break;
                case 'image':
                     //the_post_thumbnail( 'thumbnail' );
                     if( function_exists('the_post_thumbnail') )echo the_post_thumbnail( 'thumbnail' );
                    break;

                    case 'excerpt':
                     //the_post_thumbnail( 'thumbnail' );
                     if( function_exists('wp_trim_words'))  echo wp_trim_words( get_the_content(), 10, '...' );
                    break;
            }
        }

        /**
         * Summary of mh_slider_sortable_columns
         * @param mixed $columns
         * @return array
         */
        public function mh_slider_sortable_columns($columns):array
        {
            $columns['mv_slider_link_text'] = 'mv_slider_link_text';
            $columns['mv_slider_link_url'] = 'mv_slider_link_url';
            $columns['author'] = __('Post author', 'mh-slider');
            //'author' => __( 'Post author', 'mh-slider' ),
            return $columns;
        }

         /**
          * Summary of create_post_type
          * @return void
          */
         public function create_post_type():void
        {
            register_post_type('mh-slider', array(

                'labels'  => array(
                'name'    => __('MH Sliders', 'mh-slider'),
                'singular_name' => __('MH Sliders', 'mh-slider'),
                ),
                'public'      => true,
				'has_archive' => true,
               'rewrite'     => array( 'slug' => 'sliders' ), // my custom slug
               'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
               'hierarchical'       => false,
               'capability_type'    => 'post',
               'query_var'          => true,
               'show_in_menu'       => true,
               'show_ui'            => true,
               'publicly_queryable' => true,
               'menu_position'      => 5,
               'show_in_admin_bar'  => true,
               'show_in_nav_menus'  =>true,
               'show_in_rest'       => true,
               'can_export'         =>true,
               'menu_icon'          =>'dashicons-format-image'
  

            )); 
        }
    }
}