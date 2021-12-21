<?php
$list = '';
$conn = mysqli_connect("localhost", "root", "123456", "pknu_db"); //php에서 제공하는 메소드. 데이터베이스와 연동할 수 있다
$sql = "select * from sites";
$result = mysqli_query($conn, $sql); // mysqli_query([연결 객체], [쿼리]); 해당 데이터베이스에 쿼리문을 날린다
while($row = mysqli_fetch_array($result)) //true이면 계속 반복 → row를 계속 출력
{
    $list = $list."<li><a href = \"5.php?id={$row['id']}\">{$row['title']}</a></li>"; //list에 있는 내용을 모두 출력. <a href></a> 링크를 통해 내용 확인 가능
}


$article = array(
    'title' => 'Notice',
    'description' => 'Welcome to Websites for Front-end.<br>
    이 페이지에서 사이트에 등록된 모든 홈페이지들을 확인하고, 추가할 수 있습니다.' 
); //key-value형태

$update_link = '';
$delete_link = '';

if(isset($_GET['id'])) //id값이 있는가
{
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']); // 보안-필터링. $conn : 접속객체
    $sql = "select * from sites where id = {$filtered_id}"; //원래는 $_GET['id']를 넣었지만 보안을 위해 filtered_id로 바꿔준 후 그걸로 대체함
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = htmlspecialchars($row['title']); //htmlspecialchars : 보안을 위해 문자열화
    $article['description'] = htmlspecialchars($row['description']);
    
    $update_link = '
    <form action = "phpTupdate.php?id='.$_GET['id'].'" method = "POST">
        <input type = "hidden" name = "id" value = "'.$_GET['id'].'">
        <input class = "btn" type = "submit" value = "update">
    </form>
    ';


    $delete_link = '
    <form action = "phpTProcess_delete.php" method = "POST">
        <input type = "hidden" name = "id" value = "'.$_GET['id'].'">
        <input class = "btn" type = "submit" value = "delete">
    </form>
    ';

   
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
            <h2><a href = "5.php">🔎Database</a></h2>
                <ol>
                    <?php
                        echo $list;
                    ?>
                </ol>
                <p style = "height: 30px"></p>

                <!--클릭한 사이트에 대한 설명을 보여주는 곳-->
                <h2>
                <?php
                    echo "✨", $article['title'];
                ?>
                </h2>
                <h4>
                    <?php
                        echo $article['description'];
                    ?>
                </h4>
                <p style = "height: 30px"></p>

                <!--새로운 사이트 추가, 사이트 수정, 사이트 삭제-->
                <h2>🔒데이터 관리</h2>
                <input class="btn" type="button" onclick="location.href = 'phpTcreate.php'" value="Add"></input><p>
                <?php echo $update_link ?>
                <?php echo $delete_link ?>
        </div>
        
    </body>
</html>
        
       