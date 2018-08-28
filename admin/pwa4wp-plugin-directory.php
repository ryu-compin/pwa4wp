<?php


class pwa4wp_Directory {

	public function __construct($path) {
		$this->path = $path;
	}

	public function saveFile($filename, $file) {
		file_put_contents($this->path . $filename, $file);
	}
}
