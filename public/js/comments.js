$(document).ready(function() {
    
    $(".open-comment").click(function() {
        let scrollAnimate = calculateAsideScrollAnimate();

        $(".comments-container").css("right", "-"+scrollAnimate+"px");

        $("body").addClass("no-scroll");
        $(".comments-opened").removeClass("d-none");

        $(".comments-container").animate({
            right: "0"
        })
        
    })

    $(".background-dark, .close-icon").click(function() {
        let scrollAnimate = calculateAsideScrollAnimate();

        $(".comments-container").animate({
            right: "-"+scrollAnimate+"px"
        },
        {
        complete: function() {
            $(".comments-opened").addClass("d-none");
            $("body").removeClass("no-scroll");
        }
        })
    })

    function calculateAsideScrollAnimate() {
        let commentsContainerWidth = $(".comments-container").width();
        let windowWidth = $(window).width();

        let scrollAnimate = commentsContainerWidth === 0 ? windowWidth : commentsContainerWidth;

        return scrollAnimate;
    }

})