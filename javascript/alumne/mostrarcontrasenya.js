jQuery('#clickme').on('click', function() {
    jQuery('#showpassword').attr('type', function(index, attr) {
        return attr == 'text' ? 'password' : 'text';
    })
})




