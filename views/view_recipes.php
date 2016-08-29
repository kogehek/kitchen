	<script>
	$(function() {
	    $('#content').redactor({ 
	        imageUpload: '/action',
	            uploadImageFields: {
            action: "img"
        }
	    });
	});
	</script>

	<form class="padding-rec" action="/action" method="post" enctype="multipart/form-data">
		<input type="hidden" name="action" value="upload_work">
		<textarea id="content" name="content"></textarea>
		<div class="dispatch">
			<div class="dispatch">
				<div class="dispatch-padding">
					Название
				</div>
				<div class="dispatch-padding">
					Время
				</div>
			</div>
		<div class="dispatch">
			<div class="dispatch-padding">
				<input type="text" name="Name"><br>
			</div>
			<div class="dispatch-padding">
				<select  class="time-width" name="Time">
					<option value="<5"><5</option>
					<option value="15">15</option>
					<option value="30">30</option>
					<option value="45">45</option>
					<option value="60">60</option>
					<option value=">90">>90</option>
				</select><br>
			</div>
		</div><br>	
			<div class="dispatch">
				<input type="file" name="filename" id="file" class="img-download" />
				<label for="file"><i class="fa fa-upload" aria-hidden="true"></i> Choose a file</label>
			</div>
		</div>
		<div class="buttan-unstyle">
			<input class="buttan-upload b-btn" type="submit" value="Загрузить"><br>
		</div>
	</form>