<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RolModel
 *
 * @author jcaperap
 */
class RolModel  extends Model{
    //put your code here
    public function __construct() {
        parent::__construct();
    }
    public function getRoles() {
        return $this->getDb()->selectQuery("ROL", "*", "")->fetchAll(PDO::FETCH_ASSOC);
    }
}
