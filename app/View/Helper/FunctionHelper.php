<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Helper', 'View');
App::uses('CakeTime', 'Utility');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class FunctionHelper extends Helper
{
    var $helpers = array('Html');
    public function secondsToWords($seconds,$msg="Unlimited")
    {
        $ret = "";
        if($seconds>0)
        {
            /*** get the hours ***/
            $hours = intval(intval($seconds) / 3600);
            if($hours > 0)
            {
                $ret .= $hours.' '.__('Hours').' ';
            }
            /*** get the minutes ***/
            $minutes = bcmod((intval($seconds) / 60),60);
            if($hours > 0 && $minutes > 0)
            {
                $ret .= $minutes.' '.__('Mins').' ';
            }
            $tarMinutes = bcmod((intval($seconds)),60);
            if(strlen($ret)==0 || $tarMinutes>0)
            {
                if($tarMinutes>0)
                $ret .= $tarMinutes.' '.__('Sec');
                else
                $ret .= $seconds.' '.__('Sec');
            }
        }
        else
        {
            $ret=$msg;
        }
        return $ret;
    }
    public function showGroupName($gropArr,$string=" | ")
    {
        $groupNameArr=array();
        foreach($gropArr as $groupName)
        {
            $groupNameArr[]=$groupName['name'];
        }
        unset($groupName);
        $showGroup= implode($string,$groupNameArr);
        unset($groupNameArr);
        return h($showGroup);
    }
    public function favouriteMember($memberId)
    {
        $Member=ClassRegistry::init('Member');
        $Favourite=ClassRegistry::init('Favourite');
        $post=$Member->findById($memberId);
        $favUrl=$this->Html->url(array('controller'=>'Viewprofiles','action'=>'favourite'));
        if($post)
        {
            if(isset($_SESSION['Member']))
            {
               $fpost=$Favourite->findByMemberIdAndViewerId($memberId,$_SESSION['Member']['Member']['id']);
            }
            if($fpost)
            {
                return '<span class="'.$memberId.'printajax"><button onclick="favouriteMember(\''.$favUrl.'\',\''.$memberId.'\',\'remove\');" class="vertical"><i class="fa fa-heart"></i>&nbsp;<span>'.__('Remove to favorites').'</span></button></span>';
            }
            else
            {
                return '<span class="'.$memberId.'printajax"><button onclick="favouriteMember(\''.$favUrl.'\',\''.$memberId.'\',\'add\');" class="vertical"><i class="fa fa-heart-o"></i>&nbsp;<span>'.__('Add to favorites').'</span></button></span>';
            }
        }
    }
    public function shortlistMember($memberId)
    {
        $Member=ClassRegistry::init('Member');
        $Favourite=ClassRegistry::init('Shortlist');
        $post=$Member->findById($memberId);
        $favUrl=$this->Html->url(array('controller'=>'Viewprofiles','action'=>'shortlist'));
        if($post)
        {
            if(isset($_SESSION['Member']))
            {
               $fpost=$Favourite->findByMemberIdAndViewerId($memberId,$_SESSION['Member']['Member']['id']);
            }
            if($fpost)
            {
                return '<span class="'.$memberId.'sprintajax"><button onclick="shortlistMember(\''.$favUrl.'\',\''.$memberId.'\',\'remove\');" class="vertical"><i class="fa fa-check-square"></i>&nbsp;<span>'.__('Remove to shortlist').'</span></button></span>';
            }
            else
            {
                return '<span class="'.$memberId.'sprintajax"><button onclick="shortlistMember(\''.$favUrl.'\',\''.$memberId.'\',\'add\');" class="vertical"><i class="fa fa-check-square-o"></i>&nbsp;<span>'.__('Add to shortlist').'</span></button></span>';
            }
        }
    }
    public function getMemberDetails($userName)
    {
        $Member=ClassRegistry::init('Member');
        $post=$Member->findByUserName($userName);
        if($post)
        {
            return$post;
        }
    }
}
