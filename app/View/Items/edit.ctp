<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {

                $('#tab1').find('input, textarea').prop('readonly',false);
                $("#content1 div").hide(); // Initially hide all content
                $("#tabs li:eq(0)").attr("id","current"); // Activate first tab
                $("#content1 div:eq(0)").fadeIn(); // Show first tab content
                $('#tabs a').click(function(e) {
                    e.preventDefault();
                    $("#content1 div").hide(); //Hide all content
                    $("#tabs li").attr("id",""); //Reset id's
                    $(this).parent().attr("id","current"); // Activate this
                    $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab
                });
                
                var cert_type=["#ItemLVD","#ItemPHOTOBIOL","#ItemIPCLASS","#ItemEMC","#ItemRF","#ItemCPD","#ItemEUP","#ItemFLUX","#ItemROHS","#ItemPAH","#ItemREACH"
                    ,"#ItemOEM","#ItemGS","#ItemVDS","#ItemNF","#ItemBOSEC","#ItemKOMO","#ItemKK"];
                for(var i=0; i< cert_type.length; i++) {
                    var chbox=$(cert_type[i]).is(':checked');
                    if (!chbox) {
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
                var str1 = $('#ItemITEMS').val();
                var str2 = $('#ItemITEMSSAP').text();
                var n = str1.localeCompare(str2);
                if (n!=0){
                    $('#ItemITEMSSAP').css("color", "red");
                }

                $('input[type=text],select').each(function(){
                    var text_value=$(this).val();
                    if(text_value=='MISSING'){
                       $(this).css("color", "red");
                    }
                });
                switch($('#ItemKINDBULB').get(0).selectedIndex){
                    case 2: $('#dispose').html("<i><u>*Dispose:</u> Compact fluorescent lamps have to be treated as special waste, they must be taken to your local waste facilities for recycling. The European Lighting Industry has set up an infrastructure, capable of recycling mercury, other metals, glass etc.</i>");
                            $('#cleanup').html("<i><u>*Clean-up:</u> Breaking a lamp is extremely unlikely to have any impact on your health. If a lamp breaks, ventilate the room for 30 minutes and remove the parts, preferably with gloves. Put them in a closed plastic bag and take it to your local waste facilities for recycling. Do not use a vacuum cleaner.</i>"); break;
                    default: $('#dispose,#cleanup').html(""); break;
                }
        })();
        
                function cert_set_text(status,id){
                        if (status===true){
                            if($('#'+id+'DIR').length>0){
                                $('#'+id+'DIR').prop('selectedIndex',1); $('#'+id+'DIR').prop('disabled', !status);
                                if (!$('#' + id + 'CE').val().trim()) {
                                    $('#' + id + 'CE').val('MISSING'); $('#' + id + 'CE').prop('disabled', !status);
                                }
                            } else {
                                $('#' + id + 'CE').prop('selectedIndex', 1); $('#' + id + 'CE').prop('disabled', !status);
                                if ($('#' + id + 'CERT').length > 0 && !$('#' + id + 'CERT').val().trim()) {
                                    if (id === "ItemEMC" || id === "ItemROHS") {
                                        $('#' + id + 'CERT').val('NA');
                                    } else {
                                        $('#' + id + 'CERT').val('MISSING');
                                    }
                                    $('#' + id + 'CERT').prop('disabled', !status);
                                }
                            }
                            if ($('#' + id + 'TR').length > 0 && !$('#' + id + 'TR').val().trim()) {
                                $('#' + id + 'TR').val('MISSING'); $('#' + id + 'TR').prop('disabled', !status);
                            }
                            if ($('#' + id + 'DATE').length > 0) {
                                $('#' + id + 'DATE').prop('disabled', !status);
                            }
                            if ($('#' + id + 'DATEFROM').length > 0) {
                                $('#' + id + 'DATEFROM').prop('disabled', !status);
                            }
                            if ($('#' + id + 'DATETO').length > 0) {
                                $('#' + id + 'DATETO').prop('disabled', !status);
                            }
                            $('#' + id + 'NB').prop('disabled', !status);
                            if ($('#' + id + 'NBN').length > 0) {
                                $('#' + id + 'NBN').prop('disabled', !status);
                            }
                            if ($('#' + id + 'LVD').length > 0 && !$('#' + id + 'LVD').val().trim()) {
                                $('#' + id + 'LVD').val('MISSING'); $('#' + id + 'LVD').prop('disabled', !status);
                            }
                            if ($('#' + id + 'EMC').length > 0 && !$('#' + id + 'EMC').val().trim()) {
                                $('#' + id + 'EMC').val('MISSING'); $('#' + id + 'EMC').prop('disabled', !status);
                            }
                            if ($('#' + id + 'ROHS').length > 0 && !$('#' + id + 'ROHS').val().trim()) {
                                $('#' + id + 'ROHS').val('MISSING'); $('#' + id + 'ROHS').prop('disabled', !status);
                            }
                            if ($('#' + id + 'ERP').length > 0 && !$('#' + id + 'ERP').val().trim()) {
                                $('#' + id + 'ERP').val('MISSING'); $('#' + id + 'ERP').prop('disabled', !status);
                            }

                        } else {
                            if ($('#' + id + 'DIR').length > 0) {
                                $('#' + id + 'DIR').prop('selectedIndex', 0); //$('#' + id + 'DIR').prop('disabled', !status);
                                if ($('#' + id + 'CE').val() === "MISSING") {
                                    $('#' + id + 'CE').val(null); //$('#' + id + 'CE').prop('disabled', !status);
                                }
                            } else {
                                $('#' + id + 'CE').prop('selectedIndex', 0); //$('#' + id + 'CE').prop('disabled', !status);
                                if ($('#' + id + 'CERT').val() === "MISSING" || $('#' + id + 'CERT').val() === "NA") {
                                    $('#' + id + 'CERT').val(null); //$('#' + id + 'CERT').prop('disabled', !status);
                                }
                            }
                            if ($('#' + id + 'TR').val() === "MISSING") {
                                $('#' + id + 'TR').val(""); //$('#' + id + 'TR').prop('disabled', !status);
                            }
                            $('#' + id + 'DATE').val(null); //$('#' + id + 'DATE').prop('disabled', !status);
                            //$('#' + id + 'DATEFROM').prop('disabled', !status);
                            //$('#' + id + 'DATETO').prop('disabled', !status);
                            $('#' + id + 'NB').prop('selectedIndex', 0); //$('#' + id + 'NB').prop('disabled', !status);
                            //$('#' + id + 'NBN').prop('disabled', !status);
                            $('#' + id + 'LVD').prop('selectedIndex', 0);
                            $('#' + id + 'EMC').prop('selectedIndex', 0);
                            $('#' + id + 'ROHS').prop('selectedIndex', 0);
                            $('#' + id + 'ERP').prop('selectedIndex', 0);
                        }
                    }
        function sKindBulb(){
                var sel = document.getElementById('ItemKINDBULB');
                switch(sel.selectedIndex){
                    case 1: $('#ItemKWIK').val("NA"); $('#ItemKWIK').prop('disabled',true);
                            $('#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').val(""); $('#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').prop('disabled',false);
                            $('#ItemUV').prop('checked',false); $('#ItemUV').prop('disabled',true); $('#dispose,#cleanup').html(""); break;
                    case 2: $('#ItemKWIK').val(""); $('#ItemKWIK').prop('disabled',false);
                            $('#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').val("NA"); $('#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').prop('disabled',true);
                            $('#ItemUV').prop('checked',false); 
                            $('#dispose').html("<i><u>*Dispose:</u> Compact fluorescent lamps have to be treated as special waste, they must be taken to your local waste facilities for recycling. The European Lighting Industry has set up an infrastructure, capable of recycling mercury, other metals, glass etc.</i>");
                            $('#cleanup').html("<i><u>*Clean-up:</u> Breaking a lamp is extremely unlikely to have any impact on your health. If a lamp breaks, ventilate the room for 30 minutes and remove the parts, preferably with gloves. Put them in a closed plastic bag and take it to your local waste facilities for recycling. Do not use a vacuum cleaner.</i>"); break;
                    case 3: $('#ItemKWIK,#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').val("NA"); $('#ItemKWIK,#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType').prop('disabled',true);
                            $('#ItemUV').prop('checked',true); $('#ItemUV').prop('disabled',false); $('#dispose,#cleanup').html(""); break;
                    default:$('#ItemKWIK,#ItemCOLORCONS,#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType,#ItemUV').val(""); $('#ItemKWIK,#ItemCOLORCONS,#ItemCOLORCONS,#ItemLEDNUMBER,#ItemLEDType,#ItemUV').prop('disabled',false); 
                            $('#ItemUV').prop('checked',false); $('#ItemUV').prop('disabled',false); $('#dispose,#cleanup').html(""); break;
                }
        }

        function sWatt(val) {
//            $('#ItemLUMEN').focus().select();
                $('#ItemWATTAGERATED').val(Number(val).toFixed(1));
        }
        function sLumen(val) {
                $('#ItemLUMENRATED').val(Number(val).toFixed(0));
        }
        function sLifeTime(val) {
            $('#ItemLIFETIMERATED').val(val);
        }
        function sKelvin() {
            var sel = document.getElementById('ItemKELVIN');
                switch(sel.selectedIndex){
                   case 0: $('#ItemCOLOUR').val(""); break
                   case 1: $('#ItemCOLOUR').val("Warm White"); break
                   case 2: $('#ItemCOLOUR').val("Warm White"); break
                   case 3: $('#ItemCOLOUR').val("Warm White"); break
                   case 4: $('#ItemCOLOUR').val("Warm White"); break
                   case 5: $('#ItemCOLOUR').val("Warm White"); break
                   case 6: $('#ItemCOLOUR').val("Warm White"); break
                   case 7: $('#ItemCOLOUR').val("Warm White"); break
                   case 8: $('#ItemCOLOUR').val("Warm White"); break
                   case 9: $('#ItemCOLOUR').val("Natural White"); break
                   case 10: $('#ItemCOLOUR').val("Natural White"); break
                   case 11: $('#ItemCOLOUR').val("Cool White"); break
                   case 12: $('#ItemCOLOUR').val("Cool White"); break
                   case 13: $('#ItemCOLOUR').val("Cool White"); break
                   case 14: $('#ItemCOLOUR').val("Cool White"); break
                   case 15: $('#ItemCOLOUR').val("Cool White"); break
                   case 16: $('#ItemCOLOUR').val("RGB"); break
                }
        }
        function sBeam(val) {
            $('#ItemBEAMR').val(val);
            if(val===""){
                $('#ItemACCENT').prop('checked',false);
            }else if(val>89 || val==="NA"){
                $('#ItemACCENT').prop('checked',false);
            } else {
                $('#ItemACCENT').prop('checked',true);
            }
        }
        function closing(){
            //window.close();
            window.open('','_self').close();
        }
        
        function commadot(that) {
            if (that.value.indexOf(",") >= 0) {
                that.value = that.value.replace(/\,/g,".");
            }
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
                    <td><?php
                        if ($this->Session->read('Auth.User')) {
                            echo '<label>QC Status:</label>';
                            if (strlen($item['Item']['COMPONENT1']) > 0) {
                                $Red = 0; $Orange = 0; $status = "BLACK";
                                for ($i = 1; $i < 11; $i++) {
                                    if(${'item_comp' . $i}['Item']['QM_STATUS']=='RED'){
                                        $Red++;
                                    } elseif (${'item_comp' . $i}['Item']['QM_STATUS']=='ORANGE') {
                                        $Orange++;
                                    }
                                }
                                if ($Red > 0){
                                    $status = "RED";
                                } elseif ($Orange > 0) {
                                    $status = "ORANGE";
                                } else {
                                    $status = "GREEN";
                                }
                                echo '<div id="qm_status" style="display:none;">' . $status . '</div>';
                                echo '<svg height="20" width="20">' . '<circle cx="10" cy="10" r="10" stroke="black" stroke-width="1" fill="' . $status . '" />' . '</svg>';
                                echo $this->Form->input('QM_STATUS',array('hidden'=>'hidden','value'=>$status));
                            } else{
                                echo '<div id="qm_status" style="display:none;">' . $item['Item']['QM_STATUS'] . '</div>';
                                echo '<svg height="20" width="20">' . '<circle cx="10" cy="10" r="10" stroke="black" stroke-width="1" fill="' . $item['Item']['QM_STATUS'] . '" />' . '</svg>';
                            }
                        }
                        ?></td>
                    <td><?php echo $this->Form->input('ITEM', array('label' => 'Item Nr:', 'size' => '21', 'style' => 'font-size: 20px;')); ?></td>
                    <td><?php echo $this->Form->input('SAP', array('label' => 'SAP Nr:', 'size' => '8', 'style' => 'font-size: 20px;')); ?></td>
                    <td><?php
                        $arrBrand=array(
                            "AJAX"=>"AJAX","ALDI"=>"ALDI","PL AH"=>"PL AH","PL ALDI"=>"PL ALDI","ALPHA"=>"ALPHA","ANSLUT"=>"ANSLUT","PL ANSLUT"=>"PL ANSLUT","ARTON"=>"ARTON",
                            "BASELINE"=>"BASELINE","BAVARIA"=>"BAVARIA","BAVARIA/ELRO"=>"BAVARIA/ELRO","PL BLYSS"=>"PL BLYSS","BYRON"=>"BYRON",
                            "PL CASAYA"=>"PL CASAYA","CHIQUE"=>"CHIQUE",
                            "DIFFERENZ"=>"DIFFERENZ","DUOLEC"=>"DUOLEC","PL DUOLEC"=>"PL DUOLEC",
                            "EATEL"=>"EATEL","PL EATEL"=>"PL EATEL","EDEN"=>"EDEN","EDENPRO"=>"EDENPRO","ELRO"=>"ELRO","ELTRIC"=>"ELTRIC","PL ELTRIC"=>"PL ELTRIC","PL ENCHANTE"=>"PL ENCHANTE","ENERGYCARE"=>"ENERGYCARE","EYSTON"=>"EYSTON",
                            "FIRST ALERT"=>"FIRST ALERT","FLAMINGO"=>"FLAMINGO",
                            "PL GAMMA"=>"PL GAMMA","PL GAMMA / JDB"=>"PL GAMMA / JDB","PL GAMMA / OK"=>"PL GAMMA / OK","PL GAMMA BE"=>"PL GAMMA BE","PL GAMMA NL"=>"PL GAMMA NL",
                            "PL HEMA"=>"PL HEMA","HOFER"=>"HOFER","PL HOFER"=>"PL HOFER","PL HOMEBASE"=>"PL HOMEBASE","HOME EASY"=>"HOME EASY","HOMEEASY"=>"HOMEEASY","HOMEWIZARD"=>"HOMEWIZARD","HOME WIZARD"=>"HOME WIZARD",
                            "IGLOW"=>"IGLOW","PL IGLOW"=>"PL IGLOW","PL INTERTOYS"=>"PL INTERTOYS","PL ISY"=>"PL ISY",
                            "PL KONZUM"=>"PL KONZUM","PL KWANTUM"=>"PL KWANTUM",
                            "LIEF"=>"LIEF","PL LIEF"=>"PL LIEF","PL LUXTOOLS"=>"PL LUXTOOLS",
                            "MAPE"=>"MAPE","MIRO"=>"MIRO","MUMBI"=>"MUMBI","PL MUMBI"=>"PL MUMBI",
                            "PL NEDIS"=>"PL NEDIS","PL NORMA"=>"PL NORMA",
                            "PL OBI"=>"PL OBI",
                            "PL PALATRADE"=>"PL PALATRADE","PL PARTY LIGHTS"=>"PL PARTY LIGHTS","PL POWERTEC"=>"PL POWERTEC","PL PRAKTIKER"=>"PL PRAKTIKER","PRAXIS"=>"PRAXIS","PL PRAXIS"=>"PL PRAXIS","PROMAX"=>"PROMAX","PL PROTEC"=>"PL PROTEC",
                            "RANEX"=>"RANEX",
                            "SAMSUNG"=>"SAMSUNG","PL SCANPART"=>"PL SCANPART","SMARTLIGHTS"=>"SMARTLIGHTS","SMARTWARES"=>"SMARTWARES",
                            "TECHNETIX"=>"TECHNETIX",
                            "UNBRANDED"=>"UNBRANDED",
                            "XQLITE"=>"XQLITE","XQ-LITE BY COSM"=>"XQ-LITE BY COSM","XQLITE BY COSMO"=>"XQLITE BY COSMO",
                            "PL WATSHOME"=>"PL WATSHOME"
                            );
                        echo $this->Form->input('BRAND', array('options'=>$arrBrand, 'label'=>'Brand:', 'selected'=>$item['Item']['BRAND']));
                        ?>
                    </td>
                    <td><?php echo $this->Form->input('VALID_DATE', array('label' => 'Valid in SAP since:', 'size' => '10')); ?></td>
                </tr>
                <tr>
                    <td><?php
                        $arrStatus=array("B1"=>"B1","B3"=>"B3","G0"=>"G0","G1"=>"G1","G2"=>"G2","G3"=>"G3","P1"=>"P1","U0"=>"U0","N/A"=>"N/A");
                        echo $this->Form->input('STATUS', array('options'=>$arrStatus, 'label'=>'SAP Status:', 'selected'=>$item['Item']['STATUS'],'onchange'=>'sStatus()'));
                        $setstatus = $this->request->data['Item']['STATUS'];
                        switch ($setstatus) {
                            case "B1": $s= "<i>   Decline</i>";break;
                            case "B3": $s= "<i>   Purchase block – no successor</i>";break;
                            case "G0": $s= "<i>   ID phase</i>";break;
                            case "G1": $s= "<i>   Introduction phase</i>";break;
                            case "G2": $s= "<i>   Active</i>";break;
                            case "G3": $s= "<i>   op=op (ending)</i>";break;
                            case "P1": $s= "<i>   Promotion item</i>";break;
                            case "U0": $s= "<i>  End of life time</i>";break;
                            case "N/A": $s= "<i>   No SAP no.</i>";break;
                        }
                        echo '<label id="sStatus">'.$s.'</label>';
                        ?>
                        <script>
                        function sStatus() { 
                            var s="";
                            switch (document.getElementById('ItemSTATUS').value) {
                                case "B1": s= "<i>   Decline</i>";break;
                                case "B3": s= "<i>   Purchase block – no successor</i>";break;
                                case "G0": s= "<i>   ID phase</i>";break;
                                case "G1": s= "<i>   Introduction phase</i>";break;
                                case "G2": s= "<i>   Active</i>";break;
                                case "G3": s= "<i>   op=op (ending)</i>";break;
                                case "P1": s= "<i>   Promotion item</i>";break;
                                case "U0": s= "<i>  End of life time</i>";break;
                                case "N/A": s= "<i>   No SAP no.</i>";break;
                            }
                            document.getElementById("sStatus").innerHTML = s;
                        }  
                        </script>
                    </td>
                    <td><?php
                        $arrHierarchy=array("S0100"=>"S0100", "S0200"=>"S0200", "S0300"=>"S0300", "S0400"=>"S0400", "S0500"=>"S0500", "S0600"=>"S0600", "S0900"=>"S0900", "S1000"=>"S1000",
                            "S1100"=>"S1100", "S1200"=>"S1200", "S1300"=>"S1300", "S1400"=>"S1400");
                        echo $this->Form->input('HIERARCHY', array('options'=>$arrHierarchy,'label'=>'Hierarchy:','selected'=>$item['Item']['HIERARCHY'],'onchange'=>'sHierarchy()'));
                        $sethierarchy = $this->request->data['Item']['HIERARCHY'];
                        switch ($sethierarchy) {
                            case "S0100": $h= "<i> Fire (Dennis Hungs / Michiel van de Riet)</i>";break;
                            case "S0200": $h= "<i> Door-entry (Dennis Hungs / Ross Anderson)</i>";break;
                            case "S0300": $h= "<i> Camera (Dennis Hungs / Sven Emmen)</i>";break;
                            case "S0400": $h= "<i> Alarm (Dennis Hungs / Ad Daamen)</i>";break;
                            case "S0500": $h= "<i> Home-automation (Dennis Hungs / Ad Daamen)</i>";break;
                            case "S0600": $h= "<i> Personal care (Dennis Hungs / Sven Emmen)</i>";break;
                            case "S0900": $h= "<i> Other (Dennis Hungs / Michiel van de Riet)</i>";break;
                            case "S1000": $h= "<i> Functional (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                            case "S1100": $h= "<i> Indoor (Mark Lankhaar / Marcel Trouw)</i>";break;
                            case "S1200": $h= "<i> Outdoor (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                            case "S1300": $h= "<i> Bulbs (Mark Lankhaar / Kit YingKong)</i>";break;
                            case "S1400": $h= "<i> Smartlights (Mark Lankhaar / Ad Netten)</i>";break;
                        }
                        echo '<label id="sHierarchy">'.$h.'</label>';
                        ?>
                        <script>
                        function sHierarchy() {
                            var h="";
                            switch (document.getElementById('ItemHIERARCHY').value) {
                                case "S0100": h="<i> Fire (Dennis Hungs / Michiel van de Riet)</i>";break;
                                case "S0200": h="<i> Door-entry (Dennis Hungs / Ross Anderson)</i>";break;
                                case "S0300": h="<i> Camera (Dennis Hungs / Sven Emmen)</i>";break;
                                case "S0400": h="<i> Alarm (Dennis Hungs / Ad Daamen)</i>";break;
                                case "S0500": h="<i> Home-automation (Dennis Hungs / Ad Daamen)</i>";break;
                                case "S0600": h="<i> Personal care (Dennis Hungs / Sven Emmen)</i>";break;
                                case "S0900": h="<i> Other (Dennis Hungs / Michiel van de Riet)</i>";break;
                                case "S1000": h="<i> Functional (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                                case "S1100": h="<i> Indoor (Mark Lankhaar / Marcel Trouw)</i>";break;
                                case "S1200": h="<i> Outdoor (Mark Lankhaar / Jan-Willem Francke)</i>";break;
                                case "S1300": h="<i> Bulbs (Mark Lankhaar / Kit YingKong)</i>";break;
                                case "S1400": h="<i> Smartlights (Mark Lankhaar / Ad Netten)</i>";break;
                            }
                            document.getElementById("sHierarchy").innerHTML = h;
                        }
                        </script>
                    </td>
                    <td><?php echo $this->Form->input('EAN', array('label' => 'EAN:', 'size' => '14')); ?></td>
                    <td><?php echo $this->Form->input('EAN_INN', array('label' => 'EAN inner box:', 'size' => '14')); ?></td>
                    <td><?php echo $this->Form->input('EAN_OUT', array('label' => 'EAN outer box:', 'size' => '14')); ?></td>
                </tr>
                <tr>
                    <td><?php
                            echo $this->Form->input('VENDOR', array('label' => 'Vendor:', 'size' => '4'));
                        ?>
                    </td>
                    <td><?php
                            echo $this->Form->input('SUPPLIER', array('label' => 'Supplier:', 'size' => '36'));
                        ?>
                    </td>
                    <td colspan="2">
                        <?php
                            echo $this->Form->input('ITEM_S', array('label' => 'Supplier item Nr according to certificates:', 'size' => '37'));
                        ?>
                    </td>
                    <td><?php
                            echo $this->Form->label('ITEM_S_SAP', 'Supplier item Nr according to SAP:');
                            if (AuthComponent::user('group') == 0) {
                                echo $this->Form->input('ITEM_S_SAP', array('size' => '37'));
                            } else {
                                echo '<p id="ItemITEMSSAP">' . $item['Item']['ITEM_S_SAP'] . '</p>';
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td><?php echo $this->Form->input('RETURN_PLACE', array('label' => 'Return place:', 'size' => '9')); ?></td>
                    <td><?php echo $this->Form->input('LOCATION', array('label' => 'Pickup location:', 'size' => '8')); ?></td>
                </tr>
            </table>
        </td>
        <td>
                <?php
                $imgFile = $directory . "LR_" . $sapWithoutDots . "_2.jpg";
                $imgFileHR = $directory . "HR_" . $sapWithoutDots . "_2.jpg";
                $imgFile10 = $directory . "LR_" . $sapWithoutDots . "_10.jpg";
                $imgFile10HR = $directory . "HR_" . $sapWithoutDots . "_10.jpg";

                if (file_exists(WWW_ROOT . 'img' . DS . $imgFile)) {
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
                } elseif (file_exists(WWW_ROOT . 'img' . DS . $imgFile10)) {
                    $data = getimagesize(WWW_ROOT . 'img' . DS . $imgFile10);
                    $imgWidth = $data[0];
                    $imgHeight = $data[1];
                    $winWidth = 250;
                    $winHeight = 270;
                    if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                        $newHeight = $winHeight;
                        $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                        $imgFile_new = $imgFile10;
                        $imgFileHR_new = $imgFile10HR;
                    } else {
                        $newWidth = $winWidth;
                        $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                        $imgFile_new = $imgFile10;
                        $imgFileHR_new = $imgFile10HR;
                    }
                }
                ?>
                <?php
                echo $this->Html->link(
                        $this->Html->image($imgFile_new, array(
                            'alt' => 'No Image Available',
                            'style' => 'width:' . $newWidth . 'px;height:' . $newHeight . 'px; margin-left: 20px;'
                        )), array('controller' => 'img' . DS . $imgFileHR_new), array('escape' => false,
                    'target' => '_blank'
                        )
                );
                ?>
        </td>
    </tr>
    <tr>
        <td>
            <table class="descrtable">
                <tr>
                    <td>EN: <?php echo $this->Form->input('DESCR_EN', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                    <td>ES: <?php echo $this->Form->input('DESCR_ES', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                </tr>
                <tr>
                    <td>FR: <?php echo $this->Form->input('DESCR_FR', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                    <td>NL: <?php echo $this->Form->input('DESCR_NL', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                </tr>
                <tr>
                    <td>DE: <?php echo $this->Form->input('DESCR_DE', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                    <td>PL: <?php echo $this->Form->input('DESCR_PL', array('label' => false, 'size' => '64', 'style' => 'font-size: 12px;')); ?></td>
                </tr>
            </table>
        </td>
        <?php
            echo '<td>Authority remarks:<br/>';
            echo $this->Form->textarea('REMARKS_AUTH', array('rows' => '3', 'cols' => '40'));
            echo '</td>';
        ?>
    </tr>
</table>
<?php echo $this->Form->input('HIDDEN', array('div' => false, 'label' => 'DEACTIVATED', 'type' => 'checkbox'));?>    
    <ul id="tabs">
        <li><a href="#" title="tab1">Certificates</a></li>
        <li><a href="#" title="tab2">Standards</a></li>
        <li><a href="#" title="tab3">ErP</a></li>
        <?php 
//        if (strlen($item['Item']['COMPONENT1']) > 0) {
            echo '<li><a href="#" title="tab4">Components</a></li>';
//        }
        ?>
        <li><a href="#" title="tab5">Folder</a></li>
        <li><a href="#" title="tab6">Product Content</a></li>
    </ul>
<div id="content1">
    <div id="tab1">
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
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">LVD</td>
                <td><?php echo $this->Form->input('LVD', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)'));?></td>
                <td><?php echo $this->Form->input('LVD_CE', array('options'=>array("2014/35/EU"=>"2014/35/EU","2006/95/EC"=>"2006/95/EC"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['LVD_CE']));?></td>                
                <td><?php echo $this->Form->input('LVD_CERT', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('LVD_TR', array( 'size' => '45')); ?></td>
<!--                <td><?php echo $this->Form->input('LVD_DATE', array('type' => 'text','title'=>'YYYY-MM-DD','pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))',  'size' => '9')); ?></td>-->
                <td><?php echo $this->Form->input('LVD_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <?php $arrNB=array("BV"=>"BV","CTS"=>"CTS","EMTEK"=>"EMTEK","IECC"=>"IECC","INTERTEK"=>"INTERTEK","KEMA"=>"KEMA","LCS"=>"LCS","SGS"=>"SGS","TUV"=>"TUV","WALTEK"=>"WALTEK");?>
                <td><?php echo $this->Form->input('LVD_NB', array('options'=>$arrNB,'empty' =>'','label'=>false, 'selected'=>$item['Item']['LVD_NB']));?></td>
                <td style="text-align: right; color: blue;">Photobiol.</td>
                <td><?php echo $this->Form->input('PHOTOBIOL', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('PHOTOBIOL_TR', array('options'=>array("EN62471"=>"EN62471","MISSING"=>"MISSING"),'empty'=>'','label'=>false, 'selected'=>$item['Item']['PHOTOBIOL_TR']));?></td>
                <td style="text-align: right; color: blue;">IP</td>
                <td><?php echo $this->Form->input('IPCLASS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('IPCLASS_TR', array('options'=>array("EN60529"=>"EN60529","Inside LVD"=>"Inside LVD","MISSING"=>"MISSING"),'empty'=>'','label'=>false, 'selected'=>$item['Item']['IPCLASS_TR']));?></td>
            </tr>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">EMC</td>
                <td><?php echo $this->Form->input('EMC', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('EMC_CE', array('options'=>array("2014/30/EU"=>"2014/30/EU","2004/108/EC"=>"2004/108/EC"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['EMC_CE']));?></td>
                <td><?php echo $this->Form->input('EMC_CERT', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('EMC_TR', array( 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('EMC_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('EMC_NB', array('options'=>$arrNB,'empty' =>'','label'=>false, 'selected'=>$item['Item']['EMC_NB']));?></td>
            </tr>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">R&TTE</td>
                <td><?php echo $this->Form->input('RF', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('RF_CE', array('options'=>array("2014/53/EU"=>"2014/53/EU","1999/5/EC"=>"1999/5/EC"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['RF_CE']));?></td>
                <td><?php echo $this->Form->input('RF_CERT', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('RF_TR', array( 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('RF_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('RF_NB', array('options'=>$arrNB,'empty' =>'','label'=>false, 'selected'=>$item['Item']['RF_NB']));?></td>
                <td style="text-align: right">N.B. nr</td>
                <td colspan="2"><?php echo $this->Form->input('RF_NBN', array( 'size' => '2')); ?></td>
                <td style="text-align: right">Frequency</td>
                <td colspan="2"><?php echo $this->Form->input('RF_F', array( 'size' => '6')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">Specific</td>
                <td><?php echo $this->Form->input('CPD', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('CPD_DIR', array('options'=>array("(EU) 305/2011"=>"(EU) 305/2011","97/23/EC"=>"97/23/EC","EN50194-1"=>"EN50194-1","EN50291-1"=>"EN50291-1","EN1869"=>"EN1869","2001/95/EC"=>"2001/95/EC","89/686/EEC"=>"89/686/EEC"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['CPD_DIR']));?></td>
                <td><?php echo $this->Form->input('CPD_CE', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('CPD_TR', array( 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('CPD_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('CPD_NB', array('options'=>array("AFNOR"=>"AFNOR","ANPI"=>"ANPI","BRE Global"=>"BRE Global","INTERTEK"=>"INTERTEK","KRIWAN"=>"KRIWAN","VdS"=>"VdS"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['CPD_NB']));?></td>
            </tr>
            <tr>
                <td style="text-align: right; color: blue; font-weight: bold">ErP</td>
                <td><?php echo $this->Form->input('EUP', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td colspan="2"><?php echo $this->Form->input('EUP_CE', array('options'=>array("EU 874/2012"=>"EU 874/2012","EU 1194/2012"=>"EU 1194/2012","EU 1194/2012, 874/2012"=>"EU 1194/2012, 874/2012","EU 1194/2012, 244/2009, 859/2009"=>"EU 1194/2012, 244/2009, 859/2009","EU 1194/2012, 244/2009, 859/2009, 874/2012"=>"EU 1194/2012, 244/2009, 859/2009, 874/2012","EU 244/2009, 859/2009, 874/2012"=>"EU 244/2009, 859/2009, 874/2012","EU 245/2009, 874/2012"=>"EU 245/2009, 874/2012"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['EUP_CE']));?></td>
                <td><?php echo $this->Form->input('EUP_TR', array( 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('EUP_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('EUP_STATUS', array('options'=>array("Initial,1000h"=>"Initial,1000h","2000h"=>"2000h","6000h"=>"6000h"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['EUP_STATUS']));?></td>
                <td style="text-align: right; color: blue;">Flux Rep.</td>
                <td><?php echo $this->Form->input('FLUX', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('FLUX_TR', array('options'=>array("TR"=>"TR","MISSING"=>"MISSING"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['FLUX_TR']));?></td>
            </tr>
            <tr>
                <td style="text-align: right; color: blue;">RoHS</td>
                <td><?php echo $this->Form->input('ROHS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('ROHS_CE', array('options'=>array("2011/65/EU"=>"2011/65/EU","91/338/EEC"=>"91/338/EEC"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['ROHS_CE']));?></td>
                <td><?php echo $this->Form->input('ROHS_CERT', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('ROHS_TR', array( 'size' => '45')); ?></td>
                <td><?php echo $this->Form->input('ROHS_DATE', array('type' => 'text',  'size' => '9')); ?></td>
                <td><?php echo $this->Form->input('ROHS_NB', array('options'=>$arrNB,'empty' =>'','label'=>false, 'selected'=>$item['Item']['ROHS_NB']));?></td>
                <td style="text-align: right; color: blue;">PAH</td>
                <td><?php echo $this->Form->input('PAH', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('PAH_CE', array('options'=>array("ZEK 01.4-08"=>"ZEK 01.4-08","AfPS GS 2014:01 PAK"=>"AfPS GS 2014:01 PAK","MISSING"=>"MISSING"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['PAH_CE']));?></td>
                <td style="text-align: right; color: blue;">REACH</td>
                <td><?php echo $this->Form->input('REACH', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('REACH_CE', array('options'=>array("Declaration"=>"Declaration","1907/2006"=>"1907/2006","MISSING"=>"MISSING"),'empty'=>'', 'label'=>false, 'selected'=>$item['Item']['REACH_CE']));?></td>
                <td style="text-align: right;">Phthalate Rep.</td><td><?php echo $this->Form->input('PHTH', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>            
            </tr>
        </table>
        <table style="width: auto;">
            <tr>
                <td style="text-align: right;">Supplier DoC</td><td><?php echo $this->Form->input('DOC', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td style="text-align: right;">Supplier DoI</td><td><?php echo $this->Form->input('DOI', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">Co-licence/OEM Cert.</td>
                <td><?php echo $this->Form->input('OEM', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('OEM_CE', array( 'size' => '30')); ?></td>
                <td>valid from:<?php echo $this->Form->input('OEM_DATE_FROM', array('type' => 'text',  'size' => '9')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('OEM_DATE_TO', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">GS Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('GS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('GS_CE', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('GS_TR', array( 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('GS_DATE', array('type' => 'text',  'size' => '9')); ?>
                <td>N.B.<?php echo $this->Form->input('GS_NB', array('options'=>$arrNB,'empty' =>'','label'=>false, 'selected'=>$item['Item']['GS_NB']));?></td>
                <td style="text-align: right;">CDF</td><td><?php echo $this->Form->input('GS_CDF', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">VdS Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('VDS', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('VDS_CE', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('VDS_TR', array( 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('VDS_DATE', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">NF Cert.nr/Rep.nr</td>
                <td><?php echo $this->Form->input('NF', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('NF_CE', array( 'size' => '30')); ?></td>
                <td><?php echo $this->Form->input('NF_TR', array( 'size' => '45')); ?></td>
                <td></td>
                <td>valid till:<?php echo $this->Form->input('NF_DATE', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">Bosec/NCP Certificate</td>
                <td><?php echo $this->Form->input('BOSEC', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('BOSEC_CE', array( 'size' => '30')); ?></td>
                <td style="padding-left: 13px">valid till:<?php echo $this->Form->input('BOSEC_DATE', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">FFU/LGA safety Cert.</td>
                <td><?php echo $this->Form->input('KOMO', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('KOMO_CE', array( 'size' => '30')); ?></td>
                <td style="padding-left: 13px">valid till:<?php echo $this->Form->input('KOMO_DATE', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right">Other Cert. / Rep. nr</td>
                <td><?php echo $this->Form->input('KK', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td><?php echo $this->Form->input('KK_CE', array( 'size' => '30')); ?></td>
                <td>valid from:<?php echo $this->Form->input('KK_DATE', array('type' => 'text',  'size' => '9')); ?></td>
            </tr>
        </table>
        <table style="width: auto;">
            <tr>
                <td style="text-align: right">1.Battery Report</td>
                <td><?php echo $this->Form->input('BATT', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <?php $arrBatt=array("2006/66/EC"=>"2006/66/EC","2013/56/EU,2006/66/EC"=>"2013/56/EU,2006/66/EC","Lithium TR"=>"Lithium TR","Excluding"=>"Excluding","MISSING"=>"MISSING");?>
                <td><?php echo $this->Form->input('BATT_M', array('options'=>$arrBatt,'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_M']));?></td>
                <td style="text-align: right">quantity:</td><td><?php echo $this->Form->input('BATT_QUA1', array('type' => 'text','label'=>false,'size' => '1')); ?></td>
                <td style="text-align: right">brand:</td><td><?php echo $this->Form->input('BATT_BRAND1', array('type' => 'text','label'=>false)); ?></td>
                <td style="text-align: right">type:</td><td><?php echo $this->Form->input('BATT_TYPE1', array('options'=>array("Alkaline"=>"Alkaline","Lead-acid"=>"Lead-acid","Lithium"=>"Lithium","Lithium-ion"=>"Lithium-ion","NiCd"=>"NiCd","NiMH"=>"NiMH","Zinc-carbon"=>"Zinc-carbon"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_TYPE1']));?></td>
                <td style="text-align: right">size:</td><td><?php echo $this->Form->input('BATT_SIZE1', array('options'=>array("AA"=>"AA","AAA"=>"AAA","C"=>"C","D"=>"D","9-volt"=>"9-volt","A23"=>"A23","CR123A"=>"CR123A","CR2"=>"CR2","CR2032"=>"CR2032","CR2025"=>"CR2025","CR2450"=>"CR2450","CR2477"=>"CR2477","LR44"=>"LR44","accupack"=>"accupack"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_SIZE1']));?></td>
                <td style="text-align: right">voltage (V):</td><td><?php echo $this->Form->input('BATT_VOLT1', array('type' => 'text','label'=>false,'size' => '4')); ?></td>
                <td style="text-align: right; padding-left: 50px;">rechargeable (accu):</td><td><?php echo $this->Form->input('BATT_ACCU1', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td style="text-align: right">capacity (mAh):</td><td><?php echo $this->Form->input('BATT_CAP1', array('type' => 'text','label'=>false,'size' => '4')); ?></td>
                <td style="text-align: right">non-replaceable:</td><td><?php echo $this->Form->input('BATT_REPL1', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
            </tr>
            <tr>
                <td style="text-align: right;">2.Battery Report</td>
                <td><?php echo $this->Form->input('BATT2', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td><?php echo $this->Form->input('BATT_TR2', array('options'=>$arrBatt,'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_TR2']));?></td>
                <td style="text-align: right">quantity:</td><td><?php echo $this->Form->input('BATT_QUA2', array('type' => 'text','label'=>false,'size' => '1')); ?></td>
                <td style="text-align: right">brand:</td><td><?php echo $this->Form->input('BATT_BRAND2', array('type' => 'text','label'=>false)); ?></td>
                <td style="text-align: right">type:</td><td><?php echo $this->Form->input('BATT_TYPE2', array('options'=>array("Alkaline"=>"Alkaline","Lead-acid"=>"Lead-acid","Lithium"=>"Lithium","Lithium-ion"=>"Lithium-ion","NiCd"=>"NiCd","NiMH"=>"NiMH","Zinc-carbon"=>"Zinc-carbon"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_TYPE2']));?></td>
                <td style="text-align: right">size:</td><td><?php echo $this->Form->input('BATT_SIZE2', array('options'=>array("AA"=>"AA","AAA"=>"AAA","C"=>"C","D"=>"D","9-volt"=>"9-volt","A23"=>"A23","CR123A"=>"CR123A","CR2"=>"CR2","CR2032"=>"CR2032","CR2025"=>"CR2025","CR2450"=>"CR2450","CR2477"=>"CR2477","LR44"=>"LR44","accupack"=>"accupack"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['BATT_SIZE2']));?></td>
                <td style="text-align: right">voltage (V):</td><td><?php echo $this->Form->input('BATT_VOLT2', array('type' => 'text','label'=>false,'size' => '4')); ?></td>
                <td style="text-align: right; padding-left: 50px;">rechargeable (accu):</td><td><?php echo $this->Form->input('BATT_ACCU2', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td style="text-align: right">capacity (mAh):</td><td><?php echo $this->Form->input('BATT_CAP2', array('type' => 'text','label'=>false,'size' => '4')); ?></td>
                <td style="text-align: right">non-replaceable:</td><td><?php echo $this->Form->input('BATT_REPL2', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
            </tr>
        </table> 
        <table class="adaptor">
            <tr>
                <td style="text-align: right">1. Adaptor</td>
                <td><?php echo $this->Form->input('ADAPTOR1', array('div' => false, 'label' => false, 'type' => 'checkbox', 'onClick' => 'cert_set_text(this.checked,this.id)')); ?></td>
                <td style="text-align: right">Model:</td><td> <?php echo $this->Form->input('ADAPTOR1_MODEL');?></td>
                <td style="text-align: right">Type:</td><td> <?php echo $this->Form->input('ADAPTOR_TYPE1',array('options'=>array("Plug-in"=>"Plug-in","Cable"=>"Cable"),'empty' =>'','selected'=>$item['Item']['ADAPTOR_TYPE1']));?></td>
                <td style="text-align: right">Input (V):</td><td> <?php echo $this->Form->input('IN_VOLT1', array('type' => 'text'));?></td>
                <td style="text-align: right">Input (A):</td><td> <?php echo $this->Form->input('IN_AMP1', array('type' => 'text',  'size' => '3'));?></td>
                <td style="text-align: right">In Plug:</td><td> <?php echo $this->Form->input('IN_WATT1', array('type' => 'text',  'size' => '4'));?></td>
                <td style="text-align: right">Output (V):</td><td> <?php echo $this->Form->input('OUT_VOLT1', array('type' => 'text',  'size' => '4'));?></td>
                <td style="text-align: right">Output (A):</td><td> <?php echo $this->Form->input('OUT_AMP1', array('type' => 'text',  'size' => '3'));?></td>
                <td style="text-align: right">Out Plug:</td><td> <?php echo $this->Form->input('OUT_WATT1', array('type' => 'text',  'size' => '4'));?></td>
            </tr>
            <tr>
                <td></td><td></td><td style="text-align: right">- LVD:</td>
                <td><?php echo $this->Form->input('ADAPTOR1_LVD', array('options'=>array("TR OK"=>"TR OK","TR+CB OK"=>"TR+CB OK","Inside LVD"=>"Inside LVD","MISSING"=>"MISSING"),'empty' =>'','label'=>false,'selected'=>$item['Item']['ADAPTOR1_LVD']));?></td> 
            </tr>
            <tr>
                <td></td><td></td><td style="text-align: right">- EMC:</td>
                <td><?php echo $this->Form->input('ADAPTOR1_EMC', array('options'=>array("TR OK"=>"TR OK","Inside EMC"=>"Inside EMC","MISSING"=>"MISSING"),'empty' =>'','label'=>false,'selected'=>$item['Item']['ADAPTOR1_EMC']));?></td> 
            </tr>
            <tr>
                <td></td><td></td><td style="text-align: right">- RoHS:</td>
                <td><?php echo $this->Form->input('ADAPTOR1_ROHS', array('options'=>array("TR OK"=>"TR OK","Inside RoHS"=>"Inside RoHS","MISSING"=>"MISSING"),'empty' =>'','label'=>false,'selected'=>$item['Item']['ADAPTOR1_ROHS']));?></td> 
            </tr>
            <tr>
                <td></td><td></td><td style="text-align: right">- ErP:</td>
                <td><?php echo $this->Form->input('ADAPTOR1_ERP', array('options'=>array("278/2009"=>"278/2009","MISSING"=>"MISSING"),'empty' =>'','label'=>false,'selected'=>$item['Item']['ADAPTOR1_ERP']));?></td> 
            </tr>
            </table>
            <tr>
                <td colspan="9"><?php echo $this->Form->textarea('REMARKS', array('rows' => '4', 'cols' => '120', 'maxlength'=>'200')); ?></td>
            </tr>
        
    </div>
    <div  id="tab2">
        <table class="standards">
            <th style="color:rgb(0,0,255)">EMC Standards</th>
            <th style="color:rgb(0,102,51)">LVD Standards</th>
            <th style="color:rgb(153,51,255)">R&TTE Standards</th>
            <th style="color:rgb(0,102,102)">Other Standards</th>

            <tr>
                <td><?php echo $this->Form->input('EMC1');?></td>
                <td><?php echo $this->Form->input('LVD1');?></td>
                <td><?php echo $this->Form->input('RF1');?></td>
                <td><?php echo $this->Form->input('CPD1');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC2');?></td>
                <td><?php echo $this->Form->input('LVD2');?></td>
                <td><?php echo $this->Form->input('RF2');?></td>
                <td><?php echo $this->Form->input('CPD2');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC3');?></td>
                <td><?php echo $this->Form->input('LVD3');?></td>
                <td><?php echo $this->Form->input('RF3');?></td>
                <td><?php echo $this->Form->input('CPD3');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC4');?></td>
                <td><?php echo $this->Form->input('LVD4');?></td>
                <td><?php echo $this->Form->input('RF4');?></td>
                <td><?php echo $this->Form->input('CPD4');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC5');?></td>
                <td><?php echo $this->Form->input('LVD5');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC6');?></td>
                <td><?php echo $this->Form->input('LVD6');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC7');?></td>
                <td><?php echo $this->Form->input('LVD7');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC8');?></td>
                <td><?php echo $this->Form->input('LVD8');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC9');?></td>
                <td><?php echo $this->Form->input('LVD9');?></td>
            </tr>
            <tr>
                <td><?php echo $this->Form->input('EMC10');?></td>
            </tr>
        </table>
    </div>
    <div  id="tab3">
        <table class="erp_top">
            <tr>
                <td>Kind of lamp:</td><td><?php echo $this->Form->input('KIND_BULB', array('options'=>array("LED"=>"LED","CFL"=>"CFL","HAL"=>"HAL","Incandescent"=>"Incandescent","Luminaire"=>"Luminaire"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['KIND_BULB'],'onchange'=>'sKindBulb()'));?></td>            
                <td>Included bulb:</td><td><?php echo $this->Form->input('INCL', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td></td><td><?php echo $this->Form->input('ITEM_BULB'); ?></td>
                <td>Integrated LED:</td><td><?php echo $this->Form->input('INT_LED', array('div' => false, 'label' => false, 'type' => 'checkbox')); ?></td>
                <td>Special purpose:</td><td colspan="3"><?php echo $this->Form->input('SPECIAL_USE', array('options'=>array("Decorative purpose"=>"Decorative purpose","Refridgerator bulb"=>"Refridgerator bulb","Orientation purpose"=>"Orientation purpose","Toolbox light"=>"Toolbox light"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['SPECIAL_USE']));?></td>
            </tr>
            <tr>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td>Chromaticity coordinates: x=</td><td><?php echo $this->Form->input('COORDX',array('onkeyup'=>'commadot(this)','size' => '5'));?></td>
                <td>, y=</td><td><?php echo $this->Form->input('COORDY', array('onkeyup'=>'commadot(this)','size' => '5'));?></td>
            </tr>
        </table>
        <label style="color: green; font-style: italic; font-size: smaller;">Packaging</label>
        <table class="erp_packing">
            <tr>
                <td>Nominal voltage (V):</td><td><?php echo $this->Form->input('VOLTAGE', array('options'=>array("85-240V~ 50/60Hz"=>"85-240V~ 50/60Hz","100-240V~ 50/60Hz"=>"100-240V~ 50/60Hz","AC 220-240V"=>"AC 220-240V","220-240V~ 50Hz"=>"220-240V~ 50Hz","220-240V~ 50/60Hz"=>"220-240V~ 50/60Hz","230V~ 50Hz"=>"230V~ 50Hz","230V~ 50/60Hz"=>"230V~ 50/60Hz","3.2VDC"=>"3.2VDC","6.4VDC"=>"6.4VDC","12VAC"=>"12VAC","12VAC/DC"=>"12VAC/DC","12VDC/AC 50Hz"=>"12VDC/AC 50Hz","12VDC/AC 50/60Hz"=>"12VDC/AC 50/60Hz","12VDC"=>"12VDC","24VDC"=>"24VDC"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['VOLTAGE']));?></td>
                <td>Switching cycles:</td><td><?php echo $this->Form->input('SWICYC', array('options'=>array("6000"=>"6000","8000"=>"8000","10000"=>"10000","12000"=>"12000","15000"=>"15000","30000"=>"30000","100000"=>"100000"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['SWICYC']));?></td>
                <td>Nominal beam angle(°):</td><td><?php echo $this->Form->input('BEAM', array('onchange'=>'sBeam(this.value)','size' => '4'));?></td>
                <td>Suitable for accent lighting:</td><td><?php echo $this->Form->input('ACCENT', array('div' => false, 'label' => false, 'type' => 'checkbox'));?></td>
            </tr>
            <tr>
                <td>Nominal current (mA):</td><td><?php echo $this->Form->input('AMPERE'); ?></td>
                <td>Color temperature (K):</td><td><?php echo $this->Form->input('KELVIN', array('onchange'=>"sKelvin()",'options'=>array("2000"=>"2000","2200"=>"2200","2400"=>"2400","2500"=>"2500","2700"=>"2700","2800"=>"2800","2900"=>"2900","3000"=>"3000","4000"=>"4000","4100"=>"4100","5000"=>"5000","5600"=>"5600","6000"=>"6000","6400"=>"6400","6500"=>"6500","RGB"=>"RGB"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['KELVIN']));?></td>
                <td>Color rendering Ra:</td><td><?php echo $this->Form->input('RA', array('options'=>array("65"=>"65","80"=>"80","99"=>"99","NA"=>"NA"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['RA']));?></td>
                <td>Dimensions (mm):   Φ(w):</td><td><?php echo $this->Form->input('DIMENSION_FI', array('size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal lamp power (W):</td><td><?php echo $this->Form->input('WATTAGE', array('onchange'=>'sWatt(this.value)'));?></td>
                <td>Energy efficiency class:</td><td><?php echo $this->Form->input('ENCLAS', array('options'=>array("A++"=>"A++","A+"=>"A+","A"=>"A","B"=>"B","C"=>"C","D"=>"D","E"=>"E","NA"=>"NA"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['ENCLAS']));?></td>
                <td>Equivalent (W):</td><td><?php echo $this->Form->input('COMPAR', array('size' => '4')); ?></td>
                <td>Dimensions (mm):   l(h):</td><td><?php echo $this->Form->input('DIMENSION_L', array('size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal luminous flux (lm):</td><td><?php echo $this->Form->input('LUMEN', array('onchange'=>'sLumen(this.value)')); ?></td>
                <td>Warm-up time to 60% (<2s):</td><td><?php echo $this->Form->input('STAR60', array('size' => '14')); ?></td>
                <td>Base / fitting:</td><td><?php echo $this->Form->input('FITTIN', array('options'=>array("B22"=>"B22","E14"=>"E14","E27"=>"E27","G4"=>"G4","G9"=>"G9","G13"=>"G13","G24 (2p)"=>"G24 (2p)","GU5.3"=>"GU5.3","GU10"=>"GU10","GX53"=>"GX53","GY6.35"=>"GY6.35","R7s"=>"R7s","NA"=>"NA"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['FITTIN']));?></td>
                <td>Dimensions (mm):   d:</td><td><?php echo $this->Form->input('DIMENSION_D', array('size' => '4')); ?></td>
            </tr>
            <tr>
                <td>Nominal life time (h):</td><td><?php echo $this->Form->input('LIFETIME', array('onchange'=>"sLifeTime($(this).find('option:selected').text())",'options'=>array("1500"=>"1500","2000"=>"2000","3000"=>"3000","6000"=>"6000","8000"=>"8000","10000"=>"10000","15000"=>"15000","20000"=>"20000","25000"=>"25000","30000"=>"30000"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['LIFETIME']));?></td>
                <td>Dimmable:</td><td><?php echo $this->Form->input('DIMMER', array('options'=>array("No"=>"No","Yes"=>"Yes"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['DIMMER']));?></td>
                <td>Mercury content (mg): <</td><td><?php echo $this->Form->input('KWIK', array('size' => '4')); ?></td>
                <td></td>
            </tr>
        </table>
        <label style="color: blue; font-style: italic; font-size: smaller;">Website</label>
        <table class="erp_web">
            <tr>
                <td>Measured wattage (0.1 W):</td><td><?php echo $this->Form->input('WATTAGE_RATED', array('size' => '6'));?></td>
                <td>Color name:</td><td><?php echo $this->Form->input('COLOUR', array('size' => '11'));?></td>
                <td>Power factor (X.X):</td><td><?php echo $this->Form->input('POWER_FACTOR', array('size' => '4'));?></td>
                <td>Lamp survival factor (>0.90): ></td><td><?php echo $this->Form->input('LICHTB', array('size' => '4'));?></td>
            </tr>
            <tr>
                <td>Measured luminous flux (lm):</td><td><?php echo $this->Form->input('LUMEN_RATED', array('size' => '6'));?></td>
                <td>Rated beam angle(°):</td><td><?php echo $this->Form->input('BEAM_R', array('size' => '11'));?></td>
                <td>Lumen maintenance factor (>0.80): ></td><td><?php echo $this->Form->input('LUMEN_FACTOR', array('size' => '4'));?></td>
                <td>Color consistency (LED only): <</td><td><?php echo $this->Form->input('COLOR_CONS', array('size' => '4'));?></td>
            </tr>
            <tr>
                <td>Measured life time (h):</td><td><?php echo $this->Form->input('LIFETIME_RATED', array('size' => '6'));?></td>
                <td>Indoor / outdoor use:</td><td><?php echo $this->Form->input('INDOOR', array('options'=>array("Indoor"=>"Indoor","Outdoor"=>"Outdoor"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['INDOOR']));?></td>
                <td>Starting time (<0.5s): <</td><td><?php echo $this->Form->input('START_TIME', array('size' => '4'));?></td>
                <td>Rated peak in candela (cd):</td><td><?php echo $this->Form->input('CANDELA', array('size' => '4'));?></td>
            </tr>
        </table>
        <label style="color: coral; font-style: italic; font-size: smaller;">Extra</label>
        <table class="erp_extra">
            <tr>
                <td>Shape:</td><td><?php echo $this->Form->input('SHAPE', array('options'=>array("A55"=>"A55","A60"=>"A60","C37"=>"C37","CF37"=>"CF37","G45"=>"G45","G95"=>"G95","G120"=>"G120","Mini"=>"Mini","MR16"=>"MR16","PAR16"=>"PAR16","PAR20"=>"PAR20","PAR38"=>"PAR38","R39"=>"R39","R50"=>"R50","R63"=>"R63","R80"=>"R80","Spiral"=>"Spiral","R7S"=>"R7S","T8"=>"T8","T26"=>"T26","NA"=>"NA"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['SHAPE']));?></td>
                <td>Number of LEDs:</td><td><?php echo $this->Form->input('LED_NUMBER');?></td>
                <td>Type of LED:</td><td><?php echo $this->Form->input('LED_Type');?></td>
                <td>UV block:</td><td><?php echo $this->Form->input('UV', array('div' => false, 'label' => false, 'type' => 'checkbox'));?></td>
                <td>ErP Spectrum:</td><td><?php echo $this->Form->input('SPECTRUM', array('options'=>array("NA"=>"NA","YES"=>"YES"),'empty' =>'','label'=>false, 'selected'=>$item['Item']['SPECTRUM']));?></td>
            </tr>
        </table>
        <p id="dispose"></p>
        <p id="cleanup"></p>
<!--                </td>
                <td>
                    <?php
                    $erp_spectrum = "G/S&L_Data/QC/Spectrum/LR_" . $sapWithoutDots . "_34.jpg";
                    if (file_exists($erp_spectrum)) {
                        $data = getimagesize($erp_spectrum);
                        $imgWidth = $data[0];
                        $imgHeight = $data[1];
                        $winWidth = 200;
                        $winHeight = 150;
                        if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                            $newHeight = $winHeight;
                            $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                        } else {
                            $newWidth = $winWidth;
                            $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                        }
                        ?>
                        <img src="<?php echo $erp_spectrum ?>" style="width:<?php echo $newWidth ?>px ;height:<?php echo $newHeight ?>px ; margin-left: 20px;"/>
                    <?php } ?>
                </td>
            </tr>
        </table>-->
    </div>
    <div  id="tab4">
        <table class="standards">
            <tr><td><?php echo $this->Form->input('COMPONENT1');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT2');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT3');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT4');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT5');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT6');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT7');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT8');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT9');?></td></tr>
            <tr><td><?php echo $this->Form->input('COMPONENT10');?></td></tr>
        </table>
    </div>
    <div id="tab5">
        <?php echo $this->element('folderCert', array('certDirectory' => $certDirectory, 'item' => str_replace('/', '_', $item['Item']['ITEM']))); ?>
    </div>
    <div  id="tab6">
        <?php echo $this->element('productContent', array('directory' => $directory, 'sapWithoutDots' => $sapWithoutDots)); ?>
    </div>
</div>
<?php echo 'Sample checked on: '.$this->Form->input('CHECK_DATE', array('type' => 'text','title'=>'YYYY-MM-DD','pattern'=>'(?:19|20)[0-9]{2}-(?:(?:0[1-9]|1[0-2])-(?:0[1-9]|1[0-9]|2[0-9])|(?:(?!02)(?:0[1-9]|1[0-2])-(?:30))|(?:(?:0[13578]|1[02])-31))'));?>
<?php 
echo '<div style="float: right; margin-right: 800px;">';
echo $this->Form->end('Save');
echo '</div>';
//    echo $this->Form->end('Cancel');
?>
<h4 style="float: right">
        <?php
        if ($this->Session->read('Auth.User') && AuthComponent::user('group') == 1 || AuthComponent::user('group') == 0) {
    if (strlen($item['Item']['COMPONENT1']) == 0) {
        if (file_exists('img'. DS . $certDirectory . str_replace('/', '_', $item['Item']['ITEM']))){
//            echo $this->Html->link('Folder', array('controller' => 'img' . DS . $certDirectory . str_replace('/', '_', $item['Item']['ITEM'])), array('target' => '_blank', 'class' => 'button'));
        } else {
            echo $this->Form->create(null, array('controller' => 'items', 'action' => 'createFolder','style'=>'display: inline;'));
            echo $this->Form->submit('Create FOLDER', array('div' => false, 'style'=>'color: red;'));
            echo $this->Form->end();
        }
    }
    if (!file_exists('img' . DS . $directory)) {
        echo $this->Form->create(null, array('controller' => 'items', 'action' => 'createPC','style'=>'display: inline;'));
        echo $this->Form->submit('Create PRODUCT CONTENT folder', array('div' => false, 'style'=>'color: red;'));
        echo $this->Form->end();
    }
    echo $this->Html->link('Cancel', array('action' => 'view', $item['Item']['id']), array('class' => 'button'));
}
?>
</h4>