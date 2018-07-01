
$(function() {
    activeToolTip($(".noted"));


    $(".noted").on("mouseover",function(e){        
        $(e.target).find('.del-btn').show();
        $(e.target).find('.del-btn').removeClass('hide')
    })

    $(".noted").on("mouseleave", function () {
        $(this).find('.del-btn').addClass('hide');
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

    
    var $container = $('#container');
    var $selection = $('<div>').addClass('drawing');
    var click_x,click_y;
    var offset = $container.offset();
    var isDrag = false;

    


    $container.on('mousedown', function(e) {
        target = $(e.target);
        if (target.attr("id") == 'image' && e.which == 1) {
            isDrag = true;
            $(".note").remove();
            click_x = e.clientX - offset.left + $(window).scrollLeft();
            click_y = e.clientY - offset.top + $(window).scrollTop();

            $selection.css({
                'top': click_y,
                'left': click_x,
                'width': 0,
                'height': 0
            });

            $selection.appendTo($container);

            
        }
    });

    $container.on('mousemove', function (e) {
        if(isDrag)
        {
            target = $(e.target);
            var move_x = e.clientX - offset.left + $(window).scrollLeft(),
                move_y = e.clientY - offset.top + $(window).scrollTop(),

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


    $container.on('mouseup mouseleave', function (e) {
        if(isDrag)
        {
            target = $(e.target);
            var count = $("#count").val();
            if ($selection.width() > 15) {
                var note = $selection.clone()
                    .prop("class", "note")
                    .append("<span class='tip-num'>" + count + "</span>");
                count++;
                note.appendTo($container);
                note.resizable({
                    containment: "#container",
                    stop: function (event, ui) {
                        $("#width").val(ui.size.width);
                        $("#height").val(ui.size.height);
                    }
                });
                note.draggable(
                    {
                        containment: "#image",
                        drag: function () {
                            var offset = $(this).offset();
                            var parentOffset = $("#container").offset();
                            $("#pos_top").val(offset.top + $(window).scrollTop() - parentOffset.top)
                            $("#pos_left").val(offset.left + $(window).scrollLeft() - parentOffset.left)
                        }
                    });
                note.show();
                $(".form").show();
                saveCSS(note);
            }
            $selection.remove();
        }
        isDrag = false;
        
    });





});



function saveCSS(e)
{
    var pos = e.position();
    $("#form").show();
    $("#pos_top").val(pos.top)
    $("#pos_left").val(pos.left)
    $("#width").val(e.width())
    $("#height").val(e.height())
}

function activeToolTip(dom)
{
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
