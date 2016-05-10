<?php

if (file_exists('img' . DS . $directory) && strlen($item['Item']['SAP'])>0) {
    echo '<table class="prodcon">';

    $files = scandir('img' . DS . $directory);
    $pic_count = $man_count = $pac_count = $enlabel_count = $vid_count = $doc_count = $td_count = $others_count = 0;
    $pic_arrayLR = $pic_arrayMR = $pic_arrayHR = $man_array = $pac_array = $enlabel_array = $vid_array = $doc_array = $td_array = $others_array = array();

    foreach ($files as $value) {
        if ((substr($value, 0, 2) == "LR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "LR" && substr($value, -4) == ".JPG") || (substr($value, 0, 2) == "LR" && substr($value, -4) == ".png") || (substr($value, 0, 2) == "LR" && substr($value, -4) == ".PNG")) {
            $pic_count++;
            array_push($pic_arrayLR, $value);
        }
        elseif ((substr($value, 0, 2) == "MR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "MR" && substr($value, -4) == ".JPG") || (substr($value, 0, 2) == "MR" && substr($value, -4) == ".png") || (substr($value, 0, 2) == "MR" && substr($value, -4) == ".PNG")) {
            $pic_count++;
            array_push($pic_arrayMR, $value);
        }
        elseif ((substr($value, 0, 2) == "HR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "HR" && substr($value, -4) == ".JPG") || (substr($value, 0, 2) == "HR" && substr($value, -4) == ".png") || (substr($value, 0, 2) == "HR" && substr($value, -4) == ".PNG")) {
            $pic_count++;
            array_push($pic_arrayHR, $value);
        }
        elseif (substr($value, 0, 6) == "Manual" || substr($value, 0, 12) == "Installation" || substr($value, 0, 17) == "Safetyinstruction" || substr($value, 0, 11) == "Maintenance" || substr($value, 0, 12) == "Productsheet" || substr($value, 0, 9) == "Guarantee" || substr($value, 0, 5) == "Flyer" || substr($value, 0, 19) == "Productpresentation" || substr($value, 0, 4) == "Menu" || substr($value, 0, 8) == "Appendix") {
            $man_count++;
            array_push($man_array, $value);
        }
        elseif (substr($value, 0, 7) == "Package" || substr($value, 0, 9) == "Packaging" || substr($value, 0, 5) == "Inlay" || substr($value, 0, 7) == "Display" || substr($value, 0, 6) == "Rating" || substr($value, 0, 10) == "Collilabel" || substr($value, 0, 10) == "Silkscreen" || substr($value, 0, 6) == "Carton" || substr($value, 0, 7) == "Sticker" || substr($value, 0, 10) == "onlinetext" || substr($value, 0, 7) == "CDlabel" || substr($value, 0, 9) == "Multipack") {
            $pac_count++;
            array_push($pac_array, $value);
        }
        elseif (substr($value, 0, 11) == "Energylabel") {
            $enlabel_count++;
            array_push($enlabel_array, $value);
        }
        elseif (substr($value, 3, 5) == "Video" || substr($value, 0, 8) == "Ringtone") {
            $vid_count++;
            array_push($vid_array, $value);
        }
        elseif (substr($value, 0, 3) == "DoC" || substr($value, 0, 7) == "testDoC" || substr($value, 0, 12) == "repealed_DoC" || substr($value, 0, 3) == "DoP") {
            $doc_count++;
            array_push($doc_array, $value);
        }
        elseif (substr($value, -3) == "zip" || substr($value, 0, 3) == "CCC") {
            $td_count++;
            array_push($td_array, $value);
        }
        elseif (!is_dir($value) && substr($value, 0 , 6) !== 'Thumbs' && substr($value, 0 , 9) !== '.DS_Store') {
//            if (substr($value, 0 , 6) !== 'Thumbs' && substr($value, 0 , 9) !== '.DS_Store')
            {
            $others_count++;
            array_push($others_array, $value);
            }
        }
    }
    if ($pic_count > 0) {
        echo "<th> Pictures </th>";
    }
    if ($man_count > 0) {
        echo "<th> Manuals , Productsheets </th>";
    }
    if ($pac_count > 0) {
        echo "<th> Packages , Inlays , Labels </th>";
    }
    if ($enlabel_count > 0) {
        echo "<th> Energylabels </th>";
    }
    if ($vid_count > 0) {
        echo "<th> Product videos , Ringtones </th>";
    }
    if ($doc_count > 0) {
        echo "<th> DoC  &  DoP </th>";
    }
    if ($td_count > 0) {
        echo "<th> TD </th>";
    }
    if ($others_count > 0) {
        echo "<th> Others </th>";
    }
    echo '<tr>';
    if ($pic_count > 0) {
        echo "<td><table class='pictures'><th>Low Resolution</th><th>Medium Resolution</th><th>High Resolution</th><tr>";
        echo "<td>";
        natsort($pic_arrayLR);
        foreach ($pic_arrayLR as $value) {
            if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
            } else {
                $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
            }
            switch ($foto_num) {
                case 02: $fotonummering = 'Side view right angle';
                    break;
                case 03: $fotonummering = 'Front view';
                    break;
                case 04: $fotonummering = 'Side view left angle';
                    break;
                case 05: $fotonummering = 'Side view right';
                    break;
                case 06: $fotonummering = 'Side view left';
                    break;
                case 07: $fotonummering = 'Back view';
                    break;
                case 08: $fotonummering = 'Top view';
                    break;
                case 09: $fotonummering = 'Energy label';
                    break;
                case 10: $fotonummering = 'Product set 1';
                    break;
                case 11: $fotonummering = 'Product set 2';
                    break;
                case 12: $fotonummering = 'Product set 3';
                    break;
                case 13: $fotonummering = 'Product part 1';
                    break;
                case 14: $fotonummering = 'Product part 2';
                    break;
                case 15: $fotonummering = 'Product part 3';
                    break;
                case 16: $fotonummering = 'Product part 4';
                    break;
                case 17: $fotonummering = 'Product part 5';
                    break;
                case 18: $fotonummering = 'Product detail 1';
                    break;
                case 19: $fotonummering = 'Product detail 2';
                    break;
                case 20: $fotonummering = 'Product detail 3';
                    break;
                case 21: $fotonummering = 'Sphere picture 1';
                    break;
                case 22: $fotonummering = 'Sphere picture 2';
                    break;
                case 23: $fotonummering = 'Sphere picture 3';
                    break;
                case 24: $fotonummering = 'Product package 3D';
                    break;
                case 25: $fotonummering = 'Product package front';
                    break;
                case 26: $fotonummering = 'Product package left';
                    break;
                case 27: $fotonummering = 'Product package top';
                    break;
                case 28: $fotonummering = 'Product package back';
                    break;
                case 29: $fotonummering = 'Product package right';
                    break;
                case 30: $fotonummering = 'Product package bottom';
                    break;
                case 31: $fotonummering = 'Icon 1';
                    break;
                case 32: $fotonummering = 'Icon 2';
                    break;
                case 33: $fotonummering = 'Icon 3';
                    break;
                case 34: $fotonummering = 'ERP Spectrum';
                    break;
                case 35: $fotonummering = 'Square picture 1';
                    break;
                case 36: $fotonummering = 'Square picture 1';
                    break;
                case 37: $fotonummering = 'Square picture 2';
                    break;
                case 38: $fotonummering = 'Square picture 3';
                    break;
                case 39: $fotonummering = 'Square picture 4';
                    break;
                case 40: $fotonummering = 'Square picture 5';
                    break;
                case 41: $fotonummering = 'Square picture 6';
                    break;
                case 42: $fotonummering = 'Square picture 7';
                    break;
                case 43: $fotonummering = 'Square picture 8';
                    break;
                case 44: $fotonummering = 'Square picture 9';
                    break;
                case 45: $fotonummering = 'Square picture 10';
                    break;
                case 46: $fotonummering = 'Icon 4';
                    break;
                case 47: $fotonummering = 'Icon 5';
                    break;
                case 48: $fotonummering = 'Icon 6';
                    break;
                case 49: $fotonummering = 'Icon 7';
                    break;
                case 50: $fotonummering = 'Icon 8';
                    break;
                case 51: $fotonummering = 'Icon 9';
                    break;
                case 52: $fotonummering = 'Icon 10';
                    break;
            }
            echo $this->Html->link($fotonummering . '<span>' . $this->Html->image($directory . $value, array('class' => 'callout')) . '</span>', array('controller' => 'img' . DS . $directory . $value), array('class' => 'tooltip', 'escape' => false, 'target' => '_blank')) . '<br/>';
        }
        echo "</td>";
        echo "<td>";
        natsort($pic_arrayMR);
        foreach ($pic_arrayMR as $value) {
            if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
            } else {
                $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
            }
            switch ($foto_num) {
                case 02: $fotonummering = 'Side view right angle';
                    break;
                case 03: $fotonummering = 'Front view';
                    break;
                case 04: $fotonummering = 'Side view left angle';
                    break;
                case 05: $fotonummering = 'Side view right';
                    break;
                case 06: $fotonummering = 'Side view left';
                    break;
                case 07: $fotonummering = 'Back view';
                    break;
                case 08: $fotonummering = 'Top view';
                    break;
                case 09: $fotonummering = 'Energy label';
                    break;
                case 10: $fotonummering = 'Product set 1';
                    break;
                case 11: $fotonummering = 'Product set 2';
                    break;
                case 12: $fotonummering = 'Product set 3';
                    break;
                case 13: $fotonummering = 'Product part 1';
                    break;
                case 14: $fotonummering = 'Product part 2';
                    break;
                case 15: $fotonummering = 'Product part 3';
                    break;
                case 16: $fotonummering = 'Product part 4';
                    break;
                case 17: $fotonummering = 'Product part 5';
                    break;
                case 18: $fotonummering = 'Product detail 1';
                    break;
                case 19: $fotonummering = 'Product detail 2';
                    break;
                case 20: $fotonummering = 'Product detail 3';
                    break;
                case 21: $fotonummering = 'Sphere picture 1';
                    break;
                case 22: $fotonummering = 'Sphere picture 2';
                    break;
                case 23: $fotonummering = 'Sphere picture 3';
                    break;
                case 24: $fotonummering = 'Product package 3D';
                    break;
                case 25: $fotonummering = 'Product package front';
                    break;
                case 26: $fotonummering = 'Product package left';
                    break;
                case 27: $fotonummering = 'Product package top';
                    break;
                case 28: $fotonummering = 'Product package back';
                    break;
                case 29: $fotonummering = 'Product package right';
                    break;
                case 30: $fotonummering = 'Product package bottom';
                    break;
                case 31: $fotonummering = 'Icon 1';
                    break;
                case 32: $fotonummering = 'Icon 2';
                    break;
                case 33: $fotonummering = 'Icon 3';
                    break;
                case 34: $fotonummering = 'ERP Spectrum';
                    break;
                case 35: $fotonummering = 'Square picture 1';
                    break;
                case 36: $fotonummering = 'Square picture 1';
                    break;
                case 37: $fotonummering = 'Square picture 2';
                    break;
                case 38: $fotonummering = 'Square picture 3';
                    break;
                case 39: $fotonummering = 'Square picture 4';
                    break;
                case 40: $fotonummering = 'Square picture 5';
                    break;
                case 41: $fotonummering = 'Square picture 6';
                    break;
                case 42: $fotonummering = 'Square picture 7';
                    break;
                case 43: $fotonummering = 'Square picture 8';
                    break;
                case 44: $fotonummering = 'Square picture 9';
                    break;
                case 45: $fotonummering = 'Square picture 10';
                    break;
                case 46: $fotonummering = 'Icon 4';
                    break;
                case 47: $fotonummering = 'Icon 5';
                    break;
                case 48: $fotonummering = 'Icon 6';
                    break;
                case 49: $fotonummering = 'Icon 7';
                    break;
                case 50: $fotonummering = 'Icon 8';
                    break;
                case 51: $fotonummering = 'Icon 9';
                    break;
                case 52: $fotonummering = 'Icon 10';
                    break;
            }
            echo $this->Html->link($fotonummering . '<span>' . $this->Html->image($directory . $value, array('class' => 'callout')) . '</span>', array('controller' => 'img' . DS . $directory . $value), array('class' => 'tooltip', 'escape' => false, 'target' => '_blank')) . '<br/>';
        }
        echo "</td>";
        echo "<td>";
        natsort($pic_arrayHR);
        foreach ($pic_arrayHR as $value) {
            if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
            } else {
                $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
            }
            switch ($foto_num) {
                case 02: $fotonummering = 'Side view right angle';
                    break;
                case 03: $fotonummering = 'Front view';
                    break;
                case 04: $fotonummering = 'Side view left angle';
                    break;
                case 05: $fotonummering = 'Side view right';
                    break;
                case 06: $fotonummering = 'Side view left';
                    break;
                case 07: $fotonummering = 'Back view';
                    break;
                case 08: $fotonummering = 'Top view';
                    break;
                case 09: $fotonummering = 'Energy label';
                    break;
                case 10: $fotonummering = 'Product set 1';
                    break;
                case 11: $fotonummering = 'Product set 2';
                    break;
                case 12: $fotonummering = 'Product set 3';
                    break;
                case 13: $fotonummering = 'Product part 1';
                    break;
                case 14: $fotonummering = 'Product part 2';
                    break;
                case 15: $fotonummering = 'Product part 3';
                    break;
                case 16: $fotonummering = 'Product part 4';
                    break;
                case 17: $fotonummering = 'Product part 5';
                    break;
                case 18: $fotonummering = 'Product detail 1';
                    break;
                case 19: $fotonummering = 'Product detail 2';
                    break;
                case 20: $fotonummering = 'Product detail 3';
                    break;
                case 21: $fotonummering = 'Sphere picture 1';
                    break;
                case 22: $fotonummering = 'Sphere picture 2';
                    break;
                case 23: $fotonummering = 'Sphere picture 3';
                    break;
                case 24: $fotonummering = 'Product package 3D';
                    break;
                case 25: $fotonummering = 'Product package front';
                    break;
                case 26: $fotonummering = 'Product package left';
                    break;
                case 27: $fotonummering = 'Product package top';
                    break;
                case 28: $fotonummering = 'Product package back';
                    break;
                case 29: $fotonummering = 'Product package right';
                    break;
                case 30: $fotonummering = 'Product package bottom';
                    break;
                case 31: $fotonummering = 'Icon 1';
                    break;
                case 32: $fotonummering = 'Icon 2';
                    break;
                case 33: $fotonummering = 'Icon 3';
                    break;
                case 34: $fotonummering = 'ERP Spectrum';
                    break;
                case 35: $fotonummering = 'Square picture 1';
                    break;
                case 36: $fotonummering = 'Square picture 1';
                    break;
                case 37: $fotonummering = 'Square picture 2';
                    break;
                case 38: $fotonummering = 'Square picture 3';
                    break;
                case 39: $fotonummering = 'Square picture 4';
                    break;
                case 40: $fotonummering = 'Square picture 5';
                    break;
                case 41: $fotonummering = 'Square picture 6';
                    break;
                case 42: $fotonummering = 'Square picture 7';
                    break;
                case 43: $fotonummering = 'Square picture 8';
                    break;
                case 44: $fotonummering = 'Square picture 9';
                    break;
                case 45: $fotonummering = 'Square picture 10';
                    break;
                case 46: $fotonummering = 'Icon 4';
                    break;
                case 47: $fotonummering = 'Icon 5';
                    break;
                case 48: $fotonummering = 'Icon 6';
                    break;
                case 49: $fotonummering = 'Icon 7';
                    break;
                case 50: $fotonummering = 'Icon 8';
                    break;
                case 51: $fotonummering = 'Icon 9';
                    break;
                case 52: $fotonummering = 'Icon 10';
                    break;
            }
            //echo "<a href='" . $directory . $value . "' target='_blank' class='tooltip'>" . $fotonummering . "<span><img class='callout' src='" . $directory . $value . "'></span></a><br/>";
            echo $this->Html->link($fotonummering . '<span>' . $this->Html->image($directory . $value, array('class' => 'callout')) . '</span>', array('controller' => 'img' . DS . $directory . $value), array('class' => 'tooltip', 'escape' => false, 'target' => '_blank')) . '<br/>';
        }
        echo "</td>";
        echo "</tr></table></td>";
    }

    if ($man_count > 0) {
        echo "<td>";
        foreach ($man_array as $value) {
            echo $this->Html->link(str_replace(".pdf", null, str_replace(".pptx", null, str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value)))) , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }

    if ($pac_count > 0) {
        echo "<td>";
        foreach ($pac_array as $value) {
            //echo "<a href='" . $directory . $value . "' target='_blank' >" . str_replace(".pdf", null, str_replace(".doc", null, str_replace(".docx", null, str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value))))) . "</a><br/>";
            echo $this->Html->link(str_replace(".pdf", null, str_replace(".doc", null, str_replace(".docx", null, str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value))))) , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }

    if ($enlabel_count > 0) {
        echo "<td style='font-size: 14px;'>";
        foreach ($enlabel_array as $value) {
            echo $this->Html->link(str_replace("_" . $sapWithoutDots, null, str_replace(".png", null, $value)) . '<span>' . $this->Html->image($directory . $value, array('class' => 'callout')) . '</span>', array('controller' => 'img' . DS . $directory . $value), array('class' => 'tooltip', 'escape' => false, 'target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }

    if ($vid_count > 0) {
        echo "<td>";
        foreach ($vid_array as $value) {
            echo $this->Html->link(str_replace(".mp3", null, str_replace("LR_", null, str_replace("HR_", null, str_replace(".wav", null, str_replace(".mp4", null, str_replace(".mov", null, str_replace("_" . $sapWithoutDots, null, $value))))))) , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }
    if ($doc_count > 0) {
        echo "<td>";
        foreach ($doc_array as $value) {
            echo $this->Html->link(str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, str_replace(".pdf", null, $value))) , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }
    if ($td_count > 0) {
        echo "<td>";
        foreach ($td_array as $value) {
            echo $this->Html->link(str_replace(".pdf", null, str_replace(".zip", null, str_replace("_" . $sapWithoutDots, null, $value))) , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }
    if ($others_count > 0) {
        echo "<td>";
        foreach ($others_array as $value) {
            echo $this->Html->link($value , array('controller' => 'img' . DS . $directory . $value), array('target' => '_blank')) . '<br/>';
        }
        echo "</td>";
    }
    echo '</tr>';
    echo '</table>';
//    echo $this->Html->link('Product Content', array('controller' => 'img' . DS . $directory), array('target' => '_blank', 'class' => 'button'));
} else {
    echo '<h2>Product Content does not exist for this item</h2>';
}
?>