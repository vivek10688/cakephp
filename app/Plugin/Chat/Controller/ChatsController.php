<?php
class ChatsController extends ChatAppController
{
	public $helpers=array('Html');
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->userName=$this->userValue['Member']['user_name'];
		$this->sessionId=$this->userValue['Member']['session_id'];
	}
	function index()
	{
		die();
	}
	function chatHeartbeat()
	{
		$this->autoRender=false;
		$this->request->onlyAllow('ajax');
		$chatArr=$this->Chat->find('all',array('conditions'=>array('to_name'=>$this->userName,'recd'=>0),
											   'order'=>array('id'=>'asc')));
		$items = '';
		$chatBoxes = array();
		foreach($chatArr as $chat)
		{
			//if (!isset($_SESSION['openChatBoxes'][$chat['Chat']['from_name']]) && isset($_SESSION['chatHistory'][$chat['Chat']['from_name']]))
			//{
			//	$items = $_SESSION['chatHistory'][$chat['Chat']['from_name']];
			//}		
			$chat['Chat']['message'] = $this->sanitize($chat['Chat']['message']);
			$items.=json_encode(array('s'=>'0','f'=>$chat['Chat']['from_name'],'m'=>$chat['Chat']['message'])).',';
			if (!isset($_SESSION['chatHistory'][$chat['Chat']['from_name']]))
			{
				$_SESSION['chatHistory'][$chat['Chat']['from_name']] = '';
			}
			$_SESSION['chatHistory'][$chat['Chat']['from_name']].=json_encode(array('s'=>'0','f'=>$chat['Chat']['from_name'],'m'=>$chat['Chat']['message'])).',';
			unset($_SESSION['tsChatBoxes'][$chat['Chat']['from_name']]);
			$_SESSION['openChatBoxes'][$chat['Chat']['from_name']] = $chat['Chat']['sent'];
		}
		if (!empty($_SESSION['openChatBoxes']))
		{
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $time)
			{
				if (!isset($_SESSION['tsChatBoxes'][$chatbox]))
				{
					$now = CakeTime::convert(time(),$this->siteTimezone)-strtotime($time);
					$time = date('g:iA M dS', strtotime($time));
					$message = __('Sent at %s',$time);
					if ($now > 180)
					{
						$items .= json_encode(array('s'=>'2','f'=>$chatbox,'m'=>$message)).',';
						if (!isset($_SESSION['chatHistory'][$chatbox]))
						{
							$_SESSION['chatHistory'][$chatbox] = '';
						}
						$_SESSION['chatHistory'][$chatbox] .= json_encode(array('s'=>'2','f'=>$chatbox,'m'=>$message)).',';
						$_SESSION['tsChatBoxes'][$chatbox] = 1;
					}
				}
			}
		}
		$this->Chat->updateAll(array('recd'=>1),array('to_name'=>$this->userName,'recd'=>0));
		if ($items != '')
		{
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		echo '{"items":['.$items.']}';
		exit(0);
	}
	function chatBoxSession($chatbox)
	{
		$items = '';
		if (isset($_SESSION['chatHistory'][$chatbox]))
		{
			$items = $_SESSION['chatHistory'][$chatbox];
		}	
		return $items;
	}
	function startChatSession()
	{
		$this->autoRender=false;
		$this->request->onlyAllow('ajax');
		$items = '';
		if (!empty($_SESSION['openChatBoxes']))
		{
			foreach ($_SESSION['openChatBoxes'] as $chatbox => $void)
			{
				$items .= $this->chatBoxSession($chatbox);
			}
		}
		if ($items != '')
		{
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		echo '{"username": "'.$this->userName.'","items": ['.$items.']}';
		exit(0);
	}
	function sendChat()
	{
		$this->autoRender=false;
		$this->request->onlyAllow('ajax');
		$from = $this->userName;
		$to = $_POST['to'];
		$message = $_POST['message'];	
		$this->loadModel('Member');
		$this->loadModel('MembersVprofile');
		$this->Member->virtualFields=array('age'=>'TIMESTAMPDIFF(YEAR,Member.dob, CURDATE())');
		$memberArr=$this->Member->findByUserName($to);
		if($memberArr)
		{
			$memberVArr=$this->MembersVprofile->findByMemberIdAndViewerId($this->userValue['Member']['id'],$memberArr['Member']['id']);
			if($memberVArr)
			{
				$_SESSION['openChatBoxes'][$_POST['to']] = $this->currentDateTime;		
				$messagesan = $this->sanitize($message);	
				if (!isset($_SESSION['chatHistory'][$_POST['to']]))
				{
					$_SESSION['chatHistory'][$_POST['to']] = '';
				}
				$_SESSION['chatHistory'][$_POST['to']] .= json_encode(array('s'=>'1','f'=>$to,'m'=>$messagesan)).',';
				unset($_SESSION['tsChatBoxes'][$_POST['to']]);
				$this->Chat->create();
				$this->Chat->save(array('Chat'=>array('from_name'=>$from,'to_name'=>$to,'message'=>$message,'sent'=>$this->currentDateTime,'session_id'=>$this->sessionId)));
				echo "1";
			}
			else
			{
				$id=$memberArr['Member']['id'];
				$age=$memberArr['Member']['age'];
				if($age==NULL){
				 $age=0;
				}
				$url=Router::url(array('controller'=>'../Viewprofiles','action'=>'view',$id,$age));
				echo '<a href="javascript:void(0);" onclick="show_modal(\''.$url.'\');">'.__('Please view %s profile & click on show contact link',$to).'</a>';
			}
			
		}
		else
		{
			echo __('Invalid Post');
		}
		exit(0);
	}
	function closeChat()
	{
		$this->autoRender=false;
		$this->request->onlyAllow('ajax');
		unset($_SESSION['openChatBoxes'][$_POST['chatbox']]);		
		echo "1";
		exit(0);
	}
	function initializeChat()
	{
		$this->autoRender=false;
		$this->request->onlyAllow('ajax');
		$this->loadModel('Member');
		$chatBoxSessionIdArr=$this->Member->findByUserName($_POST['chatbox']);
		$chatBoxSessionId=$chatBoxSessionIdArr['Member']['session_id'];
		if($chatBoxSessionId==NULL){
			$chatBoxSessionId='';
		}
		$chatArr=$this->Chat->find('all',array('conditions'=>array('recd'=>1,'from_name'=>array($this->userName,$_POST['chatbox']),
															   'AND'=>array(array('to_name'=>array($this->userName,$_POST['chatbox']))),
															   'session_id NOT IN'=>array($this->sessionId,$chatBoxSessionId)),
								  'order'=>array('id'=>'desc'),
								  'limit'=>20));
		$chatArr=array_reverse($chatArr);
		$items = '';
		$chatBoxes = array();
		foreach($chatArr as $chat)
		{
			$chat['Chat']['message'] = $this->sanitize($chat['Chat']['message']);
			if($chat['Chat']['from_name']==$_POST['chatbox'])
			{
				$items.=json_encode(array('s'=>'0','f'=>$_POST['chatbox'],'m'=>$chat['Chat']['message'])).',';
			}
			else
			{
				$items.=json_encode(array('s'=>'0','f'=>$chat['Chat']['from_name'],'m'=>$chat['Chat']['message'])).',';
			}
		}
		$items.=$this->chatBoxSession($_POST['chatbox']);
		if ($items != '')
		{
			$items = substr($items, 0, -1);
		}
		header('Content-type: application/json');
		echo '{"username": "'.$this->userName.'","items": ['.$items.']}';
		exit(0);
	}
	function sanitize($text)
	{
		$text = htmlspecialchars($text, ENT_QUOTES);
		$text = str_replace("\n\r","\n",$text);
		$text = str_replace("\r\n","\n",$text);
		$text = str_replace("\n","<br>",$text);
		return $text;
	}
}
?>