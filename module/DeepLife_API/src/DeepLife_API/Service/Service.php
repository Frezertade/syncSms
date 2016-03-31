<?php
/**
 * Created by PhpStorm.
 * User: BENGEOS-PC
 * Date: 3/25/2016
 * Time: 1:31 PM
 */

namespace DeepLife_API\Service;


use DeepLife_API\Model\Answers;
use DeepLife_API\Model\Disciple;
use DeepLife_API\Model\Questions;
use DeepLife_API\Model\Schedule;
use DeepLife_API\Model\User;

interface Service
{
    // Users Table Services
    public function AddNew_User(User $user);
    public function Delete_User(User $user);
    public function Update_User(User $user);
    public function isThere_User(User $user);

    public function Get_User(User $user);
    public function GetAll_Disciples(User $user);
    public function GetNew_Disciples(User $user);
    public function AddNew_Disciple_log(Disciple $disciple);


    // User Schedule Table

    public function AddNew_Schedule(Schedule $schedule);
    public function AddNew_Schedule_log(Schedule $schedule);
    public function Delete_Schedule(Schedule $schedule);

    public function Update_Schedule(Schedule $schedule);
    public function GetAll_Schedule(User $user);
    public function GetNew_Schedule(User $user);
    public function Delete_Schedule_Log(User $user);

    // Disciple Service
    public function AddNew_Disciples(User $user,array $users);
    public function AddNew_Disciple(User $user,User $disciple);
    public function AddNewDisciples(User $user);
    public function Delete_Disciple_Log(User $user);

    public function isValidUser(User $user);
    public function authenticate($userName, $userPass);

    public function AddNew_Question(Questions $questions);
    public function GetAll_Question();

    public function AddNew_Answer(Answers $answers);
    public function GetAll_Answers(User $user);
}