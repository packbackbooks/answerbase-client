<?php

use Mockery as m;
use Packback\Answerbase\AnswerbaseClient;

class AnswerbaseClientTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $config = [
            'api_key' => uniqid(),
            'base_uri' => 'http://example.answerbase.com/api/',
            'timeout' => '10.0',
        ];

        $this->client = new AnswerbaseClient($config);

        $this->client->client = m::mock('GuzzleHttp\Client');
    }

    public function testItCanCreateUser()
    {
        $attributes = [
            'useremail' => uniqid(),
        ];

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $query = http_build_query($this->client->parameters);

        $this->client->client->shouldReceive('request')
            ->with('POST', 'registeruser.aspx?'.$query, [
                'form_params' => $attributes
            ])
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getContents')
            ->once()
            ->andReturn($this->generateJsonUserResponse());

        $result = $this->client->createUser($attributes);

        $this->assertNotNull($result->user);
    }

    public function testItCanUpdateUserPermissions()
    {
        $attributes = [
            'useremail' => uniqid(),
        ];

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $query = http_build_query($this->client->parameters);

        $this->client->client->shouldReceive('request')
            ->with('POST', 'updateuserpermissions.aspx?'.$query, [
                'form_params' => $attributes
            ])
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getContents')
            ->once()
            ->andReturn(json_encode(true));

        $result = $this->client->updateUserPermissions($attributes);

        $this->assertTrue($result);
    }

    public function testItCanGetUserByEmailWhenUserExists()
    {
        $email = uniqid();

        $requestString = 'getuser.aspx?'.$this->buildRequestString(['useremail' => $email]);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonUserResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getContents')
            ->once()
            ->andReturn($jsonResponse);

        $result = $this->client->getUserByEmail($email);

        $this->assertNotNull($result->user);
    }

    public function testItCanNotGetUserByEmailWhenUserNotExists()
    {
        $email = uniqid();

        $requestString = 'getuser.aspx?'.$this->buildRequestString(['useremail' => $email]);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonUserResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('400');

        $result = $this->client->getUserByEmail($email);

        $this->assertEmpty($result);
    }

    public function testItCanNotGetUserByEmailWhenExceptionThrown()
    {
        $email = uniqid();

        $requestString = 'getuser.aspx?'.$this->buildRequestString(['useremail' => $email]);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonUserResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andThrow('\Exception');

        $result = $this->client->getUserByEmail($email);

        $this->assertEmpty($result);
    }

    public function testItCanGetCategoriesWhenExist()
    {
        $defaults = [
            'maxresults' => '0',
            'restrictToFirstLevel' => 'true',
        ];
        $requestString = 'getcategories.aspx?'.$this->buildRequestString($defaults);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonCategoriesResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getContents')
            ->once()
            ->andReturn($jsonResponse);

        $result = $this->client->getCategories();

        $this->assertNotNull($result->categories);
    }

    public function testItCanNotGetCategoriesWhenNotExists()
    {
        $defaults = [
            'maxresults' => '0',
            'restrictToFirstLevel' => 'true',
        ];
        $requestString = 'getcategories.aspx?'.$this->buildRequestString($defaults);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonCategoriesResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('400');

        $result = $this->client->getCategories();

        $this->assertEmpty($result);
    }

    public function testItCanGetQuestionsByCategoryIdWhenExist()
    {
        $category_id = uniqid();
        $defaults = [
            'categoryIds' => $category_id,
            'fullquestiondetails' => 'true',
            'maxresults' => '0',
        ];
        $requestString = 'getquestionslist.aspx?'.$this->buildRequestString($defaults);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonQuestionsResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('200');
        $response->shouldReceive('getBody')
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getContents')
            ->once()
            ->andReturn($jsonResponse);

        $result = $this->client->getQuestionsByCategoryId($category_id);

        $this->assertNotNull($result->searchResult);
    }

    public function testItCanNotGetQuestionsByCategoryIdWhenNotExist()
    {
        $category_id = uniqid();
        $defaults = [
            'categoryIds' => $category_id,
            'orderby' => 'newest',
            'fullquestiondetails' => 'true',
            'maxresults' => '0',
        ];
        $requestString = 'getquestionslist.aspx?'.$this->buildRequestString($defaults);

        $response = m::mock('GuzzleHttp\Psr7\Response');

        $jsonResponse = $this->generateJsonQuestionsResponse();

        $this->client->client->shouldReceive('request')
            ->with('GET', $requestString)
            ->once()
            ->andReturn($response);
        $response->shouldReceive('getStatusCode')
            ->once()
            ->andReturn('400');

        $result = $this->client->getQuestionsByCategoryId($category_id);

        $this->assertEmpty($result);
    }

    private function buildRequestString($params = [])
    {
        return http_build_query(
            array_merge($this->client->parameters, $params)
        );
    }

    private function generateJsonCategoriesResponse($params = [])
    {
        return '{
            "categories": {
                "@name": "A History of Modern Computing (Halsted)",
                "@id": "298974"
            }
        }';
    }

    private function generateJsonQuestionsResponse($params = [])
    {
        return '{
            "searchResult": {
                "tags": null,
                "questions": null
            }
        }';
    }

    private function generateJsonUserResponse($params = [])
    {
        return '
        {
          "user": {
            "@username": "KarlHughes",
            "@id": "1588842",
            "@sso_userid": "",
            "@firstname": "Karl",
            "@lastname": "Hughes",
            "@title": "Head of Engineering, Packback",
            "@organization": "",
            "@website": "",
            "@twitterUsername": "",
            "@address": "",
            "@city": "",
            "@region": "",
            "@country": "",
            "@profileEmail": "karl@packback.co"
          }
        }';
    }
}
