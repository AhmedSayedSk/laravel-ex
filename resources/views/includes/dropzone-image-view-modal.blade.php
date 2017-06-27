<?php
	/* Translation */
	$TR = "admin_panel.ACPP";
?>

<div id="product-images">
						<div class="dropzone-image">
							<label>{{ trans("$TR.T31") }} <span id="photoCounter-1"></span></label>
							<div class="form-group">
								<div class="droping">
							        {!! Form::open(['url' => route('image-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-1']) !!}
								        {!! Form::hidden('upload_type', 'image') !!}
								        {!! Form::hidden('parent_id', 1) !!}
								        <div class="dz-message">
								        	<h3>{{ trans("$TR.T32") }}</h3>
								        </div>
								        <div class="fallback">
								            <input name="file" type="file" multiple>
								        </div>
								        <div class="dropzone-previews" id="dropzonePreview-1"></div>
							        {!! Form::close() !!}
								</div>
								@include('standers.dropzone.preview-template')
								<p class="help-block">{{ trans("$TR.T42", ['max_images' => config('sensorization.images.max_uploads')]) }}</p>
							</div>
						</div>
						<div class="dropzone-image">
							<label>{{ trans("$TR.T40") }} <span id="photoCounter-2"></span></label>
							<div class="form-group">
								<div class="droping">
							        {!! Form::open(['url' => route('carousel-upload'), 'class' => 'dropzone', 'files'=>true, 'id'=>'dropzone-2']) !!}
								        {!! Form::hidden('upload_type', 'carousel') !!}
								        {!! Form::hidden('parent_id', 2) !!}
								        <div class="dz-message">
								        	<h3>{{ trans("$TR.T41") }}</h3>
								        </div>
								        <div class="fallback">
								            <input name="file" type="file" multiple>
								        </div>
								        <div class="dropzone-previews" id="dropzonePreview-2"></div>
							        {!! Form::close() !!}
								</div>
								@include('standers.dropzone.preview-template')
								<p class="help-block">{{ trans("$TR.T43", ['max_carousel' => config('sensorization.carousel.max_uploads')]) }}</p>
							</div>
						</div>	
		        	</div>	

		        <script type="text/javascript" src="./packages/dropzone/dropzone.js"></script>	
	<script type="text/javascript" src="./assets/js/dropzone-config.js"></script>