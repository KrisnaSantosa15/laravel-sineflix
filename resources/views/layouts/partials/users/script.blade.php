<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<script>
    const heroSwiper = new Swiper(".hero-swiper", {
        // Optional parameters
        direction: "horizontal",
        loop: true,
        grabCursor: true,

        // If we need pagination
        pagination: {
            el: ".swiper-pagination",
        },
    });

    const justReleaseSwiper = new Swiper(".just-release-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 4.7,
                spaceBetween: 20,
            },
        },
    });

    const popularWeekSwiper = new Swiper(".popular-week-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3.7,
                spaceBetween: 20,
            },
        },
    });

    const featuredSwiper = new Swiper(".featured-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: true,
        breakpoints: {
            768: {
                slidesPerView: 1.6,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 2.4,
                spaceBetween: 15,
            },
        },
    });

    const moviesSwiper = new Swiper(".movies-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3.7,
                spaceBetween: 20,
            },
        },
    });

    const seriesSwiper = new Swiper(".series-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3.7,
                spaceBetween: 20,
            },
        },
    });

    const koreanSeriesSwiper = new Swiper(".korean-series-swiper", {
        slidesPerView: 1,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 10,
            },
            1024: {
                slidesPerView: 3.7,
                spaceBetween: 20,
            },
        },
    });
</script>
<script>
    // function updateFeaturedWatchlist() {
    //     // get data-in-watchlist attribute value from watchlist button
    //     let inWatchlist = $('#watchlist-button').data('in-watchlist') == true;
    //     if (inWatchlist) {
    //         $('#watchlist-button').html(`
    //             <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    //                 <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z"/>
    //             </svg>
    //             Remove from Watchlist
    //         `);
    //         $('#watchlist-button').addClass('bg-blue-700');
    //         $('#watchlist-button').removeClass('hover:bg-blue-800');
    //     } else {
    //         $('#watchlist-button').html(`
    //             <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
    //                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
    //                     d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
    //             </svg>
    //             Add Watchlist
    //         `);
    //         $('#watchlist-button').removeClass('bg-blue-700');
    //         $('#watchlist-button').addClass('hover:bg-blue-800');
    //     }
    // }

    // Function to update the featured section with the active slide data
    function updateFeaturedSection() {
        // let activeIndex = featuredSwiper.realIndex; // Use realIndex to get the original index
        // let featuredActiveSlide = document.querySelectorAll(".featured-swiper .swiper-slide")[activeIndex];
        let featuredActiveSlide = document.querySelector(".featured-swiper .swiper-slide-active");
        let activeSlideImage = featuredActiveSlide?.querySelector("img");

        if (featuredActiveSlide && activeSlideImage) {
            document.querySelector(".featured-section").style.backgroundImage = "url(" + activeSlideImage.getAttribute(
                "src") + ")";
            document.querySelector(".featured-title").innerHTML = featuredActiveSlide.getAttribute("data-title");
            document.querySelector(".featured-plot").innerHTML = featuredActiveSlide.getAttribute("data-plot");
            document.querySelector(".featured-rating").innerHTML = featuredActiveSlide.getAttribute("data-rating");
            document.querySelector(".featured-genre").innerHTML = featuredActiveSlide.getAttribute("data-genre");
            let releasedate = featuredActiveSlide.getAttribute("data-releasedate");
            let year = new Date(releasedate).getFullYear();
            document.querySelector(".featured-year").innerHTML = year.toString();
            document.querySelector(".featured-duration").innerHTML = featuredActiveSlide.getAttribute("data-duration");
            document.querySelector("#trailer-link").setAttribute("href", "/movies/" + featuredActiveSlide.getAttribute(
                "data-slug"));
            // document.querySelector("#watchlist-button").setAttribute("data-in-watchlist", featuredActiveSlide
            //     .getAttribute('data-in-watchlist'));
        }
    }

    // Initial update on page load
    updateFeaturedSection();

    // Update the featured section when the slide changes
    featuredSwiper.on("slideChangeTransitionEnd", function() {
        updateFeaturedSection();
    });

    // Event listener for clicking on slides to navigate
    document.querySelectorAll(".featured-swiper .swiper-slide").forEach((slide, index) => {
        slide.addEventListener("click", function() {
            featuredSwiper.slideToLoop(index); // Use slideToLoop for correct indexing in loop mode
            updateFeaturedSection();
        });
    });

    // Function to prevent default behavior of links with href="#"
    document.querySelectorAll('a[href="#"]').forEach((link) => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
        });
    });
</script>

{{-- Watchlist Toggle --}}
<script>
    $(document).ready(function() {
        $('.toggle-watchlist-btn').click(function(e) {
            e.preventDefault();
            var $button = $(this);
            var movieId = $button.data('movie-id');

            $.ajax({
                url: '{{ route('watchlist.toggle') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    movie_id: movieId
                },
                success: function(response) {
                    if (response.success) {
                        if (response.action === 'added') {
                            $button.html(`
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M7.833 2c-.507 0-.98.216-1.318.576A1.92 1.92 0 0 0 6 3.89V21a1 1 0 0 0 1.625.78L12 18.28l4.375 3.5A1 1 0 0 0 18 21V3.889c0-.481-.178-.954-.515-1.313A1.808 1.808 0 0 0 16.167 2H7.833Z"/>
                                </svg>
                                Remove from Watchlist
                            `);
                            $button.addClass('bg-blue-700');
                            $button.removeClass('hover:bg-blue-800');
                        } else if (response.action === 'removed') {
                            $button.html(`
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                                </svg>
                                Add Watchlist
                            `);
                            $button.removeClass('bg-blue-700');
                            $button.addClass('hover:bg-blue-800');
                        }
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
                    console.log('Error:', response);
                    // Handle error, show a message to the user, etc.
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#search-input-modal').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 2) { // Start searching when the query is at least 3 characters
                $.ajax({
                    url: '{{ route('movies.search-ajax') }}',
                    type: 'GET',
                    data: {
                        search: query
                    },
                    success: function(response) {
                        let movies = response.movies;
                        let searchResults = '';

                        movies.forEach(movie => {
                            searchResults += `<li>
                            <a href="/movies/${movie.slug}"
                                class="flex items-center p-3 text-base font-bold text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 group hover:shadow dark:bg-gray-600 dark:hover:bg-gray-500 dark:text-white">
                                <span class="flex-1 ms-3 whitespace-nowrap">${movie.title}</span>
                            </a>
                        </li>`;
                        });

                        $('#search-results').html(searchResults);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            } else {
                $('#search-results').html('');
            }
        });
    });
</script>
{{-- Password visibility toggle --}}
<script>
    function togglePasswordVisibility(elementId, showIconId = 'show-icon', hideIconId = 'hide-icon') {
        const passwordInput = document.getElementById(elementId);
        const showIcon = document.getElementById(showIconId);
        const hideIcon = document.getElementById(hideIconId);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            showIcon.style.display = 'block';
            hideIcon.style.display = 'none';
        } else {
            passwordInput.type = 'password';
            showIcon.style.display = 'none';
            hideIcon.style.display = 'block';
        }
    }
</script>
