    


jQuery('img').each(function() {
  var img = jQuery(this);

  img.error(function() {
      img.replaceWith('<div> you need to upload image </div>');
  }).attr('src', img.attr('src'));
});