<table class="standards_hover">
    <?php
    echo (isset($date_from) ? '<tr><td>Valid since: </td><td>' . $date_from . '</td></tr>' : null);
    
    if (strtotime($date_till) < time()) {
        $date_till_color="red";
    } else {
        $date_till_color="black";
    }
    
    echo (isset($date_till) ? '<tr><td>Valid till: </td><td style="color: '.$date_till_color.';">' . $date_till . '</td></tr>' : null);

    echo (isset($rf_new) ? '<tr><td>Replaced by: </td><td><strong>' . $rf_new . '</strong></td></tr>' : null);
    
    echo (isset($descr) ? '<tr><td>Description: </td><td>' . $descr . '</td></tr>' : null);
    ?>
</table>