<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');
App::import('Vendor', 'HTMLPARSER', array('file' => 'simple_html_dom.php'));

/**
 * Search Controller
 *
 */
class SearchesController extends AppController {
    /**
 * Controller name
 *
 * @var string
 */
	public $name = 'Searches';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @return void
 */
	public function index() {
            $this->set('result', array());
        }
        
        public function searchJson(){
            if (isset($_GET['searchToken'])) {
                $searchToken = $_GET['searchToken'];
                $url = "http://api.chefkoch.de/api/1.0/api-recipe-search.php?Suchbegriff=";

                $json_url = $url.$searchToken;
                $ch = curl_init( $json_url );

                // Configuring curl options
                $options = array(
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_PROXY => 'http://10.158.0.79:80'                    
                );

                // Setting curl options
                curl_setopt_array( $ch, $options );
                
                // Getting jSON result string
                $jsonResponse = curl_exec($ch); 
                
                // Close the curl handler
                curl_close($ch);
           
                $this->set('result', json_decode($jsonResponse, TRUE));
            }
            else {
                $this->set('result', array());
            }
            $this->render('index');
        }
        
        public function searchWikis(){
            if (isset($_GET['searchToken'])) {
                
                $searchToken = urlencode($_GET['searchToken']);
                $searchUrls = array("http://fbiuk.kvr.muenchen.de/index.php","http://limux.kvr.muenchen.de/index.php");
                $resultArray = array();
                
                foreach ($searchUrls as $url) {
                /**Add some wiki search spezific search configurations
                 * Preconfigured is to search in Namespaces "Artikel" and "MediaWiki"
                 * Display 500 search results max
                 */                 
                    $html = $url."?title=Spezial:Search&ns0=1&ns8=1&redirs=0&searchx=1&search=$searchToken&limit=500&offset=0";
                    //debug($html);
                // Query results from source Wiki
                    $ch = curl_init( $html );
                // Configuring curl options
                    $options = array(
                        CURLOPT_RETURNTRANSFER => true                  
                    );
                // Setting curl options
                    curl_setopt_array( $ch, $options );
                // Getting jSON result string
                    $htmlResponse = curl_exec($ch);
                // Close the curl handler
                    curl_close($ch);
                // Init simple html dom to query the search results from html response
                    $html = new simple_html_dom();
                    $html->load($htmlResponse);    
                // find all search results and write them to an array
                    foreach ($html->find('ol li a') as $erg) { 
                        //echo $erg->parent()->plaintext;
                        //echo "<br>";
                        $resultTitle = $erg->plaintext;
                        $resultText = $erg->parent()->plaintext;
                        $link = str_replace('/index.php',$url,$erg->href);
                        array_push($resultArray, array('resultTitle'=>$resultTitle,'link'=>$link,'resultText'=>$resultText));
                    }
                }
                $this->set('searchToken', $searchToken);
                $this->set('results', $resultArray);                
            }
            else {
                $this->set('results', array());
            }
            $this->render('searchResults');
        }
        
        public function viewResult() {
            if (isset($_GET['url'])) {
                $url = $_GET['url'];
                $this->set('url', $url);
                $this->render('index');
            } else {
                $this->render('searchResults');
            }
        }
}
