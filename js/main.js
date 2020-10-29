/* 

Vanilla Template

https://templatemo.com/tm-526-vanilla

*/

jQuery(document).ready(function($) {

	'use strict';

    var top_header = $('.parallax-content');
    top_header.css({'background-position':'center center'}); // better use CSS

    $(window).scroll(function () {
    var st = $(this).scrollTop();
    top_header.css({'background-position':'center calc(50% + '+(st*.5)+'px)'});
    });


    $('body').scrollspy({ 
        target: '.fixed-side-navbar',
        offset: 200
    });
      
      // smoothscroll on sidenav click

    $('.tabgroup > div').hide();
        $('.tabgroup > div:first-of-type').show();
        $('.tabs a').click(function(e){
          e.preventDefault();
            var $this = $(this),
            tabgroup = '#'+$this.parents('.tabs').data('tabgroup'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
        others.removeClass('active');
        $this.addClass('active');
        $(tabgroup).children('div').hide();
        $(target).show();
      
    })

    var owl = $("#owl-testimonials");

      owl.owlCarousel({
        
        pagination : true,
        paginationNumbers: false,
        autoPlay: 6000, //Set AutoPlay to 3 seconds
        items : 3, //10 items above 1000px browser width
        itemsDesktop : [1000,3], //5 items between 1000px and 901px
        itemsDesktopSmall : [900,2], // betweem 900px and 601px
        itemsTablet: [600,1], //2 items between 600 and 0
        itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
        
    });


});


(function ($) {
  "use strict";


  /*==================================================================
  [ Focus input ]*/
  $('.input100').each(function(){
      $(this).on('blur', function(){
          if($(this).val().trim() != "") {
              $(this).addClass('has-val');
          }
          else {
              $(this).removeClass('has-val');
          }
      })    
  })


  /*==================================================================
  [ Validate ]*/
  var input = $('.validate-input .input100');

  $('.validate-form').on('submit',function(){
      var check = true;

      for(var i=0; i<input.length; i++) {
          if(validate(input[i]) == false){
              showValidate(input[i]);
              check=false;
          }
      }

      return check;
  });


  $('.validate-form .input100').each(function(){
      $(this).focus(function(){
         hideValidate(this);
      });
  });

  function validate (input) {
      if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
          if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
              return false;
          }
      }
      else {
          if($(input).val().trim() == ''){
              return false;
          }
      }
  }

  function showValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).addClass('alert-validate');
  }

  function hideValidate(input) {
      var thisAlert = $(input).parent();

      $(thisAlert).removeClass('alert-validate');
  }
  
  /*==================================================================
  [ Show pass ]*/
  var showPass = 0;
  $('.btn-show-pass').on('click', function(){
      if(showPass == 0) {
          $(this).next('input').attr('type','text');
          $(this).addClass('active');
          showPass = 1;
      }
      else {
          $(this).next('input').attr('type','password');
          $(this).removeClass('active');
          showPass = 0;
      }
      
  });


})(jQuery);