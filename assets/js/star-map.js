//Star-map : Rotate

degrees = 0;
function get_degrees(mouse_x, mouse_y) {
    const radius	= $(".dial").width() / 2;
    const center_x	= $(".dial").offset().left + radius;
    const center_y	= $(".dial").offset().top + radius;
    const radians	= Math.atan2(mouse_x - center_x, mouse_y - center_y);
    const degrees	= Math.round((radians * (180 / Math.PI) * -1) + 100);

    return degrees;
}

function rotate(event){
    const click_degrees = get_degrees(event.pageX, event.pageY);

    $(document).bind('mousemove', click_degrees, function(event) {
        var degrees = get_degrees(event.pageX, event.pageY) - click_degrees;
        degrees = degrees / 2;
        $(".dial").css('transform', 'rotate('+degrees+'deg)');
    });

    $(document).on('mouseup', function() {
        $(document).unbind('mousemove');
    });
}

function left_slow(event){
  console.log("hi");
    degrees = degrees - 1;
    $(".dial").css('transform', 'translate(-50%, 0.5%) rotate('+degrees+'deg)');

}
function left_fast(event){
    degrees = degrees - 20;
    $(".dial").css('transform', 'translate(-50%, 0.5%) rotate('+degrees+'deg)');
}
function right_slow(event){
    degrees = degrees + 1;
    $(".dial").css('transform', 'translate(-50%, 0.5%) rotate('+degrees+'deg)');
}
function right_fast(event){
    degrees = degrees + 20;
    $(".dial").css('transform', 'translate(-50%, 0.5%) rotate('+degrees+'deg)');
}
