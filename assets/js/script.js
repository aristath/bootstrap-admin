jQuery(document).ready( function() {
  jQuery('tr.mp_order.status-order_received td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div></div>');
  jQuery('tr.mp_order.status-order_paid td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div><div class="bar bar-warning" style="width: 34%;"></div></div>');
  jQuery('tr.mp_order.status-order_shipped td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div><div class="bar bar-warning" style="width: 34%;"></div><div class="bar bar-success" style="width: 33%;"></div></div>');

  jQuery('#adminmenu li.wp-not-current-submenu.wp-has-submenu, .folded #adminmenu li.wp-has-submenu').popover({
    title: function() {
      var title = jQuery(this).find('a.menu-top').html();
      return title;
    },
    content: function() {
      var submenu = jQuery(this).find('.wp-submenu').html();
      return submenu;
    },
    placement: 'inside right',
    trigger: 'hover'
  });
});
  