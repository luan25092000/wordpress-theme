<?php
    define('THEME_URL',get_stylesheet_directory());
    define('CORE',THEME_URL."/core");

    require_once(CORE."/init.php");

    if(!isset($content_width)){
        $content_width = 620;
    }

    if(!function_exists('magenest_theme_setup')){
        function magenest_theme_setup(){
            //Thiet lap textdomain
            $language_folder = THEME_URL."/languages";
            load_theme_textdomain('magenest',$language_folder);

            //Tu dong them link RSS len <head>
            add_theme_support('automatic-feed-links');

            //Them post thumbnail
            add_theme_support('post-thumbnails');

            //Post format
            add_theme_support('post-formats',['image','video','gallery','quote','link']);

            //Them title tag
            add_theme_support('title-tag');

            //Them custom background
            add_theme_support('custom-background',['default-color' => '#e8e8e8']);

            //Them menu
            register_nav_menu('primary-menu',__('Primary Menu','Magenest'));

            //Tao sidebar
            $sidebar = [
                'name' => __('Main Sidebar','magenest'),
                'id' => 'main-sidebar',
                'description' => __('Default sidebar'),
                'class' => 'main-sidebar',
                'before_title' => '<h3 class="widgettitle">',
                'after_title' => '</h3>'
            ];
            register_sidebar($sidebar);
        }
        add_action('init','magenest_theme_setup');
    }

    // Tao header
    if(!function_exists('magenest_header')){
        function magenest_header(){ ?>
            <div class="site-name">
                <?php
                    if(is_home()){
                        printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>',
                        get_bloginfo('url'),
                        get_bloginfo('desciption'),
                        get_bloginfo('sitename'));
                    }else{
                        printf('<p><a href="%1$s" title="%2$s">%3$s</a></p>',
                        get_bloginfo('url'),
                        get_bloginfo('desciption'),
                        get_bloginfo('sitename'));
                    }
                ?>
            </div>
            <div class="site-description"><?php bloginfo('description'); ?></div> <?php
        }
    }

    //Tao menu
    if(!function_exists('magenest_menu')){
        function magenest_menu($menu){
            $menu = [
                'theme_location' => $menu,
                'container' => 'nav',
                'container_class' => $menu
            ];
            wp_nav_menu($menu);
        }
    }

    //Hien thi thumbnail
    if(!function_exists('magenest_thumbnail')){
        function magenest_thumbnail($size){
            if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')): ?>
                <div class="post-thumbnail"><?php the_post_thumbnail($size); ?></div>
            <?php endif; ?>
        <?php }
    }

    //Hien thi tieu de post
    if(!function_exists('magenest_entry_header')){
        function magenest_entry_header(){ ?>
            <?php if(!is_single()):?>
                <h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
            <?php else: ?>
                <h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <?php endif; ?>
        <?php }
    }

    //Lay du lieu post
    if(!function_exists('magenest_entry_meta')){
        function magenest_entry_meta(){ ?>
            <?php if(!is_page()): ?>
                <div class="entry-meta">
                    <?php 
                        printf(__('<span class="author">Posted by %1$s','magenest'),get_the_author());

                        printf(__('<span class="date-published">at %1$s','magenest'),get_the_date());

                        printf(__('<span class="category">in %1$s','magenest'),get_the_category_list());

                        if(comments_open()):
                            echo '<span class="meta-reply">';
                                comments_popup_link( 
                                   __('Leave a comment','magenest'), 
                                   __('One comment','magenest'), 
                                   __('% comments','magenest'),
                                   __('Read all comments','magenest')
                                );
                            echo '</span>';
                        endif;
                    ?>
                </div>
            <?php endif; ?>
        <?php }
    }

   