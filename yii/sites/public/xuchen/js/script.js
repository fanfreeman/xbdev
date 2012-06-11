//$(function(){
function dropFileUp(){	
//	var dropbox = $('.fileUploadBox'),
//		message = $('.message', dropbox);
	var dropbox = $('.fileUploadBox');
	dropbox.filedrop({
		// The name of the $_FILES entry:
		paramname:'pic',
		
		maxfiles: 5,
    	maxfilesize: 200,
		url: 'http://xuchen.atom.com/xuchen/post_file.php',
		
		uploadFinished:function(i,file,response){
			//$.data(file).addClass('done');
			// response is the JSON object that post_file.php returns
		},
		
    	error: function(err, file) {
			switch(err) {
				case 'BrowserNotSupported':
					showMessage('Your browser does not support HTML5 file uploads!');
					break;
				case 'TooManyFiles':
					alert('Too many files! Please select 5 at most! (configurable)');
					break;
				case 'FileTooLarge':
					alert(file.name+' is too large! Please upload files up to 2mb (configurable).');
					break;
				default:
					break;
			}
		},
		
		// Called before each upload is started
		beforeEach: function(file){
//			if(!file.type.match(/^image\//)){
//				alert('Only images are allowed!');
//				
//				// Returning false will cause the
//				// file to be rejected
//				return false;
//			}
			//$(".uploadDocument").show();
			if ($(".uploadDocument").is(":hidden")){
				FlyInto($(".uploadDocument"));
			}
		},
		
		uploadStarted:function(i, file, len){
			//alert(file.size);
			/****************
			 *	定制飞入效果
			 *****************/
			createImage(file);
		},
		
		progressUpdated: function(i, file, progress) {
			$.data(file).find('.uploadifyProgressBar').width(progress*3);
			//alert($.data(file).html());
		}
    	 
	});
	
//	var template = '<div class="preview">'+
//						'<span class="imageHolder">'+
//							'<img />'+
//							'<span class="uploaded"></span>'+
//						'</span>'+
//						'<div class="progressHolder">'+
//							'<div class="progress"></div>'+
//						'</div>'+
//					'</div>'; 
    	var template ='<div class="fileTypeIcon">'+
        	'<div class="fileCommon"></div>'+
        '</div>'+
        '<aside>'+
        	'<h6>File Name</h6>'+
            '<div class="uploadifyProgress blue stripes">'+
            	'<span class="uploadifyProgressBar"></span>'+
            '</div>'+
            '<p class="fileUploadInfo">68 KB of 196 KB - Processing</p>'+
        '</aside>';
	
	function createImage(file){

//		var preview = $(template), 
//			image = $('img', preview);
		var preview = $(template);	
		var reader = new FileReader();
		
//		image.width = 100;
//		image.height = 100;
		
//		reader.onload = function(e){
			
			// e.target.result holds the DataURL which
			// can be used as a source of the image:
			
//			image.attr('src',e.target.result);
//		};
		
		// Reading the file as a DataURL. When finished,
		// this will trigger the onload function above:
		reader.readAsDataURL(file);
		
		//message.hide();
		$("#uploadDocument").append(preview);
		
		// Associating a preview container
		// with the file, using jQuery's $.data():
		
		$.data(file,preview);
	}

	function showMessage(msg){
		//message.html(msg);
	}
}
//});