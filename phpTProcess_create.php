<?php
        
    $conn = mysqli_connect("localhost", "root", "123456", "pknu_db");

    $filtered = array(
        'title' => mysqli_real_escape_string($conn, $_POST['title']),
        'href' => mysqli_real_escape_string($conn, $_POST['href']),
        'kind' => mysqli_real_escape_string($conn, $_POST['kind']),
        'description' => mysqli_real_escape_string($conn, $_POST['description'])

        // 'title'=>$_POST['title'], //보안을 처리 안한 경우
    ); //filter된 배열 형태

    $sql = "
        INSERT INTO sites
        (title, href, kind, description, created)
        VALUES(
            '{$filtered['title']}',
            '{$filtered['href']}',
            '{$filtered['kind']}',
            '{$filtered['description']}',
            NOW());
    ";

    $result = mysqli_query($conn, $sql); //mysqli_multi_query는 보안에 위험하기 때문에 특별한 경우가 아니면 안쓰는게 좋다
    
    if($result === false)
    {
        echo '문제가 발생했습니다.';
        echo mysqli_error($conn);
    }
    else{
        echo '업데이트 성공했습니다.
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
