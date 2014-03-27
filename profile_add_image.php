	<div class="row-fluid" id="upload-file">
		<div class="span12">
			<h6>Temporary upload form. Will createa a more sophisticated and good looking one asap. - Sal</h6>
			<form id="fileupload" method="post" action="?a=profile" enctype="multipart/form-data">
				<input type="file" name="file1"  /><br>
						
				<p class="display-inline-block">Rate<i class="icon-question-sign" rel="tooltip" title="Rating an image will make it available for visitors to rate and comment. Choose an appropriate category below."></i>&nbsp<input type="checkbox" name="voteit" />
					&nbsp&nbsp
					
				</p>
				
				<span id="insert-permission-select">
				
				<select id="permission-level" name="state">
					<option value="1">Public</option>
					<option value="2">Friend</option>
					<option value="3">Private</option>
				</select>
				
				</span>
				
				<span id="insert-rated-category">
				</span>
								
                <p>Image title</p>
                   <textarea class="image-title" name="image_title" cols="40" rows="3"></textarea><br />
                   <strong><span id="image-title-counter"></span></strong>
                   <input type="submit" value="Upload" />
			</form>
		</div>
	</div>
				
				
		<script type="text/javascript">
			$("input[name=voteit]").change(function(){
				if($(this).prop("checked")){
					$.ajax({
						type: 'POST',
						url: '?a=profile_add_rated_options',
						success: function(data){
							$("#insert-rated-category").html(data);
							$("#insert-permission-select").children().remove();
						}
					});
				} else {
					$("#remove-rated-category").remove();
					$("#insert-permission-select").append(
							"<select id='permission-level' name='state'>\
								<option value='1'>Public</option>\
								<option value='2'>Friend</option>\
								<option value='3'>Private</option>\
							</select>"
						);
				}
			});
			$("#sub-meme").hide();
			$(".image-title").limit("140", "#image-title-counter");
		</script>