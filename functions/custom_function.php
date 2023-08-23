<?php


function doc_get_icon_attachment_file($ext_file = '')
{
    if ($ext_file == '') return '<i class="fa fa-file"></i>';

    if ($ext_file === 'docx' || $ext_file === 'doc') {
        $icon = '<i class="bi bi-file-word"></i>';
    } elseif ($ext_file === 'xlsx' || $ext_file === 'xls') {
        $icon = '<i class="bi bi-file-excel"></i>';
    } elseif ($ext_file === 'jpg' || $ext_file === 'gif' || $ext_file === 'png') {
        $icon = '<i class="bi bi-file-image"></i>';
    } elseif ($ext_file === 'pdf') {
        $icon = '<i class="bi bi-file-pdf"></i>';
    } else {
        $icon = '<i class="bi bi-file-text"></i>';
    }

    return $icon;
}


function doc_get_file_size($url_file = '')
{
    if ($url_file === '') return;
    $upload_dir = wp_upload_dir();
    $path_upload_full = $upload_dir['path'];

    $path_upload_sub = substr($path_upload_full, 0, strpos($path_upload_full, 'wp-content/uploads'));


    $position = strpos($url_file, 'wp-content/uploads');
    $sub_str = substr($url_file, $position);
    $path_file = $path_upload_sub . $sub_str;

    $file_size_byte = filesize($path_file);
    $file_size_kb = $file_size_byte * 0.0009765625;
    $file_size_kb = round($file_size_kb);

    return $file_size_kb;
}

const TOKEN_ENDPOINT = 'https://accounts.coursera.org/oauth2/v1/token';
const REDIRECT_URI = 'http://portalmunicipal.test/plataforma-de-treinamentu/';


function getNewAccessTokenUsingOAuth2($access_code)
{

    require('OAuth2/Client.php');
    require('OAuth2/GrantType/IGrantType.php');
    require('OAuth2/GrantType/AuthorizationCode.php');


    $CLIENT_ID = get_general_setting('setting_api_coursera_client_id');
    $CLIENT_SECRET = get_general_setting('setting_api_coursera_client_secret');


    $AUTHORIZATION_ENDPOINT = 'https://accounts.coursera.org/oauth2/v1/auth?scope=view_profile+access_business_api&redirect_uri=http://localhost:9876/callback&access_type=offline&grant_type=authorization_code&response_type=code&client_id=' . $CLIENT_ID;


    $client = new OAuth2\Client($CLIENT_ID, $CLIENT_SECRET);

    $params = array('code' => $access_code, 'redirect_uri' => REDIRECT_URI);
    $response = $client->getAccessToken(TOKEN_ENDPOINT, 'authorization_code', $params);
    var_dump($response);

//parse_str($response['result'], $info);
//$client->setAccessToken($info['access_token']);

} //getNewAccessTokenUsingOAuth2


function getNewAccessTokenUsingLeagueOAuth2($access_code)
{

    require_once __DIR__ . "/vendor/autoload.php";


    $CLIENT_ID = get_general_setting('setting_api_coursera_client_id');
    $CLIENT_SECRET = get_general_setting('setting_api_coursera_client_secret');


    $AUTHORIZATION_ENDPOINT = 'https://accounts.coursera.org/oauth2/v1/auth?scope=view_profile+access_business_api&redirect_uri=http://localhost:9876/callback&access_type=offline&grant_type=authorization_code&response_type=code&client_id=' . $CLIENT_ID;

    $provider = new \League\OAuth2\Client\Provider\GenericProvider([
        'clientId' => $CLIENT_ID,    // The client ID assigned to you by the provider
        'clientSecret' => $CLIENT_SECRET,    // The client password assigned to you by the provider
        'redirectUri' => REDIRECT_URI,
        'urlAuthorize' => $AUTHORIZATION_ENDPOINT,
        'urlAccessToken' => TOKEN_ENDPOINT,
        'urlResourceOwnerDetails' => 'https://api.coursera.org/api/businesses.v1/',
    ]);

    try {

        // Try to get an access token using the authorization code grant.
        $accessToken = $provider->getAccessToken('authorization_code', [
            'code' => $access_code,
            'access_token' => 'CiCnSqcUIlx6WG7M9NvbStBUSM_SIvMPoj0OwGipe7vX3xImCNDjxDUYgYCAgEAg6rvSm7UwKhCUadT0GlAopzkVZWbPs-NBeAA',
        ]);

        echo 'Access Token: ' . $accessToken->getToken() . "<br>";
        echo 'Refresh Token: ' . $accessToken->getRefreshToken() . "<br>";
        echo 'Expired in: ' . $accessToken->getExpires() . "<br>";
        echo 'Already expired? ' . ($accessToken->hasExpired() ? 'expired' : 'not expired') . "<br>";

        // Using the access token, we may look up details about the
        // resource owner.
        $resourceOwner = $provider->getResourceOwner($accessToken);

        var_export($resourceOwner->toArray());


    } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

        // Failed to get the access token or user details.
        exit($e->getMessage());

    }

} //getNewAccessTokenUsingLeagueOAuth2


function getNewAccessTokenUsingCurl()
{

    $url = 'https://accounts.coursera.org/oauth2/v1/token';

    $ch = curl_init($url);

    $auth_data = array(
        'redirect_uri' => 'http://localhost:9876/callback',
        'client_id' => get_general_setting('setting_api_coursera_client_id'),
        'client_secret' => get_general_setting('setting_api_coursera_client_secret'),
        'Access_type' => 'offline',
        'grant_type' => 'authorization_code',
        'code' => 'jCVRwqdDX5O8tiug1h8tQj5YyfKOUOVHTdNaU08E-tk',
    );


    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($auth_data));
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    $result = curl_exec($ch);
    if (!$result) {
        die("Connection Failure");
    }
    curl_close($ch);
    var_dump($result);

} //getNewAccessTokenUsingCurl
