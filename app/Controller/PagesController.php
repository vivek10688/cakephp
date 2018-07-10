<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('File', 'Utility');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();
	

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */
	public function display() {
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));
	
	$this->loadModel('Advertisement');
	$this->loadModel('Content');
	$this->loadModel('Testimonial');
	$this->loadModel('Member');
	$this->loadModel('Religion');
	$this->loadModel('Mothertongue');
	$this->loadModel('State');
	$this->loadModel('Habit');
	$this->loadModel('Maritialstatus');
	$this->loadModel('Slide');
        $this->loadModel('News');
	$fcondition=array();
	if($this->userValue){
		$fcondition=array('sex <>'=>$this->userValue['Member']['sex']);
	}
        $this->set('post',$this->Member->find('all',array('joins'=>array(array('table'=>'countries','type'=>'LEFT','alias'=>'Country','conditions'=>array('Member.country_id=Country.id')),
									  array('table'=>'employeds','type'=>'LEFT','alias'=>'Employed','conditions'=>array('Member.employed_id=Employed.id'))),
							   'fields'=>array('Employed.name','Member.profileId','Member.sex','Member.id','Member.name','Country.name','Member.photo','Member.photo_status','TIMESTAMPDIFF(YEAR,dob, CURDATE()) AS age'),
							   'conditions'=>array('feature'=>'Yes','status'=>'Active',$fcondition),
							   'order'=>array('Member.id'=>'desc','rand()'),
							   'limit'=>'15',
							      )));
	$this->set('testimonials',$this->Testimonial->find('all',array('fields'=>array('Testimonial.*','Member.photo'),
								       'conditions'=>array('Testimonial.status'=>'Active'),
								       'order'=>array('Testimonial.id'=>'desc','rand()'),
								       'limit'=>'5',
								       )));
	

	$this->set('advertisements',$this->Advertisement->findAllByStatus('Active'));
        $this->set('religion',$this->Religion->find('all',array('joins'=>array(array('table'=>'members','alias'=>'Member','type'=>'INNER','conditions'=>array('Member.religion_id=Religion.id'))),
									'group'=>array('Religion.name'))));
	$this->set('mothertongue',$this->Mothertongue->find('all',array('joins'=>array(array('table'=>'members','alias'=>'Member','type'=>'INNER','conditions'=>array('Member.mothertongue_id=Mothertongue.id'))),
									'group'=>array('Mothertongue.name'))));
	$this->set('state',$this->State->find('all',array('joins'=>array(array('table'=>'members','alias'=>'Member','type'=>'INNER','conditions'=>array('Member.state_id=State.id'))),
							  'group'=>array('State.name'))));
	$this->set('stateName',$this->State->find('list'));
	$this->set('habitName',$this->Habit->find('list'));
	$this->set('maritialstatus',$this->Maritialstatus->find('list'));
	$this->set('slides',$this->Slide->find('all',array('conditions'=>array('status'=>'Active'),'order'=>array('ordering'=>'asc'))));
        $this->set('news',$this->News->find('all',array('conditions'=>array('status'=>'Active'),'order'=>array('id'=>'desc'),'limit'=>15)));
		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
		
	}
	
        
        

}
