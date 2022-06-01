<?php

// 対象のファイル
$target="test.txt";

// ファイルが存在する場合
if (file_exists($target)) {
  if (is_dir($target)) {
    echo "同名のフォルダが存在します。";
    exit;
  }

  if (!is_writable($target)) {
    echo "ファイルの書き込み権限がありません。";
    exit;
  }
}

// ファイルハンドルを書き込みモードで開く
if (!($fp = @fopen($target,"w"))) {
  echo "ファイルの書き込みに失敗しました。";
  exit;
}

// 排他ロックを行います
if (!@flock($fp, LOCK_EX)) {
  echo "ファイルのロックに失敗しました。";
  exit;
}

//ファイルに書き込む
fputs($fp, $data);

// 排他ロックを終了します
if (!@flock($fp, LOCK_UN)) {
  echo "ファイルのロック解放に失敗しました。";
  exit;
}

// ファイルハンドルを閉じる
fclose($fp);

// パーミッションを変更する
@chmod($target, 0777);
?>
