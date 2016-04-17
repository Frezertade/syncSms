<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/25/2016
 * Time: 2:03 PM
 */

namespace DeepLife_API\Model;
class Hydrator
{
    public function Hydrate($Post,$DataType){
        if(is_array($Post)) {
            if ($DataType instanceof User) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new User();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setEmail(isset($data['email'])? ($data['email']):null);
                    $New_Data->setDisplayName(isset($data['displayName'])? $data['displayName']:null);
                    $New_Data->setPassword(isset($data['password'])? $data['password']:null);
                    $New_Data->setFirstName(isset($data['firstName'])? $data['firstName']:null);
                    $New_Data->setCountry(isset($data['country'])? $data['country']:null);
                    $New_Data->setPhoneNo(isset($data['phone_no'])? $data['phone_no']:null);
                    $New_Data->setMentorId(isset($data['mentor_id'])? $data['mentor_id']:null);
                    $New_Data->setPicture(isset($data['picture'])? $data['picture']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof Schedule) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Schedule();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setDisciplePhone(isset($data['disciple_phone'])? ($data['disciple_phone']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setTime(isset($data['time'])? $data['time']:null);
                    $New_Data->setType(isset($data['type'])? $data['type']:null);
                    $New_Data->setDescription(isset($data['description'])? $data['description']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof Questions) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Questions();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setQuestion(isset($data['question'])? $data['question']:null);
                    $New_Data->setDescription(isset($data['description'])? $data['description']:null);
                    $New_Data->setMandatory(isset($data['mandatory'])? $data['mandatory']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof Answers) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Answers();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setQuestionId(isset($data['question_id'])? $data['question_id']:null);
                    $New_Data->setCreated(isset($data['answer'])? $data['answer']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof Report) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Report();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setQuestion(isset($data['question'])? $data['question']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof NewsFeed) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new NewsFeed();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setUserId(isset($data['user_id'])? $data['user_id']:null);
                    $New_Data->setCountryId(isset($data['country_id'])? $data['country_id']:null);
                    $New_Data->setTitle(isset($data['title'])? $data['title']:null);
                    $New_Data->setContent(isset($data['content'])? $data['content']:null);
                    $New_Data->setImageUrl(isset($data['image_url'])? $data['image_url']:null);
                    $New_Data->setPublishDate(isset($data['published_date'])? $data['published_date']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data;
                }
                return $Found;
            }
        }
        return null;
    }
    public function Extract($Post,$DataType){
        if(is_array($Post)) {
            if ($DataType instanceof User) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new User();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setEmail(isset($data['email'])? ($data['email']):null);
                    $New_Data->setDisplayName(isset($data['displayName'])? $data['displayName']:null);
                    $New_Data->setPassword(isset($data['password'])? $data['password']:null);
                    $New_Data->setFirstName(isset($data['firstName'])? $data['firstName']:null);
                    $New_Data->setCountry(isset($data['country'])? $data['country']:null);
                    $New_Data->setPhoneNo(isset($data['phone_no'])? $data['phone_no']:null);
                    $New_Data->setMentorId(isset($data['mentor_id'])? $data['mentor_id']:null);
                    $New_Data->setPicture(isset($data['picture'])? $data['picture']:null);
                    $New_Data->setStage(isset($data['stage'])? $data['stage']:null);
                    $New_Data->setGender(isset($data['gender'])? $data['gender']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof Schedule) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Schedule();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setDisciplePhone(isset($data['disciple_phone'])? ($data['disciple_phone']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setTime(isset($data['time'])? $data['time']:null);
                    $New_Data->setType(isset($data['type'])? $data['type']:null);
                    $New_Data->setDescription(isset($data['description'])? $data['description']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof Questions) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Questions();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setQuestion(isset($data['question'])? $data['question']:null);
                    $New_Data->setDescription(isset($data['description'])? $data['description']:null);
                    $New_Data->setMandatory(isset($data['mandatory'])? $data['mandatory']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof Answers) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Answers();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setQuestionId(isset($data['question_id'])? $data['question_id']:null);
                    $New_Data->setCreated(isset($data['answer'])? $data['answer']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof Report) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Report();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setQuestion(isset($data['question'])? $data['question']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof Country) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Country();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setIso3(isset($data['iso3'])? ($data['iso3']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setCode(isset($data['phonecode'])? $data['phonecode']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }elseif ($DataType instanceof NewsFeed) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new NewsFeed();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setCategory(isset($data['category'])? ($data['category']):null);
                    $New_Data->setCountryId(isset($data['country_id'])? $data['country_id']:null);
                    $New_Data->setTitle(isset($data['title'])? $data['title']:null);
                    $New_Data->setContent(isset($data['content'])? $data['content']:null);
                    $New_Data->setImageUrl(isset($data['image_url'])? $data['image_url']:null);
                    $New_Data->setPublishDate(isset($data['published_date'])? $data['published_date']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found[] = $New_Data->getArray();
                }
                return $Found;
            }
        }
        return null;
    }
    public function Get_Data($Post,$DataType){
        if(is_array($Post)) {
            if ($DataType instanceof User) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new User();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setEmail(isset($data['email'])? ($data['email']):null);
                    $New_Data->setDisplayName(isset($data['displayName'])? $data['displayName']:null);
                    $New_Data->setPassword(isset($data['password'])? $data['password']:null);
                    $New_Data->setFirstName(isset($data['firstName'])? $data['firstName']:null);
                    $New_Data->setCountry(isset($data['country'])? $data['country']:null);
                    $New_Data->setPhoneNo(isset($data['phone_no'])? $data['phone_no']:null);
                    $New_Data->setMentorId(isset($data['mentor_id'])? $data['mentor_id']:null);
                    $New_Data->setPicture(isset($data['picture'])? $data['picture']:null);
                    $New_Data->setStage(isset($data['stage'])? $data['stage']:null);
                    $New_Data->setGender(isset($data['gender'])? $data['gender']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found = $New_Data;
                }
                return $Found;
            }elseif ($DataType instanceof Schedule) {
                $Found = null;
                foreach($Post as $data){
                    $New_Data = new Schedule();
                    $New_Data->setId(isset($data['id'])? intval($data['id']):null);
                    $New_Data->setUserId(isset($data['user_id'])? ($data['user_id']):null);
                    $New_Data->setName(isset($data['name'])? $data['name']:null);
                    $New_Data->setTime(isset($data['time'])? $data['time']:null);
                    $New_Data->setType(isset($data['type'])? $data['type']:null);
                    $New_Data->setCreated(isset($data['created'])? $data['created']:null);
                    $Found = $New_Data;
                }
                return $Found;
            }
        }
        return null;
    }
    public function GetDisciple($data){
        $New_Data = new User();
        $New_Data->setId(isset($data['id'])? intval($data['id']):null);
        $New_Data->setEmail(isset($data['Email'])? ($data['Email']):null);
        $New_Data->setDisplayName(isset($data['Full_Name'])? $data['Full_Name']:null);
        $New_Data->setFirstName(isset($data['Full_Name'])? $data['Full_Name']:null);
        $New_Data->setCountry(isset($data['Country'])? $data['Country']:null);
        $New_Data->setGender(isset($data['Gender'])? $data['Gender']:null);
        $New_Data->setStage(isset($data['Build_Phase'])? $data['Build_Phase']:null);
        $New_Data->setPhoneNo(isset($data['Phone'])? $data['Phone']:null);
        return $New_Data;
    }
}