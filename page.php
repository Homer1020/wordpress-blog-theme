<?php get_header(); ?>
    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h4>Conócenos</h4>
                <h2><?php the_title(); ?></h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    
    <!-- Banner Ends Here -->


    <section class="about-us">
      <div class="container">
      	
        <div class="row">
          <div class="col-lg-12">
            <?php if(has_post_thumbnail()) {
              the_post_thumbnail('full');
            } ?>
            
            <?php the_content(); ?>
          </div>
        </div>
      </div>
    </section>
<?php get_footer(); ?>