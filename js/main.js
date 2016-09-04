$( document ).ready(function() {

	$('#upload').on('click', function() {
		$('#name-rep').html('');
		$('#email-rep').html('');
		$('#password-rep').html('');
		$.post('/action', {
			action: "registration",
			password: $('#password').val(),
			name: $('#name').val(),
			email: $('#email').val()
		}, function(data){
			$('#name-rep').html(data['name']);
			$('#email-rep').html(data['email']);
			$('#password-rep').html(data['password']);
			if (data['newUser']) {
				window.location.href ="/";
			}	
		}, "json");
	});

	$('#enter').on('click', function() {
		$('#name-rep').html('');
		$('#password-rep').html('');
		$.post('/action', {
			action: "enter",
			password: $('#password').val(),
			name: $('#name').val(),
		}, function(data){
			$('#name-rep').html(data['name']);
			$('#password-rep').html(data['password']);
			if (data['enter']) {
				window.location.href ="/";
			}	
		}, "json");
	});

	$('.favorits').on('click', function() {
		var self = this;
		if ($(self).find('.block-button-in-check').hasClass("block-button-in-check")) {
			$.post('/action', {
				action: "favorit",
				id: $(this).data('id'),
				user_id_recipe: $(this).data('user_id_recipe'),
				click: "delete",
			}, function(data) {
				console.log(data);
				$count = $(self).parent().parent().find('.fa-star-o');
				$count.text(parseInt($count.text()) - 1);
				$(self).find('.block-button-in-check').addClass("block-button-in-home");
				$(self).find('.block-button-in-check').removeClass("block-button-in-check");
			}, "json");
		}
		
		else {
			$.post('/action', {
				action: "favorit",
				id: $(this).data('id'),
				user_id_recipe: $(this).data('user_id_recipe'),
				click: "add",
			}, function(data) {
				console.log(data);
				$count = $(self).parent().parent().find('.fa-star-o');
				$count.text(parseInt($count.text()) + 1);
				// $(".favorits .block-button-in").removeClass("block-button-in");
				$(self).find(".block-button-in-home").addClass("block-button-in-check");
			}, "json");
		}
	});
});

    function sendForm(user_id)
    {

        $.post('/actions/savedata.php', {
            content: $('#content').redactor('code.get'),
        }, function(){
            window.location.href = '/profile'+user_id;
        },"json");
    }

    function sendFormEdit(id)
    {
    	
        $.post('/action', {
        	action: "edit_work",
            content: $('#content').redactor('code.get'),
            id: id
        }, function(data){
            window.location.href = data.url;
        },"json");
    }


