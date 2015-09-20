	function _delTumbnail(id){

		 var ajaxRequest;
		 var classImg = '.tumb_'+id;
		 var close    = $(classImg);

	     var postForm = { 
            			'id'     : id
        				};


	       ajaxRequest= $.ajax({ 
	            url: "http://localhost/appsglobe/gallery/delete",
	            type: "post",
	            data: postForm
	        });


	     ajaxRequest.done(function (response, textStatus, jqXHR){
	     	var message = JSON.parse(response);
	          if(message.delete_tumb === 'success'){ 
	          	close.remove();
	          }
	     });

	     ajaxRequest.fail(function (){

	      
	     });

	}