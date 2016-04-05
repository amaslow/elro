<?php
$imgFile2 = $directory . "LR_" . $sapWithoutDots . "_2.jpg";
$imgFile2HR = $directory . "HR_" . $sapWithoutDots . "_2.jpg";
$imgFile3 = $directory . "LR_" . $sapWithoutDots . "_3.jpg";
$imgFile3HR = $directory . "HR_" . $sapWithoutDots . "_3.jpg";
$imgFile4 = $directory . "LR_" . $sapWithoutDots . "_4.jpg";
$imgFile4HR = $directory . "HR_" . $sapWithoutDots . "_4.jpg";
$imgFile10 = $directory . "LR_" . $sapWithoutDots . "_10.jpg";
$imgFile10HR = $directory . "HR_" . $sapWithoutDots . "_10.jpg";

if (file_exists(WWW_ROOT . 'img' . DS . $imgFile2)) {
    $imgFile = $imgFile2;
    $imgFileHR = $imgFile2HR;
} elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile3)) {
    $imgFile = $imgFile3;
    $imgFileHR = $imgFile3HR;
} elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile10)) {
    $imgFile = $imgFile10;
    $imgFileHR = $imgFile10HR;
} else {
    $imgFile = $imgFile4;
    $imgFileHR = $imgFile4HR;
}
$data = getimagesize(WWW_ROOT . 'img' . DS . $imgFile);
$imgWidth = $data[0];
$imgHeight = $data[1];
$winWidth = 250;
$winHeight = 270;
if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
    $newHeight = $winHeight;
    $newWidth = ($imgWidth / $imgHeight) * $newHeight;
    $imgFile_new = $imgFile;
    $imgFileHR_new = $imgFileHR;
} else {
    $newWidth = $winWidth;
    $newHeight = ($imgHeight / $imgWidth) * $newWidth;
    $imgFile_new = $imgFile;
    $imgFileHR_new = $imgFileHR;
}
echo $this->Html->link(
        $this->Html->image($imgFile_new, array(
            'alt' => 'No Image Available',
            'style' => 'width:' . $newWidth . 'px;height:' . $newHeight . 'px; margin-left: 20px;'
        )), array('controller' => 'img' . DS . $imgFileHR_new), array('escape' => false,
    'target' => '_blank'
        )
);
?>