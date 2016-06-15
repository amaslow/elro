<?php

if (file_exists('img' . DS . $certDirectory . $item)) {
    echo '<table class="prodcon folders">';
    $mainDir = scandir('img' . DS . $certDirectory . $item . DS);
    $dir_count = $folders_count = $folderFiles_count = $lvd_count = $emc_count = $rf_count = $cpr_count = $erp_count = $chem_count = $others_count = 0;
    $dir_array = $folders_array = $lvd_array = $emc_array = $rf_array = $cpr_array = $erp_array = $chem_array = $others_array = array();

    foreach ($mainDir as $dir_value) {
        if (!is_dir($dir_value) && substr($dir_value, 0, 6) !== 'Thumbs') {
            $dir_count++;
            $ctime = filemtime('img' . DS . $certDirectory . $item . DS . $dir_value);
            array_push($dir_array, $dir_value);
            //$dir_array[$ctime] = $dir_value;
        }
    }
    ksort($dir_array);
    $firstElement= current($dir_array);

    if ($dir_count > 1) {
        foreach ($dir_array as $dir_array) {
            if ($dir_array!=$firstElement){
                $folderColor='color:gray; font-size: 90%;';
            }
            echo '<td>';
            echo $this->Html->link($dir_array, array('controller' => 'img' . DS . $certDirectory . $item . DS . $dir_array), array('style'=>$folderColor,'target' => '_blank'));
            echo '</td>';
            echo '<td style="font-style:italic;">';
            echo date("Y-m-d", filemtime('img' . DS . $certDirectory . $item . DS . $dir_array));
            echo '</td>';
            echo '</tr>';
        }
    } else {
        $subDir = 'img' . DS . $certDirectory . $item . DS . $firstElement;
        if (file_exists($subDir . DS . 'Certificates')) {
            $subDirCon = scandir($subDir . DS . 'Certificates');
            $subDir = $subDir . DS . 'Certificates';
        } else {
            $subDirCon = scandir($subDir);
        }
        foreach ($subDirCon as $value) {
//            if (strpos(strtolower($value), 'done') !== false || strpos(strtolower($value), 'batt') !== false || strpos(strtolower($value), 'power') !== false || strpos(strtolower($value), 'adapter') !== false || strpos(strtolower($value), 'patent') !== false || strpos(strtolower($value), '.lnk') !== false) {
            if ((!is_dir($value) && pathinfo($value, PATHINFO_EXTENSION) == null) || strpos(strtolower($value), '.lnk') !== false) {
                $subSubDir = scandir($subDir . DS . $value);
                $folderFiles_count = 0;
                foreach ($subSubDir as $subSubDir) {
                    $folderFiles_count++;
                }
                $folders_count++;
                //array_push($folders_array, $value);
                $folderFiles_count = $folderFiles_count - 2;
                $folders_array[$value] = $folderFiles_count;
            } elseif (strpos(strtolower($value), 'lvd') !== false || strpos(strtolower($value), '_gs') !== false || strpos(strtolower($value), 'cdf') !== false) {
                $lvd_count++;
                array_push($lvd_array, $value);
            } elseif (strpos(strtolower($value), 'emc') !== false) {
                $emc_count++;
                array_push($emc_array, $value);
            } elseif (strpos(strtolower($value), 'rf') !== false || strpos(strtolower($value), 'r&tte') !== false) {
                $rf_count++;
                array_push($rf_array, $value);
            } elseif (strpos(strtolower($value), 'cpr') !== false || strpos(strtolower($value), '50291') !== false) {
                $cpr_count++;
                array_push($cpr_array, $value);
            } elseif (strpos(strtolower($value), 'erp') !== false || strpos(strtolower($value), 'flux') !== false) {
                $erp_count++;
                array_push($erp_array, $value);
            } elseif (strpos(strtolower($value), 'rohs') !== false || strpos(strtolower($value), 'reach') !== false || strpos(strtolower($value), 'pah') !== false || strpos(strtolower($value), 'phth') !== false || strpos(strtolower($value), 'dmf') !== false || strpos(strtolower($value), 'sccp') !== false) {
                $chem_count++;
                array_push($chem_array, $value);
            } elseif (!is_dir($value) && substr($value, 0, 6) !== 'Thumbs') {
                $others_count++;
                array_push($others_array, $value);
            }
        }
        
//        if ($folders_count > 0) {
//            echo "<th> Subfolders </th>";
//        }
        if ($lvd_count > 0) {
            echo "<th> LVD </th>";
        }
        if ($emc_count > 0) {
            echo "<th> EMC </th>";
        }
        if ($rf_count > 0) {
            echo "<th> RF </th>";
        }
        if ($cpr_count > 0) {
            echo "<th> Specifics </th>";
        }
        if ($erp_count > 0) {
            echo "<th> ErP </th>";
        }
        if ($chem_count > 0) {
            echo "<th> Chemicals </th>";
        }
        if ($others_count > 0) {
            echo "<th> Others </th>";
        }
        
        echo '<tr>';
        if ($lvd_count > 0) {
            echo "<td>";
            foreach ($lvd_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($emc_count > 0) {
            echo "<td>";
            foreach ($emc_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($rf_count > 0) {
            echo "<td>";
            foreach ($rf_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($cpr_count > 0) {
            echo "<td>";
            foreach ($cpr_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($erp_count > 0) {
            echo "<td>";
            foreach ($erp_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($chem_count > 0) {
            echo "<td>";
            foreach ($chem_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        if ($others_count > 0) {
            echo "<td>";
            foreach ($others_array as $value) {
                echo $this->Html->link($value, array('controller' => $subDir . DS . $value), array('target' => '_blank')) . '<br/>';
            }
            echo "</td>";
        }
        echo '</tr>';
        echo '<tr>';
        if ($folders_count > 0) {
            foreach ($folders_array as $key => $amount) {
                if (strpos(strtolower($key), '.lnk') !== false) {
                    $shortcut = substr(str_replace('.lnk', '', str_replace('€', '\\', $key)), 33);
                    echo $this->Html->link('Shortcut - ' . $shortcut, array('controller' => 'img' . DS . $certDirectory . DS . $shortcut), array('class' => 'shortcutfolder', 'target' => '_blank')) . '</br>';
                } else {
                    if ($amount > 0 || strpos(strtolower($key), 'done') !== false) {
                        echo $this->Html->link($key, array('controller' => $subDir . DS . $key), array('class' => 'certfolder', 'target' => '_blank')) . '&nbsp&nbsp&nbsp&nbsp&nbsp' ;
                    }
                }
            }

        }
        echo '</tr>';
    }
    echo '</table>';
}
?>