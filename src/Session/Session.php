<?php
	namespace App\Session;
	use Symfony\Component\HttpFoundation\Session\SessionInterface;

	class Session {
		private $session;
		public function __construct(SessionInterface $session) {$this->session = $session;}
		public function set($key, $value) {$this->session->set($key, $value);}
		public function get($key) {return $this->session->get($key);}
		public function clear($key) {return $this->session->remove($key);}
	}
?>