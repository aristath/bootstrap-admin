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

	jQuery('#adminmenu li.wp-not-current-submenu, .folded #adminmenu li.wp-has-submenu').popover({		
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