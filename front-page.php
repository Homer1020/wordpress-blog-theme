<?php get_header(); ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
      <div class="container-fluid">
        <div class="owl-banner owl-carousel">
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-01.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Fashion</span>
                </div>
                <a href="post-details.html"><h4>Morbi dapibus condimentum</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 12, 2020</a></li>
                  <li><a href="#">12 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-02.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Nature</span>
                </div>
                <a href="post-details.html"><h4>Donec porttitor augue at velit</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 14, 2020</a></li>
                  <li><a href="#">24 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-03.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Lifestyle</span>
                </div>
                <a href="post-details.html"><h4>Best HTML Templates on TemplateMo</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 16, 2020</a></li>
                  <li><a href="#">36 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-04.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Fashion</span>
                </div>
                <a href="post-details.html"><h4>Responsive and Mobile Ready Layouts</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 18, 2020</a></li>
                  <li><a href="#">48 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-05.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Nature</span>
                </div>
                <a href="post-details.html"><h4>Cras congue sed augue id ullamcorper</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 24, 2020</a></li>
                  <li><a href="#">64 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="item">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/banner-item-06.jpg" alt="">
            <div class="item-content">
              <div class="main-content">
                <div class="meta-category">
                  <span>Lifestyle</span>
                </div>
                <a href="post-details.html"><h4>Suspendisse nec aliquet ligula</h4></a>
                <ul class="post-info">
                  <li><a href="#">Admin</a></li>
                  <li><a href="#">May 26, 2020</a></li>
                  <li><a href="#">72 Comments</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner Ends Here -->

    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="all-blog-posts">
              <div class="row">
                
                <?php
                  $recent_posts_query = new WP_Query(array(
                    'post_type'      => 'post',
                    'posts_per_page' => 5, // Número de entradas a mostrar
                  )); ?>
                

                <?php
                  if ( $recent_posts_query->have_posts() ) :
                    while ( $recent_posts_query->have_posts() ) : $recent_posts_query->the_post(); ?>
                    <div class="col-lg-12">
                      <div class="blog-post">
                        <a href="<?= esc_url(the_permalink()); ?>" class="blog-thumb">
                          <?php the_post_thumbnail(); ?>
                          <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blog-post-01.jpg" alt=""> -->
                        </a>
                        <div class="down-content">
                          <span><?php the_category(); ?></span>
                          <a href="<?= esc_url(the_permalink()); ?>"><h4><?php the_title(); ?></h4></a>
                          <ul class="post-info">
                            <li><a href="#"><?php the_author(); ?></a></li>
                            <li><a href="#"><?php the_date(); ?></a></li>
                            <li><a href="#"><?php comments_number(); ?></a></li>
                          </ul>
                          <?php the_excerpt(); ?>
                          <!-- <p>Stand Blog is a free HTML CSS template for your CMS theme. You can easily adapt or customize it for any kind of CMS or website builder. You are allowed to use it for your business. You are NOT allowed to re-distribute the template ZIP file on any template collection site for the download purpose. <a rel="nofollow" href="https://templatemo.com/contact" target="_parent">Contact TemplateMo</a> for more info. Thank you.</p> -->
                          <div class="post-options">
                            <div class="row">
                              <div class="col-6">
                                <?php get_template_part('template-parts/post', 'tags') ?>
                              </div>
                              <div class="col-6">
                                <ul class="post-share">
                                  <li><i class="fa fa-share-alt"></i></li>
                                  <li><a href="#">Facebook</a>,</li>
                                  <li><a href="#"> Twitter</a></li>
                                </ul>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?php
                      endwhile;
                      wp_reset_postdata();
                    else :
                      echo '<p>No hay entradas recientes.</p>';
                    endif;
                  ?>
                
                <div class="col-lg-12">
                  <div class="main-button">
                    <a href="/blog"><?= __('Ver todas las publicaciones', 'homertema') ?></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <?php if ( is_active_sidebar('main-sidebar') ) : ?>
                  <?php dynamic_sidebar('main-sidebar'); ?>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
<?php get_footer(); ?>