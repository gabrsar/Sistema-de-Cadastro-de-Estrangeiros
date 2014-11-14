<?php
	/* Autor: Victor Hugo Cândido de Oliveira
	 * Funções para upload de imagens
	 */

function uploadFoto(){
try {
	$target_dir = "imagens";
echo '<p>Here is some more debugging info</p>';
	print_r($_FILES);
	// Undefined | Multiple Files | $_FILES Corruption Attack
	if (
		 !isset($_FILES['foto']['error']) ||
		 is_array($_FILES['foto']['error'])
	) {
		 throw new RuntimeException('Invalid parameters.');
	}

	// Check $_FILES['upfile']['error'] value.
	switch ($_FILES['foto']['error']) {
		case UPLOAD_ERR_OK:
			break;
		//Permite upload de nenhum arquivo
			// TODO corrigir essa gambiarra
		case UPLOAD_ERR_NO_FILE:
			throw new RuntimeException('');
		case UPLOAD_ERR_INI_SIZE:
		case UPLOAD_ERR_FORM_SIZE:
			throw new RuntimeException('Exceeded filesize limit.');
		default:
			throw new RuntimeException('Unknown errors.');
	}

	// Tamanho máximo permitido
	if ($_FILES['foto']['size'] > 1048576) {
		 throw new RuntimeException('Exceeded filesize limit.');
	}

	// DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
	// Check MIME Type by yourself.
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	if (false === $ext = array_search(
		$finfo->file($_FILES['foto']['tmp_name']),
		array(
			  'jpg' => 'image/jpeg',
			  'png' => 'image/png',
			  'gif' => 'image/gif',
			  'bmp' => 'image/bmp'
		),
		true
	)) {
		 throw new RuntimeException('Invalid file format.');
	}

	// You should name it uniquely.
	// DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
	// On this example, obtain safe unique name from its binary data.
	$t = time();
	$novoNome = "";
	$novoNome = sprintf('%s/%s_%s.%s',
					$target_dir, $t, sha1_file($_FILES['foto']['tmp_name']), $ext);
	if (!move_uploaded_file(
			$_FILES['foto']['tmp_name'],
			$novoNome
	)) {
		 throw new RuntimeException('Failed to move uploaded file.');
	}


	return $novoNome;
}
catch (RuntimeException $e) {
	echo $e->getMessage();
}
}
?>