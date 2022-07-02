<div class="row">
	<div class="col s12">
		<div class="row center">
			<h1><?= $post->name; ?></h1>
		</div>
		<div class="row">
			<div class="center col s6">
				<a href="<?= site_url('welcome/delete/' . $post->id); ?>" class="red-text">Delete</a>
			</div>
			<div class="center col s6">
				<a href="<?= site_url('welcome/update/' . $post->id); ?>" class="blue-text">Update</a>
			</div>
		</div>
		<div class="row center">
			<img src="<?= site_url('upload/post/' . $post->filename); ?>" alt="Post's Image" class="circle" width="100vw" height="100vh">
		</div>
		<div class="row">
			<p><?= $post->description; ?></p>
		</div>
	</div>
</div>