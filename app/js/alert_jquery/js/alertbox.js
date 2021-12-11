(function($){

    $.fn.extend({ 

        alertBox: function(settings) {
 
            var defaults = {
                href: null
            };
             
            var settings = $.extend(defaults, settings);
         
            return this.each(function() {
            
                var s = settings;
                var load = 'alert.html'; 
                
                $(this).click(function(e) {
                
                    e.preventDefault();
                    
                    $('body').append('<div id="overlay" />');
                    $('#overlay').fadeIn(300, function() {
                        $('body').append('<div id="alertModalOuter"><div id="alertModal"></div></div>');
                        var outer = $('#alertModalOuter');
                        var modal = $('#alertModal');
                        var defWidth = outer.outerWidth();
                        var defHeight = outer.outerHeight();
                        modal.load(load + ' #alert', function() {
                        
                            var alertBoxContent = $('#alert');
                            
                            var alertWidth = alertBoxContent.outerWidth();
                            var alertHeight = alertBoxContent.outerHeight();
                            
                            var widthCombine = -((defWidth + alertWidth) / 2);
                            var heightCombine = -((defHeight + alertHeight) / 2);

                            modal.animate({width: alertWidth, height: alertHeight}, 200);
                            outer.animate({marginLeft: widthCombine, marginTop: heightCombine}, 200, function() {
                                alertBoxContent.fadeIn(200, function() {
                                    $('#yes').click(function(e) {
                                        e.preventDefault();
                                        window.location.href = s.href;
                                    });
                                    $('#no').click(function(e) {
                                        e.preventDefault();
                                        $('#overlay, #alertModalOuter').fadeOut(400, function() {
                                            $(this).remove();
                                        });
                                    });
                                });
                            });

                        });
                    });
                });
            });
        }
    });
})(jQuery);