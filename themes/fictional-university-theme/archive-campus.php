<?php 
    get_header();  
    pageBanner(array(
        'title'=>'Our campuses',
        'subtitle'=>'We have several conveniently located campuses.'
    ));
?>     
    <!-- <div class="acf-map"></div> -->
    <div class="container container--narrow page-section">
        <ul class="link-list min-list">
            <?php
                // $map_location = get_field("map_location");


                while(have_posts()){
                    the_post(); ?>
                    <!-- <div class="marker" data-lat="map_location_lat" data-lng="map_location_lng" > 
                        <h3><a href="#">title</a></h3>
                        <p>address</p>
                    </div> -->
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php  }
                echo paginate_links();
            ?>
        </ul>
       
    </div>
        
    <?php get_footer();
?>