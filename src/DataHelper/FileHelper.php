<?php

namespace App\DataHelper;

use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FileHelper
{
    public function loadAudio($audio, $slugger)
    {
        if ($audio) {
            $originalFilename = pathinfo($audio->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$audio->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $audio->move(
                    "audios/podcasts",
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            return $newFilename;
        }
    }


    public function loadPicture($picture, $slugger)
    {
        if ($picture) {
            $originalFilename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            // this is needed to safely include the file name as part of the URL
            $safeFilename = $slugger->slug($originalFilename);
            $newFilename = $safeFilename.'-'.uniqid().'.'.$picture->guessExtension();

            // Move the file to the directory where brochures are stored
            try {
                $picture->move(
                    "images/podcasts",
                    $newFilename
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            return $newFilename;
        }
    }
}