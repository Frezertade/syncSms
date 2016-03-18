<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:31 AM
 */

namespace Mobile_API\Repository;
use Mobile_API\Model\NewsFeed;
use Mobile_API\Model\Testimony;

interface RepositoryInterface extends Repository
{
    public function AddNew_NewsFeed(NewsFeed $news_Feed);
    public function AddNew_Testimony(Testimony $testimony);
    public function Add_NewsFeed_Log(NewsFeed $news_Feed, $IMEI);
    public function GetNew_NewsFeeds($IMEI);
    public function GetAll_NewsFeeds();
}