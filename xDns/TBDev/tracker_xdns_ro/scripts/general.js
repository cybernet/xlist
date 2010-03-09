jQuery.preloadImages = function()
{
	for(var i = 0; i<arguments.length; i++)
	jQuery("<img>").attr("src", arguments[i]);
}
jQuery.preloadImages("css-menu/home.png", "css-menu/homeo.png", "css-menu/browse.png", "css-menu/browseo.png", "css-menu/search.png", "css-menu/searcho.png", "css-menu/upload.png", "css-menu/uploado.png", "css-menu/chat.png", "css-menu/chato.png", "css-menu/forum.png", "css-menu/forumo.png", "css-menu/top.png", "css-menu/topo.png", "css-menu/rules.png", "css-menu/ruleso.png", "css-menu/faq.png", "css-menu/faqo.png", "css-menu/links.png", "css-menu/linkso.png", "css-menu/staff.png", "css-menu/staffo.png", "css-menu/profile.png", "css-menu/profileo.png" );

jQuery(document).ready(function(){
	
	$("#iconbar li a").hover(
		function(){
			var iconName = $(this).children("img").attr("src");
			var origen = iconName.split(".png")[0];
			$(this).children("img").attr({src: "" + origen + "o.png"});
			$(this).css("cursor", "pointer");
			$(this).animate({ width: "100px" }, {queue:false, duration:"normal"} );
			$(this).children("span").animate({opacity: "show"}, "fast");
		}, 
		function(){
			var iconName = $(this).children("img").attr("src");
			var origen = iconName.split("o.")[0];
			$(this).children("img").attr({src: "" + origen + ".png"});			
			$(this).animate({ width: "57px" }, {queue:false, duration:"normal"} );
			$(this).children("span").animate({opacity: "hide"}, "fast");
		});
});