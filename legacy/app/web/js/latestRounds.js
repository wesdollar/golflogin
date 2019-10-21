$(document).ready(function(){
    $(".slideshow").SlideShowManager();
});

jQuery.fn.SlideShowManager = function(options) {
    return this.each(function(){
        new SlideShow(this);
    });
};

// todo: create switch for dev/live url
var web_url = 'http://www.golflogin.com/_stable/';

function SlideShow(base){
    var self = this;

    self.currentPosition = 0;
    self.slideWidth = 808;
    self.slides = $('.slide', base);
    self.numberOfSlides = this.slides.length;
    self.base = base;
    self.direction = 1;
    self.Timer = null;
    self.AutoSlide = true;
    self.AutoSlideTimeOut = 8000;


    self.slides
        .wrapAll('<div class="slideInner"></div>')
        // Float left to display horizontally, readjust .slides width
        .css({
            'float' : 'left',
            'width' : self.slideWidth
        });

    $('.slidesContainer',base).css('overflow', 'hidden');
    $('.slideInner',base).css('width', self.slideWidth * self.numberOfSlides);

    $('#icon_pause').append ('<div class="autoplayControl"><img src="'+web_url+'app/web/img/icon_play.png" alt="Play Rounds" /></div>');

    $('#icon_previous').append('<span class="leftControl"><img src="'+web_url+'app/web/img/icon_previous.png" alt="Previous Round" /></span>');
    $('#icon_next').append('<span  class="rightControl"><img src="'+web_url+'app/web/img/icon_next.png" alt="Next Round" /></span>');

    $('.leftControl', base).bind('click', $.proxy(self.onLeftControlClick, self));
    $('.rightControl', base).bind('click', $.proxy(self.onRightControlClick, self));
    $('.autoplayControl',base).bind('click', $.proxy(self.onAutoPlayControlClick, self));

    $('.leftControl', base).bind('click', function() {
        window.clearInterval(self.Timer);
        self.Timer = window.setInterval(function(){
                self.autoAnimate();}
            ,self.AutoSlideTimeOut);
        $('.autoplayControl',self.base).html("<img src=\""+web_url+"app/web/img/icon_pause.png\" alt=\"Pause Rounds\" />");
        self.AutoSlide = true;
    })
    $('.rightControl', base).bind('click', function() {
        window.clearInterval(self.Timer);
        self.Timer = window.setInterval(function(){
                self.autoAnimate();}
            ,self.AutoSlideTimeOut);
        $('.autoplayControl',self.base).html("<img src=\""+web_url+"app/web/img/icon_pause.png\" alt=\"Pause Rounds\" />");
        self.AutoSlide = true;
    })

    if (self.AutoSlide == true)
        self.AutoPlay();

    self.manageControls();
}

SlideShow.prototype.manageControls = function(){
    var self = this;
    if (self.currentPosition == 0){
        $('.leftControl', self.base).hide()
        self.direction = +1;
    }
    else
    {
        $('.leftControl', self.base).show();
    }

    if (self.currentPosition == (self.numberOfSlides - 1)){
        $('.rightControl', self.base).hide();
        self.direction = -1;
    }
    else
    {
        $('.rightControl', self.base).show();
    }
}

SlideShow.prototype.animate = function(){
    var self = this;
    $('.slideInner', self.base).animate({ 'marginLeft' : self.slideWidth * (-self.currentPosition)});
}

SlideShow.prototype.onLeftControlClick = function(){
    //for( k in this)   console.log(k);
    var self = this;
    self.currentPosition--;
    self.manageControls();
    self.animate();
}

SlideShow.prototype.onRightControlClick = function(){
    //for( k in this)   console.log(k);
    var self = this;
    self.currentPosition++;
    self.manageControls();
    self.animate();
}

SlideShow.prototype.autoAnimate = function(){
    var self = this;
    if (self.direction == 1){
        self.currentPosition++;
    }
    else
    {
        self.currentPosition = 0;
    }
    //for (k in o) console.log(k);
    self.manageControls();
    self.animate();
}

SlideShow.prototype.onAutoPlayControlClick = function(){
    var self = this;
    self.AutoPlay();
}

SlideShow.prototype.AutoPlay = function(){
    var self = this;


    if (self.Timer == null){
        self.Timer = window.setInterval(function(){
                self.autoAnimate();}
            ,self.AutoSlideTimeOut);
        $('.autoplayControl',self.base).html("<img src=\""+web_url+"app/web/img/icon_pause.png\" alt=\"Pause Rounds\" />");
        self.AutoSlide = true;
    }else
    {
        window.clearInterval(self.Timer);
        self.Timer = null;
        $('.autoplayControl',self.base).html("<img src=\""+web_url+"app/web/img/icon_play.png\" alt=\"Play Rounds\" />")
        self.AutoSlide = false;
    }
}