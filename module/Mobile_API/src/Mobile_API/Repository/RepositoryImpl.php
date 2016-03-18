<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/15/2016
 * Time: 4:31 AM
 */

namespace Mobile_API\Repository;


use Mobile_API\Model\Hydrater;
use Mobile_API\Model\NewsFeed;
use Mobile_API\Model\Testimony;
use Zend\Db\Adapter\AdapterAwareTrait;

class RepositoryImpl implements RepositoryInterface
{
    use AdapterAwareTrait;

    public function AddNew_NewsFeed(NewsFeed $news_Feed)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'user_id'=>$news_Feed->getUserId(),
                'title'=>$news_Feed->getTitle(),
                'content'=>$news_Feed->getContent(),
                'description'=>$news_Feed->getDescription(),
                'image'=>$news_Feed->getImage(),
                'published_date'=>$news_Feed->getPublishedDate(),
            ))
            ->into('news_feeds');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

    public function Add_NewsFeed_Log(NewsFeed $news_Feed, $IMEI)
    {
        try{
            /**
             * @var \Zend\Db\Sql\Sql $ sql
             */
            $sql = new \Zend\Db\Sql\Sql($this->adapter);
            $insert = $sql->insert()
                ->values(array(
                    'news_feed_id'=>$news_Feed->getId(),
                    'IMEI'=>$IMEI,
                ))
                ->into('news_feed_logs');
            $statement = $sql->prepareStatementForSqlObject($insert);
            $result = $statement->execute();
            return $result->valid();
        }catch(Exception $e){
            return null;
        }

    }

    public function GetNew_NewsFeeds($IMEI)
    {
        $row_sql = 'SELECT * FROM news_feeds WHERE news_feeds.id NOT IN( SELECT news_feed_logs.news_feed_id FROM news_feed_logs WHERE news_feed_logs.imei ='.$IMEI.')';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrater();
        return($hydrator->Extract($posts, new NewsFeed()));
    }

    public function GetAll_NewsFeeds()
    {
        $row_sql = 'SELECT * FROM news_feeds';
        $statement = $this->adapter->query($row_sql);
        $result = $statement->execute();
        $posts = null;
        if($result->count()>0){
            while($result->valid()){
                $posts[] = $result->current();
                $result->next();
            }
        }
        $hydrator = new Hydrater();
        return $hydrator->Extract($posts,new NewsFeed());
    }

    public function AddNew_Testimony(Testimony $testimony)
    {
        /**
         * @var \Zend\Db\Sql\Sql $ sql
         */
        $sql = new \Zend\Db\Sql\Sql($this->adapter);
        $insert = $sql->insert()
            ->values(array(
                'full_name'=>$testimony->getFullName(),
                'testimony'=>$testimony->getTestimony(),
                'gps'=>$testimony->getGPS(),
                'imei'=>$testimony->getIMEI(),
            ))
            ->into('testimony');
        $statement = $sql->prepareStatementForSqlObject($insert);
        $result = $statement->execute();
        return $result->valid();
    }

}