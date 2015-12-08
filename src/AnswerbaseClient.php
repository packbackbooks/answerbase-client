<?php namespace Packback\Answerbase;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Psr7\Response;

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

    public function createUser($attributes = [])
    {
        $response = $this->post('registeruser.aspx', $attributes);

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

    public function getUserByEmail($email = '')
    {
        $response = $this->get('getuser.aspx', ['useremail' => $email]);

        if ($response && $response->getStatusCode() == 200) {
            return $this->getData($response);
        }
        return [];
    }

    public function updateUserPermissions($attributes = [])
    {
        $response = $this->post('updateuserpermissions.aspx', $attributes);

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
