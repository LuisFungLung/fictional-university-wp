<?php

function university_post_types(){

    //Campus Post Type
    register_post_type('campus', array(
        'capability_type'=>'campus',
        'map_meta_cap'=>true,
        'show_in_rest'=> true,
        'supports'=>array('title','editor','thumbnail'),
        'rewrite'=>array('slug'=> 'campuses'),
        'has_archive'=>true,
        'public'=>true,
        'labels'=> array(
            'name'=>'Campuses',
            'add_new_item' => 'Add New Campus',
            'edit_item' => 'Edit Campus',
            'all_items' => 'All Campuses',
            'singular_event' => 'Campus'
        ),
        'menu_icon'=>'dashicons-location-alt'
    ));

    //Event Post Type
    register_post_type('event', array(
        'capability_type'=>'event',
        'map_meta_cap'=>true,
        'show_in_rest'=> true,
        'supports'=>array('title','editor','excerpt'), /* use the element 'editor' in order to have a modern support, with 'show in rest' = true */ 
        'rewrite'=>array('slug'=> 'events'),
        'has_archive'=>true,
        'public'=>true,
        'labels'=> array(
            'name'=>'Events',
            'add_new_item' => 'Add New Event',
            'edit_item' => 'Edit Event',
            'all_items' => 'All Events',
            'singular_event' => 'Event'
        ),
        'menu_icon'=>'dashicons-calendar'
    ));

    //Program Post Type
    register_post_type('program', array(        
        'show_in_rest'=> true,
        'supports'=>array('title'),
        'rewrite'=>array('slug'=> 'programs'),
        'has_archive'=>true,
        'public'=>true,
        'labels'=> array(
            'name'=>'Programs',
            'add_new_item' => 'Add New Program',
            'edit_item' => 'Edit Program',
            'all_items' => 'All Programs',
            'singular_event' => 'Program'
        ),
        'menu_icon'=>'dashicons-awards'
    ));

     //Professor Post Type
     register_post_type('professor', array(
        'show_in_rest'=> true,
        'supports'=>array('title','editor','thumbnail'),
        'public'=>true,
        'labels'=> array(
            'name'=>'Professors',
            'add_new_item' => 'Add New Professor',
            'edit_item' => 'Edit Professor',
            'all_items' => 'All Professors',
            'singular_event' => 'Professor'
        ),
        'menu_icon'=>'dashicons-welcome-learn-more'
    ));

    //Note Post Type
    register_post_type('note', array(
        'capability_type' => 'note',
        'map_meta_cap'=> true,
        'show_in_rest'=> true,
        'supports'=>array('title','editor','thumbnail'),
        'public'=>false,
        'show_ui'=>true, //show in the dashboard ui
        'labels'=> array(
            'name'=>'Notes',
            'add_new_item' => 'Add New Note',
            'edit_item' => 'Edit Note',
            'all_items' => 'All Notes',
            'singular_event' => 'Note'
        ),
        'menu_icon'=>'dashicons-welcome-write-blog'
    ));

     //Like Post Type
     register_post_type('like', array(                   
        'supports'=>array('title'),
        'public'=>false,
        'show_ui'=>true, //show in the dashboard ui
        'labels'=> array(
            'name'=>'Likes',
            'add_new_item' => 'Add New Like',
            'edit_item' => 'Edit Like',
            'all_items' => 'All Likes',
            'singular_event' => 'Like'
        ),
        'menu_icon'=>'dashicons-heart'
    ));

    //Slider for home
    register_post_type('slider', array(    
        'capability_type' => 'slider', //to assign for specific roles           
        'map_meta_cap'=> true,
        'show_in_rest'=> true,           
        'supports'=>array('title','thumbnail'),
        'public'=>true,
        'show_ui'=>true,
        'labels'=> array(
            'name'=>'Sliders',
            'add_new_item' => 'Add New Slider',
            'edit_item' => 'Edit Slider',
            'all_items' => 'All Sliders',
            'singular_event' => 'Slider'
        ),
        'menu_icon'=>'dashicons-category'
    ));
}

add_action('init','university_post_types');