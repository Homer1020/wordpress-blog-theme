<?php get_header(); ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4><?= __('Publicaciones recientes') ?></h4>
                <?php
                    $posts_page_id = get_option( 'page_for_posts' );
                ?>
                <h2><?= get_the_title($posts_page_id); ?></h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->

    <section class="blog-posts grid-system">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                <?php while(have_posts()): the_post(); ?>
                    <div class="col-lg-6">
                    <div class="blog-post">
                        <div class="blog-thumb">
                            <?php $imagen_url = get_the_post_thumbnail_url( get_the_ID('thumbnail') ); ?>
                            <img src="<?= $imagen_url ?>" alt="">
                        </div>
                        <div class="down-content">
                        <span><?php the_category(); ?></span>
                        <a href="<?= esc_url(the_permalink()); ?>"><h4><?php the_title(); ?></h4></a>
                        <?php get_template_part('template-parts/post', 'info') ?>
                        <p>Nullam nibh mi, tincidunt sed sapien ut, rutrum hendrerit velit. Integer auctor a mauris sit amet eleifend.</p>
                        <div class="post-options">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php get_template_part('template-parts/post', 'tags') ?>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                <?php endwhile ?>
                <div class="col-lg-12">
                    <?php
                        the_posts_pagination( array(
                            'prev_text' => __('&larr;', 'homertema'),
                            'next_text' => __('&rarr;', 'homertema'),
                        ) );
                    ?>
                </div>
                <!-- <div class="col-lg-12">
                  <ul class="page-numbers">
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
                  </ul>
                </div> -->
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <?php get_template_part('template-parts/post', 'sidebar') ?>
          </div>
        </div>
      </div>
    </section>
<?php get_footer(); ?>