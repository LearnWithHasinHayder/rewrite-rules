<?php
/*
Plugin Name: Rewrite Rules Examples
Description: Examples of how to use rewrite rules
Version: 1.0
Author: Hasin Hayder
Author URI: http://www.example.com
*/

class Rewrite_Rules {

    public function __construct() {
        add_action('init', array($this, 'init'));
        register_activation_hook(__FILE__, array($this, 'activation'));
        add_filter('post_type_link',[$this,'book_chapters_relationship'],1,2);
    }

    function book_chapters_relationship($post_link, $id){
        if(get_post_type($id) === 'chapter'){
            $parent_book = get_field('parent_book');
            //get slug
            $book = get_post($parent_book);
            $book_slug = $book->post_name;
            $post_link = str_replace('%book%', $book_slug, $post_link);
        }
        return $post_link;
    }

    function activation() {
        // flush_rewrite_rules();
        // global $wp_rewrite;
        // $wp_rewrite->flush_rules();
    }

    public function init() {
        //sample rewrite rule
        add_rewrite_rule(
            '^intro/sample$',
            'index.php?pagename=sample-page',
            'top'
        );

        //localevents to event cpt
        add_rewrite_rule(
            '^localevents/([^/]*)/info/([^/]*)?',
            'index.php?post_type=event&name=$matches[1]&info=$matches[2]',
            'top'
        );

        add_rewrite_rule(
            '^great$',
            'index.php?post_type=event&name=dhaka-wordcamp-2023',
            'top'
        );

        global $wp_rewrite;
        $wp_rewrite->author_base = 'writers';

        //change author to writers
        add_rewrite_rule(
            '^writers/([^/]*)/?',
            'index.php?author_name=$matches[1]',
            'top'
        );

    }

}

new Rewrite_Rules();
