<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<h6><?= validation_errors(); ?></h6>
<h6><?= $this->session->flashdata('error'); ?></h6>

  <div class="row">
    <form action="<?= site_url('auth/login'); ?>" method="post" enctype="multipart/form-data" class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input name="username" id="username" type="text" class="validate">
          <label for="username">Username</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name="password" id="password" type="password" class="validate">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row center">
        <div class="input-field col s12">
          <button type="submit" class="btn light-blue darken-4">Create</button>
        </div>
      </div>
    </form>
  </div>