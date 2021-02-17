<!--Carousel-->
<section class="carousel">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><!--video(src='media/bg-home.mp4' autoplay='autoplay' loop='loop' muted='mute')-->
                <video poster="<?php bloginfo('template_url'); ?>/media/bg-video.jpg" preload="none" autoplay="autoplay" loop="loop" muted="muted">
                    <source src="<?php bloginfo('template_url'); ?>/media/bg-home.mp4" type="video/mp4"/>
                </video>
                <div class="video-bg">
                    <div class="slide-content">
                        <div class="slide-title">Миссионерский отдел Санкт-Петербургской епархии</div>
                        <div class="slide-desc">Московский патриархат</div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php bloginfo('template_url'); ?>/media/1.jpeg);">
                <div class="slide-content">
                    <div class="slide-title">Антисектантское направление</div>
                    <div class="slide-desc">Помощь попавшим в секту и их близких, необходимая информация</div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php bloginfo('template_url'); ?>/media/2.jpeg);">
                <div class="slide-content">
                    <div class="slide-title">Ассоциация молодежных общин</div>
                    <div class="slide-desc">Взаимодействие миссионеров Санкт-Петербурга для проведения общих
                        мероприятий
                    </div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php bloginfo('template_url'); ?>/media/3.jpeg);">
                <div class="slide-content">
                    <div class="slide-title">Конференции и семинары</div>
                    <div class="slide-desc">Съезды миссионеров, конференции, семинары, миссионерские молебны</div>
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url(<?php bloginfo('template_url'); ?>/media/4.jpeg);">
                <div class="slide-content">
                    <div class="slide-title">Социальное направление</div>
                    <div class="slide-desc">Помощь нуждающимся, бездомным</div>
                </div>
            </div>
        </div>
        <div class="swiper-button-next is-hidden-touch"></div>
        <div class="swiper-button-prev is-hidden-touch"></div>
        <div class="swiper-pagination is-hidden-touch"></div>
    </div>
</section>