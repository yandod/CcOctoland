<?php
	class HomeController extends CcOctolandAppController {
	public $uses = array('Issue');
	
	public $images = array(
		'original' => array(
			'img' => 'original.jpg',
			'name' => 'Original'
		),
		'class-act' => array(
			'img' => 'class-act.jpg',
			'name' => 'Class Act'
		),
		'octobiwan' => array(
			'img' => 'octobiwan.jpg',
			'name' => 'Octobi Wan Catnobi'
		),
		'puppeteer' => array(
			'img' => 'puppeteer.jpg',
			'name' => 'Puppeteer'
		),
		'scottocat' => array(
			'img' => 'scottocat.jpg',
			'name' => 'Scottocat'
		),
		'benevocats' => array(
			'img' => 'benevocats.jpg',
			'name' => 'Benevocats'
		),
		'forktocat' => array(
			'img' => 'forktocat.jpg',
			'name' => 'Forktocat'
		),
		'repocat' => array(
			'img' => 'repo.jpg',
			'name' => 'Repocat'
		),
	);

	public function beforeFilter() {
		parent::beforeFilter();
		$this->require_login();
	}
  
	public function index() {
		
		$this->set('images', $this->getList());
		$this->set('count',$this->Session->read('octocount'));
	}
	
	public function gacha() {
		$idx = rand(1, 100);
		
		switch (true) {
			case $idx < 5:
				$num = 1;
				break;
			case $idx < 10:
				$num = 2;
				break;
			case $idx < 15:
				$num = 3;
				break;
			default:
				$num = rand(4,7);
				
		}
		$count = $this->Session->read('octocount');
		$count++;
		$this->Session->write('octocount', $count);
		
		$this->unlock($num);
		$this->checkComplete();
		$this->redirect('index');
	}
	
	private function unlock($idx) {
		$list = $this->getList();
		
		$i = 0;
		foreach ($this->images as $row) {
			if ($i === $idx) {
				$class = 'flash flash_notice';
				if ( $list[$i]['img'] == $row['img'] ) {
					$class = 'flash flash_error';
				}
				
				$list[$i] = $row;
				$this->Session->setFlash(
					__d('cc_octoland', 'You got ') . $row['name'],
					'default',
					array('class'=>$class)
				);
			}
			$i++;
		}
		
		$this->Session->write('octoland', $list);
	}
	
	private function getList() {
		
		$default = array(
			'img' => 'shadow.png',
			'name' => '????'
		);

		$list = $this->Session->read('octoland');
		if ( empty($list)) {
			$list = array(
				$default,
				$default,
				$default,
				$default,
				$default,
				$default,
				$default,
				$default,
			);
		}
		
		return $list;
	}
	
	private function checkComplete() {
		$list = $this->getList();
		foreach ($list as $idx => $row) {
			if ($idx == 0) {
				if ($row['name'] !== '????') {
					return;
				}
				continue;
			}
			if ($row['name'] == '????') {
				return;
			}
		}
		$this->unlock(0);
		return;
	}
}

