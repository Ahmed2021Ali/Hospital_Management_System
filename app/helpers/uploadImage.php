<?php


    function uploadImage($request,$folderNname)
    {
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images/'.$folderNname), $imageName);
        return $imageName;
    }
    function deleteImage($image,$folderNname)
{
    $image_path=public_path('images/'.$folderNname.'/').$image;
    if (file_exists($image_path)) {
        unlink($image_path);
        return true;
    }
    return false;
}
