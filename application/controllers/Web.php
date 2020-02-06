<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }
    
    public function index() {}

	public function getTopPost()
	{
		$allPostsJson = file_get_contents('https://jsonplaceholder.typicode.com/posts');
        $allPosts = json_decode($allPostsJson, true);
        
        $posts = [];
        foreach($allPosts as $p) {
            $posts[$p['id']] = $p;
            $posts[$p['id']]['comment_count'] = 0;
        }
        
        $allCommentsJson = file_get_contents('https://jsonplaceholder.typicode.com/comments');
        $allComments = json_decode($allCommentsJson, true);
        
        $largestCount = 0;
        foreach($allComments as $c) {
            if(isset($posts[$c['postId']])) {
                $posts[$c['postId']]['comment_count']++;
                $latestCount = $posts[$c['postId']]['comment_count'];
                
                if($latestCount > $largestCount) {
                    $largestCount = $latestCount;
                }
            }
        }
        
        $topPosts = [];
        foreach($posts as $p) {
            if($p['comment_count'] == $largestCount) {
                $topPosts[] = [
                    'post_id' => $p['id'],
                    'post_title' => $p['title'],
                    'post_body' => $p['body'],
                    'total_number_of_comments' => $p['comment_count']
                ];
            }
        }
        
        $this->success($topPosts);
	}
    
    public function searchComments() {
        $allCommentsJson = file_get_contents('https://jsonplaceholder.typicode.com/comments');
        $allComments = json_decode($allCommentsJson, true);
        
        $searchResult = [];
        if(isset($_GET['postId'])) {
            foreach($allComments as $key => $c) {
                if($c['postId'] == $_GET['postId']) {
                    $searchResult[] = $c;
                    unset($allComments[$key]);
                }
            }
        }
        
        if(isset($_GET['id'])) {
            foreach($allComments as $key => $c) {
                if($c['id'] == $_GET['id']) {
                    $searchResult[] = $c;
                    unset($allComments[$key]);
                }
            }
        }
        
        if(isset($_GET['name'])) {
            foreach($allComments as $key => $c) {
                if(strpos($c['name'], urldecode($_GET['name'])) !== false) {
                    $searchResult[] = $c;
                    unset($allComments[$key]);
                }
            }
        }
        
        if(isset($_GET['email'])) {
            foreach($allComments as $key => $c) {
                if($c['email'] == urldecode($_GET['email'])) {
                    $searchResult[] = $c;
                    unset($allComments[$key]);
                }
            }
        }
        
        if(isset($_GET['body'])) {
            foreach($allComments as $key => $c) {
                if(strpos($c['body'], urldecode($_GET['body'])) !== false) {
                    $searchResult[] = $c;
                    unset($allComments[$key]);
                }
            }
        }
        
        $this->success($searchResult);
    }
}
