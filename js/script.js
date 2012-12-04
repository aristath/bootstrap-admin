jQuery(document).ready( function() {
	jQuery('#icon-index.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-dashboard icon-large"></i></div> ');
  jQuery('#icon-edit.icon32-posts-post').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-th-large icon-large"></i></div> ');
  jQuery('#icon-upload.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-picture icon-large"></i></div> ');
  jQuery('#icon-link-manager.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-link icon-large"></i></div> ');
  jQuery('#icon-edit-pages.icon32-posts-page').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-file icon-large"></i></div> ');
  jQuery('#icon-edit-comments.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-comment icon-large"></i></div> ');
  jQuery('#icon-edit.icon32-posts-portfolio').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-th-large icon-large"></i></div> ');
  jQuery('#icon-wpcf7.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-edit icon-large"></i></div> ');
  jQuery('#icon-edit-news.icon32').replaceWith('<div style="font-size:22px;" class="icon32 fonticon"><i class="icon-envelope-alt icon-large"></i></div> ');

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
