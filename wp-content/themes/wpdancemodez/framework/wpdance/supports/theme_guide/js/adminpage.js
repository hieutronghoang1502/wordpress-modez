(function($) {

	// call when dom ready
	$(function() {

		/**
		 * Toggle class 'skip' to hide/show incomplete sections
		 * when click on its title (h3)
		 */
		//$('#wpdancebootstrap_walkthrough_page .card.skip:not(.complete) h3').on('click', function(e) {

		//Accordion
		/*var acc = document.getElementsByClassName("accordion");
		var i;

		for (i = 0; i < acc.length; i++) {
		    acc[i].onclick = function(){
		        this.classList.toggle("active");
		        this.nextElementSibling.classList.toggle("show");
		    }
		}*/


		$('.accordion').on('click',function(){
			$(this).toggleClass('active');
			var id_panel = $(this).attr('data-id-panel');
		    $('#'+id_panel).toggleClass('show');
		})

		/**
		 * Toggle class 'hide' to show/hide content of element .inside.hide
		 */
		$('#wpdancebootstrap_walkthrough_page .card:has(.inside.hide) h3')
			.addClass('hndler')
			.on('click', function(e) {
				e.preventDefault();
				$(this).offsetParent('.card').find('.inside').toggleClass('hide');
				$(this).toggleClass('open');
			});



		var $cards_hide = $('#wpdancebootstrap_walkthrough_page .card.hide-done');

		/**
		 * Toggle class 'hide-done' to hide/show sections 
		 * when click on button #wpdancebootstrap_walkthrough_show_check_list
		 */ 
		$('#wpdancebootstrap_walkthrough_show_check_list').on('click', function(e) {
			e.preventDefault();
			$cards_hide.toggleClass('hide-done');
			
		});

	});

})(jQuery);


