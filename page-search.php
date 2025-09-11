<?php 
    get_header();
    
    while(have_posts()){
        the_post(); 
          pageBanner();
        ?>
        

    <div class="container container--narrow page-section">
        <?php
        $the_parent = wp_get_post_parent_id(get_the_ID()); // on the child page this value is always greater than 0 and if the page is a parent page then the value will always be 0
        if( wp_get_post_parent_id(get_the_ID())){?>
            <div class="metabox metabox--position-up metabox--with-home-link">
                <p>
                <a class="metabox__blog-home-link" href="<?php echo get_permalink($the_parent); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to <?php echo get_the_title($the_parent); ?></a> <span class="metabox__main"><?php the_title(); ?></span>
                </p>
            </div>
        <?php }?>


        <?php $testArray = get_pages(array(
            'child_of' => get_the_ID()
        ));?> 
        <?php if($the_parent || $testArray ){?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_permalink($the_parent); ?>"><?php echo get_the_title($the_parent); ?></a></h2>
        <ul class="min-list">
          <?php 
          $find_children_of = $the_parent ? $the_parent : get_the_ID();
          wp_list_pages(array(
            'title_li' => null,
            'child_of' => $find_children_of,
            'sort_column' => 'menu_order',
            'sort_order' => 'ASC'
          ));
          ?>
        </ul>
      </div>
      <?php }?>



      <div class="generic-content">
         <?php  get_search_form(); ?>
      </div>
    </div>
    <?php }
?>
<?php get_footer(); ?>
