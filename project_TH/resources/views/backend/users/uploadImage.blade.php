<form action="{{ route('backend.user.addImage') }}" enctype="multipart/form-data" method="POST">
	@csrf
	<input type="file" name="image">
	<button type="submit" value="submit">+</button>
</form>