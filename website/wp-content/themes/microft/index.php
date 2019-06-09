<?php

get_header(); ?>
<div id="primary" class="content-area">


    <main id="main" class="site-main" role="main">
        <?php if (is_front_page()) : ?>

            <div class="siema carousel">
                <?php for ($x = 1; $x <= 7; $x++): ?>
                    <?php $value = get_field("image_$x"); ?>
                    <?php if (!empty($value['image'])): ?>
                        <div class="carousel__item">
                            <img src="<?= $value['image'] ?>" alt="<?= $value['title'] ?>" class="carousel__item-image">
                            <h3 class="carousel__item-text">
                                <?= $value['title'] ?>
                            </h3>
                        </div>
                    <?php endif ?>
                <?php endfor; ?>
            </div>
            <div class="content--main">
                <?php
                if (have_posts()) {
                    while (have_posts()) {
                        the_post();
                        the_content();
                    }
                };
                ?>
            </div>

            <div class="content content--mesh">
                <form action="/contact" method="post" class="contact-form clearfix">
                    <h3>Contact Us</h3>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name"  placeholder="Your name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"  aria-describedby="emailHelp"
                               placeholder="Your email">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone"  aria-describedby="emailHelp"
                               placeholder="Your phone number">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control contact-form__message" name="message" placeholder="Your message..."></textarea>
                    </div>
                    <?= do_shortcode('[bws_google_captcha]') ?>
                    <?php wp_nonce_field('contact_form'); ?>
                    <input type="submit" class="btn btn-primary">
                </form>
            </div>
        <?php else: ?>
            <section id="primary" class="content-area">
                <main id="main" class="site-main">

                    <div class="error-404 not-found">
                        <header class="page-header">
                            <h1 class="page-title">Oops! That page can't be found.</h1>
                        </header><!-- .page-header -->

                        <div class="page-content">
                            <p>It looks like nothing was found at this location.</p>
                        </div><!-- .page-content -->
                    </div><!-- .error-404 -->

                </main><!-- #main -->
            </section><!-- #primary -->

        <?php endif; ?>
    </main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>
