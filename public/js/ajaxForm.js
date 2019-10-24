$(function() {
	/*
		ajax-form control:
	*/
	$("body").on("submit", ".ajax-form", function(e)
	{
		e.preventDefault();
		$that = $(this);
		$elMsg = $($that.data('af-message'));
		$progressBar = $($that.data('af-progress'));
		
		if(($that.data("confirm")))
		{
			if(!confirm($that.data("confirm")))
			{
				return false;
			}
		}
		$('html').css('cursor', 'progress');
		var formData = new FormData($that[0]);

		var callback = window[$that.data('af-callback')];
		var onSubmit = window[$that.data('af-submitted')];
		$.ajax({
			url: $that.attr('action'),
			type: 'POST',

			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			enctype: 'multipart/form-data',

			beforeSend: function(xhr, settings)
				{
					$progressBar.show();
				},

			xhr: function()
				{
					var myXhr;
					//Send to onSubmit callback
					if(typeof(onSubmit) === 'function')
					{
						myXhr = onSubmit();
					}
					if(typeof(myXhr) != 'object')
					{
						myXhr = $.ajaxSettings.xhr();
						// Update Progressbar
						if($progressBar.length)
						{
							if(myXhr.upload){ // Check if upload property exists
								myXhr.upload.addEventListener('progress',function(e){
									if(e.lengthComputable)
									{
										if($progressBar.is('progress'))
										{
											$progressBar.attr({value:e.loaded, max:e.total});
										}
										else if($progressBar.is('.progress-bar'))
										{
											var percentWidth = e.loaded / e.total * 100;
											$progressBar.width(percentWidth + "%");
										}
									}
								}, false); // For handling the progress of the upload
							}
						}
					}
					return myXhr;
					
				},
			success: function(result)
				{
					if(result != "")
					{
						if(typeof(result) != 'object')
						{
							result = JSON.parse(result);
						}
						$elMsg.html(result.message).show();
						setTimeout(function(){
							$elMsg.fadeOut(1000);
						}, 2000);
						if(typeof(callback) === 'function')
						{
							callback(result);
						}
					}
					else if($elMsg.length != 0)
					{
						$elMsg.text('Could Not Connect').show();
						setTimeout(function(){
							$elMsg.fadeOut(1000);
						}, 2000);
					}
					else
					{
						alert( "Could Not Connect" );
					}
				},
			error: function(result)
				{
					if($elMsg.length != 0)
					{
						$elMsg.text('Could Not Connect').show();
						setTimeout(function(){
							$elMsg.fadeOut(1000);
						}, 2000);
					}
					else
					{
						alert( "Could Not Connect" );
					}
				},
			complete: function(result)
				{
					$('html').css( 'cursor', 'initial' );
				}
		});
	});
});