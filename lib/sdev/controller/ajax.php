<?php
    /**
     *  Ajax Controller
     *
     *
     * @package SDEV
     * @subpackage SDEV WP
     * @since 2.0
     */

    namespace SDEV\Controller;

    class Ajax extends \SDEV\Controller implements \SDEV\Interfaces\WPXHRActionControllerInterface {

        public function __construct(){
            parent::__construct();    
        }

        public function registerActions(){
            add_action( 'wp_ajax_post_load_more', array($this, 'loadMore') );
            add_action( 'wp_ajax_nopriv_post_load_more', array($this, 'loadMore') );
        }
        
        public function loadMore(){

            $data = array(
                'success' => false,
                'message' => 'Bad Request',
                'code' => 400
            );

            if(isset($_POST['page']) && isset($_POST['page_size']) && isset($_POST['post_type'])){

                $queryHelper = new \SDEV\Helper\Query();

                $posts = $queryHelper->setQueryArgs([
                    'post_type' => $_POST['post_type'],
                    'post_status' => 'publish'
                ])
                ->setOrder('date', 'desc')
                ->setPageSize($_POST['page_size'])
                ->setPage($_POST['page'])
                ->getList();

                $final_posts = [];

                if($posts){
                    foreach($posts as $p){


                        // add your acf fields here or other fields you want, example below:

                        $final_posts[] = [
                            'id' => $p->ID,
                            'title' => $p->post_title,
                            'permalink' => get_pemalink($p->ID),
                            'custom_field' => get_field('sample_custom_field', $p->ID) // example acf field
                        ];
                    }
                }


                $data = array(
                    'success' => true,
                    'message' => 'Success',
                    'code' => 200,
                    'data' => [
                        'has_more' => (sizeOf($posts) < $_POST['page_size']) ? false : true, // return false if this is the last page
                        'posts' => $final_posts,
                        'request' => $_POST
                    ]
                );


            }

            echo json_encode($data);
            exit;

        }

    }

?>