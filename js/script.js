jQuery(document).ready( function() {
	jQuery('#adminmenu li a.menu-icon-dashboard').prepend('<i class="icon-home"></i> ');
	jQuery('#adminmenu li a.menu-icon-post').prepend('<i class="icon-pencil"></i> ');
	jQuery('#adminmenu li a.menu-icon-page').prepend('<i class="icon-file"></i> ');
	jQuery('#adminmenu li a.menu-icon-media').prepend('<i class="icon-picture"></i> ');
	jQuery('#adminmenu li a.menu-icon-links').prepend('<i class="icon-book"></i> ');
	jQuery('#adminmenu li a.menu-icon-comments').prepend('<i class="icon-comment"></i> ');
	jQuery('#adminmenu li a.menu-icon-appearance').prepend('<i class="icon-eye-open"></i> ');
	jQuery('#adminmenu li a.menu-icon-plugins').prepend('<i class="icon-magnet"></i> ');
	jQuery('#adminmenu li a.menu-icon-users').prepend('<i class="icon-user"></i> ');
	jQuery('#adminmenu li a.menu-icon-tools').prepend('<i class="icon-wrench"></i> ');
	jQuery('#adminmenu li a.menu-icon-settings').prepend('<i class="icon-cog"></i> ');
	jQuery('#adminmenu li a.menu-icon-site').prepend('<i class="icon-th-list"></i> ');
	jQuery('#adminmenu li a.toplevel_page_psts-checkout').prepend('<i class="icon-heart"></i> ');
	jQuery('#adminmenu li a.menu-icon-product').prepend('<i class="icon-shopping-cart"></i> ');
	jQuery('#adminmenu li a.toplevel_page_cp_main').prepend('<i class="icon-filter"></i> ');
	jQuery('#adminmenu li a.toplevel_page_mp_st').prepend('<i class="icon-signal"></i> ');
	jQuery('#adminmenu li a.toplevel_page_sitepress-multilingual-cms/menu/languages').prepend('<i class="icon-flag"></i> ');
	jQuery('#adminmenu li a.toplevel_page_incsub_support').prepend('<i class="icon-fire"></i> ');
	jQuery('#adminmenu li a.toplevel_page_customize').prepend('<i class="icon-tint"></i> ');
	jQuery('#adminmenu li a.toplevel_page_tools\\?page\\=domainmapping').prepend('<i class="icon-globe"></i> ');
	jQuery('#adminmenu li a.toplevel_page_logout').prepend('<i class="icon-remove"></i> ');
	jQuery('#adminmenu li a.toplevel_page_business_tools').prepend('<i class="icon-map-marker"></i> ');
	jQuery('#adminmenu li a.toplevel_page_users\\?page\\=affiliateearnings').prepend('<i class="icon-ok"></i> ');
	jQuery('#adminmenu li a.toplevel_page_jetpack').prepend('<i class="icon-th-large"></i> ');
	jQuery('#adminmenu li a.toplevel_page_wpmudev').prepend('<i class="icon-briefcase"></i> ');
	jQuery('#adminmenu li a.menu-icon-feedback').prepend('<i class="icon-share"></i> ');
	jQuery('#adminmenu li a.toplevel_page_wpcf7').prepend('<i class="icon-envelope"></i> ');
	jQuery('#adminmenu li a.toplevel_page_newsletter\\/intro').prepend('<i class="icon-inbox"></i> ');
	jQuery('#adminmenu li a.toplevel_page_nrelate-main').prepend('<i class="icon-random"></i> ');
	jQuery('#adminmenu li a.toplevel_page_wdfb').prepend('<i class="icon-share"></i> ');
	
	jQuery('tr.mp_order.status-order_received td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div></div>');
	jQuery('tr.mp_order.status-order_paid td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div><div class="bar bar-warning" style="width: 34%;"></div></div>');
	jQuery('tr.mp_order.status-order_shipped td.mp_orders_status a').append('<div class="progress"><div class="bar bar-danger" style="width: 33%;"></div><div class="bar bar-warning" style="width: 34%;"></div><div class="bar bar-success" style="width: 33%;"></div></div>');

	jQuery('#adminmenu li.wp-not-current-submenu.wp-has-submenu, .folded #adminmenu li.wp-has-submenu').popover({		
		title: function() {
			var title = jQuery(this).find('a.menu-top').html();
			return title;
		},
		content: function() {
			var submenu = jQuery(this).find('.wp-submenu ul').html();
			return submenu;
		},
		placement: 'inside right',
		trigger: 'hover'
	});
});

