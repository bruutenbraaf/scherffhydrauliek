$( document ).ready(function() {
	jQuery( '.carousel-inner').find('.carousel-item:first' ).addClass( 'active' );
	jQuery( '.tab-content').find('.tab-pane:first' ).addClass( 'active' );
	jQuery( 'ul.nav-tabs').find('.tab-pane:first' ).addClass( 'active' );
	
	jQuery( 'ul.nav-tabs-home').find('li:first' ).addClass( 'active' );
	jQuery( 'tab-content').find('div:first' ).addClass( 'active' );
	jQuery( 'ul.nav-tabs').find('li:first a' ).addClass( 'active' );
	
	$( ".hamburger" ).click(function() {
		$(".m-menu-col:nth-child(1)").toggleClass("animate-menu-col-one");
		$(".m-menu-col:nth-child(2)").toggleClass("animate-menu-col-two");
		$(".m-menu").toggleClass("show");
		$(".m-menu-col ul li").toggleClass("menu-item-animation");
		$(".hamburger div").toggleClass("hamburger-animate");
		$(".hamburger div:nth-child(1)").toggleClass("f");
		$(".hamburger div:nth-child(2)").toggleClass("o");
		$(".hamburger div:nth-child(3)").toggleClass("b");
	});	
	+function($) {
    'use strict';

    var modals = $('.modals.multi-step');

    modals.each(function(idx, modals) {
        var $modals = $(modals);
        var $bodies = $modals.find('div.modals-body');
        var total_num_steps = $bodies.length;
        var $progress = $modals.find('.m-progress');
        var $progress_bar = $modals.find('.m-progress-bar');
        var $progress_stats = $modals.find('.m-progress-stats');
        var $progress_current = $modals.find('.m-progress-current');
        var $progress_total = $modals.find('.m-progress-total');
        var $progress_complete  = $modals.find('.m-progress-complete');
        var reset_on_close = $modals.attr('reset-on-close') === 'true';

        function reset() {
            $modals.find('.step').hide();
            $modals.find('[data-step]').hide();
        }

        function completeSteps() {
            $progress_stats.hide();
            $progress_complete.show();
            $modals.find('.progress-text').animate({
                top: '-2em'
            });
            $modals.find('.complete-indicator').animate({
                top: '-2em'
            });
            $progress_bar.addClass('completed');
        }

        function getPercentComplete(current_step, total_steps) {
            return Math.min(current_step / total_steps * 100, 100) + '%';
        }

        function updateProgress(current, total) {
            $progress_bar.animate({
                width: getPercentComplete(current, total)
            });
            if (current - 1 >= total_num_steps) {
                completeSteps();
            } else {
                $progress_current.text(current);
            }

            $progress.find('[data-progress]').each(function() {
                var dp = $(this);
                if (dp.data().progress <= current - 1) {
                    dp.addClass('completed');
                } else {
                    dp.removeClass('completed');
                }
            });
        }

        function goToStep(step) {
            reset();
            var to_show = $modals.find('.step-' + step);
            if (to_show.length === 0) {
                // at the last step, nothing else to show
                return;
            }
            to_show.show();
            var current = parseInt(step, 10);
            updateProgress(current, total_num_steps);
            findFirstFocusableInput(to_show).focus();
        }

        function findFirstFocusableInput(parent) {
            var candidates = [parent.find('input'), parent.find('select'),
                              parent.find('textarea'),parent.find('button')],
                winner = parent;
            $.each(candidates, function() {
                if (this.length > 0) {
                    winner = this[0];
                    return false;
                }
            });
            return $(winner);
        }

        function bindEventsTomodals($modals) {
            var data_steps = [];
            $('[data-step]').each(function() {
                var step = $(this).data().step;
                if (step && $.inArray(step, data_steps) === -1) {
                    data_steps.push(step);
                }
            });

            $.each(data_steps, function(i, v) {
                $modals.on('next.m.' + v, {step: v}, function(e) {
                    goToStep(e.data.step);
                });
            });
        }

        function initialize() {
            reset();
            updateProgress(1, total_num_steps);
            $modals.find('.step-1').show();
            $progress_complete.hide();
            $progress_total.text(total_num_steps);
            bindEventsTomodals($modals, total_num_steps);
            $modals.data({
                total_num_steps: $bodies.length,
            });
            if (reset_on_close){
                //Bootstrap 2.3.2
                $modals.on('hidden', function () {
                    reset();
                    $modals.find('.step-1').show();
                })
                //Bootstrap 3
                $modals.on('hidden.bs.modals', function () {
                    reset();
                    $modals.find('.step-1').show();
                })
            }
        }

        initialize();
    })
}(jQuery);








+function ($) {
  'use strict';

  if ( !$.fn.carousel ) {
    throw new Error( "carousel-swipe required bootstrap carousel" )
  }

  // CAROUSEL CLASS DEFINITION
  // =========================

  var CarouselSwipe = function(element) {
    this.$element    = $(element)
    this.carousel    = this.$element.data('bs.carousel')
    this.options     = $.extend({}, CarouselSwipe.DEFAULTS, this.carousel.options)
    this.startX      =
    this.startY      =
    this.startTime   =
    this.cycling     =
    this.$active     =
    this.$items      =
    this.$next       =
    this.$prev       =
    this.dx          = null
    this.sliding     = false

    this.$element
      .on('touchstart',        $.proxy(this.touchstart,this))
      .on('touchmove',         $.proxy(this.touchmove,this))
      .on('touchend',          $.proxy(this.touchend,this))
      .on('slide.bs.carousel', $.proxy(this.startSliding, this))
      .on('slid.bs.carousel',  $.proxy(this.stopSliding, this))
  }

  CarouselSwipe.DEFAULTS = {
    swipe: 50 // percent per second
  }

  CarouselSwipe.prototype.startSliding = function() {
    this.sliding = true
  }

  CarouselSwipe.prototype.stopSliding = function() {
    this.sliding = false
  }

  CarouselSwipe.prototype.touchstart = function(e) {
    if (this.sliding || !this.options.swipe) return;
    var touch = e.originalEvent.touches ? e.originalEvent.touches[0] : e
    this.dx = 0
    this.startX = touch.pageX
    this.startY = touch.pageY
    this.cycling = null
    this.width = this.$element.width()
    this.startTime = e.timeStamp
  }

  CarouselSwipe.prototype.touchmove = function(e) {
    if (this.sliding || !this.options.swipe || !this.startTime) return;
    var touch = e.originalEvent.touches ? e.originalEvent.touches[0] : e
    var dx = touch.pageX - this.startX
    var dy = touch.pageY - this.startY
    if (Math.abs(dx) < Math.abs(dy)) return; // vertical scroll

    if ( this.cycling === null ) {
      this.cycling = !!this.carousel.interval
      this.cycling && this.carousel.pause()
    }

    e.preventDefault()
    this.dx = dx / (this.width || 1) * 100
    this.swipe(this.dx)
  }

  CarouselSwipe.prototype.touchend = function(e) {
    if (this.sliding || !this.options.swipe || !this.startTime) return;
    if (!this.$active) return; // nothing moved
    var all = $()
      .add(this.$active).add(this.$prev).add(this.$next)
      .carousel_transition(true)

    var dt = (e.timeStamp - this.startTime) / 1000
    var speed = Math.abs(this.dx / dt) // percent-per-second
    if (this.dx > 40 || (this.dx > 0 && speed > this.options.swipe)) {
      this.carousel.prev()
    } else if (this.dx < -40 || (this.dx < 0 && speed > this.options.swipe)) {
      this.carousel.next();
    } else {
      this.$active
        .one($.support.transition.end, function () {
          all.removeClass('prev next')
        })
      .emulateTransitionEnd(this.$active.css('transition-duration').slice(0, -1) * 1000)
    }

    all.css('transform', '')
    this.cycling && this.carousel.cycle()
    this.$active = null // reset the active element
    this.startTime = null
  }

  CarouselSwipe.prototype.swipe = function(percent) {
    var $active = this.$active || this.getActive()
    if (percent < 0) {
        this.$prev
            .css('transform', 'translate3d(0,0,0)')
            .removeClass('prev')
            .carousel_transition(true)
        if (!this.$next.length || this.$next.hasClass('active')) return
        this.$next
            .carousel_transition(false)
            .addClass('next')
            .css('transform', 'translate3d(' + (percent + 100) + '%,0,0)')
    } else {
        this.$next
            .css('transform', '')
            .removeClass('next')
            .carousel_transition(true)
        if (!this.$prev.length || this.$prev.hasClass('active')) return
        this.$prev
            .carousel_transition(false)
            .addClass('prev')
            .css('transform', 'translate3d(' + (percent - 100) + '%,0,0)')
    }

    $active
        .carousel_transition(false)
        .css('transform', 'translate3d(' + percent + '%, 0, 0)')
  }

  CarouselSwipe.prototype.getActive = function() {
    this.$active = this.$element.find('.item.active')
    this.$items = this.$active.parent().children()

    this.$next = this.$active.next()
    if (!this.$next.length && this.options.wrap) {
      this.$next = this.$items.first();
    }

    this.$prev = this.$active.prev()
    if (!this.$prev.length && this.options.wrap) {
      this.$prev = this.$items.last();
    }

    return this.$active;
  }

  // CAROUSEL PLUGIN DEFINITION
  // ==========================

  var old = $.fn.carousel
  $.fn.carousel = function() {
    old.apply(this, arguments);
    return this.each(function () {
      var $this   = $(this)
      var data    = $this.data('bs.carousel.swipe')
      if (!data) $this.data('bs.carousel.swipe', new CarouselSwipe(this))
    })
  }

  $.extend($.fn.carousel,old);

  $.fn.carousel_transition = function(enable) {
    enable = enable ? '' : 'none';
    return this.each(function() {
      $(this)
        .css('-webkit-transition', enable)
        .css('transition', enable)
    })
  };

}(jQuery);
});	