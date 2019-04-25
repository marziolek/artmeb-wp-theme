(function ($) {
  'use strict';

  var Artmeb = {

    /**
   * Init
   */
    init: function() {
      Artmeb.homePageRecommendedSlider();
      Artmeb.realizationsSlider();
      Artmeb.visualizationList();
      Artmeb.visualizationLoadMore();
      Artmeb.visualizationHideEmptyCats();
      Artmeb.filterPictograms();
      Artmeb.woocommerceFiltering();
    },

    /**
   * Settings
   */
    WIN: $(window),
    DOC: $(document),

    homePageRecommendedSlider: function() {
      var recommended = $('#polecane-tkaniny');

      if (recommended.length) {
        var windowW = Artmeb.WIN.outerWidth(),
            recomW = recommended.width(),
            itemWidth;

        if (windowW > 960) {
          itemWidth = recomW / 6;
        } else if ((windowW <= 960) && (windowW > 480)) {
          itemWidth = recomW / 3;
        } else {
          itemWidth = recomW / 2;
        };

        recommended.flexslider({
          animation: 'slide',
          animationLoop: false,
          itemWidth: itemWidth,
          controlNav: false
        });
      }

    },

    realizationsSlider: function() {
      var realizations = $('.realizations-page-list'),
          sliderPage = $('.realizations-page-page-number--text');

      if (realizations.length) {
        realizations.flexslider({
          animation: 'slide',
          animationLoop: false,
          controlNav: false,
          slideshow: false,
          after: function(slider) {
            sliderPage.text(slider.currentSlide + 1);
          },
          start: function(slider) {
            sliderPage.text(slider.currentSlide + 1);
          }
        });
      }
    },

    pageNumber: 1,
    visualizationList: function() {
      var button = $('.visualization-page-list--item-button');

      button.click( function() {
        var parent = $(this).parent();

        parent.siblings().removeClass('active');
        $(this).parent().toggleClass('active');
      })
    },

    visualizationAjax: function(cat, pageNumber, btn) {
      Artmeb.pageNumber++;
      var str = '&cat=' + cat + '&pageNumber=' + Artmeb.pageNumber + '&action=more_post_ajax';
      $.ajax({
        type: 'POST',
        dataType: 'html',
        url: ajaxurl,
        data: str,
        success: function(data) {
          var $data = $(data);

          if($.trim(data).length > 0) {
            $data.insertBefore($(btn[0]));
            btn.removeClass('loading').attr('disabled',false);

            changeMaterials();
          } else {
            btn.removeClass('loading').addClass('hide').attr('disabled',true);
          }
        },
        error : function(jqXHR, textStatus, errorThrown) {
          $loader.html(jqXHR + ' :: ' + textStatus + ' :: ' + errorThrown);
        }

      });
      return false;
    },

    visualizationLoadMore: function() {
      var button = $('.visualization-page-material--load-more');

      button.click( function() {
        $(this).addClass('loading').attr('disabled', true);
        Artmeb.visualizationAjax($(this).data('cat'), Artmeb.pageNumber, $(this));
      })
    },

    visualizationHideEmptyCats: function() {
      var subcat = $('.visualization-page-list--item-subcat');

      if (subcat.length) {
        var noMaterials = subcat.find('.no-materials');

        if (noMaterials.length) {
          noMaterials.parent().parent().hide();
        }
      }
    },

    filterPictograms: function() {
      var pictograms = $('.footer-pictograms-link'),
          pictogramsList = $('.footer-pictograms-list'),
          pictogramsListForm = pictogramsList.parent(),
          removeFilterBtn = $('.footer-pictograms-remove-filters'),
          filterBtn = $('.footer-pictograms-submit-filters'),
          clearFilters = $('#clear-filters'),
          filterAnchor = $('.filter-anchor');

      if (pictograms.length) {
        pictograms.click( function(e) {
          e.preventDefault();
          e.stopPropagation();

          var self = $(this);

          self.parent().toggleClass('active');
          if (self.parent().hasClass('active')) {
            self.find('input').prop('checked', true);
          } else {
            self.find('input').prop('checked', false);
          };

          if (pictogramsList.find('.active').length > 0) {
            pictogramsListForm.addClass('filtered');
            clearFilters.val('false');
          } else {
            pictogramsListForm.removeClass('filtered');
            clearFilters.val('true');
          }
        })
      };

      if (removeFilterBtn.length) {
        removeFilterBtn.click( function() {
          clearFilters.val('true');
          pictograms.find('input').prop('checked', false);
          pictograms.parent().removeClass('active');
          pictogramsListForm.removeClass('filtered');
          filterBtn.click();
        })
      };

      filterAnchor.click( function(e) {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    },

    woocommerceFiltering: function() {
      var filterForm = $('.woocommerce-ordering'),
        widgetArea = $('.widget-area');

      if (filterForm.length) {
        $('input[name="orderby"]').change( function() {
          filterForm.submit()
        });

        if (widgetArea.length) {
          $(document).ready( function() {
            filterForm.css('top', widgetArea.height())
          })

          $(document.body).on( 'added_to_cart' , function() {
            setTimeout( function() { filterForm.css('top', widgetArea.height()) }, 100)
          })
        }
      }
    }
  };

  document.addEventListener('DOMContentLoaded', function() {
    Artmeb.init();
  });

})(jQuery);