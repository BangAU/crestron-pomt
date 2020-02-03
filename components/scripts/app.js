'use strict';

import $ from 'jquery';
import AOS from 'aos';
require ('jquery-validation');
import jcf from 'jcf';

document.addEventListener('DOMContentLoaded', function() {
    AOS.init();

    var $doc = $(document);


    $doc.on("click", function(e){
        var menu = $('#nav ul');
        var menu_btn = $('#nav input');
        // check that the click target is not the menu or it's child
        if(!menu.is(e.target) && menu.has(e.target).length === 0){
            // check if the target is the menu-toggle amd show or hide the menu accordingly
            if(menu_btn.is(e.target)){
                if ($(menu_btn).is(":checked")) {
                    menu.fadeIn(300);
                } else {
                    menu.fadeOut(300);
                }
            }
            // else if it's outside the menu or the menu-toggle, hide the menu and change the menu-toggle state
            else{
                menu.fadeOut(300);
                menu_btn.prop("checked", false);
            }
        } 
    });
    $('.btn-submit').click(function(ev){
        ev.preventDefault();
        if( $("#work-form").valid() ){
            $( ".btn-submit" ).addClass( "disabled" );
            var var_data = $("#work-form").serialize(),
                var_url = $("#work-form").attr('action');
            $('body').css('cursor','wait');
            $.ajax({
                type:"POST",
                url: var_url,
                data: var_data,
                success: function(response){
                    $("#work-form").slideUp("slow",function(){
                        $('.message-success').fadeIn(500);
                    })
                    $('body').css('cursor','auto');
                }
            });
        }
    });

    var banner = $('.banner-image');
    var bg = $('.bg-back');

    $(document).mousemove(function(e){
        var moveX=(e.pageX*-1/10);
        var moveY=(e.pageY*-1/10);
      
        bg.css('background-position', moveX + 'px ' + moveY + 'px')
        
    })

    // scroll link animation
    $(function() {
        $('#nav ul a, .btn-anchor').on('click', function(e) {
          e.preventDefault();
          $('html, body').animate({ scrollTop: $($(this).attr('href')).offset().top}, 600, 'linear');
        });
    });

    //custom forms
    jcf.setOptions('Select', {
        wrapNative: false,
        wrapNativeOnMobile: false,
        fakeDropInBody: false,
        maxVisibleItems: 5
      });
    jcf.replace($('.work-form select'));
});