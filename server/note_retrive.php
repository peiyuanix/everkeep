<?php

session_start();

require_once './permission_manager.php';
require_once './response_code.php';

if(isLogin())
{
    $GLOBALS['userid'] = $_SESSION['uid'];
}
else
{
    die_for_no_login();
}

if(!isset($_GET["noteid"]))
{
    $msg = json_encode([
        "code" => GET_NO_NOTEID,
        "msg" => "NOTE ID无效",
    ]);
    die($msg);
}

$GLOBALS["noteid"] = $_GET['noteid'];

readNoteFromDB($GLOBALS['noteid'], $GLOBALS['userid']);



function readNoteFromDB($noteid, $userid)
{
    $servername = "localhost";
    $username = "everkeep";
    $password = "everkeep_team10";
    $dbname = "everkeep";
    $tablename = "note";

// 创建连接
    $conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
    if ($conn->connect_error) {
        $msg = json_encode([
            "code" => DB_CONNECTION_ERROR,
            "msg" => "数据库连接失败",
        ]);
        die($msg);
    }

    $sql = <<<EOF
select title, content, userid from $tablename where noteid = '$noteid';
EOF;

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        // 输出数据
        while($row = $result->fetch_assoc()) {

            if($row["userid"] != $userid)
            {
                die_for_no_permission();
            }
            else
            {
                $data = json_encode([
                    "noteid" => $noteid,
                    "notetitle" => $row["title"],
                    "notecontent" => $row["content"],
                ]);

                $msg = json_encode([
                    "code" => SUCCESS,
                    "msg" => "成功",
                    "data" => $data
                ]);
                die($msg);
            }
        }
    } else {
        $msg = json_encode([
            "code" => QUERY_NO_DATA,
            "msg" => "未找到数据",
        ]);
        die($msg);
    }

    $conn->close();
}
