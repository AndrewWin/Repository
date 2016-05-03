<?php
 
	class WEditModal extends CWidget {
		
		public function init() {
			$editForm = new Main;
			$this->render('application.views.site.modal.editForm', array('editForm' => $editForm));
		}        
		
	}
 