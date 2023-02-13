<?php
namespace App\Services\Microsoft;

use Microsoft\Graph\Graph;
use Microsoft\Graph\Http;
use Microsoft\Graph\Model;
use GuzzleHttp\Client;

class GraphHelper {
    public static Client $tokenClient;
    public static string $clientId = '';
    public static string $tenantId = '';
    public static string $graphUserScopes = '';
    public static Graph $userClient;
    public static string $userToken;

    public static function initializeGraphForUserAuth(): void {
        GraphHelper::$tokenClient = new Client();
        GraphHelper::$clientId = env("MICROSOFT_CLIENT_ID");
        GraphHelper::$tenantId = env("MICROSOFT_TENANT_ID");
        GraphHelper::$graphUserScopes = env("MICROSOFT_GRAPH_USER_SCOPES");
        GraphHelper::$userClient = new Graph();
    }
}