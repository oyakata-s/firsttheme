// javascript

function setPagePath( pagePath ) {
	$('a').each(function() {
		var link = $(this).attr('href');
		link = getAbsoluteLink(link, pagePath);
		$(this).attr('href', link);
	});
	$('img').each(function() {
		var link = $(this).attr('src');
		link = getAbsoluteLink(link, pagePath);
		$(this).attr('src', link);
	});
}

function getAbsoluteLink(link, absDir) {
	check = link.indexOf('http://');
	checks = link.indexOf('https://');
	if (check === -1 && checks === -1) { newLink = absDir + link;
	} else { newLink = link;
	}
	return newLink;
}
