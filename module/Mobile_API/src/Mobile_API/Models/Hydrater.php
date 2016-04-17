<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/17/2016
 * Time: 11:32 AM
 */

namespace Mobile_API\Model;


class Hydrater {
    public function Hydrate($Post,$DataType){
        if(is_array($Post)) {
            if ($DataType instanceof NewsFeed) {
                $Found = null;
                foreach ($Post as $data) {
                    $New_Data = new NewsFeed();
                    $New_Data->setId(isset($data['id']) ? intval($data['id']) : null);
                    $New_Data->setUserId(isset($data['user_id']) ? ($data['user_id']) : null);
                    $New_Data->setTitle(isset($data['title']) ? $data['title'] : null);
                    $New_Data->setContent(isset($data['content']) ? $data['content'] : null);
                    $New_Data->setImage(isset($data['image']) ? intval($data['image']) : null);
                    $New_Data->setDescription(isset($data['description']) ? $data['description'] : null);
                    $New_Data->setPublishedDate(isset($data['published_date']) ? $data['published_date'] : null);
                    $New_Data->setCreated(isset($data['created']) ? intval($data['created']) : null);
                    $New_Data->setUpdated(isset($data['updated']) ? $data['updated'] : null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }
        }
        return null;
    }
    public function Extract($Post,$DataType){
        if(is_array($Post)) {
            if (($DataType instanceof NewsFeed)) {
                $Found = null;
                foreach ($Post as $data) {
                    $New_Data = new NewsFeed();
                    $New_Data->setId(isset($data['id']) ? intval($data['id']) : null);
                    $New_Data->setUserId(isset($data['user_id']) ? ($data['user_id']) : null);
                    $New_Data->setTitle(isset($data['title']) ? $data['title'] : null);
                    $New_Data->setContent(isset($data['content']) ? $data['content'] : null);
                    $New_Data->setImage(isset($data['image']) ? $data['image'] : null);
                    $New_Data->setDescription(isset($data['description']) ? $data['description'] : null);
                    $New_Data->setPublishedDate(isset($data['published_date']) ? $data['published_date'] : null);
                    $New_Data->setCreated(isset($data['created']) ? intval($data['created']) : null);
                    $New_Data->setUpdated(isset($data['updated']) ? $data['updated'] : null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }

        }

    }
}