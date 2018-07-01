
jQuery.event.special.touchstart = {
    setup: function (_, ns, handle) {
        if (ns.includes("noPreventDefault")) {
            this.addEventListener("touchstart", handle, { passive: false });
        } else {
            this.addEventListener("touchstart", handle, { passive: true });
        }
    }
};

$(function () {
    activeToolTip($(".noted"));

    $(".noted").on("touchstart", function (e) {
        $(e.target).find('.del-btn').show();
        $(e.target).find('.del-btn').removeClass('hide')
    })

    $(".noted").on("touchend", function () {
        //$(this).find('.del-btn').addClass('hide');
    })


    $(".noted").draggable(
        {
            containment: "#container",
            drag: function () {
                var offset = $(this).offset();
                var parentOffset = $("#container").offset();
                $("#pos_top").val(offset.top + $(window).scrollTop() - parentOffset.top);
                $("#pos_left").val(offset.left + $(window).scrollLeft() - parentOffset.left);
                /* $.ajax({
                    url: 

                }) */
            }
        });

    $("#image").get(0).draggable = false;

    var $container = $('#container');
    var $selection = $('<div>').addClass('drawing');
    var offset = $container.offset();
    var click_x, click_y;
    var isDrag = 0;


    $container.on('touchstart', function (e) {
        target = $(e.target);
        if (target.attr("id") == 'image') {
            isDrag = 1;
            $(".note").remove();            
            var touch = e.touches[0];
            click_x = touch.clientX - offset.left + $(window).scrollLeft();
            click_y = touch.clientY - offset.top + $(window).scrollTop();
            $selection.css({
                'top': click_y,
                'left': click_x,
                'width': 0,
                'height': 0
            });
            $selection.appendTo($container);
        }
        
    });

    $container.on('touchmove', function (e) {
            target = $(e.target);
        e.preventDefault();
        if (target.attr("id") == 'image' && isDrag == 1)
            {
                var touch = e.touches[0];
                
                var x1 = offset.left;
                var y1 = offset.top;
                var x2 = $("#image").width() + x1;
                var y2 = $("#image").height() + y1;

                if (touch.pageY > y2 || touch.pageX > x2 || touch.pageX < x1 || touch.pageY < y1) {
                    isDrag = 2;
                }

                var move_x = touch.clientX - offset.left + $(window).scrollLeft(),
                    move_y = touch.clientY - offset.top + $(window).scrollTop(),

                    width = Math.abs(move_x - click_x),
                    height = Math.abs(move_y - click_y),
                    new_x, new_y;

                new_x = (move_x < click_x) ? (click_x - width) : click_x;
                new_y = (move_y < click_y) ? (click_y - height) : click_y;

                if (width != 0 && height != 0)
                    $selection.css({
                        'width': width,
                        'height': height,
                        'top': new_y,
                        'left': new_x
                    });
            }
    });

    $container.on('touchend touchcancel', function (e) {
            target = $(e.target);
            if (target.attr("id") == 'image' && isDrag != 0 ) {
                var count = $("#count").val();
                $(".note").remove();
                if ($selection.width() > 15) {
                    var note = $selection.clone();
                    note.prop("class", "note");
                    note.append("<span class='tip-num'>" + count + "</span>");
                    count++;
                    note.appendTo($container);
                    note.draggable(
                        {
                            containment: "#container",
                            drag: function () {
                                var offset = $(this).offset();
                                var parentOffset = $("#container").offset();
                                $("#pos_top").val(offset.top + $(window).scrollTop() - parentOffset.top)
                                $("#pos_left").val(offset.left + $(window).scrollLeft() - parentOffset.left)
                            }
                        });
                    note.resizable({
                        containment: "#container",
                        stop: function (event, ui) {
                            $("#width").val(ui.size.width);
                            $("#height").val(ui.size.height);
                        },
                    });
                    note.show();
                    $(".form").show();
                    saveCSS(note);
                }

                $selection.remove();
                isDrag = 0;
            }
        });

});
function saveCSS(e) {
    var pos = e.position();
    $("#form").show();
    $("#pos_top").val(pos.top)
    $("#pos_left").val(pos.left)
    $("#width").val(e.width())
    $("#height").val(e.height())
}
function activeToolTip(dom) {
    dom.tooltip({
        position: {
            my: "bottom",
            at: "top-13",
            collision: "flip",
            using: function (position, feedback) {
                $(this).addClass(feedback.vertical)
                    .css(position);
            }
        }
    });
}
