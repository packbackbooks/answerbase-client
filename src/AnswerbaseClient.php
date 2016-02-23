<?php namespace Packback\Answerbase;

use GuzzleHttp\Client as HttpClient;

/**
 * This is a client that allows use of the Answerbase API in PHP.
 * All of the endpoints have a corresponding method, though each is just a wrapper.
 */
class AnswerbaseClient
{
    public $client;
    public $parameters;

    public function __construct($config = [])
    {
        $this->parameters = [
            'apikey' => $config['api_key'],
            'format' => 'json',
        ];
        $this->client = new HttpClient([
            'base_uri' => $config['base_uri'],
            'timeout'  => $config['timeout'],
        ]);
    }

    /**
     * STANDARD API METHODS
     *
     * These methods are available to those that have the Professional plan or higher.
     * These are all read-only API endpoints.
     */

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsList($parameters = [])
    {
        return $this->request('get', 'getquestionslist.aspx', $parameters);
    }

    public function getQuestionsByCategoryId($category_id = null, $parameters = [])
    {
        $defaults = [
            'categoryIds' => $category_id,
            'fullquestiondetails' => 'true',
            'maxresults' => '0',
        ];
        return $this->request('get', 'getquestionslist.aspx', array_merge($defaults, $parameters));
    }

    /**
     * @codeCoverageIgnore
     */
    public function searchQuestions($parameters = [])
    {
        return $this->request('get', 'searchquestions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getSimilarQuestions($parameters = [])
    {
        return $this->request('get', 'getsimilarquestions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestion($parameters = [])
    {
        return $this->request('get', 'getquestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getFeaturedQuestion($parameters = [])
    {
        return $this->request('get', 'getfeaturedquestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getFeaturedQuestions($parameters = [])
    {
        return $this->request('get', 'getfeaturedquestions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUpdatedQuestions($parameters = [])
    {
        return $this->request('get', 'getupdatedquestions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getRecentlyViewedQuestionsByUser($parameters = [])
    {
        return $this->request('get', 'getquestionsviewedbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsAskedByUser($parameters = [])
    {
        return $this->request('get', 'getquestionsaskedbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsAnsweredByUser($parameters = [])
    {
        return $this->request('get', 'getquestionsansweredbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionswithHighestRatedAnswersByUser($parameters = [])
    {
        return $this->request('get', 'getquestionswithhighestratedanswersbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsFollowedByUser($parameters = [])
    {
        return $this->request('get', 'getquestionswatchedbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsCommentedByUser($parameters = [])
    {
        return $this->request('get', 'getquestionscommentedbyuser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getQuestionsAskedDirectlytoUser($parameters = [])
    {
        return $this->request('get', 'getquestionsaskeddirectlytouser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getAnswer($parameters = [])
    {
        return $this->request('get', 'getanswer.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getComment($parameters = [])
    {
        return $this->request('get', 'getcomment.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTopExperts($parameters = [])
    {
        return $this->request('get', 'gettopexperts.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getStaffExperts($parameters = [])
    {
        return $this->request('get', 'getstaffexperts.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUser($parameters = [])
    {
        return $this->request('get', 'getuser.aspx', $parameters);
    }

    public function getUserByEmail($email = '')
    {
        return $this->request('get', 'getuser.aspx', ['useremail' => $email]);
    }

    public function getUserByUsername($username = '')
    {
        return $this->request('get', 'getuser.aspx', ['username' => $username]);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUserPointSummary($parameters = [])
    {
        return $this->request('get', 'getuserpoints.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUserSubscriptions($parameters = [])
    {
        return $this->request('get', 'getusersubscriptions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getUsers($parameters = [])
    {
        return $this->request('get', 'getusers.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getFeaturedExpert($parameters = [])
    {
        return $this->request('get', 'getfeaturedexpert.aspx', $parameters);
    }

    public function getCategories($parameters = [])
    {
        $defaults = [
            'maxresults' => '0',
            'restrictToFirstLevel' => 'true',
        ];

        return $this->request('get', 'getcategories.aspx', array_merge($defaults, $parameters));
    }

    /**
     * @codeCoverageIgnore
     */
    public function getCategory($parameters = [])
    {
        return $this->request('get', 'getcategory.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTags($parameters = [])
    {
        return $this->request('get', 'gettags.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTag($parameters = [])
    {
        return $this->request('get', 'gettag.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function searchTags($parameters = [])
    {
        return $this->request('get', 'searchtags.aspx', $parameters);
    }

    /**
     * ADVANCED API METHODS
     *
     * These methods are available to those that have the Business plan or higher.
     * These are all API endpoints that write data to Answerbase.
     */

    /**
     * @codeCoverageIgnore
     */
    public function askQuestion($parameters = [])
    {
        return $this->request('get', 'askquestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function registerUser($parameters = [])
    {
        return $this->createUser($parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function createUser($parameters = [])
    {
        return $this->request('post', 'registeruser.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function removeFollowedQuestion($parameters = [])
    {
        return $this->request('post', 'removewatchedquestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function addUserSubscriptions($parameters = [])
    {
        return $this->request('post', 'addusersubscriptions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function removeUserSubscriptions($parameters = [])
    {
        return $this->request('post', 'removeuserubscriptions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function reportQuestion($parameters = [])
    {
        return $this->request('post', 'reportquestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function reportAnswer($parameters = [])
    {
        return $this->request('post', 'reportanswer.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function reportComment($parameters = [])
    {
        return $this->request('post', 'reportcomment.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function postAnswer($parameters = [])
    {
        return $this->request('post', 'postanswer.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function postComment($parameters = [])
    {
        return $this->request('post', 'postcomment.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function postRelatedContent($parameters = [])
    {
        return $this->request('post', 'postrelatedcontent.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function postImage($parameters = [])
    {
        return $this->request('post', 'postimage.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function voteAnswer($parameters = [])
    {
        return $this->request('post', 'voteanswer.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function voteComment($parameters = [])
    {
        return $this->request('post', 'votecomment.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateQuestion($parameters = [])
    {
        return $this->request('post', 'updatequestion.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateAnswer($parameters = [])
    {
        return $this->request('post', 'updateanswer.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateComment($parameters = [])
    {
        return $this->request('post', 'updatecomment.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateUserData($parameters = [])
    {
        return $this->request('post', 'updateuserdata.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateUserPermissions($parameters = [])
    {
        return $this->request('post', 'updateuserpermissions.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function updateEmailSettings($parameters = [])
    {
        return $this->request('post', 'updateuseremailsettings.aspx', $parameters);
    }

    /**
     * @codeCoverageIgnore
     */
    public function followQuestion($parameters = [])
    {
        return $this->request('post', 'watchquestion.aspx', $parameters);
    }

    private function request($method = 'get', $endpoint = '', $parameters = [])
    {
        if ($method=='post') {
            $response = $this->post($endpoint, $parameters);
        } else {
            $response = $this->get($endpoint, $parameters);
        }

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        // an error occured!
        return null;
    }

    private function get($path = '', $parameters = [])
    {
        $this->parameters = array_merge($this->parameters, $parameters);
        $query = http_build_query($this->parameters);

        return $this->client->request('GET', $path.'?'.$query);
    }

    private function getData($response)
    {
        return json_decode($response->getBody()->getContents());
    }

    private function post($path = '', $parameters = [])
    {
        $query = http_build_query($this->parameters);

        return $this->client->request('POST', $path.'?'.$query, [
            'form_params' => $parameters
        ]);
    }
}
