 $(document).ready(function(){
	
	$("css-selector").click(function(){ //anonymous function
		$.get(
			"phpfile.php",
			{ Name1 : "Sal", Name2 : "Pal"},
			function(e){
				
			}
		).done(function(e){
		}).fail(function(e){
		}); // end get function
	});
	
	$.get(
		"phpFile-php",
		{ 'choices[]' : ["someVariable1", "someVariable2"] },
		function(){
		}
	).done(function(){
	}).fail(function(){
		
	});
	

	var name = "Salman";
	$.ajax({
		type: 'GET',
		url: 'profile.php',
		data: {
			'key1': name
		},
		success: function(data){
			$(".css-class-selector")
		}
	});
	
	$.ajax({
		type: 'POST',
		url: 'somePHPfile.php',
		data: {
			"key1" : "Somevalue",
			"key2" : "Somevalue",
			"key3" : "SomeOtherValue"
		},
		success: function(data){
			var JSONarray = $.parseJSON(data); /*data is an json_encode($somePHParray);*/
			$(".classAttribute").html("<strong><b>" + JSONarray.element + "</b></strong>");
		}
	});
	
	$("#some-htmltag-id-attribute").click(function(){
		
		$.ajax({
			type: 'GET',
			url: '../foldername/filename.php',
			data: {
				"key1" : variable1,
				"key2" : varible2
			},
			success : function(data){
				var someParsedArray = $.parseJSON(data);
				if(someParsedArray.someKey1 != 1){
					
				} else if(someParsedArray.someKey2 ) return false;
			}
		}); //end ajax
		
		$.get(
			'doSomething.php',
			{"someKey1" : value1, "someAssociation" : value2},
			function(data){ //callbackfunction
				$(".some-html-tag-class-attribute").add();
			}
		); // end get function
		
		$.post(
			'someUrlPath.php',
			{ 'someArray[]' : [variable1, variable2, variable3]},
			function(data){
				var someParsedXML = $.parseXML(data); // XML is a structed way to exchange data.
				
			}
		); // end post function
	});
	
	
	
	
});

$(document).ready(function(e) {
    
	$("#input-value").click(function(){
		var someVar1 = $(this).data("image_id");
		$.ajax({
			type: 'GET',
			url: 'someViewFile.php',
			data: {
				"value" : someVar1
			},
			success: function(data){
				var ObjectNotation = $.parseJSON(data);
				if()
			}
		});
	});
});