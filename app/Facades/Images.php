<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Str;
class Images extends Facade
{
    protected static function getFacadeAccessor() { return 'Images'; }

    public static function save($foldername,$photo)
    {
       $file_extension = $photo -> getClientOriginalExtension();
       $file_name = date('d_m_Y').'_'.Str::uuid().'.'.$file_extension;
       $path = 'storage/'.$foldername;
       $photo -> move($path,$file_name);
       return $file_name;
    }
    public static function saveAll($foldername,$images){
        $files=[];
        foreach ($images as  $image) {
            $files[]=self::save($foldername,$image);
        }
        return $files;
    }
   
}
