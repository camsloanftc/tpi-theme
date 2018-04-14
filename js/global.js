jQuery(document).ready(function($){

	// ===== Product Tables Expand ===== //
  $('.table-toggle').click(function(){
    $(this).parent('.table-wrap').toggleClass('minimized maximized');
  });

});
