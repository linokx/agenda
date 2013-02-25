<form action="http://localhost/agenda/etablissement/ajouterPhoto" accept-charset="utf-8" method="post" enctype="multipart/form-data">
	<input type="hidden" name="id_lieu" value="<?php echo $this->uri->segment(2); ?>">
<input type="file" name="image" value="" id="image">
<input type="submit" name="" value="Proposer l'établissement">
</form>