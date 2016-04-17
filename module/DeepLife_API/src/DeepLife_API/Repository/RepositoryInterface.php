<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/25/2016
 * Time: 1:19 PM
 */

namespace DeepLife_API\Repository;


use DeepLife_API\Model\Answers;
use DeepLife_API\Model\Disciple;
use DeepLife_API\Model\NewsFeed;
use DeepLife_API\Model\Questions;
use DeepLife_API\Model\Schedule;
use DeepLife_API\Model\User;
use DeepLife_API\Model\User_Role;
use DeepLife_API\Model\UserReport;

interface RepositoryInterface extends Repository
{
    // Users Table Services
    public function AddNew_User(User $user);
    public function Add_User_Role($user_id, $role_id);
    public function Delete_User(User $user);
    public function Update_User(User $user);
    public function Update_User1(User $user);
    public function isThere_User(User $user);

    public function Get_User(User $user);
    public function GetAll_Disciples(User $user);
    public function GetNew_Disciples(User $user);
    public function AddNew_Disciple_log(Disciple $disciple);
    public function Delete_Disciple_Log(User $user);


    // User Schedule Table

    public function AddNew_Schedule(Schedule $schedule);
    public function AddNew_Schedule_log(Schedule $schedule);
    public function Delete_Schedule(Schedule $schedule);
    public function Delete_Schedule_Log(User $user);

    public function Update_Schedule(Schedule $schedule);
    public function GetAll_Schedule(User $user);
    public function GetNew_Schedule(User $user);

    public function isValidUser(User $user);
    public function getAuthenticationAdapter();
    public function getAuthenticationAdapter2();

    public function AddNew_Question(Questions $questions);
    public function GetAll_Question();

    public function AddNew_Answer(Answers $answers);
    public function GetAll_Answers(User $user);

    public function AddNew_Report(User $user);
    public function GetAll_Report();

    public function GetAll_Country();

    public function AddNew_UserReport(UserReport $userReport);

    public function GetAll_NewsFeeds();
    public function GetNew_NewsFeeds(User $user);
    public function AddNew_NewsFeed_log(NewsFeed $news);
    public function Delete_All_NewsFeed_Log(User $user);
}