<?php
class PostsController extends AppController {
	public $scaffold = 'admin';

	
	public $helpers = array("Html", 'Form', 'Session');
	public $components = array('Session');
	
	public function index() {
		$this->set('posts', $this->Post->find('all'));
	}
	
	public function view($id = null) {
		$this->Post->id = $id;
		$this->set('post',  $this->Post->read());
	}
	
	public function add() {
		if($this->request->is('post')) {
			$this->Post->create();
			if($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been saved.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('unable to add you post.');
			}
		}
	}
	
	public function edit($id = null) {
		$this->Post->id = $id;
		if($this->request->is('get')) {
			$this->request->data = $this->Post->read();
		} else {
			if($this->Post->save($this->request->data)) {
				$this->Session->setFlash('Your post has been updated.');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Unable to update your post.');
			}
		}
	}
	
	public function delete($id) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		} else {
			if($this->Post->delete($id)) {
				$this->Session->setFlash('The post with id:' . $id . ' has been deleted.');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}