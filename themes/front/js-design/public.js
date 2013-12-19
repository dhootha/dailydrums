// JavaScript Document

$(document).ready(function(){

	//for Selectbox
	$('.selectForm').jqTransform();
	
	$('.search_main .categories').click(function(){
		//$('.category_dropdown').toggleClass('show');
		$('.category_dropdown').slideToggle(400);
	});
	$('.menu_col').click(function(){
		//$('.category_dropdown').toggleClass('show');
		$('.menu_item').slideToggle(400);
	});
	
	$('.sort_by a:first').click(function(){
		$('.sort_by_option').toggleClass('show');	
	});
	
	$('.dropdown1 a:first').click(function(){
		$(this).toggleClass('active');
		$('.dropdown1_rel').toggleClass('show');
	});
	
	$('.menu_local_submenu').click(function(){
		$(this).toggleClass('active');
		$('.menu_local_dropdown').toggleClass('show');
	});
	
	// hide #back-top first
	$("#back-top").hide();
	
	// fade in #back-top
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});


var SITE = SITE || {};
 
SITE.fileInputs = function() {
  var $this = $(this),
      $val = $this.val(),
      valArray = $val.split('\\'),
      newVal = valArray[valArray.length-1],
      $button = $this.siblings('.button'),
      $fakeFile = $this.siblings('.file-holder');
  if(newVal !== '') {
    $button.text('Photo Chosen');
    if($fakeFile.length === 0) {
      $button.after('<span class="file-holder">' + newVal + '</span>');
    } else {
      $fakeFile.text(newVal);
    }
  }
};
 
$(document).ready(function() {
  $('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);
});