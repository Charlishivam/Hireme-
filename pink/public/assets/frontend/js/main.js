$(document).on('mouseenter', '.navcat', function(){
    var curr_cat = $(this).data('cat');
    $('.scat').hide();
    setTimeout(function () {
        $('#navcat'+curr_cat).show();
    },10);
});

$(document).on('mouseenter', '.navscat', function(){
    var curr_scat = $(this).data('scat');
    $('.navtopic').hide();
    setTimeout(function () {
        $('#navtopic'+curr_scat).show();
    },10);
});

$(document).ready(function () {
    if ($(window).width() < 768) {
        $("#category-nav").click(function () {
            $(".category-menu-nav").addClass("d-flex");
        });
        
        $(".menu-category a").click(function () {
            $(".menu-subcategory").show();
        });
        
        $(".menu-subcategory a").click(function () {
            $(".menu-topic").show();
        });
    }
});

$(document).ready(function () {
    if ($(window).width() < 768) {
        $("#category-nav").click(function () {
            $("body").addClass("body-100");
        });

        $(".menu-category a").click(function () {
            $("body").addClass("body-100");
        });
        $(".menu-subcategory a").click(function () {
            $("body").addClass("body-100");
        });
    }
});

// $('#owl-carousel-1').owlCarousel({
//     loop: false,
//     margin: 0,
//     nav: true,
//     dots: false,
//     responsive: {
//         0: {
//             items: 1
//         },
//         600: {
//             items: 2
//         },
//         1000: {
//             items: 4
//         }
//     }
// });