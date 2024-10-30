<?php

function cosmic_carousel__post_type() {

    $labels = array(
        'name' => __('Cosmic Carousel'),
        'singular_name' => __('Cosmic Carousel'),
        'add_new' => __('Add new carousel'),
        'add_new_item' => __('Add New carousel'),
        'edit_item' => __('Edit Carousel'),
        'new_item' => __('Add New Carousel'),
        'view_item' => __('View Cosmic Carousel'),
        'search_items' => __('Search Cosmic Carousel'),
        'not_found' => __('No Cosmic Carousel found'),
        'not_found_in_trash' => __('No Cosmic Carousel found in trash')
    );

    $supports = array(
        'title',
    );

    $args = array(
        'labels' => $labels,
        'supports' => $supports,
        'public' => true,
        'capability_type' => 'post',
        'hierarchical' => true,
        'rewrite' => array('slug' => 'cosmic-carousel'),
        'has_archive' => true,
        'menu_position' => 1,
        'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('<svg width="20px" height="20px" viewBox="0 0 64 64"  version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
     <g id="cosmic-icon" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="Artboard" fill-rule="nonzero" fill="#000000">
            <g id="cosmic-carousel" transform="translate(32.000000, 32.000000) rotate(-327.000000) translate(-32.000000, -32.000000) translate(8.000000, 8.000000)">
                <path fill="black" d="M46.232292,1.21791615 C43.5730198,-1.441338 37.0824323,0.399236796 29.4912905,5.32627695 C27.6684054,4.7537674 25.7328596,4.44378728 23.724507,4.44378728 C13.0928456,4.44378728 4.44278673,13.0936127 4.44278673,23.7248142 C4.44278673,25.7330946 4.75277799,27.6685708 5.32530813,29.4913903 C0.398090793,37.080786 -1.44107699,43.5725357 1.21835032,46.2317899 C3.87925083,48.8925947 10.3741804,47.0579125 17.9697417,42.1264529 C19.7882072,42.6974893 21.7208066,43.0059963 23.7261353,43.0059963 C34.3592699,43.0059963 43.0078556,34.3561709 43.0078556,23.7248918 C43.0078556,21.7197127 42.6993375,19.7885785 42.1298313,17.9687827 C47.0585219,10.3734945 48.8917193,3.87872098 46.232292,1.21791615 Z M5.15030806,42.2970272 C3.72789942,40.8746697 4.53629585,37.5019496 6.95985687,33.2141756 C8.68628646,36.2517171 11.2107226,38.7745893 14.2498465,40.497933 C9.94997772,42.9317964 6.57713629,43.7238817 5.15030806,42.2970272 Z M8.89245624,23.7248918 C8.89245624,15.546782 15.5461032,8.89329679 23.7245846,8.89329679 C30.1232137,8.89329679 35.5695384,12.9719621 37.6475189,18.6598415 C35.3277794,21.9019947 32.3584383,25.4097012 28.8847218,28.8818196 C25.4110053,32.3568069 21.9016995,35.3261187 18.6594296,37.6457748 C12.9712683,35.5694197 8.89245624,30.120267 8.89245624,23.7248918 Z M23.7245846,38.5564867 C23.4798791,38.5564867 23.2410664,38.5312883 22.9993074,38.5208987 C25.7180502,36.3939916 28.496186,33.9602058 31.2267143,31.2281474 C33.9587159,28.4962441 36.3942176,25.7196813 38.5196504,22.9995631 C38.5315135,23.2413135 38.5567904,23.4801176 38.5567904,23.7248142 C38.5567129,31.9030791 31.903066,38.5564867 23.7245846,38.5564867 Z M33.2142096,6.96076692 C37.5022153,4.53876618 40.8750568,3.72892568 42.2973879,5.15128318 C43.7242161,6.57658696 42.9321799,9.95078024 40.498229,14.2519676 C38.7748233,11.2129529 36.253256,8.68713443 33.2142096,6.96076692 Z" id="Shape"></path>
            </g>
        </g>
    </g>
</svg>'),
        'show_in_admin_bar' => true,
        'register_meta_box_cb' => 'add_cosmic_carousel__metaboxes',
    );

    register_post_type('cosmic-carousel', $args);
}

add_action('init', 'cosmic_carousel__post_type');




$postTypesArgs = array('public' => true);
$post_types = get_post_types($postTypesArgs);

/**
 * AGGIUNGO I METABOXES
 */
function add_cosmic_carousel__metaboxes() {


    add_meta_box(
            '_info', 'Carousel Builder', 'cosmic_carousel_info', 'cosmic-carousel', 'normal', 'high'
    );
}

function cosmic_carousel_info() {
    global $post;


// Nonce field to validate form request came from current site
    wp_nonce_field(basename(__FILE__), 'cosmic_carousel_fields');
    $cosmicType = get_post_meta($post->ID, 'cosmic_carousel__type', true);
    $cosmicSlides = get_post_meta($post->ID, 'cosmic_carousel__slides', true);
    $related_pages = get_post_meta($post->ID, 'related_pages', true);

// Get all post types to select
    $post_types = get_post_types(array('public' => true));
    $clickable = ($post->post_status != 'auto-draft') ? 'display:none' : '';
    ?>
    <style>
        .cosmic_item:before {
            <?php echo $clickable ?>
        }
    </style>
    <div class="cosmic_item cosmic_item--Type">
        <h2><?php echo __('Select post type', 'cosmic-carousel'); ?></h2>
        <p><?php echo __('Select the post type you wanna use to create the carousel and click publish.', 'cosmic-carousel'); ?></p>
        <div class="wrapper">
            <?php
            echo '<input type="text" class="cosmic_input cosmic_imput--full" name="cosmic_carousel__type" autocomplete="false" value="' . $cosmicType . '" list="types" placeholder="' . __('Post type', 'cosmic_carousel') . '"/>';

            echo '<datalist id="types">';
            foreach ($post_types as $post_type) :
                if ($post_type != 'attachment' && $post_type != 'cosmic-carousel'):
                    echo '<option>';
                    echo esc_textarea($post_type);
                    echo '</option>';
                endif;
            endforeach;
            echo '</datalist>';
            ?>

            <div class=" cosmic_item--cta">

            </div>
        </div>
    </div>

    <div class="cosmic_item cosmic_item--settings">
        <h2><?php echo __('Settings', 'cosmic-carousel'); ?></h2>
        <label for="cosmic_carousel__slides"><?php echo __('Slides to show', 'cosmic-carousel'); ?></label>
        <?php
        echo '<input type="number" name="cosmic_carousel__slides" id="cosmic_carousel__slides" value="' . esc_textarea($cosmicSlides) . '" class=" " placeholder="' . __(2, 'cosmic_carousel') . '">';
        ?>
    </div>

    <div class="cosmic_item cosmic_item--settings">

        <?php
        echo ' <h2>' . __('Add Slides', 'cosmic-carousel') . '</h2>';
        echo __('<p>' . __('Drag and drop the slides from the left to the right list.', 'cosmic-carousel') . '</p>', 'cosmic-carousel');


        // Blocchi related

        $page_args = array(
            'posts_per_page' => -1,
            'post_type' => $cosmicType,
            'post_status' => 'publish',
            'orderby' => 'post_date',
            'order' => 'DESC',
            'fields' => 'ids'
        );
        $pages = get_posts($page_args);
//if we have pages to display
        if ($pages) {
            echo '<div class="related_pages">';
            //left container (all pages)
            echo '<div class="left_container">';

            //loop through all pages
            foreach ($pages as $page) {
                //collect their id and name and create the page item
                $page_id = $page;
                $page_name = get_the_title($page_id);
                $page_thumbID = get_post_thumbnail_id($page_id);
                echo '<div class="page_item" data-page-id="' . $page_id . '">';
                echo '<div class="page_thumb">' . wp_get_attachment_image($page_thumbID, 'carousel-thumb') . '</div>';
                echo '<div class="page_title">' . $page_name . '</div>';
                echo '<div class="remove_item"> Remove </div>';
                echo '</div>';
            }
            echo '</div>';
            //end left container
            //Right container
            echo '<div class="right_container">';


            if (!empty($related_pages)) {
                $related_pages_array = json_decode($related_pages);
                foreach ($related_pages_array as $related_page) {
                    //page information
                    $page_id = $related_page;
                    $page_name = get_the_title($page_id);
                    $page_thumbID = get_post_thumbnail_id($page_id);

                    echo '<div class="page_item" data-page-id="' . $page_id . '">';
                    echo '<div class="page_thumb">' . wp_get_attachment_image($page_thumbID, 'carousel-thumb') . '</div>';
                    echo '<div class="page_title">' . $page_name . '</div>';
                    echo '<div class="remove_item active"> Remove </div>';
                    echo '<input type="hidden" name="related_pages[]" value="' . $page_id . '"/>';
                    echo '</div>';
                }
            }
            echo '<div class="droppable-helper"></div>';
            echo '</div>';
            echo '<div class="clearfix"></div>';
            echo '</div>';
        }
        ?>
        <div class=" cosmic_item--cta">
            <?php
            echo '<div id="publishing-action">
	<span class="spinner"></span>
			<input name="original_publish" type="hidden" id="original_publish" value="Genera Carousel">
			<input name="save" type="submit" class="button button-primary button-large" id="publish" value="Save carousel">
	</div>';
            ?>
        </div>
    </div>
    <div class="cosmic_item cosmic_item--shortcode">
        <h2><?php echo __('Shortcode', 'cosmic-carousel'); ?></h2>
        <p><?php echo __('Copy and past the shortcode in the content of pages, posts or post types to show this carousel', 'cosmic-carousel'); ?></p>
        <div class="wrapper">
            <?php
            $shortcode = '[cosmic-carousel id=' . get_the_ID() . ']';
            echo '<pre>';
            echo $shortcode;
            echo '</pre>';
            ?>
            <div class=" cosmic_item--cta">

            </div>
        </div>
    </div>

    <?php
// Fine Blocchi related    
// Output the field
}

/**
 * Save the metabox data
 */
function save_cosmic_carousel_meta($post_id, $post) {

// Return if the user doesn't have edit permissions.
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

// Verify this came from the our screen and with proper authorization,
// because save_post can be triggered at other times.
    if (!isset($_POST['cosmic_carousel__slides'], $_POST['cosmic_carousel__type']) || !wp_verify_nonce($_POST['cosmic_carousel_fields'], basename(__FILE__))) {
        return $post_id;
    }




// Now that we're authenticated, time to save the data.
// This sanitizes the data from the field and saves it into an array $cosmic_carousel_meta.
    $cosmic_carousel_meta['cosmic_carousel__type'] = esc_textarea($_POST['cosmic_carousel__type']);
    $cosmic_carousel_meta['cosmic_carousel__slides'] = esc_textarea($_POST['cosmic_carousel__slides']);
    $cosmic_carousel_meta['related_pages'] = esc_html($_POST['related_pages']);






    foreach ($cosmic_carousel_meta as $key => $value) :

// Don't store custom data twice
        if ('revision' === $post->post_type) {
            return;
        }

        if (get_post_meta($post_id, $key, false)) {
// If the custom field already has a value, update it.
            update_post_meta($post_id, $key, $value);
        } else {
// If the custom field doesn't have a value, add it.
            add_post_meta($post_id, $key, $value);
        }

        if (!$value) {
// Delete the meta key if there's no value
            delete_post_meta($post_id, $key);
        }




    endforeach;

//SAFE to save data, let's go
    $related_pages_value = '';
//collect related pages (if set)
    if (isset($_POST['related_pages'])) {
        $related_pages_array = $_POST['related_pages'];
        $related_pages_value = json_encode($related_pages_array);
    }

//update post meta
    update_post_meta($post_id, 'related_pages', $related_pages_value);
}

add_action('save_post', 'save_cosmic_carousel_meta', 1, 2);





// create shortcode with parameters so that the user can define what's queried - default is to list all blog posts
add_shortcode('cosmic-carousel', 'rmcc_post_listing_parameters_shortcode');

function rmcc_post_listing_parameters_shortcode($atts) {

    ob_start();
// define attributes and their defaults
    extract(shortcode_atts(array(
        'id' => '',
                    ), $atts));

    $related_pages = get_post_meta($id, 'related_pages', true);
    $related_pages_array = json_decode($related_pages);

    if ($related_pages) {
//begin related pages output
        $cosmicSlides = get_post_meta($id, 'cosmic_carousel__slides', true);

        $related_pages_array = json_decode($related_pages);
        ?>
        <div id="wrapper-cosmic-carousel">
            <div data-slick='{"slidesToShow": <?php echo $cosmicSlides ?>, "slidesToScroll": 1 }' class="row autoplay cosmic--wrapper">

                <?php
                foreach ($related_pages_array as $related_page) {
                    //get page information
                    $page_id = $related_page;
                    $page_name = get_the_title($page_id);
                    $page_permalink = get_permalink($page_id);
                    $page_thumbID = get_post_thumbnail_id($page_id);
                    $page_excerpt = get_the_excerpt($page_id);
                    $page_excerpt_trim = wp_trim_words($page_excerpt, 20);
                    echo '<div class="square-resize item-cosmic">';
                    echo '<section class="page_thumb cosmic_slide_image square-resize" style="background: linear-gradient(rgba(0,0,0,0),rgba(0,0,0,7)),url(' . wp_get_attachment_url($page_thumbID) . ')">';
                    echo '<h4>' . $page_name . '</h4>';
                    echo '</section>';
                    echo '</div>'; 
//                echo '<section class="page_thumb cosmic_slide_image">';
//                echo '<a href="' . $page_permalink . '">';
//                echo wp_get_attachment_image($page_thumbID, 'medium');
//                echo '</a>';
//                echo '<a href="' . $page_permalink . '">';
//                echo '<h4>' . $page_name . '</h4>';
//                echo '</a>';
//                echo '<p>' .  $page_excerpt_trim . '</p>';
                    // echo '</section>';
                }
                ?>

            </div>

        </div>


        <?php
    }



    $myvariable = ob_get_clean();
    return $myvariable;
}
