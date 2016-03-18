<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:33 AM
 */

namespace Mobile_API\Service;


use Mobile_API\Model\News_Feed;
use Mobile_API\Model\NewsFeed;
use Mobile_API\Model\Testimony;

class ServiceImpl implements Service
{
    /**
     * @var \Mobile_API\Repository\RepositoryInterface $Repository
     */
    protected $Repository;

    /**
     * @param \Mobile_API\Repository\RepositoryInterface $Repository
     */
    public function setRepository($Repository)
    {
        $this->Repository = $Repository;
    }

    public function AddNew_NewsFeed(NewsFeed $news_Feed)
    {
        return $this->Repository->AddNew_NewsFeed($news_Feed);
    }

    public function Add_NewsFeed_Log(NewsFeed $news_Feed, $IMEI)
    {
        return $this->Repository->Add_NewsFeed_Log($news_Feed,$IMEI);
    }

    public function GetNew_NewsFeeds($IMEI)
    {
        return $this->Repository->GetNew_NewsFeeds($IMEI);
    }

    public function GetAll_NewsFeeds()
    {
        return $this->Repository->GetAll_NewsFeeds();
    }

    public function AddNew_Testimony(Testimony $testimony)
    {
        return $this->Repository->AddNew_Testimony($testimony);
    }


}