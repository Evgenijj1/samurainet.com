<?php
class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->role;
        }
    }

    function getStatus() {
        if($user = $this->getModel()){
            // в таблице User есть поле role
            return $user->status;
        }
    }
 
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'role, status'));
        }
        return $this->_model;
    }


    private function getModel1(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = User::model()->findByPk($this->id, array('select' => 'status'));
        }
        return $this->_model;
    }
}