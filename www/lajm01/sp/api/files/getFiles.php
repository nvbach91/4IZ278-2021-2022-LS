<?php
    //CHANGE FOR PRODUCTION
    header("Access-Control-Allow-Origin: http://localhost:8080");
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header('Content-Type: application/json; charset=utf-8');
    //=====================
    require("../../php/configHelper.php");
    require("../../php/requestHelper.php");
    require("../../php/database.php");
    require("../../php/authHelper.php");
    require_once("../../php/phpHelper.php");

    RequestHelper::getInstance()->checkMethod("GET");
    $userData = AuthHelper::getInstance()->auth();

    $private_enabled = 0;
    $limit = ConfigHelper::getInstance()->getConfigValue("file_fetch_limit");
    $offset = RequestHelper::getInstance()->getParam("offset") ?? 0;
    $tags = RequestHelper::getInstance()->getParam("tags") ?? "";
    $file_name = RequestHelper::getInstance()->getParam("filename") ?? "";
    $order_by = RequestHelper::getInstance()->getParam("orderBy") ?? "DATE_ASC";
    $tags = $tags == "" ? [] : explode(",", $tags);
    
    $tag_array = count($tags) > 0 ? implode(",",$tags) : -1;

    //orderBy login
    $allowed_orders = [
        "DATE_ASC" => "ORDER BY f.uploadedAt ASC", 
        "DATE_DESC" => "ORDER BY f.uploadedAt DESC", 
        "NAME_ASC" => "ORDER BY f.filename ASC", 
        "NAME_DESC" => "ORDER BY f.filename DESC", 
        "RATING_ASC" => "ORDER BY f.rating ASC", 
        "RATING_DESC" => "ORDER BY f.rating DESC", 
    ];

    if(!in_array($order_by, array_keys($allowed_orders)))
        RequestHelper::getInstance()->reject("Unknown order value");

    $order_by_sql = $allowed_orders[$order_by];

    // if authToken is valid (not null or not string)
    $identifier = RequestHelper::getInstance()->getIP();
    $ratingQuery = "";

    if(!is_null($userData) && !is_string($userData)){
        //pokud má alespoň jednu roli (těď je jenom admin ale bude víc roli)
        $private_enabled = (int) (count(array_intersect($userData->roles, ["admin"])) > 0);
        $identifier = $userData->idUser;
        $ratingQuery = "LEFT JOIN Rating r ON (r.idFile = f.idFile AND r.idUser = {0})";
    }else{
        if(is_null($identifier))
            $ratingQuery = "LEFT JOIN Rating r ON (0=1)";
        else
            $ratingQuery = "LEFT JOIN Rating r ON (r.idFile = f.idFile AND r.ipAddress = '{0}')";
    }

    $files = Database::getInstance()->assocQuery("SELECT f.idFile as idFile, f.filename as filename, concat(f.permalink,'.', f.extension) as permalink, f.mimetype as mimeType, f.extension as extension, IFNULL(r.rating, 0) as rating, f.rating as globalRating
                                                    FROM Files f
                                                    LEFT JOIN FileTags ft ON(ft.idFile = f.idFile)
                                                    LEFT JOIN Tags t ON(t.idTag = ft.idTag AND (t.isPublic = 0))
                                                    ".$ratingQuery."
                                                    WHERE 
                                                        f.filename LIKE '%{1}%'
                                                        AND 
                                                        (SELECT COUNT(rt.idTag) FROM FileTags rt WHERE rt.idFile = f.idFile AND rt.idTag IN ({2})) = {3}
                                                    GROUP BY f.idFile 
                                                    HAVING 
                                                        COUNT(t.idTag) = 0 
                                                        OR
                                                        1 = {4}
                                                    ".$order_by_sql."
                                                    LIMIT {5} OFFSET {6}", [$identifier, $file_name, $tag_array, count($tags), $private_enabled, $limit, $offset]);

    RequestHelper::getInstance()->resolve([
        "limit" => $limit,
        "files" => $files
    ]);
?>