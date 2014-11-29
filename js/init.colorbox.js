$(document).ready(function() {
	$("img.lightbox").each(function() {
		var a = $('<a/>').attr({
			href: this.src,
			class: "colorbox"
		});
		$(this).addClass('image').wrap(a);
	});
});
