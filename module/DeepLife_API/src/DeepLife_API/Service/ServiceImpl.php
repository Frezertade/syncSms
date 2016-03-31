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
use Zend\Authentication\AuthenticationService;

class ServiceImpl implements Service
{
    /**
     * @var \DeePLife_API\Repository\RepositoryInterface  $apiRepository
     */
    protected $apiRepository;

    /**
     * @return mixed
     */
    public function getApiRepository()
    {
        return $this->apiRepository;
    }

    /**
     * @param mixed $apiRepository
     */
    public function setApiRepository($apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }
    public function LogError($error){

    }

    public function isValidUser(User $user)
    {
        try{
            return $this->apiRepository->isValidUser($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function isThere_User(User $user)
    {
        try{
            return $this->apiRepository->isThere_User($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return true;
        }
    }

    public function getAuthenticationService()
    {
        $AuthAdapter = $this->apiRepository->getAuthenticationAdapter();
        return new AuthenticationService(null,$AuthAdapter);
    }
    public function getAuthenticationService2()
    {
        $AuthAdapter = $this->apiRepository->getAuthenticationAdapter2();
        return new AuthenticationService(null,$AuthAdapter);
    }
    public function authenticate($userName, $userPass)
    {
        try{
            $AuthService = $this->getAuthenticationService();
            $AuthService2 = $this->getAuthenticationService2();
            /**
             * @var  \Zend\Authentication\Adapter\DbTable\CallbackCheckAdapter $AuthAdapter
             */
            $AuthAdapter = $AuthService->getAdapter();
            $AuthAdapter->setIdentity($userName);
            $AuthAdapter->setCredential($userPass);
            $Result = $AuthAdapter->authenticate();
            if($Result->isValid()){
                return true;
            }else{
                $AuthAdapter = $AuthService2->getAdapter();
                $AuthAdapter->setIdentity($userName);
                $AuthAdapter->setCredential($userPass);
                $Result = $AuthAdapter->authenticate();
                if($Result->isValid()){
                    return true;
                }
            }
            return false;
        }catch(\Exception $e){
            $this->LogError($e);
            return false;
        }
    }

    public function AddNew_User(User $user)
    {
        try{
            return $this->apiRepository->AddNew_User($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function Delete_User(User $user)
    {
        // TODO: Implement Delete_User() method.
    }

    public function Update_User(User $user)
    {
        // TODO: Implement Update_User() method.
    }

    /**
     * @param \DeepLife_API\Model\User $user
     * @return \DeepLife_API\Model\User | null
     */
    public function Get_User(User $user)
    {
        try{
            return $this->apiRepository->Get_User($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetAll_Disciples(User $user)
    {
        try{
            return $this->apiRepository->GetAll_Disciples($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetNew_Disciples(User $user)
    {
        try{
            return $this->apiRepository->GetNew_Disciples($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Schedule(Schedule $schedule)
    {
        try{
            return $this->apiRepository->AddNew_Schedule($schedule);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Schedule_log(Schedule $schedule)
    {
        try{
            return $this->apiRepository->AddNew_Schedule_log($schedule);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function Delete_Schedule(Schedule $schedule)
    {
        try{
            return $this->apiRepository->Delete_Schedule($schedule);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function Update_Schedule(Schedule $schedule)
    {
        try{
            return $this->apiRepository->Update_Schedule($schedule);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetAll_Schedule(User $user)
    {
        try{
            return $this->apiRepository->GetAll_Schedule($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetNew_Schedule(User $user)
    {
        try{
            return $this->apiRepository->GetNew_Schedule($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function Delete_Schedule_Log(User $user)
    {
        try{
            return $this->apiRepository->Delete_Schedule_Log($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Disciples(User $user, array $users)
    {
        try{
            if(is_array($users)){
                /**
                 * @var \DeepLife_API\Model\User $newUser
                 */
                $state = null;
                foreach($users as $newUser){
                    $newUser->setMentorId($user->getId());
                    $state[] = $this->apiRepository->AddNew_User($newUser);
                }
                return $state;
            }
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }

    }

    public function AddNewDisciples(User $user)
    {
        try{
            return $this->apiRepository->AddNew_User($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Disciple(User $user, User $disciple)
    {
        try{
            $disciple->setMentorId($user->getId());
            return $this->apiRepository->AddNew_User($disciple);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Disciple_log(Disciple $disciple)
    {
        try{
            return $this->apiRepository->AddNew_Disciple_log($disciple);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function Delete_Disciple_Log(User $user)
    {
        try{
            return $this->apiRepository->Delete_Disciple_Log($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Question(Questions $questions)
    {
        try{
            return $this->apiRepository->AddNew_Question($questions);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetAll_Question()
    {
        try{
            return $this->apiRepository->GetAll_Question();
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function AddNew_Answer(Answers $answers)
    {
        try{
            return $this->apiRepository->AddNew_Answer($answers);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }

    public function GetAll_Answers(User $user)
    {
        try{
            return $this->apiRepository->GetAll_Answers($user);
        }catch(\Exception $e){
            $this->LogError($e);
            return null;
        }
    }


}