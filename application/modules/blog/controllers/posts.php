<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use blog\models\Post;

class Posts extends MX_Controller {
  
	public function index()
	{
		$this->load->helper('url');
		
		$this->load->view('post_index');
	}

	public function install()
	{
		// Load Doctrine library
		$this->load->library('doctrine');
		
		$this->doctrine->tool->createSchema(array(
			$this->doctrine->em->getClassMetadata('blog\models\Post')));
			
		echo 'Post schema created';
	}

	public function create()
	{
		// Load Doctrine library
		$this->load->library('doctrine');
		
		// Create new post
		$post = new Post;
		$post->title('Example post');
		$post->content('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>');
		$post->visits(0);

		// Save post in db
		$this->doctrine->em->persist($post);
		$this->doctrine->em->flush();
		
		echo 'Post created';
	}
	
	public function find($id)
	{
		// Load Doctrine library
		$this->load->library('doctrine');
		
		// Find post
		$post = $this->doctrine->em->find('blog\models\Post', $id);
		
		// Show post
		if ($post) {
			$post->addVisit();
			$this->doctrine->em->persist($post);
			$this->doctrine->em->flush();
			
			$this->load->view('post', array('post' => $post));
		}
		
		else
			show_404();
	}
	
	public function remove($id)
	{
		// Load Doctrine library
		$this->load->library('doctrine');
		
		// Find post
		$post = $this->doctrine->em->find('blog\models\Post', $id);
		
		// Remove post
		if ($post) {
			$this->doctrine->em->remove($post);
			$this->doctrine->em->flush();
			
			echo 'Post removed';
		}
		
		else
			show_404();
	}
	

}

/* End of file posts.php */
/* Location: ./application/modules/blog/controllers/posts.php */