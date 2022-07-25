<?php


namespace app\Services;


class AvatarSettingsService
{
    private $path = './avatars/';
    private $files;


    public function __construct($files)
    {
        $this->files = $files;
    }

    public function getPathToAvatarsFolder()
    {
        return $this->path;
    }

    public function setPathToAvatarsFolder($path)
    {
        $this->path = $path;
    }

    public function setAvatar($user) : ?string
    {
        $fileTmpPath = $this->files['avatar']['tmp_name'];
        $filename = $user['token'] . $this->files['avatar']['name'];
        $filenameParts = explode('.', $filename);
        $fileExtension = strtolower(end($filenameParts));
        $allowExtensions = ['jpg', 'jpeg', 'png'];
        $allowMimeTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        $mimeType = mime_content_type($fileTmpPath);

        if (in_array($fileExtension, $allowExtensions) && in_array($mimeType, $allowMimeTypes)) {
            $destination = $this->path . $filename;

            if ($this->issetAvatar($user)) {
                $this->deleteAvatar($user);
            }
            
            if (move_uploaded_file($fileTmpPath, $destination)) {

                return $filename;
            }
        }

        return null;
    }

    private function deleteAvatar($user)
    {
        $path = $this->path . $user['avatar'];
        unlink($path);
    }

    private function issetAvatar($user)
    {
        if ($user['avatar'] == 'default.png') {
            return false;
        }
    
        $path = $this->path . $user['avatar'];
        return file_exists($path);
    }
}
