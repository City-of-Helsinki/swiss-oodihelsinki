var omistuskirjoitusSwipe = {
  xDown: null,                                                        
  yDown: null,

  getTouches: function(evt) {
    return evt.touches ||             // browser API
           evt.originalEvent.touches; // jQuery
  },                                                     

  handleTouchStart: function(evt) {
      const firstTouch = omistuskirjoitusSwipe.getTouches(evt)[0];                                      
      this.xDown = firstTouch.clientX;                                      
      this.yDown = firstTouch.clientY;                                      
  },                                               

  handleTouchMove: function(evt) {
    
      if ( ! this.xDown || ! this.yDown ) {
          return;
      }

      var xUp = evt.touches[0].clientX;                                    
      var yUp = evt.touches[0].clientY;

      var xDiff = this.xDown - xUp;
      var yDiff = this.yDown - yUp;

      if ( Math.abs( xDiff ) > Math.abs( yDiff ) ) {/*most significant*/
          if ( xDiff > 0 ) {
            omistuskirjoitusScroller.swipeLeft(xDiff);
          } else {
            omistuskirjoitusScroller.swipeRight(xDiff);
          }                       
      } else {
          if ( yDiff > 0 ) {
              /* up swipe */ 
          } else { 
              /* down swipe */
          }                                                                 
      }
      /* reset values */
      this.xDown = null;
      this.yDown = null;                                             
  }
}
document.addEventListener('touchstart', omistuskirjoitusSwipe.handleTouchStart, false);        
document.addEventListener('touchmove', omistuskirjoitusSwipe.handleTouchMove, false);
