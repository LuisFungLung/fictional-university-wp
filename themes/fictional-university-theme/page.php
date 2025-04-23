<?php 

    get_header();

    while(have_posts()){
        the_post(); 
        // pageBanner(array(
        //     'title'=>'Hello this is the title',
        //     'subtitle'=>'Hi, this is the subtitle',
        //     'photo'=>'https://www.w3schools.com/html/pic_trulli.jpg'
        // ));
        pageBanner();
        ?>

          
        <div class="container container--narrow page-section">

            <?php               
                $theParent = wp_get_post_parent_id(get_the_ID());                
                if ( $theParent ){ ?>
                    <div class="metabox metabox--position-up metabox--with-home-link">
                        <p>
                        <a class="metabox__blog-home-link" href=" <?php echo get_permalink($theParent); ?>  "><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($theParent); ?> </a> <span class="metabox__main"> <?php the_title(); ?> </span>
                        </p>
                    </div>
                <?php }            
            ?>

          
            <?php
                $testArray = get_pages(array(
                    'child_of' => get_the_ID(),
                ));
                
                if ($theParent or $testArray) { ?>
                <div class="page-links">
                    <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent);  ?></a></h2>
                    <ul class="min-list">
                    
                        <?php 

                            if ( $theParent ){
                                $findChildrenOf = $theParent;
                            } else {
                                $findChildrenOf = get_the_ID();
                            }
                        
                            wp_list_pages(array(
                                'title_li' => NULL,
                                'child_of' => $findChildrenOf,
                            ));  
                        ?>
                        <!-- <li class="current_page_item"><a href="#">Our History</a></li>
                        <li><a href="#">Our Goals</a></li> -->
                    </ul>
                </div>
            <?php } ?>

            <div class="generic-content">
                <?php                                                 
                the_content(); 

                $skyColorValue = sanitize_text_field(get_query_var('skyColor'));
                $grassColorValue = sanitize_text_field(get_query_var('grassColor'));

                if ( $skyColorValue == 'blue' AND $grassColorValue == 'green' ) {
                    echo '<p>The sky is blue today and the grass is green. Life is great.</p>';
                }
                ?>
                <form method="get">
                    <input type="text" name="skyColor" placeholder="Sky color">
                    <input type="grassColor" name="grassColor" placeholder="Grass color">
                    <button>Submit</button>
                </form>
            </div>
        </div>
          
    <?php }
    
    get_footer();
    
?>