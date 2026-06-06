<?php

class FileManager
{

    public string $mimeType;
    public string $size;

    public function __construct(array $file)
    {

        if (!isset($file["tmp_name"])) {
            throw new Error("Fichier vide ou corrompu");
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $this->mimeType = finfo_file($finfo, $file["tmp_name"]);
        $this->size = $file["size"];
    }
}
