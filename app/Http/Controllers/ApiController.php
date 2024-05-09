<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class ApiController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function bornToday(Request $request): \Illuminate\Http\JsonResponse
    {
        define("API_HOST", "imdb8.p.rapidapi.com");
        define("API_KEY", "a8818b1e0amsh4812456ddbb8ad9p183bd1jsnf0f931d70abb");
        define("BASE_URL", "https://" . API_HOST);

        $date = $request->input('today');

        $endpoint = "/actors/v2/get-born-today?today=$date";
        $url = BASE_URL . $endpoint;

        // Specify the path to the CA certificates bundle
        $caPath = __DIR__ . '/../../../cacert.pem';

        // Create a new Guzzle client with custom options
        $client = new Client([
            'base_uri' => BASE_URL,
            'verify' => $caPath, // Specify the path to the CA certificates bundle
            'headers' => [
                'X-RapidAPI-Host' => API_HOST,
                'X-RapidAPI-Key' => API_KEY
            ]
        ]);

        try{
            // Make the request using the Guzzle client
            $response = $client->request('GET', $url);

            // Process the response...
            $decoded_response = json_decode($response->getBody(), true);
            $actors_names = [];

            foreach ($decoded_response["data"]["bornToday"]["edges"] as $edge) {
                $id = $edge["node"]["id"];
                $endpoint = "/actors/v2/get-bio?nconst=$id";
                $response = $client->request('GET', $endpoint);

                $decoded_response = json_decode($response->getBody(), true);

                if (isset($decoded_response["data"]["name"]["nameText"]["text"])) {
                    $actors_names[] = $decoded_response["data"]["name"]["nameText"]["text"];
                }
            }

            // Return the list of actor names as JSON response
            return response()->json($actors_names);
        }
        catch (GuzzleException $e) {
            // Handle errors...
            return response()->json(['error' => $e], 500);
        }
    }
}
