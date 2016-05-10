<!--<h1><?php echo h($item['Item']['SAP']); ?></h1>

<p><small>Created <?php echo $item['Item']['created']; ?></small></p>
<p><?php echo h($item['Item']['ITEM']); ?></p>-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

        <script type="text/javascript">
             $(document).ready(function() {
                
                $('#tab1').find('input, textarea').prop('readonly',true);
                
                $("#content1 div").hide(); // Initially hide all content
                //$("#tabs li:first").attr("id","current"); // Activate first tab
                //$("#content1 div:first").fadeIn(); // Show first tab content
                $("#tab1").fadeIn();
                $('#tabs a').click(function(e) {
                    e.preventDefault();
                    $("#content1 div").hide(); //Hide all content
                    $("#tabs li").attr("id",""); //Reset id's
                    $(this).parent().attr("id","current"); // Activate this
                    $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
                });
                
                var cert_type=["#ItemLVD","#ItemPHOTOBIOL","#ItemIPCLASS","#ItemEMC","#ItemRF","#ItemCPD","#ItemEUP","#ItemFLUX","#ItemROHS","#ItemPAH","#ItemREACH"
                    ,"#ItemOEM","#ItemDOC","#ItemDOI","#ItemGS","#ItemGSCDF","#ItemPHTH","#ItemVDS","#ItemNF","#ItemBOSEC","#ItemKOMO","#ItemKK","#ItemBATT","#ItemBATT2"];
                for(var i=0; i< cert_type.length; i++) {
                    var chbox=$(cert_type[i]).is(':checked');
                    if (!chbox) {
                         $(cert_type[i]).prop('disabled', !chbox);
                         $(cert_type[i]+'CE').prop('disabled', !chbox);
                         $(cert_type[i]+'DIR').prop('disabled', !chbox);
                         $(cert_type[i]+'CERT').prop('disabled', !chbox);
                         $(cert_type[i]+'TR').prop('disabled', !chbox);
                         $(cert_type[i]+'DATE').prop('disabled', !chbox);
                         $(cert_type[i]+'DATEFROM').prop('disabled', !chbox);
                         $(cert_type[i]+'DATETO').prop('disabled', !chbox);
                         $(cert_type[i]+'NB').prop('disabled', !chbox);
                         $(cert_type[i]+'NBN').prop('disabled', !chbox);
                         $(cert_type[i]+'STATUS').prop('disabled', !chbox);
                         $(cert_type[i]+'M').prop('disabled', !chbox);
                         $(cert_type[i]+'TR2').prop('disabled', !chbox);
                    }
                }
                
                //var str1 = String($('#ItemITEMS').val());
                var str1 = $('#ItemITEMS').text();
                var str2 = $('#ItemITEMSSAP').text();
                var n = str1.localeCompare(str2);
                if (n!=0){
                    $('#ItemITEMSSAP').css("color", "red");
                }
                
                $('input[type=text],select').not("[id='ItemPAHCE']").each(function(){
                    var text_value=$(this).val();
                    if(text_value.toLowerCase().indexOf("missing") >= 0){
//                    if(text_value=='MISSING'){

                       $(this).css("color", "red");
                       $(this).each(function blink() { 
                            $(this).fadeOut(500).fadeIn(500, blink); 
                        });
                    }
                  });
                  
                (function blink() { 
                    $('.blink_me').fadeOut(500).fadeIn(500, blink);
                })();

                $('input[type=text],select').each(function(){
                    var text_value=$(this).val();
                    if(text_value.toLowerCase().indexOf("draft") >= 0){
                       $(this).css("color", "#ee7600");
                    }
                  });
            })();
            
        function readOnlyCheckBox() {
            return false;
        }
        
        function closing(){
            //window.close();
            window.open('','_self').close();
        }
        
    </script>
</head>

<?php

$sapWithoutDots = str_replace(".", "", $item['Item']['SAP']);
$directory = "G" . DS . "S&L_Data" . DS . "Product Content" . DS . "PRODUCTS" . DS . $sapWithoutDots . DS;
$certDirectory = "G" . DS . "S&L_Data" . DS . "QC" . DS . "Certificates" . DS;

echo $this->Form->create('Item', array(
    'inputDefaults' => array(
        'label' => false,
        'div' => false
    )
));
echo $this->Form->input('id', array('hidden' => 'hidden'));
?>
<table>
    <tr>
        <td>
            <table class="toptable">
                <tr>
                    <td><?php if ($this->Session->read('Auth.User')):?>
                        <label>QC Status:</label>
                        <div style="display:none;"><?php echo $item['Item']['QM_STATUS'];?></div>
                        <svg height="24" width="24">
                            <circle cx="12" cy="12" r="12" stroke="black" stroke-width="0" fill="<?php echo $item['Item']['QM_STATUS'];?>" />
                            <?php if ($item['Item']['ADAPTOR1']==1){
//                                if ($item['Item']['ADAPTOR1_LVD']=='MISSING' || $item['Item']['ADAPTOR1_EMC']=='MISSING' || $item['Item']['ADAPTOR1_ERP']=='MISSING'){
//                                    echo '<circle cx="12" cy="12" r="6" stroke="black" stroke-width="1" fill="red" />';
//                                } else if ($item['Item']['ADAPTOR1_ROHS']=='MISSING' && $item['Item']['ADAPTOR1_LVD']!='MISSING' && $item['Item']['ADAPTOR1_EMC']!='MISSING' && $item['Item']['ADAPTOR1_ERP']!='MISSING') {
//                                    echo '<circle cx="12" cy="12" r="6" stroke="black" stroke-width="1" fill="orange" />';
//                                } else {
//                                    echo '<circle cx="12" cy="12" r="6" stroke="black" stroke-width="1" fill="green" />';
//                                }
                                echo '<circle cx="12" cy="12" r="5" stroke="black" stroke-width="1" fill="' . $item['Item']['QC_STATUS'] . '" />';
                            }?>

                        </svg>
                        
                        <?php endif; ?>
                    </td>
                    <td><?php echo $this->Form->input('ITEM', array('label' => 'Item Nr:', 'readonly' => 'readonly', 'size' => '21', 'style' => 'font-size: 20px;')); ?></td>
                    <td><?php echo $this->Form->input('SAP', array('label' => 'SAP Nr:', 'readonly' => 'readonly', 'size' => '8', 'style' => 'font-size: 20px;')); ?></td>
                    <td><?php echo $this->Form->input('BRAND', array('label' => 'Brand:', 'readonly' => 'readonly', 'size' => '14')); ?></td>
                    <td><?php echo $this->Form->input('VALID_DATE', array('label' => 'Valid in SAP since:', 'readonly' => 'readonly', 'size' => '10')); ?></td>
                </tr>
                <tr>
                    <td><?php echo $this->Form->input('STATUS', array('label' => 'SAP Status:', 'readonly' => 'readonly', 'size' => '1'));
                        $setstatus = $this->request->data['Item']['STATUS'];
                        echo '<br>';
                        switch($setstatus):
                            case "B1": echo "<i>   Decline</i>";break;
                            case "B3": echo "<i>   Purchase block – no successor</i>";break;
                            case "G0": echo "<i>   ID phase</i>";break;
                            case "G1": echo "<i>   Introduction phase</i>";break;
                            case "G2": echo "<i>   Active</i>";break;
                            case "G3": echo "<i>   op=op (ending)</i>";break;
                            case "P1": echo "<i>   Promotion item</i>";break;
                            case "U0": echo "<i>  End of life time</i>";break;
                            case "N/A": echo "<i>   No SAP no.</i>";break;
                        endswitch;?>
                    </td>
                    <td><?php echo $this->Form->input('HIERARCHY', array('label' => 'Hierarchy:', 'readonly' => 'readonly', 'size' => '4'));
                        $sethierarchy = $this->request->data['Item']['HIERARCHY'];
                        echo '<br>';
                        switch($sethierarchy):
                            case "S0100": echo "<i> Fire (Dennis Hungs / Michiel van de Riet)</i>";break;
                            case "S0200": echo "<i> Door-entry (Dennis Hungs / Ross Anderson)</i>";break;
                            case "S0300": echo "<i> Camera (Dennis Hungs / Sven Emmen)</i>";break;
                            case "S0400": echo "<i> Alarm (Dennis Hungs / Ad Daamen)</i>";break;
                            case "S0500": echo "<i> Home-automation (Dennis Hungs / Ad Daamen)</i>";break;
                            case "S0600": echo "<i> Personal care (Dennis Hungs / Sven Emmen)</i>";break;
                            case "S0900": echo "<i> Other (Dennis Hungs / Michiel van de Riet)</i>";break;
                            case "S1000": echo "<i> Functional (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                            case "S1100": echo "<i> Indoor (Mark Lankhaar / Marcel Trouw)</i>";break;
                            case "S1200": echo "<i> Outdoor (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                            case "S1300": echo "<i> Bulbs (Mark Lankhaar / Kit YingKong)</i>";break;
                            case "S1400": echo "<i> Smartlights (Mark Lankhaar / Ad Netten)</i>";break;
                        endswitch;?>
                    </td>
                    <td><?php echo $this->Form->input('EAN', array('label' => 'EAN:', 'readonly' => 'readonly', 'size' => '14')); ?></td>
                    <td><?php echo $this->Form->input('EAN_INN', array('label' => 'EAN inner box:', 'readonly' => 'readonly', 'size' => '14')); ?></td>
                    <td><?php echo $this->Form->input('EAN_OUT', array('label' => 'EAN outer box:', 'readonly' => 'readonly', 'size' => '14')); ?></td>
                </tr>
                <?php if ($this->Session->read('Auth.User')):?>
                <tr>
                    <td><?php if ($item_vendor['Supplier']['ID']>0):
                                echo $this->Form->label('VENDOR', 'Vendor:');
                                echo $this->Html->link($item['Item']['VENDOR'], array('controller' => 'suppliers', 'action' => 'sview', $item_vendor['Supplier']['ID']. '?subject='.$item['Item']['ITEM_S'].' ('.$item['Item']['ITEM'].')'), array('target' => '_blank', 'style'=>'text-decoration:none;font-size: 150%;'));
                            else:
                                echo $this->Form->input('VENDOR', array('label' => 'Vendor:', 'readonly' => 'readonly', 'size' => '4'));
                        endif; ?>
                    </td>
                    <td><?php echo $this->Form->input('SUPPLIER', array('label' => 'Supplier:', 'readonly' => 'readonly', 'size' => '36')); ?></td>
<!--                    <td colspan="2"><?php echo $this->Form->input('ITEM_S', array('label' => 'Supplier item Nr according to certificates:', 'readonly' => 'readonly', 'size' => '37', 'style' => 'font-size: 14px;')); ?></td>-->
                    <td colspan="2"><?php echo $this->Form->label('ITEM_S', 'Supplier item Nr according to certificates:'); ?>
                            <p id="ItemITEMS"><?php echo $item['Item']['ITEM_S'];?></p>
                    </td>
                    <td><?php echo $this->Form->label('ITEM_S_SAP', 'Supplier item Nr according to SAP:');?>
<!--                            echo $this->Text->autoParagraph($item['Item']['ITEM_S_SAP']);-->
                            <p id="ItemITEMSSAP"><?php echo $item['Item']['ITEM_S_SAP'];?></p>
                    </td>
                </tr>
                <?php endif;?>
                <tr>
                    <td colspan="3"></td>
                    <td><?php echo $this->Form->input('RETURN_PLACE', array('label' => 'Return place:', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                    <td><?php echo $this->Form->input('LOCATION', array('label' => 'Pickup location:', 'readonly' => 'readonly', 'size' => '8')); ?></td>
                </tr>
            </table>
        </td>
        <td <?php if (!strlen($item['Item']['REMARKS_AUTH']) > 0) {echo ' rowspan="2"';}?> >
            <?php echo $this->element('picture_top', array('directory' => $directory, 'sapWithoutDots' => $sapWithoutDots)); ?>
        </td>
    </tr>
    <tr>
        <td><?php echo $this->element('descriptions_view'); ?></td>
        <?php if (strlen($item['Item']['REMARKS_AUTH']) > 0):?>
            <td>Authority remarks:<br/>
            <?php echo $this->Form->textarea('REMARKS_AUTH', array('rows' => '3', 'cols' => '40', 'style' => 'color: red; border-top-color: red; border-right-color: red; border-bottom-color: red; border-left-color: red'));?>
            </td>
        <?php endif;?>
    </tr>
</table>
<?php if ($item['Item']['HIDDEN']==1){echo'<p id="hidden"> DEACTIVATED </p>';};?>
    <ul id="tabs">
        <?php
        if ($this->Session->read('Auth.User')){
            $tabPcNum = 5; $tabPcDisp = 'block'; $tabPcId = null;
            if (strlen($item['Item']['COMPONENT1']) == 0) {
                $tabCertNum = 1; $tabCertDisp = 'block'; $tabCertId = 'current';
                $tabStandNum = 2; $tabStandDisp = 'block';
                $tabCompNum = 11; $tabCompDisp = 'none'; $tabCompId = null;
                if ($item['Item']['EUP'] == 1) {
                    $tabErpNum = 3; $tabErpDisp = 'block';
                }   else {
                        $tabErpNum = 13; $tabErpDisp = 'none';
                }
                if (file_exists('img'. DS . $certDirectory . str_replace('/', '_', $item['Item']['ITEM']))&& AuthComponent::user('group') < 2){
                    $tabFolderNum = 4; $tabFolderDisp = 'block';
                }   else {
                    $tabFolderNum = 14; $tabFolderDisp = 'none';
                }
                if (count($item_supplier)>1 && $item['Item']['ITEM_S']!=''){
                    $tabRelatedNum = 6; $tabRelatedDisp = 'block';
                } else {
                    $tabRelatedNum = 16; $tabRelatedDisp = 'none';
                }
            }   else {
                    $tabCertNum = 11; $tabCertDisp = 'none'; $tabCertId = null;
                    $tabStandNum = 12; $tabStandDisp = 'none';
                    $tabErpNum = 13; $tabErpDisp = 'none';
                    $tabFolderNum = 14; $tabFolderDisp = 'none';
                    $tabRelatedNum = 16; $tabRelatedDisp = 'none';
                    $tabCompNum = 1; $tabCompDisp = 'block'; $tabCompId = 'current';
                }
            echo '<li id="'.$tabCertId.'"><a href="#" title="tab'.$tabCertNum.'" style="display: '.$tabCertDisp.';">Certificates</a></li>';
            echo '<li><a href="#" title="tab'.$tabStandNum.'" style="display: '.$tabStandDisp.';">Standards</a></li>';
            echo '<li><a href="#" title="tab'.$tabErpNum.'" style="display: '.$tabErpDisp.';">ErP</a></li>';
            echo '<li><a href="#" title="tab'.$tabFolderNum.'" style="display: '.$tabFolderDisp.';">Folder</a></li>';
            echo '<li id="'.$tabCompId.'"><a href="#" title="tab'.$tabCompNum.'" style="display: '.$tabCompDisp.';">Components</a></li>';
            echo '<li id="'.$tabPcId.'"><a href="#" title="tab'.$tabPcNum.'" style="display: '.$tabPcDisp.';">Product Content</a></li>';
            echo '<li><a href="#" title="tab'.$tabRelatedNum.'" style="display: '.$tabRelatedDisp.';">Related</a></li>';
        }   else {
                $tabPcNum = 1; $tabPcDisp = 'block'; $tabPcId = 'current';
                if (strlen($item['Item']['COMPONENT1']) == 0) {
                    $tabCompNum = 11; $tabCompDisp = 'none'; $tabCompId = null;
                    if ($item['Item']['EUP'] == 1) {
                        $tabErpNum = 2; $tabErpDisp = 'block';
                    }   else {
                            $tabErpNum = 13; $tabErpDisp = 'none';
                        }
                    if (count($item_supplier)>1 && $item['Item']['ITEM_S']!=''){
                        $tabRelatedNum = 6; $tabRelatedDisp = 'block';
                    } else {
                        $tabRelatedNum = 16; $tabRelatedDisp = 'none';
                        }
                }   else {
                        $tabErpNum = 13; $tabErpDisp = 'none';
                        $tabCompNum = 2; $tabCompDisp = 'block'; $tabCompId = null;
                        $tabRelatedNum = 16; $tabRelatedDisp = 'none';
                    }
                echo '<li id="'.$tabPcId.'"><a href="#" title="tab'.$tabPcNum.'" style="display: '.$tabPcDisp.';">Product Content</a></li>';
                echo '<li id="'.$tabCompId.'"><a href="#" title="tab'.$tabCompNum.'" style="display: '.$tabCompDisp.';">Components</a></li>';
                echo '<li><a href="#" title="tab'.$tabErpNum.'" style="display: '.$tabErpDisp.';">ErP</a></li>';
                echo '<li><a href="#" title="tab'.$tabRelatedNum.'" style="display: '.$tabRelatedDisp.';">Related</a></li>';
            }
        ?>
    </ul>
<div id="content1" <?php //if ($item['Item']['HIDDEN']==1){echo 'style="opacity: 0.96"';};?>>
    <div <?php echo 'id="tab'.$tabCompNum.'"';?>>
        <p>This set contains following components:</p>
        <table class="components">
        <?php for ($i = 1; $i < 11; $i++):
            ${'sapWithoutDots_comp' . $i} = str_replace(".", "", ${'item_comp' . $i}['Item']['SAP']);
            ${'directory_comp' . $i} = "G" . DS . "S&L_Data" . DS . "Product Content" . DS . "PRODUCTS" . DS . ${'sapWithoutDots_comp' . $i} . DS;
            $imgFile2 = ${'directory_comp' . $i} . "LR_" . ${'sapWithoutDots_comp' . $i} . "_2.jpg";
            $imgFile3 = ${'directory_comp' . $i} . "LR_" . ${'sapWithoutDots_comp' . $i} . "_3.jpg";
            $imgFile10 = ${'directory_comp' . $i} . "LR_" . ${'sapWithoutDots_comp' . $i} . "_10.jpg";
            $imgFile4 = ${'directory_comp' . $i} . "LR_" . ${'sapWithoutDots_comp' . $i} . "_4.jpg";
            if (file_exists(WWW_ROOT . 'img' . DS . $imgFile2)) {
                $imgFile = $imgFile2;
            } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile3)) {
                $imgFile = $imgFile3;
            } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile10)) {
                $imgFile = $imgFile10;
            } else {
                $imgFile = $imgFile4;
            }
            if (strlen($item['Item']['COMPONENT' . $i]) > 0):
                $Red = 0; $Orange = 0;?>
            <tr>
                <td><?php echo '('.${'item_comp' . $i}['Item']['STATUS'] .') ';
                    if ($this->Session->read('Auth.User')):?>
                        <svg height="16" width="16"><circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="<?php echo ${'item_comp' . $i}['Item']['QM_STATUS'];?>"/></svg>
                    <?php endif;
                echo $this->Html->link(str_replace('   ', '   -   ', $item['Item']['COMPONENT' . $i]). '<span>' . $this->Html->image($imgFile, array('class' => 'calloutComp', 'onerror'=>'this.style.display = "none"')) . '</span>', array('controller' => 'items', 'action' => 'view', ${'item_comp' . $i}['Item']['ID']), array('escape' => false, 'target' => '_blank'));?>
                </td>
            </tr>
            <?php endif;
            endfor;
        if (strlen($item['Item']['REMARKS'])>0):?>
            <tr>
                <td colspan="9"><?php echo $this->Form->textarea('REMARKS', array('rows' => '4', 'cols' => '120'));?></td>
            </tr>
        <?php endif;?>
        </table>
    </div>
    <div <?php echo 'id="tab'.$tabCertNum.'"';?>>
        <table style="width: auto;">
            <tr>
                <td></td>
                <td></td>
                <td style="font-size: 10px; font-weight: bold; text-align: center;"><i>Directive/Regulation</i></td>
                <td style="font-size: 10px; font-weight: bold; text-align: center;"><i>Certificate</i></td>
                <td style="font-size: 10px; font-weight: bold; text-align: center;"><i>Test report</i></td>
                <td style="font-size: 10px; font-weight: bold;text-align: center;"><i>valid from</i></td>
                <td style="font-size: 10px; font-weight: bold; text-align: center;"><i>Notify body</i></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php if ($item['Item']['LVD']==1 || $item['Item']['PHOTOBIOL']==1 || $item['Item']['IPCLASS']==1):?>
            <tr>
            <?php if ($item['Item']['LVD']==1):?>
                <td style="text-align: right; color: blue; font-weight: bold">LVD</td>
                <td><?php echo $this->Form->input('LVD', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('LVD_CE', array('readonly' => 'readonly', 'size' => '12'));?></td>
                <td><?php echo $this->Form->input('LVD_CERT', array('readonly' => 'readonly', 'size' => '30'));?></td>
                <td><?php echo $this->Form->input('LVD_TR', array('readonly' => 'readonly', 'size' => '45'));?></td>
<!--                <td><?php echo $this->Form->input('LVD_DATE', array('dateFormat' => 'YMD'));?></td>-->
<!--                <td><?php echo $this->Time->format($item['Item']['LVD_DATE'], '%Y.%m.%d');?></td>-->
                <td><?php echo  $this->Form->input('LVD_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9'));?></td>
                <td><?php echo $this->Form->input('LVD_NB', array('readonly' => 'readonly', 'size' => '10'));?></td>
            <?php if ($item['Item']['PHOTOBIOL']==1):?>
                <td style="text-align: right; color: blue;">Photobiol.</td>
                <td><?php echo $this->Form->input('PHOTOBIOL', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('PHOTOBIOL_TR', array('readonly' => 'readonly', 'size' => '10'));?></td>
            <?php endif;
            if ($item['Item']['IPCLASS']==1):?>
                <td style="text-align: right; color: blue;">IP</td>
                <td><?php echo $this->Form->input('IPCLASS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('IPCLASS_TR', array('readonly' => 'readonly', 'size' => '8'));?></td>
            <?php endif;
            else:?>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            <?php if ($item['Item']['PHOTOBIOL']==1):?>
                <td style="text-align: right; color: blue;">Photobiol.</td>
                <td><?php echo $this->Form->input('PHOTOBIOL', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('PHOTOBIOL_TR', array('readonly' => 'readonly', 'size' => '10'));?></td>
            <?php endif;
            if ($item['Item']['IPCLASS']==1):?>
                <td style="text-align: right; color: blue;">IP</td>
                <td><?php echo $this->Form->input('IPCLASS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('IPCLASS_TR', array('readonly' => 'readonly', 'size' => '8'));?></td>
            <?php endif;
            endif;?>
            </tr>
            <?php endif;
            if ($item['Item']['EMC']==1):?>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">EMC</td>
                <td><?php echo $this->Form->input('EMC', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('EMC_CE', array('readonly' => 'readonly', 'size' => '12')); ?></td>
                <td><?php echo $this->Form->input('EMC_CERT', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('EMC_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('EMC_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('EMC_NB', array('readonly' => 'readonly', 'size' => '10')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['RF']==1):?>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">R&TTE</td>
                <td><?php echo $this->Form->input('RF', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('RF_CE', array('readonly' => 'readonly', 'size' => '12')); ?></td>
                <td><?php echo $this->Form->input('RF_CERT', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <?php 
                $rf=0;
                for ($r = 1; $r < 5; $r++) {
                    if (strtotime(${rf_standard . $r}['Standardr']['RF_DATE_TILL']) < time() && ${rf_standard . $r}['Standardr']['RF_DATE_TILL']!=null) {
                        $rf+=1;
                    }
                }
                if ($rf>0){
                    $rf_class=' class="blink_me"';
                }else {
                    $rf_class=null;
                }
                ?>
                <td <?php echo $rf_class;?>><?php echo $this->Form->input('RF_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('RF_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('RF_NB', array('readonly' => 'readonly', 'size' => '10')); ?></td>
                <td style="text-align: right">N.B. nr</td>
                <td colspan="2"><?php echo $this->Form->input('RF_NBN', array('readonly' => 'readonly', 'size' => '2')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['CPD']==1):?>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">Specific</td>
                <td><?php echo $this->Form->input('CPD', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('CPD_DIR', array('readonly' => 'readonly', 'size' => '12')); ?></td>
                <td><?php echo $this->Form->input('CPD_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('CPD_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('CPD_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('CPD_NB', array('readonly' => 'readonly', 'size' => '10')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['EUP']==1):?>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">ErP</td>
                <td><?php echo $this->Form->input('EUP', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td colspan="2"><?php echo $this->Form->input('EUP_CE', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('EUP_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('EUP_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('EUP_STATUS', array('readonly' => 'readonly', 'size' => '10')); ?></td>
            <?php
            if ($item['Item']['EUP_STATUS']=='Initial,1000h'):
                $erp_date = new DateTime($item['Item']['EUP_DATE']);
                $erp_date->modify("+5000 hours");
                $ed = $erp_date->format('Y-m-d');
                $today= new DateTime();
                $td = $today->format('Y-m-d');
                if($td < $ed){
                    $col='black';
                } else {
                    $col='red';
                }
                echo '<td style="color: '.$col.'" colspan="3">' . '6000h => '.$ed . '</td>';
                endif;
            if ($item['Item']['FLUX']==1):?>
                <td style="text-align: right; color: blue;">Flux Rep.</td>
                <td><?php echo $this->Form->input('FLUX', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('FLUX_TR', array('readonly' => 'readonly', 'size' => '10'));?></td>
            <?php endif;?>
            </tr>
            <?php endif; ?>
            <tr>
                <td style="text-align: right; color: blue;">RoHS</td>
                <td><?php echo $this->Form->input('ROHS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('ROHS_CE', array('readonly' => 'readonly', 'size' => '12')); ?></td>
                <td><?php echo $this->Form->input('ROHS_CERT', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('ROHS_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('ROHS_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('ROHS_NB', array('readonly' => 'readonly', 'size' => '10')); ?></td>
            <?php if ($item['Item']['PAH']==1):?>
                <td style="text-align: right; color: blue;">PAH</td>
                <td><?php echo $this->Form->input('PAH', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td><?php echo $this->Form->input('PAH_CE', array('readonly' => 'readonly', 'size' => '10'));?></td>
            <?php else:?>
                <td></td><td></td><td></td>
            <?php endif;?>
                <td style="text-align: right; color: blue;">REACH</td>
                <td><?php echo $this->Form->input('REACH', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('REACH_CE', array('readonly' => 'readonly', 'size' => '9')); ?></td>
            <?php if ($item['Item']['PHTH']==1):?>
                <td>Phthalaten Rep.</td><td><?php echo $this->Form->input('PHTH', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
            <?php endif;?>
            </tr>
        </table>
        <table style="width: auto;">
            <tr>
                <td style="text-align: right">Supplier DoC</td><td><?php echo $this->Form->input('DOC', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td style="text-align: right">Supplier DoI</td><td><?php echo $this->Form->input('DOI', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
            </tr>
            <?php
            if ($item['Item']['OEM']==1):?>
            <tr>
                <td style="text-align: right">Co-licence/OEM Cert.</td>
                <td><?php echo $this->Form->input('OEM', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('OEM_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td>valid from:<?php echo $this->Form->input('OEM_DATE_FROM', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('OEM_DATE_TO', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['GS']==1 || $item['Item']['GS_CDF']==1):?>
            <tr>
                <td style="text-align: right">GS Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('GS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('GS_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('GS_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('GS_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?>
                <td>N.B.<?php echo $this->Form->input('GS_NB', array('readonly' => 'readonly', 'size' => '10')); ?></td>
                <td style="text-align: right">CDF</td><td><?php echo $this->Form->input('GS_CDF', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['VDS']==1):?>
            <tr>
                <td style="text-align: right">VdS Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('VDS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('VDS_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('VDS_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('VDS_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['NF']==1):?>
            <tr>
                <td style="text-align: right">NF Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('NF', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('NF_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('NF_TR', array('readonly' => 'readonly', 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('NF_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['BOSEC']==1):?>
            <tr>
                <td style="text-align: right">Bosec/NCP Certificate</td>
                <td><?php echo $this->Form->input('BOSEC', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('BOSEC_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td style="text-align: right;">valid till:<?php echo $this->Form->input('BOSEC_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['KOMO']==1):?>
            <tr>
                <td style="text-align: right">FFU/LGA safety Cert.</td>
                <td><?php echo $this->Form->input('KOMO', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('KOMO_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td style="text-align: right;">valid till:<?php echo $this->Form->input('KOMO_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['KK']==1):?>
            <tr>
                <td style="text-align: right">Other Cert. / Rep. nr</td>
                <td><?php echo $this->Form->input('KK', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('KK_CE', array('readonly' => 'readonly', 'size' => '30')); ?></td>
                <td style="text-align: right;width: 130px;">valid from:<?php echo $this->Form->input('KK_DATE', array('type' => 'text', 'readonly' => 'readonly', 'size' => '9')); ?></td>
            </tr>
            <?php endif;
            if ($item['Item']['BATT']==1 || $item['Item']['BATT2']==1):?>
            <tr>
                <td style="text-align: right">1.Battery Report</td>
                <td><?php echo $this->Form->input('BATT', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('BATT_M', array('type' => 'text', 'readonly' => 'readonly', 'size' => '22')); ?></td>
                <td style="text-align: right">2.Battery Rep.</td>
                <td><?php echo $this->Form->input('BATT2', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()')); ?></td>
                <td><?php echo $this->Form->input('BATT_TR2', array('type' => 'text', 'readonly' => 'readonly', 'size' => '22')); ?></td>
            </tr>
            <?php endif;?>
        </table>
        <table class="adaptor">
        <?php if ($item['Item']['ADAPTOR1']==1):?>
            <tr><td style="font-weight: bold;">1. Adaptor model</td><td style="text-align: left;"><?php echo $this->Form->input('ADAPTOR1_MODEL', array('type' => 'text', 'readonly' => 'readonly', 'size' => '22')); ?></td></tr>
            <tr><td style="text-align: right;">LVD</td><td><?php echo $this->Form->input('ADAPTOR1_LVD', array('type' => 'text', 'readonly' => 'readonly', 'size' => '10')); ?></td></tr>
            <tr><td style="text-align: right;">EMC</td><td><?php echo $this->Form->input('ADAPTOR1_EMC', array('type' => 'text', 'readonly' => 'readonly', 'size' => '10')); ?></td></tr>
            <tr><td style="text-align: right;">RoHS</td><td><?php echo $this->Form->input('ADAPTOR1_ROHS', array('type' => 'text', 'readonly' => 'readonly', 'size' => '10')); ?></td></tr>
            <tr><td style="text-align: right;">ErP</td><td><?php echo $this->Form->input('ADAPTOR1_ERP', array('type' => 'text', 'readonly' => 'readonly', 'size' => '10')); ?></td></tr>
        <?php endif;?>
        </table>                            
        <?php if (strlen($item['Item']['REMARKS'])>0):?>
            <tr>
                <td colspan="9"><?php echo $this->Form->textarea('REMARKS', array('rows' => '4', 'cols' => '120')); ?></td>
            </tr>
        <?php endif; ?>
    </div>
    <div  <?php echo 'id="tab'.$tabStandNum.'"';?>>
        <table  class="normtable">
            <th style="color:rgb(0,0,255)">EMC Standards</th>
            <th style="color:rgb(0,102,51)">LVD Standards</th>
            <th style="color:rgb(153,51,255)">R&TTE Standards</th>
            <th style="color:rgb(0,102,102)">Other Standards</th>
            <tr>
                <td><?php echo (isset($item['Item']['EMC1']) ? $item['Item']['EMC1'] : null);?></td>
                <td><?php echo (isset($item['Item']['LVD1']) ? $item['Item']['LVD1'] : null);?></td>
                <?php
                for ($r = 1; $r < 5; $r++) {
                    if (strtotime(${rf_standard . $r}['Standardr']['RF_DATE_TILL']) < time() && ${rf_standard . $r}['Standardr']['RF_DATE_TILL']!=null) {
                        ${rf_date_till_color . $r} = "red";
                    } else {
                        ${rf_date_till_color . $r} = "green";
                    }
                    if (strtotime(${cpd_standard . $r}['Standardr']['RF_DATE_TILL']) < time() && ${cpd_standard . $r}['Standardr']['RF_DATE_TILL']!=null) {
                        ${cpd_date_till_color . $r} = "red";
                    } else {
                        ${cpd_date_till_color . $r} = "green";
                    }
                }
                ?>
                <td style="color: <?php echo $rf_date_till_color1;?>"><text class="zoomimg"><?php echo (isset($item['Item']['RF1']) ? $item['Item']['RF1'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$rf_standard1['Standardr']['RF_DESCR'],'date_from'=>$rf_standard1['Standardr']['RF_DATE_FROM'],'date_till'=>$rf_standard1['Standardr']['RF_DATE_TILL'],'rf_new'=>$rf_standard1['Standardr']['RF_NEW'])); ?>
                    </span></td>
                <td style="color: <?php echo $cpd_date_till_color1;?>"><text class="zoomimg"><?php echo (isset($item['Item']['CPD1']) ? $item['Item']['CPD1'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$cpd_standard1['Standardr']['RF_DESCR'],'date_from'=>$cpd_standard1['Standardr']['RF_DATE_FROM'],'date_till'=>$cpd_standard1['Standardr']['RF_DATE_TILL'],'rf_new'=>$cpd_standard1['Standardr']['RF_NEW'])); ?>
                    </span></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC2']) ? $item['Item']['EMC2'] : null);?></td>
                <td><?php echo (isset($item['Item']['LVD2']) ? $item['Item']['LVD2'] : null);?></td>
                <td style="color: <?php echo $rf_date_till_color2;?>"><text class="zoomimg"><?php echo (isset($item['Item']['RF2']) ? $item['Item']['RF2'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$rf_standard2['Standardr']['RF_DESCR'],'date_from'=>$rf_standard2['Standardr']['RF_DATE_FROM'],'date_till'=>$rf_standard2['Standardr']['RF_DATE_TILL'],'rf_new'=>$rf_standard2['Standardr']['RF_NEW'])); ?>
                    </span></td>
                <td style="color: <?php echo $cpd_date_till_color2;?>"><text class="zoomimg"><?php echo (isset($item['Item']['CPD2']) ? $item['Item']['CPD2'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$cpd_standard2['Standardr']['RF_DESCR'],'date_from'=>$cpd_standard2['Standardr']['RF_DATE_FROM'],'date_till'=>$cpd_standard2['Standardr']['RF_DATE_TILL'],'rf_new'=>$cpd_standard2['Standardr']['RF_NEW'])); ?>
                    </span></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC3']) ? $item['Item']['EMC3'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD3']) ? $item['Item']['LVD3'] : null); ?></td>
                <td style="color: <?php echo $rf_date_till_color3;?>"><text class="zoomimg"><?php echo (isset($item['Item']['RF3']) ? $item['Item']['RF3'] : null); ?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$rf_standard3['Standardr']['RF_DESCR'],'date_from'=>$rf_standard3['Standardr']['RF_DATE_FROM'],'date_till'=>$rf_standard3['Standardr']['RF_DATE_TILL'],'rf_new'=>$rf_standard3['Standardr']['RF_NEW'])); ?>
                    </span></td>
                <td style="color: <?php echo $cpd_date_till_color3;?>"><text class="zoomimg"><?php echo (isset($item['Item']['CPD3']) ? $item['Item']['CPD3'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$cpd_standard3['Standardr']['RF_DESCR'],'date_from'=>$cpd_standard3['Standardr']['RF_DATE_FROM'],'date_till'=>$cpd_standard3['Standardr']['RF_DATE_TILL'],'rf_new'=>$cpd_standard3['Standardr']['RF_NEW'])); ?>
                    </span></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC4']) ? $item['Item']['EMC4'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD4']) ? $item['Item']['LVD4'] : null); ?></td>
                <td style="color: <?php echo $rf_date_till_color4;?>"><text class="zoomimg"><?php echo (isset($item['Item']['RF4']) ? $item['Item']['RF4'] : null); ?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$rf_standard4['Standardr']['RF_DESCR'],'date_from'=>$rf_standard4['Standardr']['RF_DATE_FROM'],'date_till'=>$rf_standard4['Standardr']['RF_DATE_TILL'],'rf_new'=>$rf_standard4['Standardr']['RF_NEW'])); ?>
                    </span></td>
                <td style="color: <?php echo $cpd_date_till_color4;?>"><text class="zoomimg"><?php echo (isset($item['Item']['CPD4']) ? $item['Item']['CPD4'] : null);?></text>
                    <span><?php echo $this->element('standards_hover',array('descr'=>$cpd_standard4['Standardr']['RF_DESCR'],'date_from'=>$cpd_standard4['Standardr']['RF_DATE_FROM'],'date_till'=>$cpd_standard4['Standardr']['RF_DATE_TILL'],'rf_new'=>$cpd_standard4['Standardr']['RF_NEW'])); ?>
                    </span></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC5']) ? $item['Item']['EMC5'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD5']) ? $item['Item']['LVD5'] : null); ?></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC6']) ? $item['Item']['EMC6'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD6']) ? $item['Item']['LVD6'] : null); ?></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC7']) ? $item['Item']['EMC7'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD7']) ? $item['Item']['LVD7'] : null); ?></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC8']) ? $item['Item']['EMC8'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD8']) ? $item['Item']['LVD8'] : null); ?></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC9']) ? $item['Item']['EMC9'] : null); ?></td>
                <td><?php echo (isset($item['Item']['LVD9']) ? $item['Item']['LVD9'] : null); ?></td>
            </tr>
            <tr>
                <td><?php echo (isset($item['Item']['EMC10']) ? $item['Item']['EMC10'] : null); ?></td>
            </tr>
        </table>
    </div>
    <div  <?php echo 'id="tab'.$tabErpNum.'"';?>>
        <table class="erp_top" style="margin-bottom: 0;">
            <tr>
                <td>Kind of lamp:</td><td><?php echo $this->Form->input('KIND_BULB', array('readonly' => 'readonly')); ?></td>
            <?php if ($item['Item']['INCL']==1):?>
                <td>Included bulb:</td><td><?php echo $this->Form->input('INCL', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td></td><td><?php echo $this->Html->link($item['Item']['ITEM_BULB'],array('controller' => 'items?filter='.$item['Item']['ITEM_BULB']),array('target'=>'_blank'));?></td>
            <?php endif;
            if ($item['Item']['INT_LED']==1):?>
                <td>Integrated LED:</td><td><?php echo $this->Form->input('INT_LED', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
            <?php endif;
            $coordX = $this->request->data['Item']['COORDX'];
            $coordY = $this->request->data['Item']['COORDY'];
            if (strlen($item['Item']['SPECIAL_USE'])>0):?>
                <td>Special purpose:</td><td><?php echo $this->Form->input('SPECIAL_USE', array('readonly' => 'readonly', 'style'=>'font-weight: bold'));?></td>
                <?php if ($coordX <> '' or $coordY <> ''):?>
                <td>Chromaticity coordinates: x=</td><td><?php echo $this->Form->input('COORDX', array('readonly' => 'readonly', 'size' => '5'));?></td>
                <td style="text-align: left; padding-left: 1px;">, y=</td><td><?php echo $this->Form->input('COORDY', array('readonly' => 'readonly', 'size' => '5'));?></td>
                <?php endif;
            endif;?>
            </tr>
            <?php if ($coordX <> '' or $coordY <> ''):?>
            <tr>
                <td></td><td></td>
                <?php if ($item['Item']['INCL']==1):?>
                <td></td><td></td><td></td><td></td>
                <?php endif;
                if ($item['Item']['INT_LED']==1):?>
                <td></td><td></td>
                <?php endif;
                if ($coordX >= 0.270 and $coordX <= 0.530):
                    $textX='0.270  ≤ x ≤ 0.530';
                    $colX='red';
                elseif ($coordX < 0.270):
                    $textX='x < 0.270';
                    $colX='green';
                elseif ($coordX > 0.530):
                    $textX='x > 0.530';
                    $colX='green';
                endif;
                $minY = round((-2.3172*pow($coordX, 2))+(2.3653*$coordX)-0.2199, 4);
                $maxY = round((-2.3172*pow($coordX, 2))+(2.3653*$coordX)-0.1595, 4);
                if ($coordY >= $minY and $coordY <= $maxY):
                    $textY = $minY . ' ≤ y ≤ ' . $maxY;
                    $colY = 'red';
                elseif ($coordY < $minY):
                    $textY = 'y < ' . $minY;
                    $colY = 'green';
                elseif ($coordY > $maxY):
                    $textY = 'y > ' . $maxY;
                    $colY = 'green';
                endif;
                if (strlen($item['Item']['SPECIAL_USE'])>0):?>
                <td></td><td></td>
                <td colspan="2" style="text-align: right; color: <?php echo $colX;?>;"><?php echo $textX; ?></td>
                <td colspan="2" style="color: <?php echo $colY;?>;"><?php echo ' , ' . $textY; ?></td>
                <?php endif;?>
            </tr>
            <?php endif;?>
        </table>
            <?php if (strlen($item['Item']['SPECIAL_USE'])>0 and $colX <> 'red' and colY <> 'red'):?>
        <p style="text-align: center;"><i><b> Not suitable for household room illumination</b></i></p>
            <?php endif;?>
        <label style="color: green; font-style: italic; font-size: smaller;">Packaging</label>
        <table class="erp_packing">
            <tr>
                <td>Nominal voltage (V):</td><td><?php echo $this->Form->input('VOLTAGE', array('readonly' => 'readonly'));?></td>
                <td>Switching cycles:</td><td><?php echo $this->Form->input('SWICYC', array('readonly' => 'readonly', 'size' => '14'));?></td>
                <td>Nominal beam angle(°):</td><td><?php echo $this->Form->input('BEAM', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Suitable for accent lighting:</td><td><?php echo $this->Form->input('ACCENT', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
            </tr>
            <tr>
                <td>Nominal current (mA):</td><td><?php echo $this->Form->input('AMPERE', array('readonly' => 'readonly')); ?></td>
                <td>Colour temperature (K):</td><td><?php echo $this->Form->input('KELVIN', array('readonly' => 'readonly', 'size' => '14')); ?></td>
                <td>Color rendering Ra:  ></td><td><?php echo $this->Form->input('RA', array('readonly' => 'readonly', 'size' => '4')); ?></td>
                <td>Dimensions (mm):   Φ(w):</td><td><?php echo $this->Form->input('DIMENSION_FI', array('readonly' => 'readonly', 'size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal lamp power (W):</td><td><?php echo $this->Form->input('WATTAGE', array('readonly' => 'readonly'));?></td>
                <td>Energy efficiency class:</td><td><?php echo $this->Form->input('ENCLAS', array('readonly' => 'readonly', 'size' => '14')); ?></td>
                <td>Equivalent (W):</td><td><?php echo $this->Form->input('COMPAR', array('readonly' => 'readonly', 'size' => '4')); ?></td>
                <td>Dimensions (mm):   l(h):</td><td><?php echo $this->Form->input('DIMENSION_L', array('readonly' => 'readonly', 'size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal luminous flux (lm):</td><td><?php echo $this->Form->input('LUMEN', array('readonly' => 'readonly')); ?></td>
                <td>Warm-up time to 60% (<2s):</td><td><?php echo $this->Form->input('STAR60', array('readonly' => 'readonly', 'size' => '14')); ?></td>
                <td>Base / fitting:</td><td><?php echo $this->Form->input('FITTIN', array('readonly' => 'readonly', 'size' => '4')); ?></td>
                <td>Dimensions (mm):   d:</td><td><?php echo $this->Form->input('DIMENSION_D', array('readonly' => 'readonly', 'size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal life time (h):</td><td><?php echo $this->Form->input('LIFETIME', array('readonly' => 'readonly')); ?></td>
                <td>Dimmable:</td><td><?php echo $this->Form->input('DIMMER', array('readonly' => 'readonly', 'size' => '14')); ?></td>
                <td>Mercury content (mg): <</td><td><?php echo $this->Form->input('KWIK', array('readonly' => 'readonly', 'size' => '4')); ?></td>
                <td></td>
            </tr>
        </table>
        <label style="color: blue; font-style: italic; font-size: smaller;">Website</label>
        <table class="erp_web">
            <tr>
                <td>Measured wattage (0.1 W):</td><td><?php echo $this->Form->input('WATTAGE_RATED', array('readonly' => 'readonly', 'size' => '6'));?></td>
                <td>Color name:</td><td><?php echo $this->Form->input('COLOUR', array('readonly' => 'readonly', 'size' => '11'));?></td>
                <td>Power factor (X.X):</td><td><?php echo $this->Form->input('POWER_FACTOR', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Lamp survival factor (>0.90): ></td><td><?php echo $this->Form->input('LICHTB', array('readonly' => 'readonly', 'size' => '4'));?></td>
            </tr>
            <tr>
                <td>Measured luminous flux (lm):</td><td><?php echo $this->Form->input('LUMEN_RATED', array('readonly' => 'readonly', 'size' => '6'));?></td>
                <td>Rated beam angle(°):</td><td><?php echo $this->Form->input('BEAM_R', array('readonly' => 'readonly', 'size' => '11'));?></td>
                <td>Lumen maintenance factor (>0.80): ></td><td><?php echo $this->Form->input('LUMEN_FACTOR', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Color consistency (LED only): <</td><td><?php echo $this->Form->input('COLOR_CONS', array('readonly' => 'readonly', 'size' => '4'));?></td>
            </tr>
            <tr>
                <td>Measured life time (h):</td><td><?php echo $this->Form->input('LIFETIME_RATED', array('readonly' => 'readonly', 'size' => '6'));?></td>
                <td>Indoor / outdoor use:</td><td><?php echo $this->Form->input('INDOOR', array('readonly' => 'readonly', 'size' => '11'));?></td>
                <td>Starting time (<0.5s): <</td><td><?php echo $this->Form->input('START_TIME', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Rated peak in candela (cd):</td><td><?php echo $this->Form->input('CANDELA', array('readonly' => 'readonly', 'size' => '4'));?></td>
            </tr>
        </table>
        <table style="width: auto;">
            <td style="vertical-align: top;">
        <label style="color: coral; font-style: italic; font-size: smaller;">Extra</label>
        <table class="erp_extra">
            <tr>
                <td>Shape:</td><td><?php echo $this->Form->input('SHAPE', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Number of LEDs:</td><td><?php echo $this->Form->input('LED_NUMBER', array('readonly' => 'readonly', 'size' => '4'));?></td>
                <td>Type of LED:</td><td><?php echo $this->Form->input('LED_Type', array('readonly' => 'readonly', 'size' => '12'));?></td>
                <td>UV block:</td><td><?php echo $this->Form->input('UV', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'return readOnlyCheckBox()'));?></td>
                <td>ErP Spectrum:</td><td><?php echo $this->Form->input('SPECTRUM', array('readonly' => 'readonly', 'size' => '3'));?></td>
            </tr>
        </table>
        </td>
        <td>
            <?php
                    $erp_spectrum = $directory . "LR_" .$sapWithoutDots . "_34.jpg";
                    if (file_exists(WWW_ROOT . 'img' . DS . $erp_spectrum)) {
                        $data = getimagesize(WWW_ROOT . 'img' . DS . $erp_spectrum);
                        $imgWidth = $data[0];
                        $imgHeight = $data[1];
                        $winWidth = 160;
                        $winHeight = 120;
                        if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                            $newHeight = $winHeight;
                            $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                        } else {
                            $newWidth = $winWidth;
                            $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                        }
                    echo $this->Html->image($erp_spectrum, array(
                            'alt' => 'No Image Available',
                            'style' => 'width:' . $newWidth . 'px;height:' . $newHeight . 'px;'
                        ));
                    } ?>
        </td>
        </table>
        <?php if ($item['Item']['KIND_BULB']=='CFL'):?>
            <p><i><u>*Dispose:</u> Compact fluorescent lamps have to be treated as special waste, they must be taken to your local waste facilities for recycling. The European Lighting Industry has set up an infrastructure, capable of recycling mercury, other metals, glass etc.</i></p>
            <p><i><u>*Clean-up:</u> Breaking a lamp is extremely unlikely to have any impact on your health. If a lamp breaks, ventilate the room for 30 minutes and remove the parts, preferably with gloves. Put them in a closed plastic bag and take it to your local waste facilities for recycling. Do not use a vacuum cleaner.</i></p>
        <?php endif;
        ?>
    </div>
    <div <?php echo 'id="tab'.$tabFolderNum.'"';?>>
        <?php echo $this->element('folderCert', array('certDirectory' => $certDirectory, 'item' => str_replace('/', '_', $item['Item']['ITEM']))); ?>
    </div>
    <div  <?php echo 'id="tab'.$tabPcNum.'"';?>>
        <?php echo $this->element('productContent', array('directory' => $directory, 'sapWithoutDots' => $sapWithoutDots)); ?>
    </div>
    <div <?php echo 'id="tab'.$tabRelatedNum.'"';?>>
        <p>This item is related (by the same supplier's item number) with <?php echo (count($item_supplier)-1)?> following items:</p>        <table class="index">
            <?php
        if ($this->Session->read('Auth.User')):?>
        <th><?php echo $this->Paginator->sort('QM_STATUS', 'QC status');?></th>
        <?php endif;?>
        <th><?php echo $this->Paginator->sort('ITEM', 'Item') ?></th>
        <th><?php echo $this->Paginator->sort('SAP', 'SAP') ?></th>
        <th><?php echo $this->Paginator->sort('DESCR_EN', 'Description') ?></th>
        <th><?php echo $this->Paginator->sort('EAN', 'EAN') ?></th>
        <th><?php echo $this->Paginator->sort('BRAND', 'Brand') ?></th>
        <th><?php echo $this->Paginator->sort('STATUS', 'SAP Status') ?></th>
        <th><?php echo $this->Paginator->sort('VALID_DATE', 'Valid in SAP since') ?></th>
            <?php 
            $i = 0;
            foreach ( $item_supplier as $value ) :
                if ($item_supplier[$i]['Item']['SAP']!==$item['Item']['SAP']){
            ?>
            <tr>
                <?php
                $sapWithoutDots = str_replace(".", "", $item_supplier[$i]['Item']['SAP']);
                $directory = "G" . DS . "S&L_Data" . DS . "Product Content" . DS . "PRODUCTS" . DS . $sapWithoutDots . DS;
                $imgFile2 = $directory . "LR_" . $sapWithoutDots . "_2.jpg";
                $imgFile3 = $directory . "LR_" . $sapWithoutDots . "_3.jpg";
                $imgFile4 = $directory . "LR_" . $sapWithoutDots . "_4.jpg";
                $imgFile10 = $directory . "LR_" . $sapWithoutDots . "_10.jpg";
                if (file_exists(WWW_ROOT . 'img' . DS . $imgFile2)) {
                    $imgFile = $imgFile2;
                } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile3)) {
                    $imgFile = $imgFile3;
                }  elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile4)) {
                    $imgFile = $imgFile4;
                }  else {
                    $imgFile = $imgFile10;
                }
            if ($this->Session->read('Auth.User')):?>
                <td>
            <?php if ($this->Session->read('Auth.User') && AuthComponent::user('group') == 0):
                        echo $this->Form->input($i, array('div' => false, 'label' => false, 'type' => 'checkbox','class' => 'checkbox_related','checked' => 'checked'));
            endif;?>
                    <div style="display:none;"><?php echo $item_supplier[$i]['Item']['QM_STATUS'];?></div>
                    <svg height="16" width="16"><circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="<?php echo $item_supplier[$i]['Item']['QM_STATUS'];?>"/></svg>
                </td>
            <?php endif;?>
                <td><?php echo $this->Html->link($item_supplier[$i]['Item']['ITEM'] . '<span>' . $this->Html->image($imgFile, array('class' => 'callout', 'onerror'=>'this.style.display = "none"')) . '</span>', array('controller' => 'items', 'action' => 'view', $item_supplier[$i]['Item']['ID']), array('escape' => false, 'target' => '_blank')); ?></td>
                <td><?php echo $this->Html->link($item_supplier[$i]['Item']['SAP'] . '<span>' . $this->Html->image($imgFile, array('class' => 'callout', 'onerror'=>'this.style.display = "none"')) . '</span>', array('controller' => 'items', 'action' => 'view', $item_supplier[$i]['Item']['ID']), array('escape' => false, 'target' => '_blank')); ?></td>
                <td><?php echo $item_supplier[$i]['Item']['DESCR_EN']; ?></td>
                <td><?php echo $item_supplier[$i]['Item']['EAN']; ?></td>
                <td><?php echo $item_supplier[$i]['Item']['BRAND']; ?></td>
                <td><?php echo $item_supplier[$i]['Item']['STATUS']; ?></td>
                <td><?php echo $item_supplier[$i]['Item']['VALID_DATE']; ?></td>
            </tr>
                <?php }
                $i++;
                endforeach; 
                ?>
        </table>
        <?php 
        if ($this->Session->read('Auth.User') && (AuthComponent::user('group') == 0 || AuthComponent::user('id') == 19)):
            if ($item['Item']['EUP'] == 1):
                echo $this->Form->postLink();
                echo $this->Form->postLink('COPY certificates & standards', array('action' => 'copyCert', $item['Item']['id']), array('class' => 'button','confirm' => 'Copy all certificates and standards info from this item between choosed items?'));
                echo $this->Form->postLink('COPY ErP', array('action' => 'copyERP', $item['Item']['id']), array('class' => 'button','style'=>'margin-right:250px;','confirm' => 'Copy all ErP info from this item between choosed items?'));
            else:
                echo $this->Form->postLink();
                echo $this->Form->postLink('COPY certificates & standards', array('action' => 'copyCert', $item['Item']['id']), array('class' => 'button','style'=>'margin-right:250px;','confirm' => 'Copy all certificates and standards info from this item between choosed items?'));
            endif;
        endif;?>
    </div>
</div>
<p> <?php if ($this->Session->read('Auth.User')){echo isset($item['Item']['CHECK_DATE']) ? 'Sample checked on: ' . $item['Item']['CHECK_DATE'] : 'Sample not checked yet';?> <span><?php echo 'Modified by ' . $item['Item']['MOD_WHO'] . ' on ' . $item['Item']['MOD_DATE'];}?></span></p>

<div>
    <h4>
        <?php
        if ($this->Session->read('Auth.User') && AuthComponent::user('group') < 2) {
            //echo $this->Html->link('DoC', array('controller' => 'img/DoC/DoC.php?sap='.$item['Item']['SAP'].'&Date='. date("Y-m-d")), array('target' => '_blank', 'class' => 'button'));
            //echo $this->Form->input('DoC_DATE', array('dateFormat' => 'YMD'));
            //echo $this->Time->format("DoC_Date", '%Y.%m.%d');
            //echo 'DoC date:<input id="DoC_date" type="date"/>';
            echo '<span>';
            if (strlen($item['Item']['COMPONENT1']) == 0){
                if (file_exists('img'. DS . $certDirectory . str_replace('/', '_', $item['Item']['ITEM']))){
                    echo $this->Html->link('Folder', array('controller' => 'img'. DS . $certDirectory . str_replace('/', '_', $item['Item']['ITEM'])), array('target' => '_blank', 'class' => 'button'));
                }
            }
            echo $this->Html->link('Edit', array('action' => 'edit', $item['Item']['id']), array('class' => 'button','style'=>'margin-right:800px;'));
//            echo $this->Form->postLink('Delete', array('action' => 'delete', $item['Item']['id']), array('confirm' => 'Are you sure?'));
            echo '</span>';
        }
        ?>
    </h4>
    <?//php echo $this->Form->end(array('label' => 'Close', 'div' => FALSE, 'onclick' => 'closing()')); ?>
</div>