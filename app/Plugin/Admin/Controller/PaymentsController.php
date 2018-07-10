<?php
class PaymentsController extends AdminAppController {
    public $helpers = array('Html','Form','Session');
    public $components = array('Session');
    public function index()
    {
        try
        {
            $post = $this->Payment->find('all');        
            if ($this->request->is('post'))
            {
                $rost = $this->Payment->findByType($this->request->data['Payment']['type']);
                $this->Payment->id = $rost['Payment']['id'];
                try
                {
                    if ($this->Payment->save($this->request->data))
                    {
                        $this->Session->setFlash(__('Payment Setting has been saved'),'flash',array('alert'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }
                catch (Exception $e)
                {
                    $this->Session->setFlash(__('Setting Problem'),'flash',array('alert'=>'danger'));
                    return $this->redirect(array('action' => 'index'));
                }
            }
            if (!$this->request->data)
            {
                $this->set('post',$post);
            }
        }
        catch (Exception $e)
        {
            $this->Session->setFlash($e->getMessage(),'flash',array('alert'=>'danger'));
        }
    }
}