
$(function() {
    //activeToolTip($(document));


    $(".noted").on("mouseover",function(e){        
        $(e.target).find('.fa-trash').show();
        console.log($(e.target).find('.fa-trash').removeClass('hide'))
    })

    $(".noted").on("mouseleave", function () {
        $(this).find('.fa-trash').addClass('hide');
    })

    $('.fa-trash').on('click',function(e)
    {
        var noted = $(e.target).closest('.noted');
        console.log(noted.data('id'));
        noted.hide();
    })



    $("#image").get(0).draggable = false;
    console.log("OK");
    var $container = $('#container');
    var $selection = $('<div>').addClass('drawing');
    $container.on('mousedown', function(e) {
        target = $(e.target);
        console.log(target);
        if(target.attr("id") != 'image') return;
        if(e.which != 1) return;

        var offset = $container.offset();
        var pos = $container.position();
        console.log(offset,pos);
        var click_x = e.clientX - offset.left + $(window).scrollLeft();
        var click_y = e.clientY - offset.top + $(window).scrollTop();
        console.log(e.clientX,e.clientY);
        

        $selection.css({
          'top':    click_y,
          'left':   click_x,
          'width':  0,
          'height': 0
        });
        $selection.appendTo($container);
        
        $container.on('mousemove', function(e) {

        if(target.attr("id") != 'image') return;
        if(e.which != 1) return;       
            var move_x = e.clientX - offset.left +  $(window).scrollLeft(),
                move_y = e.clientY - offset.top +  $(window).scrollTop(),

              width  = Math.abs(move_x - click_x),
              height = Math.abs(move_y - click_y),
              new_x, new_y;

              
          new_x = (move_x < click_x) ? (click_x - width) : click_x;
          new_y = (move_y < click_y) ? (click_y - height) : click_y;

          
          if(width != 0 && height != 0)
          $selection.css({
            'width': width,
            'height': height,
            'top': new_y,
            'left': new_x
          });
          
        }).on('mouseup mouseleave', function(e) {
            if(target.attr("id") != 'image') return;
            if(e.which != 1) return;
            $container.off('mousemove');
            var count = $("#count").val();
            $(".note").remove();
           if($selection.width() > 15) 
           {
               var note = $selection.clone();
               note.prop("class","note");
               note.append("<span class='tip-num'>" + count + "</span>");
               count++;
               note.appendTo($container);
               note.draggable(
                {
                    containment: "#container",
                    drag: function(){
                        var offset = $(this).offset();              
                        var parentOffset = $("#container").offset();              
                        $("#pos_top").val(offset.top + $(window).scrollTop() - parentOffset.top)
                        $("#pos_left").val(offset.left + $(window).scrollLeft() - parentOffset.left)
                    }
                });
              note.attr('title',"Hello comment");
               //activeToolTip(note);
               note.resizable({                
                stop : function(event,ui) {                    
                    $("#width").val(ui.size.width);
                    $("#height").val(ui.size.height);
                },
               });
               note.show();
               $(".form").show();
               saveCSS(note);
           }
            
            $selection.remove();
        });
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
