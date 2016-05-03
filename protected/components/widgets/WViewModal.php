<?php
 
	class WViewModal extends CWidget {
		
		public function init() {
			$viewModal = new Main;
			$this->render('application.views.site.modal.viewModal', array('viewModal' => $viewModal));
		}        
		
	}
 