<?php get_header(); ?>

<!-- Page Content -->
<!-- Banner Starts Here -->
<div class="heading-page header-text">
    <section class="page-heading">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="text-content">
            <h4>Detalles de la publicación</h4>
            <h2><?= get_the_title(); ?></h2>
            </div>
        </div>
        </div>
    </div>
    </section>
</div>

<!-- Banner Ends Here -->

<?
if( have_posts() ):
    while( have_posts() ):
        the_post(); ?>
    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <?php the_post_thumbnail(); ?>
                                    </div>
                                    <div class="down-content">
                                        <span><?php the_category(); ?></span>
                                        <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                                        <ul class="post-info">
                                            <li><a href="#"><?php the_author(); ?></a></li>
                                            <li><a href="#"><?php the_date(); ?></a></li>
                                            <li><a href="#"><?php comments_number(); ?></a></li>
                                        </ul>
                                        <?php the_content(); ?>
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
                            <?php
                                if ( comments_open() || get_comments_number() ) :
                                    comments_template(); 
                                endif;
                            ?>
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
<?php
    endwhile;
endif
?>
<?php get_footer(); ?>