// https://greensock.com/docs/v3/GSAP/Timeline/to()
// https://codepen.io/GreenSock/pen/VwaWdoB
// https://cdnjs.com/libraries/gsap

var omistuskirjoitusScroller = {
  slides: null,
  numSlides: 0,
  my_direction: "-",
  scroll_duration: 100,
  swipe_duration: 1,
  swipe_percent: 2,
  wrap: null,
  proxy: null,
  animation: null,
  scrollerReady: function() {
  },
  scroll: function() {
    this.animation.repeat(-1);
    this.animation.clear().to(this.slides, {
      duration: this.scroll_duration,
      /*ease:"power1.in",*/
      
      xPercent:  this.my_direction + "=" + (this.numSlides * 100),
      ease: "none",
      modifiers: {
        xPercent: this.wrap
      },
      onStart: this.scrollerReady
    });
    
    $('body').addClass('omistuskirjoitus-scroller-ready');
  },
  swipe: function() {
    this.animation.repeat(0);
    this.animation.clear().to(this.slides, {
      duration: this.swipe_duration,
      ease:"power1.out",
      
      xPercent:  this.my_direction + "=" + (this.numSlides * this.swipe_percent),
    /*  ease: "none",*/
      modifiers: {
        xPercent: this.wrap
      },
      onStart: this.scrollerReady
    });
    
    $('body').addClass('omistuskirjoitus-scroller-ready');
  },
  break: function() {
    this.animation.repeat(0);
    this.animation.clear().to(this.slides, {
      duration: 1,
      ease:"power1.out",
      
      xPercent:  this.my_direction + "=" + (this.numSlides * 0.5),
    /*  ease: "none",*/
      modifiers: {
        xPercent: this.wrap
      },
      onStart: this.scrollerReady
    });
    
    $('body').addClass('omistuskirjoitus-scroller-ready');
  },
  scrollerLeft: function() {
    this.my_direction = "-";
    this.scroll();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  },
  scrollerRight: function() {
    this.my_direction = "+";
    this.scroll();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  },
  swipeLeft: function(xDiff) {
    this.my_direction = "-";
    let swipeStrength = Math.abs(xDiff/30);
    if (swipeStrength > 1) swipeStrength = 1;
    this.swipe_percent = 0.5 + swipeStrength * 3;
    this.swipe();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  },
  swipeRight: function(xDiff) {
    this.my_direction = "+";
    let swipeStrength = Math.abs(xDiff/30);
    if (swipeStrength > 1) swipeStrength = 1;
    this.swipe_percent = 0.5 + swipeStrength * 3;
    this.swipe();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  },
  breakLeft: function() {
    this.my_direction = "-";
    this.break();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  },
  breakRight: function() {
    this.my_direction = "+";
    this.break();
    if (!this.animation.isActive()) {
      this.animation.play();
    }
  }
}

omistuskirjoitusScroller.proxy = document.createElement("div");
omistuskirjoitusScroller.animation = gsap.timeline({repeat:-1,paused: true});

omistuskirjoitusScroller.slides = document.querySelectorAll(".omistuskirjoitus-column");
omistuskirjoitusScroller.numSlides = omistuskirjoitusScroller.slides.length;
omistuskirjoitusScroller.wrap = gsap.utils.wrap(-100, (omistuskirjoitusScroller.numSlides - 1) * 100);

gsap.set(omistuskirjoitusScroller.slides, { xPercent: i => i * 100 });
omistuskirjoitusScroller.scroll();
//window.addEventListener("resize", omistuskirjoitusScroller.resize);

$('.omistuskirjoitus-left').click(function(e) {
  e.preventDefault();
  //if (omistuskirjoitusScroller.animation.isActive()) {
    omistuskirjoitusScroller.swipeRight(10);
  //}
});
$('.omistuskirjoitus-right').click(function(e) {
  e.preventDefault();
  //if (omistuskirjoitusScroller.animation.isActive()) {
    omistuskirjoitusScroller.swipeLeft(10);
  //}
});

$( '.omistuskirjoitus-left' ).hover(
  function() {
    omistuskirjoitusScroller.scrollerRight();
  }, function() {
    if (omistuskirjoitusScroller.animation.isActive()) {
      omistuskirjoitusScroller.breakRight();
    }
  }
);

$( '.omistuskirjoitus-right' ).hover(
  function() {
    omistuskirjoitusScroller.scrollerLeft();
  }, function() {
    if (omistuskirjoitusScroller.animation.isActive()) {
      omistuskirjoitusScroller.breakLeft();
    }
  }
);

document.onkeydown = omistuskirjoitus_checkKey;
function omistuskirjoitus_checkKey(e) {
  e = e || window.event;
  if (e.keyCode == '37') {
     omistuskirjoitusScroller.swipeRight(3);
  }
  else if (e.keyCode == '39') {
     omistuskirjoitusScroller.swipeLeft(3);
  }
}
