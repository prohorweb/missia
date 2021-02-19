<?php $cat_ID = get_query_var('cat'); ?>
<section class="section last-newes">
    <div class="container">
        <div class="columns is-multiline">
            <?php

            $the_query = new WP_Query(array(
                'posts_per_page' => 5,
                'cat' => $cat_ID,
                'paged' => $paged
            ));

            // цикл вывода полученных записей
            while ($the_query->have_posts()) {
            $the_query->the_post();
            ?>
            <div class="column is-4">
                <div class="card is-shady">
                    <div class="card-image has-text-centered">
                        <a href="<?= get_permalink($post_id); ?>">
                            <img class="w-100" src="<?= get_the_post_thumbnail_url($post_id, 'thumbnail'); ?>"
                                 alt="">
                        </a>
                    </div>
                    <div class="card-content">
                        <div class="content"><h4>   <?= get_the_title(); ?></h4>
                            <div class="date">
                                <?= get_the_date('d.m.Y'); ?>
                            </div>
                            <p><?php trim_excerpt_chars(100, '...'); ?>.</p>
                            <p><a href="<?= get_permalink($post_id); ?>">Подробнее...</a></p></div>
                    </div>
                </div>
            </div>
            <?php
            }
            wp_reset_postdata();
            ?>
        </div>
        <nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">
            <?php custom_pagination() ?>
        </nav>
    </div>
</section>