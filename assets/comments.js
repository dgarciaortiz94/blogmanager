$(".comments-icon, .comments-button").on('click', function() {
    let scrollAnimate = calculateAsideScrollAnimate();

    $(".comments-container").css("right", "-"+scrollAnimate+"px");

    $("body").addClass("no-scroll");
    $(".comments-window, .comments-container").removeClass("d-none");

    $(".comments-container").animate({
        right: "0"
    })
})

$(".background-dark, .close-icon").on('click', function() {
    let scrollAnimate = calculateAsideScrollAnimate();

    $(".comments-container").animate({
        right: "-"+scrollAnimate+"px"
    },
    {
    complete: function() {
        $(".comments-window, .comments-container").addClass("d-none");
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