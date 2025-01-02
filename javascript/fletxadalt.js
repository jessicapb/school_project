var $j = jQuery.noConflict();
$j(window).scroll(function() {
    if ($j(this).scrollTop() > 300) {
        $j('a#scroll-top').fadeIn('slow');
    } else {
        $j('a#scroll-top').fadeOut('slow');
    }
});
$j('a#scroll-top').click(function(event) {
    event.preventDefault();
    $j('html, body').animate({scrollTop: 0}, 600);
});