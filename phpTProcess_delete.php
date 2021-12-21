<?php
    //var_dump($_POST);
    $conn = mysqli_connect("localhost", "root", "123456", "pknu_db");

    settype($_POST['id'], 'interger'); //정수타입으로 정함
    $filtered = array(
        'id' => mysqli_real_escape_string($conn, $_POST['id']),
        'title' => mysqli_real_escape_string($conn, $_POST['title']),
        'href' => mysqli_real_escape_string($conn, $_POST['href']),
        'kind' => mysqli_real_escape_string($conn, $_POST['kind']),
        'description' => mysqli_real_escape_string($conn, $_POST['description'])

    ); //filter된 배열 형태

    $sql = "
        delete from sites
        where id = {$filtered['id']}
    "; //


    //die($sql); //쿼리문을 출력하지 않고 sql문을 출력

    $result = mysqli_query($conn, $sql); //mysqli_multi_query는 보안에 위험하기 때문에 특별한 경우가 아니면 안쓰는게 좋다
    if($result === false)
    {
        echo '문제가 발생했습니다.';
        echo mysqli_error($conn);
    }
    else{
        echo '삭제 성공했습니다.
        <a href = "5.php">돌아가기</a>';
    }
    
?>

<html>
    <head>
        <meta charset = "utf-8"/>
        <style type = "text/css">
            #view{
                font-family: Pretendard Variable;
                font-size: 16px;
                padding:2em;
            }
            .btn{
                border: 1px solid darkturquoise;
                background-color:rgba(0,0,0,0);
                color:darkturquoise;
                padding:5px;
                border-radius:5px;
            }
            .btn:hover{
                border: 1px solid darkturquoise;
                background-color:darkturquoise;
                color:white;
                padding:5px;
                border-radius:5px;
            }
            a:link { color: #0013e3; text-decoration: none;}
            a:visited { color: #0013e3; text-decoration: none;}
            a:hover { color: #00e3cc; text-decoration: none;}
        </style>
    </head>
    <body bgcolor="#f5f5f5">
        <div id = "view">
        
        </div>
        
    </body>
</html>