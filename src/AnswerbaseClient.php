<?php namespace Packback\Answerbase;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

/**
 * This is a client that allows use of the Answerbase API in PHP.
 * Not all API endpoints currently have methods - those unimplemented are commented out.
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
     * These methods are available to those that have the Professional plan or higher. These are all read-only API endpoints.
     */

    // public function getQuestionsList() {}

    public function getQuestionsByCategoryId($category_id = null, $parameters = [])
    {
        $defaults = [
            'categoryIds' => $category_id,
            'fullquestiondetails' => 'true',
            'maxresults' => '0',
        ];

        $response = $this->get('getquestionslist.aspx', array_merge($defaults, $parameters));

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    // public function searchQuestions() {}
    // public function getSimilarQuestions() {}
    // public function getQuestion() {}
    // public function getFeaturedQuestion() {}
    // public function getFeaturedQuestions() {}
    // public function getUpdatedQuestions() {}
    // public function getRecentlyViewedQuestionsByUser() {}
    // public function getQuestionsAskedByUser() {}
    // public function getQuestionsAnsweredByUser() {}
    // public function getQuestionswithHighestRatedAnswersByUser() {}
    // public function getQuestionsFollowedByUser() {}
    // public function getQuestionsCommentedByUser() {}
    // public function getQuestionsAskedDirectlytoUser() {}
    // public function getAnswer() {}
    // public function getComment() {}
    // public function getTopExperts() {}
    // public function getStaffExperts() {}
    // public function getUser() {}

    public function getUserByEmail($email = '')
    {
        $response = $this->get('getuser.aspx', ['useremail' => $email]);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    // public function getUserPointSummary() {}
    // public function getUserSubscriptions() {}
    // public function getUsers() {}
    // public function getFeaturedExpert() {}

    public function getCategories($parameters = [])
    {
        $defaults = [
            'maxresults' => '0',
            'restrictToFirstLevel' => 'true',
        ];

        $response = $this->get('getcategories.aspx', array_merge($defaults, $parameters));

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    // public function getCategory() {}
    // public function getTags() {}
    // public function getTag() {}
    // public function searchTags() {}

    /**
     * ADVANCED API METHODS
     *
     * These methods are available to those that have the Business plan or higher. These are all API endpoints that write data to Answerbase.
     */

    // public function askQuestion() {}
    // public function registerUser() {}

    public function createUser($parameters = [])
    {
        $response = $this->post('registeruser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return false;
    }

    // public function removeFollowedQuestion() {}
    // public function addUserSubscriptions() {}
    // public function removeUserSubscriptions() {}
    // public function reportQuestion() {}
    // public function reportAnswer() {}
    // public function reportComment() {}
    // public function postAnswer() {}
    // public function postComment() {}
    // public function postRelatedContent() {}
    // public function postImage() {}
    // public function voteAnswer() {}
    // public function voteComment() {}
    // public function updateQuestion() {}
    // public function updateAnswer() {}
    // public function updateComment() {}

    public function updateUserData($parameters = [])
    {
        $response = $this->post('updateuserdata.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return false;
    }

    public function updateUserPermissions($parameters = [])
    {
        $response = $this->post('updateuserpermissions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return false;
    }

    // public function updateEmailSettings() {}
    // public function followQuestion() {}

    private function get($path = '', $parameters = [])
    {
        $this->parameters = array_merge($this->parameters, $parameters);
        $query = http_build_query($this->parameters);

        try {
            return $this->client->request('GET', $path.'?'.$query);
        } catch (\Exception $e) {
            return false;
        }
    }

    private function getData(Response $response)
    {
        return json_decode($response->getBody()->getContents());
    }

    private function post($path = '', $parameters = [])
    {
        $query = http_build_query($this->parameters);

        try {
            return $this->client->request('POST', $path.'?'.$query, [
                'form_params' => $parameters
            ]);
        } catch (\Exception $e) {
            return false;
        }
    }
}
