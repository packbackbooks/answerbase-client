<?php namespace Packback\Answerbase;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

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

    public function getQuestionsList($parameters = [])
    {
        $response = $this->get('getquestionslist.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

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

    public function searchQuestions($parameters = [])
    {
        $response = $this->get('searchquestions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getSimilarQuestions($parameters = [])
    {
        $response = $this->get('getsimilarquestions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestion($parameters = [])
    {
        $response = $this->get('getquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getFeaturedQuestion($parameters = [])
    {
        $response = $this->get('getfeaturedquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getFeaturedQuestions($parameters = [])
    {
        $response = $this->get('getfeaturedquestions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getUpdatedQuestions($parameters = [])
    {
        $response = $this->get('getupdatedquestions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getRecentlyViewedQuestionsByUser($parameters = [])
    {
        $response = $this->get('getquestionsviewedbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionsAskedByUser($parameters = [])
    {
        $response = $this->get('getquestionsaskedbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionsAnsweredByUser($parameters = [])
    {
        $response = $this->get('getquestionsansweredbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionswithHighestRatedAnswersByUser($parameters = [])
    {
        $response = $this->get('getquestionswithhighestratedanswersbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionsFollowedByUser($parameters = [])
    {
        $response = $this->get('getquestionswatchedbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionsCommentedByUser($parameters = [])
    {
        $response = $this->get('getquestionscommentedbyuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getQuestionsAskedDirectlytoUser($parameters = [])
    {
        $response = $this->get('getquestionsaskeddirectlytouser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getAnswer($parameters = [])
    {
        $response = $this->get('getanswer.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getComment($parameters = [])
    {
        $response = $this->get('getcomment.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getTopExperts($parameters = [])
    {
        $response = $this->get('gettopexperts.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getStaffExperts($parameters = [])
    {
        $response = $this->get('getstaffexperts.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getUser($parameters = [])
    {
        $response = $this->get('getuser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getUserByEmail($email = '')
    {
        $response = $this->get('getuser.aspx', ['useremail' => $email]);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getUserPointSummary($parameters = [])
    {
        $response = $this->get('getuserpoints.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }
    public function getUserSubscriptions($parameters = [])
    {
        $response = $this->get('getusersubscriptions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }
    public function getUsers($parameters = [])
    {
        $response = $this->get('getusers.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }
    public function getFeaturedExpert($parameters = [])
    {
        $response = $this->get('getfeaturedexpert.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

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

    public function getCategory($parameters = [])
    {
        $response = $this->get('getcategory.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getTags($parameters = [])
    {
        $response = $this->get('gettags.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function getTag($parameters = [])
    {
        $response = $this->get('gettag.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function searchTags($parameters = [])
    {
        $response = $this->get('searchtags.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    /**
     * ADVANCED API METHODS
     *
     * These methods are available to those that have the Business plan or higher.
     * These are all API endpoints that write data to Answerbase.
     */

    public function askQuestion($parameters = [])
    {
        $response = $this->get('askquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function registerUser($parameters = [])
    {
        return $this->createUser($parameters);
    }

    public function createUser($parameters = [])
    {
        $response = $this->post('registeruser.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return false;
    }

    public function removeFollowedQuestion($parameters = [])
    {
        $response = $this->post('removewatchedquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function addUserSubscriptions($parameters = [])
    {
        $response = $this->post('addusersubscriptions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function removeUserSubscriptions($parameters = [])
    {
        $response = $this->post('removeuserubscriptions.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function reportQuestion($parameters = [])
    {
        $response = $this->post('reportquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function reportAnswer($parameters = [])
    {
        $response = $this->post('reportanswer.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function reportComment($parameters = [])
    {
        $response = $this->post('reportcomment.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function postAnswer($parameters = [])
    {
        $response = $this->post('postanswer.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function postComment($parameters = [])
    {
        $response = $this->post('postcomment.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function postRelatedContent($parameters = [])
    {
        $response = $this->post('postrelatedcontent.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function postImage($parameters = [])
    {
        $response = $this->post('postimage.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function voteAnswer($parameters = [])
    {
        $response = $this->post('voteanswer.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function voteComment($parameters = [])
    {
        $response = $this->post('votecomment.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function updateQuestion($parameters = [])
    {
        $response = $this->post('updatequestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function updateAnswer($parameters = [])
    {
        $response = $this->post('updateanswer.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function updateComment($parameters = [])
    {
        $response = $this->post('updatecomment.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

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

    public function updateEmailSettings($parameters = [])
    {
        $response = $this->post('updateuseremailsettings.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function followQuestion($parameters = [])
    {
        $response = $this->post('watchquestion.aspx', $parameters);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

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
