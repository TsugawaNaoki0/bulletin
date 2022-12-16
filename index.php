<html>
<head>
  <title>PHP TEST</title>
  <link rel="stylesheet" href="./home.css">
</head>
<body>
<div class="main">
<br>
<p class="kakikomi">一行掲示板</p>

<form method="POST" action="<?php print($_SERVER['PHP_SELF']) ?>">
<!-- <input type="text" name="personal_name" placeholder="名無しさん"> -->

<select class="kakikomi" name="personal_name" required>
    <option value=""></option>
    <option value="イヌ">イヌ</option>
    <option value="ネコ">ネコ</option>
    <option value="ハムスター">ハムスター</option>
    <option value="オウム">オウム</option>
    <option value="クモ">クモ</option>
    <option value="金魚">金魚</option>
</select>
<br>
<br>
<!-- <input type="text" class="kakikomi_main" name="contents" required="required"> -->
<textarea class="kakikomi" name="contents" rows="8" cols="40" required="required"></textarea>
<br>
<br>
<input type="submit" class="kakikomi" name="btn1" value="投稿する">
</form>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    writeData();
    header("Location:/");
   exit;

}

readData();

function readData(){
    $keijban_file = 'test.txt';

    $fp = fopen($keijban_file, 'rb');

    $text_data = [];

    if ($fp){
        if (flock($fp, LOCK_SH)){
            while (!feof($fp)) {
                $buffer = fgets($fp);
                $text_data[] = $buffer;
            }

            $num = sizeof($text_data);
            for($i=$num-1; $i>=0; $i--){
              echo $text_data[$i];
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);
}

function writeData(){

    $personal_name = $_POST['personal_name'];
    $contents = $_POST['contents'];
    $contents = nl2br($contents);

    $data = "<hr>";
    $time = date( "Y年m月d日 H時i分s秒");
    $data = $data.$time;
    // $hitsuyou = $time;
    $data = $data."<p>投稿者:".$personal_name."</p>";
    // $hitsuyou = $hitsuyou."\n".$personal_name;
    $data = $data."<p>内容:</p>";
    $data = $data."<p>".$contents."</p>";
    // $hitsuyou = $hitsuyou."\n".$contents;
    // $data = $data."<input type='button' name='' value='削除'>";
    $data = $data."\n";




    $keijban_file = 'test.txt';

    $fp = fopen($keijban_file, 'ab');


    if ($fp){
        if (flock($fp, LOCK_EX)){
            if (fwrite($fp,  $data) === FALSE){
                print('ファイル書き込みに失敗しました');
            }

            flock($fp, LOCK_UN);
        }else{
            print('ファイルロックに失敗しました');
        }
    }

    fclose($fp);

}


?>
</div>

</body>
</html>
