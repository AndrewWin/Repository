<?php
 
	class WAuthModal extends CWidget {
		
		public function init() {
			$authForm = new LoginForm;
			$this->render('application.views.site.modal.authForm', array('authForm' => $authForm));
		}        
		
	}
 