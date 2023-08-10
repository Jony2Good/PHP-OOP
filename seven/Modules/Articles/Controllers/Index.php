<?php

namespace Modules\Articles\Controllers;

use Modules\_base\Controller as BaseController;
use Modules\Articles\Models\Index as ModelsIndex;
use System\Exceptions\Exc404;
use System\Exceptions\ExcValidation;
use System\Template;

class Index extends BaseController{
	protected ModelsIndex $model;

	public function __construct(){
		parent::__construct();
		$this->model = ModelsIndex::getInstance();
	}

	public function index(){
		$articles = $this->model->all();
		
		$this->title = 'Home page';
		$this->content = $this->view->render('Articles/Views/v_all.twig', [
			'articles' => $articles
		]);
	}

	public function item(){
		$this->title = 'Article page';
		$id = (int)$this->env['params']['id'];
		$article = $this->model->get($id);

		if($article === null){
			throw new Exc404('article not found');
		}

		$this->content = $this->view->render('Articles/Views/v_item.twig', [
			'article' => $article
		]);
	}

	public function add(){
		$this->checkAccess();
		$this->title = 'Article add';
		$fields = [];
		$errors = [];

		if($this->env['server']['REQUEST_METHOD'] == 'POST'){
			try{
				$fields = [
					'title' => $this->env['post']['title'], 
					'content' => $this->env['post']['content'], 
					'id_user' => $this->user['id_user']
				];
				
				$id = $this->model->add($fields);
				header("Location: " . BASE_URL . "article/$id");
				exit();
			}
			catch(ExcValidation $e){
				$bag = $e->getBag();
				$errors = $bag->firstOfAll();
			}
		}

		$this->content .=  $this->view->render('Articles/Views/v_add.twig', [
			'fields' => $fields,
			'errors' => $errors
		]);
	}

	public function edit(){
		$this->checkAccess();
		$this->title = 'Article edit';
		$id = (int)$this->env['params']['id'];
		$article = $this->model->get($id);

		// user , his article
		if($article === null || $article['id_user'] != $this->user['id_user']){
			throw new Exc404('article not found');
		}

		$fields = [ 'title' => $article['title'], 'content' => $article['content'] ];
		$errors = [];

		if($this->env['server']['REQUEST_METHOD'] == 'POST'){
			try{
				$fields = [
					'title' => $this->env['post']['title'], 
					'content' => $this->env['post']['content']
				];
				
				$this->model->edit($id, $fields);
				header("Location: " . BASE_URL . "article/$id");
				exit();
			}
			catch(ExcValidation $e){
				$bag = $e->getBag();
				$errors = $bag->firstOfAll();
			}
		}

		$this->content .=  $this->view->render('Articles/Views/v_edit.twig', [
			'fields' => $fields,
			'errors' => $errors
		]);
	}

	public function remove(){
		var_dump($this->model->remove(1));
	}
	
}