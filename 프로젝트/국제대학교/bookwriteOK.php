<?php
  $username = $_POST['name'];
  $userpw = $_POST['pw'];
  $title = $_POST['title'];
  $content = $_POST['content'];
  $date = date('Y-m-d');

  $tmpfile =  $_FILES['SelectFile']['tmp_name'];
  $o_name = $_FILES['SelectFile']['name'];
  $filename = iconv("UTF-8", "EUC-KR",$_FILES['SelectFile']['name']); #문자 캐릭터셋을 'EUC-KR'로 변경
  $folder = "./upload/".$filename; #폴더 경로 지정
  move_uploaded_file($tmpfile,$folder); #$tmpfile변수를 가져와 업로드 파일을 사용자 지정 디렉터리로 이동

  $conn= mysqli_connect('localhost', 'root', 'pearl2044','jejulibrary');
  $sql = "INSERT INTO ibooksub(book_title,book_name,book_pw,book_content,book_date, book_file) VALUES('".$title."','".$username."','".$userpw."','".$content."','".$date."','".$o_name."')";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if($username && $userpw && $title && $content){ #username, userpw, title, content에 값이 있으면
      echo "<script>
      alert('글쓰기 완료되었습니다.');
      location.href='도서신청.php';</script>"; #글쓰기가 완료되면 게시판 페이지로 돌아감
  }else{
      echo "<script>
      alert('글쓰기에 실패했습니다.');
      history.back();</script>"; #글쓰기에 실패하면 이전 페이지로 돌아감
  }
?>
