<?php
$list = '';
$conn = mysqli_connect("localhost", "root", "123456", "pknu_db"); //php에서 제공하는 메소드. 데이터베이스와 연동할 수 있다
$sql = "select * from sites";
$result = mysqli_query($conn, $sql); // mysqli_query([연결 객체], [쿼리]);
while($row = mysqli_fetch_array($result)) //true이면 계속 반복 → row를 계속 출력
{
    $list = $list."<li><a href = \"5.php?id={$row['id']}\">{$row['title']}</a></li>"; //문자열과 문자열은 .을 붙이면 이어진다. list가 계속 이어지며 누적되는 형태.
    //\" : " 형태 그대로 출력됨
    //<a href = \"php3select.php?id={$row['id']}\"> .. </a> : 클릭한 항목의 id 값에 따라 링크가 걸려있다
}


$article = array(
    'title' => 'Notice',
    'description' => 'Welcome to Websites for Front-end.<br>
    이 페이지에서 사이트에 등록된 모든 홈페이지들을 확인하고, 추가할 수 있습니다.' 
); //key-value형태

if(isset($_GET['id'])) //id값이 있는가
{
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "select * from sites where id = {$filtered_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = $row['title'];
    $article['href'] = $row['href'];
    $article['kind'] = $row['kind'];
    $article['description'] = $row['description'];
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

                <form action = "phpTprocess_update.php" method = "POST"> <!--submit버튼을 클릭하면 action으로 이동. 데이터베이스에 입력하게끔 해줘야함-->
                    <input type = "hidden" name = "id" value="<?=$_GET['id']?>">  <!--hidden : 숨긴다는 속성. id는 굳이 보여줄 필요는 없지만 id 자체는 필요함. 눈에 안보이는 컴포넌트로 만들어준다. GET으로 가져옴-->
                    <p><input type = "text" name = "title" placeholder = "사이트명" value="<?=$article['title']?>"></p> <!--placehoder : 텍스트 박스 안내사항(회색 글씨)-->
                    <p><input type = "text" name = "href" placeholder = "사이트 주소" value="<?=$article['href']?>"></p>
                    <p><input type = "text" name = "kind" placeholder = "분류" value="<?=$article['kind']?>"></p>
                    <p><textarea name = "description" placeholder = "설명" rows="4" cols="50"><?=$article['description']?></textarea></p>
                    <p><input type = "submit" class="btn"></p> <!--submit 버튼을 클릭하면 action으로 이동-->
                </form>

                <!--새로운 사이트 추가, 사이트 수정, 사이트 삭제-->
                <h2>🔒데이터 관리</h2>
                <input class="btn" type="button" onclick="location.href = 'phpTcreate.php'" value="Add"></input><p>
                <?php echo $update_link ?>
                <?php echo $delete_link ?>
        </div>
        
    </body>
</html>