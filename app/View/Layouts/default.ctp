<!DOCTYPE html>
<html lang="<?php echo$configLanguage;?>" dir="<?php echo$dirType;?>">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="google-translate-customization" content="839d71f7ff6044d0-328a2dc5159d6aa2-gd17de6447c9ba810-f">
	<?php echo $this->Html->charset();?>
	<title><?php echo $metaTitle;?></title>
	<meta name="keyword" content="<?php echo$metaKeyword;?>"/>
	<meta name="description" content="<?php echo$metaContent;?>"/>
	<?php 
		echo $this->Html->meta('icon');		
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Oswald:300,400,700');
		echo $this->Html->css('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700');
		echo $this->Html->css('/design700/css/font-awesome.min.css');
		echo $this->Html->css('/design700/css/bootstrap-3.1.1.min.css');
		echo $this->Html->css('/design700/css/flexslider.css');
		echo $this->Html->css('/design700/css/style.css');
		echo $this->Html->css('bootstrap-datetimepicker.min');
		if($this->Session->check('Member') && $isChat>0){echo $this->Html->css('/Chat/css/chat');
		echo $this->Html->css('/Chat/css/screen');}
		echo $this->Html->css('style');
		echo $this->fetch('meta');		
		echo $this->fetch('css');
		echo $this->Html->script('/design700/js/jquery.min.js');
		echo $this->Html->script('/design700/js/bootstrap.min.js');
		echo $this->Html->script('/design700/js/jquery.flexslider.js');
		echo $this->Html->script('moment-with-locales');
		echo $this->Html->script('bootstrap-datetimepicker.min');
		echo $this->Html->script('waiting-dialog.min');
		if($this->Session->check('Member') && $isChat>0){echo $this->Html->script('/Chat/js/chat');}
		echo $this->Html->script('custom.min');
		echo $this->fetch('script');
                echo $this->Js->writeBuffer();
		?>
<?php if($translate>0){?>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<?php }?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<script>
$(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
            $(this).toggleClass('open');       
        }
    );
});
</script>

</head>
<div id="google_translate_element"></div>

<body class="bgimage">
<!-- ============================  Navigation Start =========================== -->
 <div class="navbar navbar-inverse-blue navbar">
  <div class="pull-right" style="padding-right:10px;padding-top: 10px;">
 <?php if(strlen($contact[0])>0){?>
	    <a href="#" class="text-topheading"><i class="fa fa-phone"></i>&nbsp; <strong><span class="text-topheading"><?php echo$contact[0];?></span></strong></a><?php }?>
	    <?php if(strlen($contact[1])>0){?>
	    <a href="mailto:<?php echo$contact[1];?>"  class="text-topheading"><i class="fa fa-envelope"></i>&nbsp;<strong><span class="text-topheading"><?php echo$contact[1];?></span></strong></a><?php }?>
	    <?php if(strlen($contact[2])>0){?>
	    <a href="<?php echo$contact[2];?>"  class="text-topheading" target="_blank"><i class="fa fa-facebook"></i>&nbsp;<strong><span class="text-topheading"><?php echo __('follow on facebook');?></span></strong></a><?php }?>
	    </div>
    <!--<div class="navbar navbar-inverse-blue navbar-fixed-top">-->
      <div class="navbar-inner">
        <div class="container">
	  <div class="col-sm-2">
	  <h3><?php if(strlen($frontLogo)>0){?><?php echo $this->Html->link($this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive')),array('controller'=>'pages','action'=>''),array('escape'=>false));} else{?><?php echo$siteName;?><?php }?></h3>
	  </div>
	   <div class="col-sm-10">
               <div class="pull-right" >
          	<nav class="navbar nav_bottom" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
		  <div class="navbar-header nav_2">
		      <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">Menu
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#"></a>
		   </div> 
		   <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs" >
		        <ul class="nav navbar-nav nav_1">
			<?php   if($this->Session->check('Member')){?>
			  <li><?php echo $this->Html->link('<span class="fa fa-home"></span>&nbsp;'.__('Home'),array('controller' => 'pages'),array('escape' => false));?></li>
			    <?php }?>
			    <?php foreach($frontmenuArr as $menuName=>$menu): $menuIcon=$menu['icon'];h($menuName);if($this->params['controller']=="pages"){$this->params['controller']="";}$isMenu=true;
			     if(!$this->Session->check('Member')){
			    if($menuName=="Register" && $frontRegistration!=1){$isMenu=false;}?>
			    <li <?php if($isMenu==true){ echo (strtolower($this->params['controller'])==strtolower($menu['controller']))?>"><?php echo $this->Html->link("<span class=\"$menuIcon\"></span>&nbsp;$menuName",array('controller' => $menu['controller'],'action'=>$menu['action']),array('escape' => false));?></li>
			  <?php }} endforeach;unset($menu);unset($menuName);unset($menuIcon);?>
			  <?php foreach($contents as $menu): $menuName=h($menu['Content']['link_name']);
			  if($menu['Content']['is_url']=="External"){?><li><?php echo$this->Html->Link($menu['Content']['link_name'],$menu['Content']['url'],array('target'=>$menu['Content']['url_target']));?>></li><?php }else{?><li <?php echo (strtolower($contentId)==strtolower($menu['Content']['page_url']))?>"><?php echo $this->Html->link($menuName,array('controller' => 'Contents','action'=>'pages',$menu['Content']['page_url']),array('escape' => false));?></li><?php }?>
			  <?php endforeach;unset($menu);unset($menuName);?>
			    <?php if($this->Session->check('Member')){?>
			    <li class="dropdown">
			<?php echo $this->Html->link('<span class="fa fa-user"></span>&nbsp;'.__('My Account').'<span class="caret"></span>',array('controller' => 'Dashboards', 'action' => 'index'),array('escape' => false,'class'=>'dropdown-toggle'));?>	
		              <ul class="dropdown-menu" role="menu">
				<li><?php  echo$this->Html->link('<span class="fa fa-power-off"></span>&nbsp;'.__('Sign Out'),array('controller'=>'Users','action'=>'logout'),array('escape' => false));?></li>
			        </ul>
		            </li>
			    
			    
			    
			    <?php }?>
			      <li class="dropdown">
		              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-search"></span>&nbsp;<?php echo __('Search');?><span class="caret"></span></a>
		              <ul class="dropdown-menu" role="menu">
				<li><?php  echo$this->Html->link(__('Quick Search'),array('controller'=>'Searches','action'=>'Quick'),array('escape' => false));?></li>
			        <li><?php  echo$this->Html->link(__('Regular Search'),array('controller'=>'Searches','action'=>'Regular'),array('escape' => false));?></li>	
		                <li><?php  echo$this->Html->link(__('Advanced Search'),array('controller'=>'Searches','action'=>'Advanced'),array('escape' => false));?></li>
				<li><?php  echo$this->Html->link(__('Profile By Id'),array('controller'=>'Searches','action'=>'Profile'),array('escape' => false));?></li>
		               </ul>
		            </li>
			    <li><?php  echo$this->Html->link('<span class="fa fa-briefcase"></span>&nbsp;'.__('Plans'),array('controller'=>'Plans','action'=>'index'),array('escape' => false));?></li>
			    
			</ul>
		     </div><!-- /.navbar-collapse -->
		    </nav>
		   </div> <!-- end pull-right -->
	   </div>
          <div class="clearfix"> </div>
        </div> <!-- end container -->
      </div> <!-- end navbar-inner -->
    </div> <!-- end navbar-inverse-blue -->
<!-- ============================  Navigation End ============================ -->
<?php if(strtolower($this->params['controller']!="")){?>
<div class="container"><?php echo $this->fetch('content');?>
</div>	
<?php } else {?>
<div class="container-fluid  frontbackground"><?php echo $this->fetch('content');?></div>      
<?php }?>      
<!-- ////////////////////////////////////////////////////////////////////////////footer////////////////////////////////////////////////////////////////////////-->	
    <div class="footer">
    	<div class="container">
    		<div class="col-md-4 col_2">
    			<h4><?php echo $about['Content']['link_name'];?></h4>
    			<p>"<?php echo substr($about['Content']['main_content'],0,140);?>"&nbsp;&nbsp;
			<?php echo $this->Html->link(__('More..'),array('controller' => 'Contents','action'=>'pages',$about['Content']['page_url']),array('escape' => false));?>
			</p>
    		</div>
    		<div class="col-md-2 col_2">
    			<h4>Help & Support</h4>
    			<ul class="footer_links">
				<li>
					<?php echo $this->Html->link(__('24x7 Live help'),array('controller' => 'Contents','action'=>'pages','live-help'),array('escape' => false));?>
				</li>
    				<li>
					<?php echo $this->Html->link(__('Contact us'),array('controller' => 'Contacts','action'=>'index'),array('escape' => false));?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Success Stories'),array('controller' => 'Testimonials','action'=>'index'),array('escape' => false));?>
				</li>
    			</ul>
    		</div>
    		<div class="col-md-2 col_2">
    			<h4>Quick Links</h4>
    			<ul class="footer_links">
				<li>
					<?php echo $this->Html->link(__('Profiles'),array('controller' => 'Viewprofiles','action'=>'index'),array('escape' => false));?>
				</li>
    				
    				<li>
					<?php echo $this->Html->link(__('Privacy Policy'),array('controller' => 'Contents','action'=>'pages','privacy-policy'),array('escape' => false));?>
				</li>
    				<li>
					<?php echo $this->Html->link(__('Terms and Conditions'),array('controller' => 'Contents','action'=>'pages','terms-and-conditions'),array('escape' => false));?>
				</li>
				<li>
					<?php echo $this->Html->link(__('Services'),array('controller' => 'Contents','action'=>'pages','services'),array('escape' => false));?>
				</li>
    			</ul>
    		</div>
    		<div class="col-md-2 col_2">
    			<h4>Social</h4>
    			<ul class="footer_social">
				  <li><a href="#"><i class="fa fa-facebook fa1"> </i></a></li>
				  <li><a href="#"><i class="fa fa-twitter fa1"> </i></a></li>
				  <li><a href="#"><i class="fa fa-google-plus fa1"> </i></a></li>
			    </ul>
    		</div>
    		<div class="clearfix"> </div>
    		<div class="copy">
		      <p><?php echo __('&copy; Copyright');?> <?php echo$this->Time->format('Y',$siteTimezone);?> <?php echo$siteName;?> | <?php echo __('Time');?> <span><?php echo $this->Time->format('d-m-Y h:i:s A',$siteTimezone);?></span> </p>
	        </div>
      </div>
    </div>

    <div class="modal fade" id="targetModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-content"></div>
    </div>
    <style type="text/css">
.navbar {background:<?php echo$siteColor;?>}
.navbar-inverse-blue .navbar-inner {background:<?php echo$siteColor;?>}
.footer {background: <?php echo$siteColor;?>;}
i.fa1 {background: <?php echo$siteColor;?>;}
.btn_1 {background: <?php echo$siteColor;?>;}
.flex-control-paging li a.flex-active {background: <?php echo$siteColor;?>;}
.suceess_story-content-info p a {color: <?php echo$siteColor;?>;}
.pink-heart {color: <?php echo$siteColor;?>;}
.nbs-flexisel-nav-left:after{color: #ffffff;}
.nbs-flexisel-nav-right:after{color: #ffffff;}
i.home_1 {color: <?php echo$siteColor;?>;}
.vertical::before {background: <?php echo$siteColor;?>;}
.nav-tabs1>li.active>a, .nav-tabs1>li.active>a:focus, .nav-tabs1>li.active>a:hover {background-color: <?php echo$siteColor;?>;}
.chatboxhead {background-color: <?php echo$siteColor;?>;   border-right: 1px solid <?php echo$siteColor;?>;border-left: 1px solid <?php echo$siteColor;?>;}
</style>
<div id="chaturl" style="display: none;"><?php echo$this->Html->url(array('controller'=>'chat','action'=>'Chats'));?></div>
</body>
</html>