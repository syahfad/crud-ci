<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h6><?= validation_errors(); ?></h6>
<h6><?= $this->session->flashdata('error'); ?></h6>

<div class="row">
  <form action="<?= site_url('welcome/update/' . $post->id); ?>" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="input-field col s12">
        <input name="name" id="name" type="text" class="validate" value="<?= $post->name; ?>">
        <label for="name">Item Name</label>
      </div>
      <div class="input-field col s12">
        <textarea name="description" id="description" class="materialize-textarea"><?= $post->description; ?></textarea>
        <label for="description">Description</label>
      </div>
      <div class="center col s12">
        <img class="responsive-img" id="image" style="max-height:30vh;" src="<?= site_url('upload/post/' . $post->filename); ?>">
      </div>
      <div class="file-field input-field col s12">
        <div class="btn light-blue darken-4">
          <span>Image</span>
          <input name="image" type="file" id="file">
        </div>
        <div class="file-path-wrapper">
          <input class="file-path validate" type="text" onchange="thumbnail();" name="file">
        </div>
      </div>
    </div>
    <div class="col s12 center">
      <button class="btn light-blue darken-4" type="submit">Submit</button>
    </div>
  </form>
</div>

<script type="text/javascript">
  var elem = document.querySelector('#description');
  M.textareaAutoResize(elem);

  function thumbnail() {
    var preview = document.querySelector('#image');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
      preview.src = reader.result;
    }

    if (file) {
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  }
</script>