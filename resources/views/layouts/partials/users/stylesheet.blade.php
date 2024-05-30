<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

@vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<style>
    .hero-swiper {
        width: auto;
        height: 80vh;
    }

    .hero-swiper .swiper-slide {
        font-size: 18px;
        background: #fff;
        /* Center slide text vertically */
        display: flex;
        /* justify-content: center;
  align-items: center; */
    }

    .swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .swiper-pagination-bullet {
        width: 10px;
        height: 10px;
        background: #fff;
        margin: 0 5px;
        border-radius: 50%;
        opacity: 0.5;
        cursor: pointer;
    }

    .swiper-pagination-bullet-active {
        opacity: 1;
        background: #007aff;
    }

    .overlay {
        background: linear-gradient(to top, rgba(0, 0, 0, 1), rgba(0, 0, 0, 0)) !important;
        opacity: 0.7;
        z-index: 1;
    }


    .just-release-swiper {
        width: auto;
        height: 100%;

    }

    /* Just Release Swiper */
    .just-release-swiper .swiper-slide {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;

        height: 380px;
    }

    .popular-week-swiper {
        width: auto;
        height: 100%;
    }

    /* Popular This Week Swiper */
    .popular-week-swiper .swiper-slide {
        overflow: hidden;
        height: 150px;
    }

    .popular-week-swiper .swiper-slide img {
        border-radius: 10px !important;
        width: 110px;
        height: 130px !important;
    }

    /* Featured Swiper */
    .featured-swiper {
        width: auto;
        height: auto;
    }

    .featured-swiper .swiper-slide {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        /* height: 80%; */
    }

    .featured-swiper .swiper-slide img {
        border-radius: 10px !important;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .featured-swiper .swiper-slide-active {
        border: 2px solid #007aff;
    }

    .featured-section::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        /* Black with 40% opacity */
        pointer-events: none;
        /* Make sure the overlay does not interfere with interactions */
    }


    /* Movies swiper */
    .movies-swiper {
        width: auto;
        height: 100%;
    }

    .movies-swiper .swiper-slide {
        border-radius: 10px;
        overflow: hidden;
        height: auto;

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .movies-swiper .swiper-slide img {
        border-radius: 10px !important;
        width: 280px;
        height: 200px;
        object-fit: cover;
    }

    .movies-swiper .swiper-slide .movie-title {
        max-width: 280px;
    }

    /* Series swiper */
    .series-swiper {
        width: auto;
        height: 100%;
    }

    .series-swiper .swiper-slide {
        border-radius: 10px;
        overflow: hidden;
        height: auto;

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .series-swiper .swiper-slide img {
        border-radius: 10px !important;
        width: 280px;
        height: 200px;
        object-fit: cover;
    }

    .series-swiper .swiper-slide .movie-title {
        max-width: 280px;
    }

    /* Korean Series swiper */
    .korean-series-swiper {
        width: auto;
        height: 100%;
    }

    .korean-series-swiper .swiper-slide {
        border-radius: 10px;
        overflow: hidden;
        height: auto;

        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .korean-series-swiper .swiper-slide img {
        border-radius: 10px !important;
        width: 280px;
        height: 200px;
        object-fit: cover;
    }

    .korean-series-swiper .swiper-slide .movie-title {
        max-width: 280px;
    }
</style>
