<?php

namespace App\Model;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

class Notification
{
    private static $basicRef = 'Notification/Articles/';

    private static function getDb(){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/test-chat-8fd39-firebase-adminsdk-qpul5-4bcd158e7f.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();
        return $firebase->getDatabase();
    }

    private static function getRef($children = ''){
        return self::getDb()->getReference(self::$basicRef.$children);
    }

    public static function all(){
        return self::getRef();
    }

    public static function find($id){
        return self::getRef("Article_{$id}/"); 
    }

    public function save(){
        $lastArticle = self::all()->orderByKey()->limitToLast(1)->getValue();
        
        if($lastArticle){
            foreach($lastArticle as $article) $lastArticle = $article;
            var_dump($lastArticle);
            $lastId = $lastArticle['id'] + 1;
        }else{
            $lastId = 1;
        }
        self::getRef("Article_{$lastId}/")
        ->set($this);
        
        return $lastId;
    }
    
}
