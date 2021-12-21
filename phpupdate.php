<?php
$list = '';
$conn = mysqli_connect("localhost", "root", "123456", "pknu_db"); //php에서 제공하는 메소드. 데이터베이스와 연동할 수 있다
$sql = "select * from books";
$result = mysqli_query($conn, $sql); // mysqli_query([연결 객체], [쿼리]);
while($row = mysqli_fetch_array($result)) //true이면 계속 반복 → row를 계속 출력
{
    $list = $list."<li><a href = \"php3select.php?id={$row['id']}\">{$row['title']}</a></li>"; //문자열과 문자열은 .을 붙이면 이어진다. list가 계속 이어지며 누적되는 형태.
    //\" : " 형태 그대로 출력됨
    //<a href = \"php3select.php?id={$row['id']}\"> .. </a> : 클릭한 항목의 id 값에 따라 링크가 걸려있다
}


$article = array(
    'title' => 'notice',
    'description' => 'Welcome to Programming World' 
); //key-value형태

if(isset($_GET['id'])) //id값이 있는가
{
    $filtered_id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "select * from books where id = {$filtered_id}";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $article['title'] = $row['title'];
    $article['description'] = $row['description'];
}
?>

<html>
    <head>
        <meta charset = "utf-8">
        <title>Programming</title>
    </head>
    <body>
        <h1>Programming Language</h1>
        <ol>
            <?php
                echo $list; //위에서 처리한 php를 여기서는 결과만 출력.
            ?>
        </ol>

        <form action = "php3myprocess_update.php" method = "POST"> <!--submit버튼을 클릭하면 action으로 이동. 데이터베이스에 입력하게끔 해줘야함-->
            <input type = "hidden" name = "id" value="<?=$_GET['id']?>">  <!--hidden : 숨긴다는 속성. id는 굳이 보여줄 필요는 없지만 id 자체는 필요함. 눈에 안보이는 컴포넌트로 만들어준다. GET으로 가져옴-->
            <p><input type = "text" name = "title" placeholder = "title" value="<?=$article['title']?>"></p> <!--placehoder : 텍스트 박스 안내사항(회색 글씨)-->
            <p><textarea name = "description" placeholder = "description"><?=$article['description']?></textarea></p>
            <p><input type = "submit"></p> <!--submit 버튼을 클릭하면 action으로 이동-->
        </form>
        
        <h2>
            <?php
                echo $article['title'];
            ?>
        </h2>
        <h4>
            <?php
                echo $article['description'];
            ?>
        </h4>
    </body>
</html>