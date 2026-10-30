<?php get_header(); ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="main-banner header-text">
        <?php 
        $sliderPosts = get_field('publicaciones_slider');
        
        if ($sliderPosts):
            // 1. Extraer todos los IDs de los posts del slider
            $post_ids = wp_list_pluck($sliderPosts, 'ID');
            
            // 2. Precargar en caché la información básica, metadatos y términos (categorías/etiquetas) 
            // de TODOS los posts de golpe (Evita N+1 para posts y taxonomías)
            _prime_post_caches($post_ids, true, true);
            
            // 3. Extraer los IDs de los autores únicos para precargar sus datos de usuario de golpe
            $author_ids = array_unique(wp_list_pluck($sliderPosts, 'post_author'));
            if (!empty($author_ids)) {
                cache_users($author_ids);
            }
        ?>
          <div class="container-fluid">
            <div class="owl-banner owl-carousel">
              <?php foreach($sliderPosts as $sliderPost): 
                  $postID = $sliderPost->ID;
                  
                  // Obtener la URL permanente del post de forma dinámica
                  $permalink = get_permalink($postID);
                  
                  // Obtener el nombre del autor (ya está en caché gracias a cache_users)
                  $author_name = get_the_author_meta('display_name', $sliderPost->post_author);
                  
                  // Obtener la fecha formateada (puedes usar el formato de WordPress)
                  $post_date = get_the_date('', $postID);
                  
                  // Obtener las categorías del post (ej. la primera categoría o un listado)
                  $categories = get_the_category($postID);
                  $category_name = !empty($categories) ? $categories[0]->name : 'Sin categoría';
                  $category_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
              ?>
                <div class="item">
                  <?= get_the_post_thumbnail($postID, 'full') ?>
                  <div class="item-content">
                    <div class="main-content">
                      <div class="meta-category">
                        <a href="<?= esc_url($category_link); ?>"><span><?= esc_html($category_name); ?></span></a>
                      </div>
                      <a href="<?= esc_url($permalink); ?>"><h4><?= esc_html($sliderPost->post_title); ?></h4></a>
                      <ul class="post-info">
                        <li><a href="#"><?= esc_html($author_name); ?></a></li>
                        <li><a href="#"><?= esc_html($post_date); ?></a></li>
                        <li><a href="#"><?= esc_html($sliderPost->comment_count); ?> Comentarios</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>
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
                          <?php get_template_part('template-parts/post', 'info') ?>
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
            <?php get_template_part('template-parts/post', 'sidebar') ?>
          </div>
        </div>
      </div>
    </section>
<?php get_footer(); ?>